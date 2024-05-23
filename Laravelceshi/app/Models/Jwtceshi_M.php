<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;

class Jwtceshi_M extends Authenticatable implements JWTSubject {//
    protected $table = "jwtceshi";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    use HasFactory;//使用模型工厂来创建模型实例
    protected $fillable = [
        'name',
        'password',
    ];

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }

    public static function FindDate($token)
    {
        //指定删除某个用户的数据
        try {
            $data = Jwtceshi_M::where('id','1')
                ->updata([
                    'password'=>$token,
                ]);
            return $data;
        }catch(Exception $error){
            return 'error'.$error->getMessage();
        }

    }

    //返回一个包含自定义声明的关联数组。
    public function getJWTCustomClaims()
    {
        return [];
    }
}
