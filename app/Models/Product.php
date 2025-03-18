<?php

namespace App\Models;

use App\Presenters\ProductPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Robbo\Presenter\PresentableInterface;

class Product extends Model implements PresentableInterface
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category_id', 'status_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function pawnProducts()
    {
        return $this->hasMany('App\Models\PawnProduct');
    }

    public function getPresenter()
    {
        return new ProductPresenter($this);
    }
}
