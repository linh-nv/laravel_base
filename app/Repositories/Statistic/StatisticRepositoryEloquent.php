<?php

namespace App\Repositories\Statistic;

use App\Repositories\Base\RepositoryEloquent;

class StatisticRepositoryEloquent extends RepositoryEloquent implements StatisticRepository
{
    public function getModel()
    {
        return \App\Models\Statistic::class;
    }

    public function findYearData($year)
    {
        return $this->_model->where('year',$year)->whereNull('month')->whereNull('day')->first();
    }

    public function findMonthData($year, $month)
    {
        return $this->_model->where('year',$year)->where('month',$month)->whereNull('day')->first();
    }

    public function findDayData($year, $month, $day)
    {
        return $this->_model->where('year',$year)->where('month',$month)->where('day',$day)->first();
    }
}
