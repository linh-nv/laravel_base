<?php

namespace App\Models;

use App\Presenters\CustomerPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;


class Customer extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'address',  'identify_region', 'identify_number', 'tab', 'tip', 'identify_date', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function pawnReceipts()
    {
        return $this->hasMany('App\Models\PawnReceipt');
    }

    public function getPresenter()
    {
        return new CustomerPresenter($this);
    }
}
