<?php

namespace App\Models;

use App\Presenters\ShareholderPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class Shareholder extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'total_capital', 'user_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function getPresenter()
    {
        return new ShareholderPresenter($this);
    }

}
