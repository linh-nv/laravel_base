<?php

namespace App\Models;

use App\Presenters\InvoicePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;
use App\TraitHelpers\ConfigTrait;

class Invoice extends Model implements PresentableInterface
{
    use SoftDeletes, ConfigTrait;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'invoice_type_id', 'user_id', 'amount', 'date', 'description', 'status_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function invoiceType()
    {
        return $this->belongsTo('App\Models\InvoiceType');
    }

    public function status()
    {
        return new Status('invoice', $this->status_id);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getPresenter()
    {
        return new InvoicePresenter($this);
    }
}
