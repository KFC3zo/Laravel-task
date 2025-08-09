<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = [
        'name',        // لو عاوز تحتفظ بيه (ممكن تبقى username بدل الاسم)
    'username',    // أضف هذا لو مستخدم
    'email',
    'mobile_number',
    'password',

    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // JWT methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function posts()
{
    return $this->hasMany(Post::class);
}

}
