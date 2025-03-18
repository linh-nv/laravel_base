<?php


namespace App\Services\PawnReceipt;


use App\Repositories\Customer\CustomerRepository;
use App\Repositories\InterestPaidHistory\InterestPaidHistoryRepository;
use App\Repositories\LoanPaidHistory\LoanPaidHistoryRepository;
use App\Repositories\PawnProduct\PawnProductRepository;
use App\Repositories\PawnReceipt\PawnReceiptRepository;
use App\Repositories\Product\ProductRepository;
use App\Services\FundHistory\FundHistoryService;
use App\Services\Generate\GenerateService;
use App\Services\Statistic\StatisticService;
use App\TraitHelpers\ConfigTrait;
use App\TraitHelpers\DateTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PawnReceiptServiceImp implements PawnReceiptService
{
    use DateTrait, ConfigTrait;

    protected $customerRepository, $pawnReceiptRepository, $productRepository, $generateService, $pawnProductRepository, $interestPaidHistoryRepository, $statisticService, $fundHistoryService, $loanPaidHistoryRepository;

    public function __construct(PawnReceiptRepository $pawnReceiptRepository, CustomerRepository $customerRepository, ProductRepository $productRepository, GenerateService $generateService, PawnProductRepository $pawnProductRepository, InterestPaidHistoryRepository $interestPaidHistoryRepository, StatisticService $statisticService, FundHistoryService $fundHistoryService, LoanPaidHistoryRepository $loanPaidHistoryRepository)
    {
        $this->pawnReceiptRepository = $pawnReceiptRepository;
        $this->customerRepository = $customerRepository;
        $this->productRepository = $productRepository;
        $this->generateService = $generateService;
        $this->pawnProductRepository = $pawnProductRepository;
        $this->interestPaidHistoryRepository = $interestPaidHistoryRepository;
        $this->statisticService = $statisticService;
        $this->fundHistoryService = $fundHistoryService;
        $this->loanPaidHistoryRepository = $loanPaidHistoryRepository;

    }

    public function store($customerInfo, $pawnReceiptInfo, $pawnProducts, $userId)
    {

        DB::beginTransaction();
        try {
            $customerInfo['identify_date'] = $customerInfo['identify_date'] != null ? $this->parseDate($customerInfo['identify_date'], 'd/m/Y', 'Y/m/d') : null;
            if ($customerInfo['phone'] != null) {
                $customer = $this->customerRepository->firstOrCreate(['phone' => $customerInfo['phone']], $customerInfo);
                $pawnReceiptInfo['customer_id'] = $customer->id;
                if ($customerInfo['phone'] != null) {
                    $customer = $this->customerRepository->firstOrCreate(['phone' => $customerInfo['phone']], $customerInfo);
                    $pawnReceiptInfo['customer_id'] = $customer->id;
                    $customer->increment('tab', $pawnReceiptInfo['origin_amount']);
                }
            }

            $pawnDate = Carbon::createFromFormat('d/m/Y', $pawnReceiptInfo['pawn_date']);
            $interestPaymentDate = $pawnDate->copy()->addDays($pawnReceiptInfo['payment_day']);
            $liquidationDate = $interestPaymentDate->copy()->addDays($pawnReceiptInfo['liquidated_day']);
            $pawnReceiptInfo['interest_payment_date'] = $interestPaymentDate->format('Y-m-d');
            $pawnReceiptInfo['liquidation_date'] = $liquidationDate->format('Y-m-d');
            $pawnReceiptInfo['pawn_date'] = $pawnDate->format('Y-m-d');
            $pawnReceiptInfo['user_id'] = $userId;
            $attachedProducts = $pawnReceiptInfo['attached_products'] ?? [];
            $pawnReceiptInfo['attached_products'] = json_encode($attachedProducts);
            $pawnReceiptInfo['code'] = $this->generateService->generateLogicCodeForModel('pawn_receipt', 6, 'BD');;
            $activeProductId = $this->findStatusBySlug('active', 'product')['id'];
            $product = $this->productRepository->firstOrCreate(['name' => $pawnProducts['product_name'], 'category_id' => $pawnProducts['category_id']], ['status_id' => $activeProductId]);
            $pawnReceipt = $this->pawnReceiptRepository->create($pawnReceiptInfo);
            $pawnProductInfo = ['product_id' => $product->id, 'pawn_receipt_id' => $pawnReceipt->id, 'description' => $pawnProducts['product_description']];
            $pawnProduct = $this->pawnProductRepository->create($pawnProductInfo);
            $rootStatistic = $this->statisticService->updateStatisticData(date('Y'), date('m'), date('d'), ['fund_amount' => $pawnReceipt->origin_amount * -1, 'loan_count_new' => 1, 'loan_amount_new' => $pawnReceipt->origin_amount]);
            $this->fundHistoryService->store(['user_id' => $userId, 'invoice_type_id' => 3, 'amount' => $pawnReceipt->origin_amount, 'last_amount' => $rootStatistic->fund_amount, 'fundable_id' => $pawnProduct->pawn_receipt_id, 'date' => now(), 'is_in' => false], 'pawn_receipt');
            DB::commit();
            return $pawnReceipt;

        } catch
        (\Exception $exception) {
            Log::error("Create new pawn receipt has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


    public function payInterest($pawnReceiptId, $interestPaymentInfo, $userId)
    {

        DB::beginTransaction();
        try {
            $pawnReceipt = $this->pawnReceiptRepository->findOrFail($pawnReceiptId);
            $interestPaymentInfo['pawn_receipt_id'] = $pawnReceipt->id;
            $interestPaymentInfo['user_id'] = $userId;
            $interestPaymentDate = Carbon::createFromFormat('Y-m-d', $pawnReceipt->interest_payment_date);
            $interestPaymentInfo['interest_pay_date'] = $this->parseDate($interestPaymentInfo['interest_pay_date'], 'd/m/Y', 'Y-m-d');
            $dayOfRound = $pawnReceipt->payment_day * $interestPaymentInfo['payment_round'];
            $nextRoundDate = $interestPaymentDate->copy()->addDays($dayOfRound);
            $liquidationDate = $nextRoundDate->copy()->addDays($pawnReceipt->liquidated_day);
            $interestPaymentInfo['next_round_date'] = $nextRoundDate->format('Y-m-d');
            $interestPaid = $this->interestPaidHistoryRepository->create($interestPaymentInfo);
            $pawnReceipt->interest_period += $interestPaid->payment_round;
            $pawnReceipt->interest_paid += $interestPaid->interest_amount;
            $pawnReceipt->interest_payment_date = $nextRoundDate->format('Y-m-d');
            $pawnReceipt->liquidation_date = $liquidationDate->format('Y-m-d');
            $pawnReceipt->save();
            $customer = $pawnReceipt->customer;
            if ($customer != null) {
                $customer->increment('tip', $interestPaid->interest_amount);
            }
            $rootStatistic = $this->statisticService->updateStatisticData(date('Y'), date('m'), date('d'), ['fund_amount' => $interestPaid->interest_amount, 'interest_count' => 1, 'interest_amount' => $interestPaid->interest_amount]);
            $this->fundHistoryService->store(['user_id' => $userId, 'invoice_type_id' => 4, 'amount' => $interestPaid->interest_amount, 'last_amount' => $rootStatistic->fund_amount, 'fundable_id' => $interestPaid->id, 'date' => now(), 'is_in' => true], 'interest_paid_history');
            DB::commit();
            return $pawnReceipt;
        } catch
        (\Exception $exception) {
            Log::error("Create interest payment has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function payLoan($pawnReceiptId, $loanInfo, $userId)
    {
        DB::beginTransaction();
        try {
            $pawnReceipt = $this->pawnReceiptRepository->findActivePawnReceipt($pawnReceiptId);
            $loanInfo['pawn_receipt_id'] = $pawnReceipt->id;
            $loanInfo['user_id'] = $userId;
            $loanInfo['loan_payment_date'] = $this->parseDate($loanInfo['loan_payment_date'], 'd/m/Y', 'Y-m-d');
            $pawnReceipt->loan_paid += $loanInfo['loan'];
            $remainLoan = $pawnReceipt->origin_amount - $pawnReceipt->loan_paid;
            if ($remainLoan <= 0) {
                $completedPawnReceiptId = $this->findStatusBySlug('completed', 'pawn_receipt')['id'];
                $pawnReceipt->status_id = $completedPawnReceiptId;
                $remainLoan = 0;
            }
            $pawnReceipt->save();
            $loanInfo['last_loan'] = $remainLoan;
            $loanPaid = $this->loanPaidHistoryRepository->create($loanInfo);
            $rootStatistic = $this->statisticService->updateStatisticData(date('Y'), date('m'), date('d'), ['fund_amount' => $loanPaid->loan, 'loan_count_paid' => 1, 'loan_amount_paid' => $loanPaid->loan]);
            $this->fundHistoryService->store(['user_id' => $userId, 'invoice_type_id' => 5, 'amount' => $loanPaid->loan, 'last_amount' => $rootStatistic->fund_amount, 'fundable_id' => $loanPaid->id, 'date' => now(), 'is_in' => true], 'loan_paid_history');
            DB::commit();
            return $pawnReceipt;
        } catch
        (\Exception $exception) {
            Log::error("Create loan payment has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function getStatisticToday()
    {

    }

}
