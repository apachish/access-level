# access-level
Authentication performed by JWT Have three levels of admin, author and user access The list should only be created by the author admin Each admin has the ability to edit and delete the entire list and each author only has the ability to edit their own list Have an address to display the list to all users There is a section with the possibility of sending emails to all users

install package 
````
composer require apachish/access-level
````

after install run command install table in database

````
php artisan migrate
````

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
        'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \Apachish\AccessLevel\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

````
I have included a helper command to generate a key for you:

````
php artisan jwt:secret
````

you can create admin by set email in .env parmter `ADMIN_USER_EMAIL`

for create role admin and author and set user admin run command ,The following command
````
php artisan db:seed --class="Apachish\AccessLevel\Database\Seeds\RoleSeeder"
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

all aunder api use header :

````
Accept: application/json
Content-type: application/json
Authorization:Bearer {{access_token}}
````
add user for author use api :

http://127.0.0.1:8000/api/user/add/author/7

list api
![img.png](img.png)
 
