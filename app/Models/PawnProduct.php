<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PawnProduct extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'pawn_receipt_id', 'image_url', 'description', 'status_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    public function status()
    {
        return new Status('user', $this->status_id);
    }

    public function pawnReceipt()
    {
        return $this->belongsTo('App\Models\PawnReceipt');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
