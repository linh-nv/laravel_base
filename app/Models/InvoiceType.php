<?php

namespace App\Models;

use App\Presenters\InvoiceTypePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class InvoiceType extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_system','created_at', 'updated_at', 'deleted_at',
    ];

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function getPresenter()
    {
        return new InvoiceTypePresenter($this);
    }
}
