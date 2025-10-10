<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'web_access',
        'cell_phone',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }
    public function imageprofile()
    {
        return $this->hasOne('App\Models\ImageProfile');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function user_type_name()
    {
        return $this->hasOne(UserType::class, 'id', 'user_type')->select('id', 'title');
    }

    public function user_type()
    {
        return $this->belongsTo(UserType::class);
    }

    public function hasRole($role_name)
    {
        foreach ($this->roles as $role) {
            if ($role->title == $role_name)
                return true;
        }
        return false;
    }
}
