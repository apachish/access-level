# access-level
Authentication performed by JWT Have three levels of admin, author and user access The list should only be created by the author admin Each admin has the ability to edit and delete the entire list and each author only has the ability to edit their own list Have an address to display the list to all users There is a section with the possibility of sending emails to all users

##config

config laravel in file *./config/auth.php*

Change the following parameters in the corresponding file 
````
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

````
Change your user model as below
````
<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Rest omitted for brevity

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
}
````


##list api

To register a user:

http://127.0.0.1:8000/api/user/register

header request
````
Accept: application/json
Content-type: application/json
````
body request
````
{
    "name":"shahriar",
    "email":"apachish@gmail.com",
    "password":"12345678",
    "password_confirmation":"12345678"
}
````

resulte request
````
{
    "status": "Success",
    "meta": {
        "code": 200,
        "message": "با موفقیت انجام گردید"
    },
    "data": {
        "user": {
            "id": 2,
            "name": "shahriar",
            "email": "apachish@gmail.com"
        }
    }
}
````

To login a user

http://127.0.0.1:8000/api/user/login

header request
````
Accept: application/json
Content-type: application/json
````
body request
````
{
    "email":"apachish@gmail.com",
    "password":"12345678"
}
````

resulte 

````
{
    "status": "Success",
    "meta": {
        "code": 200,
        "message": "با موفقیت انجام گردید"
    },
    "data": {
        "items": {
            "id": 2,
            "name": "shahriar",
            "email": "apachish@gmail.com"
        },
        "token_detiles": {
            "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6MTYyODc5NTgyOSwiZXhwIjoxNjI4Nzk5NDI5LCJuYmYiOjE2Mjg3OTU4MjksImp0aSI6IlpRZmx1aldkYkFUeVdINWoiLCJzdWIiOjIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.WlEud3yTwVlhYr6YdJQt95b3968A_hqFoz_16b3Hhuk",
            "token_type": "bearer",
            "expires_in": 3600
        }
    }
}
````