<?php
namespace App\Models;//这是命名空间的声明

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
//use Illuminate\Contracts\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;//DemoModel中使用HasFactory特性，从而可以使用模型工厂来快速创建模型实例。
use Tymon\JWTAuth\Contracts\JWTSubject;

class lianxi_M extends Authenticatable implements JWTSubject {//
    protected $table = "demo_models";
    public $timestamps = true;
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

    //返回一个包含自定义声明的关联数组。
    public function getJWTCustomClaims()
    {
        return [];
    }
}
