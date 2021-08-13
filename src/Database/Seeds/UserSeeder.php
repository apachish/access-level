<?php

namespace Apachish\AccessLevel\Database\Seeds;

use Apachish\AccessLevel\Models\Role;
use Illuminate\Database\Seeder;
use Apachish\AccessLevel\Models\User as UserModel;
use Apachish\AccessLevel\Models\Item as ItemModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where("name","author")->first();
        UserModel::factory()->count(5)->create()->each(function ($user) use($role){
            $user->roles()->syncWithoutDetaching($role);
            $user->items()->saveMany(ItemModel::factory()->count(rand(1, 6))->make());
        });
    }
}
