<?php

namespace App\Models;

use App\Presenters\FundHistoryPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class FundHistory extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'last_amount', 'invoice_type_id', 'fundable_id', 'fundable_type', 'date', 'is_in', 'description', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }

    public function invoiceType()
    {
        return $this->belongsTo('App\Models\InvoiceType')->withTrashed();
    }

    public function fundable()
    {
        return $this->morphTo();
    }

    public function getPresenter()
    {
        return new FundHistoryPresenter($this);
    }
}
