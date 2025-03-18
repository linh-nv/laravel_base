<?php

namespace App\Rules;

use App\Repositories\System\SystemRepository;
use App\Services\Statistic\StatisticService;
use Illuminate\Contracts\Validation\Rule;

class CheckEnoughFund implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $statisticRepository = app()->make(StatisticService::class);
        $fund = $statisticRepository->findOrCreateRootData();
        return $fund->fund_amount >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __("Tiền trong ngân khố không đủ.");
    }
}
