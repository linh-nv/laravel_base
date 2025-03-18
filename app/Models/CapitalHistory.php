<?php

namespace App\Models;

use App\Presenters\CapitalHistoryPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class CapitalHistory extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shareholder_id', 'amount', 'last_amount', 'date', 'is_in', 'description', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function shareholder()
    {
        return $this->belongsTo('App\Models\Shareholder')->withTrashed();
    }

    public function getPresenter()
    {
        return new CapitalHistoryPresenter($this);
    }
}
