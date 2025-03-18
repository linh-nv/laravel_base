<?php


namespace App\Services\CapitalHistory;


use App\Repositories\CapitalHistory\CapitalHistoryRepository;
use App\Repositories\Shareholder\ShareholderRepository;
use App\Services\FundHistory\FundHistoryService;
use App\Services\Statistic\StatisticService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CapitalHistoryServiceImp implements CapitalHistoryService
{
    protected $shareholderRepository, $capitalHistoryRepository, $statisticService, $fundHistoryService;

    public function __construct(CapitalHistoryRepository $capitalHistoryRepository, ShareholderRepository $shareholderRepository, FundHistoryService $fundHistoryService, StatisticService $statisticService)
    {
        $this->capitalHistoryRepository = $capitalHistoryRepository;
        $this->shareholderRepository = $shareholderRepository;
        $this->statisticService = $statisticService;
        $this->fundHistoryService = $fundHistoryService;


    }

    public function store($capitalHistory, $userId)
    {
        DB::beginTransaction();
        try {
            $shareholder = $this->shareholderRepository->findOrFail($capitalHistory['shareholder_id']);
            $isIn = $capitalHistory['is_in'];
            $amount = $capitalHistory['amount'];
            $updateAmount = $isIn ? $amount : $amount * -1;
            $shareholder->increment('total_capital', $updateAmount);
            $capitalHistory['last_amount'] = $shareholder->total_capital;
            $capitalHistory = $this->capitalHistoryRepository->create($capitalHistory);
            $rootStatistic = $this->statisticService->updateStatisticData(date('Y'), date('m'), date('d'), ['fund_amount' => $updateAmount]);
            $this->fundHistoryService->store(['user_id' => $userId, 'amount' => $amount,'last_amount'=>$rootStatistic->fund_amount, 'invoice_type_id' => $isIn ? 1 : 2, 'fundable_id' => $capitalHistory->id, 'date' => now(), 'is_in' => $capitalHistory->is_in], 'capital_history');
            DB::commit();
            return $capitalHistory;
        } catch (\Exception $exception) {
            Log::error("Create new capitalHistory has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


}
