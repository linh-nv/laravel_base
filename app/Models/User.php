<?php

namespace App\Models;

use App\Presenters\UserPresenter;
use App\TraitHelpers\ConfigTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Robbo\Presenter\PresentableInterface;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer $id
 * @property string $name
 * @property string $username
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property integer $type_id
 * @property integer $status_id
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class User extends Authenticatable implements PresentableInterface
{
    use Notifiable, SoftDeletes, ConfigTrait, HasRoles;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'email', 'password', 'status_id', 'created_at', 'updated_at', 'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function getPresenter()
    {
        return new UserPresenter($this);
    }

    public function status()
    {
        return new Status('user', $this->status_id);
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function isActive()
    {
        return $this->status()->slug == 'active';
    }
}
