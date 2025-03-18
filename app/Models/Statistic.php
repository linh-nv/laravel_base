<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fund_amount', 'interest_amount', 'interest_count', 'loan_amount_paid', 'loan_count_paid', 'loan_amount_new', 'loan_count_new', 'day', 'month', 'year', 'created_at', 'updated_at',
    ];

}
