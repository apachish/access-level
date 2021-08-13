<?php

namespace Apachish\AccessLevel\App\Http\Controllers;

use Apachish\AccessLevel\App\Http\Requests\ItemStore;
use Apachish\AccessLevel\App\Http\Resources\ItemCollection;
use Apachish\AccessLevel\App\Jobs\SendEmail;
use Apachish\AccessLevel\App\Models\Item;
use Apachish\AccessLevel\Models\Role;
use Apachish\AccessLevel\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Apachish\AccessLevel\App\Http\Resources\Item as ItemResource;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function sendEmail(Request $request)
    {
        dispatch(new SendEmail());
        return $this->responseData(self::SUCCESS, [], "ارسال شد");
    }

    public function addAuthor(Request $request, $user_id)
    {
        $user = User::find($user_id);

        if ($user == null) return $this->responseData(self::NOTFOUND, []);

        if (!Gate::allows('user-admin', $user)) return $this->responseData(self::INACCESSIBILITY, []);

        $role = Role::where("name","author")->first();

        if ($role == null) return $this->responseData(self::NOTFOUND, []);

        $user->roles()->syncWithoutDetaching($role);

        return $this->responseData(self::SUCCESS, [], "انجام شد");

    }
}
