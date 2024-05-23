<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DemoModel;
use App\Models\Login_M;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class Login_C extends Controller
{
    //用于用户注册和用户登录的功能 register 方法负责创建新用户并生成 JWT
    public function register2(Request $request)
    {
        $userData = [
            'name' => $request->name,
            'password' => $request->password,
            //'password' => Hash::make($request->password),
        ];
        //将name和加密的password传入Logic_M进行寻找
        $user = Login_M::WdwFinddate($userData);
        if($user){
            var_dump("登录成功！！！");
        }else{
            var_dump("登录失败！！！");
        }
        //$dm  = DemoModel::create($credentials);
        //$dm = DemoModel::create($credentials);
        //if ($dm) {
            //对传入的数据进行jwt加密
            // 生成 token
            //$token = JWTAuth::fromSubject($dm);
            //将加密过后的密码存放在数据库中
            //$dm->update(['password' => $token]);
            //DemoModel::FindDate($token);
            //return var_dump($token);
        //}
    }
}
