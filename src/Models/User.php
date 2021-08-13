<?php

namespace Apachish\AccessLevel\Models;

use Apachish\AccessLevel\Database\Factories\UserFactory;
use App\Models\User as BaseUser;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends BaseUser  implements JWTSubject
{


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
}
