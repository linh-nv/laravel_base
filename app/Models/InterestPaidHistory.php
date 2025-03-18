<?php

namespace App\Models;

use App\Presenters\InterestPaidHistoryPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;
use Robbo\Presenter\Robbo;

class InterestPaidHistory extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pawn_receipt_id', 'user_id', 'interest_amount', 'payment_round','interest_pay_date','next_round_date', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function pawnReceipt()
    {
        return $this->belongsTo('App\Models\PawnReceipt');
    }

    public function getPresenter()
    {
        return new InterestPaidHistoryPresenter($this);
    }
}
