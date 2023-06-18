<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    /**
    * @bodyParam email string required The email of the user. Example: admin@gmail.com
    * @bodyParam password string required The password of the user. Example: password
    * @response {"status":"Request was successful.","message":"Successfully logged in","result":{"user":{"id":1,"name":"Admin User","email":"admin@gmail.com","email_verified_at":"2023-06-18T14:22:34.000000Z","created_at":"2023-06-18T14:22:34.000000Z","updated_at":"2023-06-18T14:22:34.000000Z"},"token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiN2FkZjcyZDU1MmNjZTcwMzk3N2NjM2Y5YzZlNmFhODk2NzY4NDY0ZDczYWE5ZTBkOGUyM2MzNjdjNDI3MjE5ZjYwYzRmNzQ4NzBhMTdkNjEiLCJpYXQiOjE2ODcwOTk2MzcuMDYzNTM3LCJuYmYiOjE2ODcwOTk2MzcuMDYzNTM4LCJleHAiOjE3MTg3MjIwMzcuMDU4ODMzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.BModeTvViAKZhCkiGZZr7j7cfSDvGzNh38ewdNdUXZdNF2pOLVTJs-DOA81BfAcRf5awirFlgJ9YK5uuFuWcDOg9YbFLTIKZop_Y56tTt0vdv4Li6ZFqPqZA8aWrZg6qtKlAcONNMm-StZScT6-ks897i86GGjbvHQU8PsBb5oqPLYW8G-259Go81Mv3dYWdH0joB9Kf5GRTpzw4JmzRokNEZjF2vRebSjGePQc1VYNHv_ODELQtpo_TDD4MX4Xnp9jhqcsQp8y3zdJ749PuXwRvAHSMTWrhLk-2MSnAC-xlbSc3EXdyfSCYGtCWD9FZXHnqRdVVWpIi-FW78YA9AtbWWrPbIWV-ejXVOIIoh-7sX89xGJ21d8NHAWwWr6AVdf51GJTifJBjsR765553UVNPxy-SFJBj5_L6sM4s2VK-HitGn5OBJJq7PVGX5r2DoMnixkj-SLURJXYyBOH2b-xeo08ZLBV_q-_6hWAs85_Fbp8SJoxTHDg82XjOznvlsxORMMjKG15g6e24zwIoykdc5jdKT6IrDd9CY207azi7-BQnZTSdAN-9pO32DVotLPLgHAhWovmCTeTqns1jyckbJhrOpZZV8UlpG41E4tWZOFFBuHWl9OPT2X1RoSku4hW63LDeiZuG-IY5h9ODVB_aBUb8yiZYUCFJtzmUnhc"}}
    * @response 401 {"status":"Error has occurred.","message":"Unauthorized login","result":null}
    **/
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken('User Token')->accessToken;

            return $this->success(['user' => $user , 'token' => $token], 'Successfully logged in');
        } else {
            return $this->error(null, 'Unauthorized login', 401);
        }
    }


    /**
    * @header Authorization Bearer {token}
    * @response {"status":"Request was successful.","message":"User Details","result":{"id":1,"name":"Admin User","email":"admin@gmail.com","email_verified_at":"2023-06-18T14:22:34.000000Z","created_at":"2023-06-18T14:22:34.000000Z","updated_at":"2023-06-18T14:22:34.000000Z"}}
    * @response 401 {"message":"Unauthenticated."
    * @authenticated
    **/
    public function getMe()
    {
        $user = Auth::user();
        return $this->success($user, 'User Details');
    }

    /**
    * @header Authorization Bearer {token}
    * @response {"status":"Request was successful.","message":"Successfully logout","result": null}
    * @response 401 {"message":"Unauthenticated."}
    * @authenticated
    **/
    public function logout()
    {
        $user = Auth::user();
        $user->token()->revoke();
        return $this->success(null, 'Successfully Logout');
    }
}
