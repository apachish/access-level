<?php

namespace Apachish\AccessLevel\App\Http\Controllers;

use Apachish\AccessLevel\App\Http\Requests\ItemStore;
use Apachish\AccessLevel\App\Http\Resources\ItemCollection;
use Apachish\AccessLevel\App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Apachish\AccessLevel\App\Http\Resources\Item as ItemResource;

class UsersController extends Controller
{
    public function sendEmail(Request $request)
    {
        
        return $this->responseData(self::SUCCESS, [],"ارسال شد");
    }
}
