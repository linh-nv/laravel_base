<?php

namespace App\Repositories\Statistic;

interface StatisticRepository
{
    public function findYearData($year);

    public function findMonthData($year, $month);

    public function findDayData($year, $month, $day);
}

?>
