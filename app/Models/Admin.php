<?php

namespace App\Models;

use App\Enums\NotificationType;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Automatically hash the password when setting it.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function permissions()
{
    $permissionsJson = $this->getAttribute('permissions');
    $permissions = json_decode($permissionsJson, true) ?? [];
    return $permissions;
}

    // public function hasPermission($permission)
    // { 
    //     $permissions = $this->permissions();
    //     return in_array($permission, $permissions);
    // }

}
