<?php

namespace Apachish\AccessLevel\App\Http\Controllers;

use Apachish\AccessLevel\App\Http\Requests\ItemStore;
use Apachish\AccessLevel\App\Http\Requests\LoginRequest;
use Apachish\AccessLevel\App\Http\Requests\RegisterRequest;
use Apachish\AccessLevel\App\Http\Resources\ItemCollection;
use Apachish\AccessLevel\App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Apachish\AccessLevel\App\Http\Resources\User as UserResource;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token_detiles = $this->respondWithToken($token);


        $data = [
            "items" =>   new UserResource(auth()->user()),
            "token_detiles" =>  $token_detiles
        ];

        return $this->responseData(self::SUCCESS, $data);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $data = [
            "user" =>   new UserResource($user)
        ];

        return $this->responseData(self::SUCCESS, $data);
    }


    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token_detiles = $this->respondWithToken(auth()->refresh());
        $data = [
            "items" =>   new UserResource($items),
            "token_detiles" =>  $token_detiles
        ];

        return $this->responseData(self::SUCCESS, $data);
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
