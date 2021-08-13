<?php

namespace Apachish\AccessLevel\Database\Seeds;

use Apachish\AccessLevel\Models\Role;
use Apachish\AccessLevel\Models\User;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            "admin"=>[
                "title"=>"admin"
            ],
            "author"=>[
                "title"=>"author"
            ]
        ];
        foreach ($roles as $role) 
            $roles[$role["title"]] =  Role::updateOrCreate(["name"=>$role["title"]],["name"=>$role["title"]]);

        $user = User::where("email",env("ADMIN_USER_EMAIL","apachish@gmail.com"))->first();
        if($user)
            $user->roles()->syncWithoutDetaching($roles["admin"]);
    }
}
