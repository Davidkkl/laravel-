<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth; // 引入 Auth 类

class Login_M extends Authenticatable
{
    protected $table = "jwtceshi2";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    // 对传入的name和加密的password进行判断是否正确，如果正确，返回用户对象；否则返回null
    protected static function WdwFinddate($userData)
    {
        // 查询数据库中是否存在给定的用户名
        $user = static::where('name',  $userData['name'])->first();
        //var_dump(Auth::attempt(['name' => $credentials['name'], 'password' => $credentials['password']]));
        // 如果找到用户，则尝试使用用户凭据进行身份验证
        if ($user && Auth::attempt(['name' => $userData['name'], 'password' => $userData['password']])) {
            return $user; // 密码匹配，返回用户对象
        } else {
            return null; // 用户不存在或密码不匹配，返回null
        }
    }

    // 使用 HasFactory trait
//    use HasFactory;

    // 指定可以批量赋值的属性
//    protected $fillable = [
//        'name',
//        'password',
//    ];
}
