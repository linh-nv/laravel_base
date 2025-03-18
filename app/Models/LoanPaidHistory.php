<?php

namespace App\Models;

use App\Presenters\LoanPaidHistoryPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class LoanPaidHistory extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pawn_receipt_id', 'user_id', 'loan', 'last_loan', 'loan_payment_date', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function pawnReceipt()
    {
        return $this->belongsTo('App\Models\PawnReceipt');
    }

    public function getPresenter()
    {
        return new LoanPaidHistoryPresenter($this);
    }
}
