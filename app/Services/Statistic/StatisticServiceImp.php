<?php


namespace App\Services\Statistic;


use App\Repositories\Statistic\StatisticRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StatisticServiceImp implements StatisticService
{
    protected $statisticRepository;

    public function __construct(StatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;

    }

    public function store($statistic)
    {

        DB::beginTransaction();
        try {
            $statistic = $this->statisticRepository->create($statistic);
            DB::commit();
            return $statistic;
        } catch (\Exception $exception) {
            Log::error("Create new statistic has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function findOrCreateRootData()
    {
        DB::beginTransaction();
        try {
            $statistic = $this->statisticRepository->firstOrCreate(['year' => null, 'month' => null, 'day' => null], []);
            DB::commit();
            return $statistic;
        } catch (\Exception $exception) {
            Log::error("Create new root statistic has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function findOrCreateYearData($year)
    {
        DB::beginTransaction();
        try {
            $statistic = $this->statisticRepository->firstOrCreate(['year' => $year, 'month' => null, 'day' => null], []);
            DB::commit();
            return $statistic;
        } catch (\Exception $exception) {
            Log::error("Create new year statistic has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function findOrCreateMonthData($year, $month)
    {
        DB::beginTransaction();
        try {
            $statistic = $this->statisticRepository->firstOrCreate(['year' => $year, 'month' => $month, 'day' => null], []);
            DB::commit();
            return $statistic;
        } catch (\Exception $exception) {
            Log::error("Create new month statistic has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

    public function findOrCreateDayData($year, $month, $day)
    {
        DB::beginTransaction();
        try {
            $statistic = $this->statisticRepository->firstOrCreate(['year' => $year, 'month' => $month, 'day' => $day], []);
            DB::commit();
            return $statistic;
        } catch (\Exception $exception) {
            Log::error("Create new day statistic has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }


    public function updateIncrementStatisticData($statistic, $updateStatisticData)
    {
        $statistic->fund_amount += $updateStatisticData['fund_amount'] ?? 0;
        $statistic->interest_amount += $updateStatisticData['interest_amount'] ?? 0;
        $statistic->loan_amount_paid += $updateStatisticData['loan_amount_paid'] ?? 0;
        $statistic->loan_amount_new += $updateStatisticData['loan_amount_new'] ?? 0;
        $statistic->interest_count += $updateStatisticData['interest_count'] ?? 0;
        $statistic->loan_count_paid += $updateStatisticData['loan_count_paid'] ?? 0;
        $statistic->loan_count_new += $updateStatisticData['loan_count_new'] ?? 0;
        $statistic->save();
        return $statistic;
    }

    public function updateStatisticData($year, $month, $day, $updateStatisticData)
    {
        DB::beginTransaction();
        try {
            $dayStatistic = $this->findOrCreateDayData($year, $month, $day);
            $this->updateIncrementStatisticData($dayStatistic, $updateStatisticData);

            $monthStatistic = $this->findOrCreateMonthData($year, $month);
            $this->updateIncrementStatisticData($monthStatistic, $updateStatisticData);

            $yearStatistic = $this->findOrCreateYearData($year);
            $this->updateIncrementStatisticData($yearStatistic, $updateStatisticData);

            $rootStatistic = $this->findOrCreateRootData();
            $rootStatistic = $this->updateIncrementStatisticData($rootStatistic, $updateStatisticData);
            DB::commit();
            return $rootStatistic;
        } catch (\Exception $exception) {
            Log::error("Update statistic has error: " . $exception->getMessage());
            Log::info($exception->getTraceAsString());
            DB::rollBack();
            return false;
        }
    }

}
