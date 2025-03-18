<?php

namespace App\Models;

use App\Presenters\PawnReceiptPresenter;
use App\TraitHelpers\ArrayTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class PawnReceipt extends Model implements PresentableInterface
{
    use SoftDeletes, ArrayTrait;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'customer_id', 'name', 'phone', 'address', 'user_id', 'origin_amount', 'loan_paid', 'interest_percent', 'interest_amount', 'interest_paid', 'interest_period', 'identify_region', 'identify_number', 'identify_date', 'pawn_date', 'interest_payment_date', 'liquidation_date', 'liquidated_day', 'payment_day', 'note', 'attached_products', 'status_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function getPresenter()
    {
        return new PawnReceiptPresenter($this);
    }

    private const CODE_COL = 'code';

    private const CODE_PREFIX = 'BK';

    public function getCodeColumn()
    {
        return self::CODE_COL;
    }

    public function getCodePrefix()
    {
        return self::CODE_PREFIX;
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function pawnProducts()
    {
        return $this->hasMany('App\Models\PawnProduct');
    }


    public function pawnProduct()
    {
        return $this->hasOne('App\Models\PawnProduct');
    }

    public function status()
    {
        return new Status('pawn_receipt', $this->status_id);
    }

    public function getAttachedProductsAttribute($value)
    {
        return json_decode($value);

    }

    public function interestPaidHistories()
    {
        return $this->hasMany('App\Models\InterestPaidHistory');
    }
    public function loanPaidHistories()
    {
        return $this->hasMany('App\Models\LoanPaidHistory');
    }
}
