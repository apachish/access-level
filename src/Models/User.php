<?php

namespace Apachish\AccessLevel\Models;

use Apachish\AccessLevel\Database\Factories\UserFactory;
use App\Models\User as BaseUser;

class User extends BaseUser 
{

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
