<?php


namespace App\Services\Statistic;


interface StatisticService
{
    public function findOrCreateRootData();

    public function findOrCreateYearData($year);

    public function findOrCreateMonthData($year, $month);

    public function findOrCreateDayData($year, $month, $day);

    public function updateStatisticData($year, $month, $day, $updateStatisticData);
}
