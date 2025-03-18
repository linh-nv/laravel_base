<?php


namespace App\Services\FundHistory;


use App\Repositories\FundHistory\FundHistoryRepository;
use App\TraitHelpers\StringTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FundHistoryServiceImp implements FundHistoryService
{
    use StringTrait;

    protected $fundHistoryRepository;

    public function __construct(FundHistoryRepository $fundHistoryRepository)
    {
        $this->fundHistoryRepository = $fundHistoryRepository;

    }

    public function store(array $fundHistory, $modelSlug = null)
    {
        DB::beginTransaction();
        try {
            if ($modelSlug) {
                $fundableType = $this->convertToModelable($modelSlug);
                $fundHistory['fundable_type'] = $fundableType;
            }
            $fundHistoryCreated = $this->fundHistoryRepository->create($fundHistory);
            DB::commit();
            return $fundHistoryCreated;
        } catch (\Exception $exception) {
            Log::error("Create new fund history has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

}
