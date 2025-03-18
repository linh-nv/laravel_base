<?php

namespace App\Models;

use App\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class Category extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'recommend_amount', 'payment_day', 'liquided_day', 'description', 'status_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function status()
    {
        return new Status('category', $this->status_id);
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function getPresenter()
    {
        return new CategoryPresenter($this);
    }
}
