<?php

namespace Apachish\AccessLevel\Models;

use Apachish\AccessLevel\Database\Factories\ItemsFactory;
use Apachish\AccessLevel\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ["title","description","user_id"];

    protected static function newFactory()
    {
        return ItemsFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
