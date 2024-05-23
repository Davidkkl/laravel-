<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jwtceshi_M;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class Jwtceshi_C extends Controller
{
    //用于用户注册和用户登录的功能 register 方法负责创建新用户并生成 JWT
    public function register(Request $request)
    {
        $credentials = [
            'name' => $request->name,
            'password' => $request->password
        ];

        $dm = Jwtceshi_M::create($credentials);
        if ($dm) {
            //对传入的数据进行jwt加密
            // 生成 token
            $token = JWTAuth::fromSubject($dm['password']);
            //将加密过后的密码存放在数据库中
            Jwtceshi_M::FindDate($token);
            return var_dump($token);
        }
    }
}
    //负责验证用户发送的JWT是否有效
//    public function login(Request $request)
//    {
//        //返回的是一个布尔表达式
//        // 验证 token
//        return var_dump((JWTAuth::parseToken()->check()));
//    }

