<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;

class CeshiModel extends Authenticatable implements JWTSubject {//
    protected $table = "ceshi2";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    //不知道有什么用
    use HasFactory;//使用模型工厂来创建模型实例

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }

    //返回一个包含自定义声明的关联数组。
    public function getJWTCustomClaims()
    {
        return ['role => CeshiModel'];
    }

    public static function FindDate($date)
    {
        try {
            $data = DB::table('ceshi2')->insert([
                'project_type' => $date['project_type'],
                'project_name' => $date['project_name'],
                'major' => $date['major'],
                'student_ID' => $date['student_ID'],
                'name' => $date['name'],
            ]);
            return $data;
        }catch (Exception $e){
            return 'error'.$e->getMessage();
        }
    }
}
