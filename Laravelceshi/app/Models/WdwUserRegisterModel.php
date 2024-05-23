<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;

class WdwUserRegisterModel extends Authenticatable implements JWTSubject {//
    protected $table = "student";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    //不知道有什么用
    use HasFactory;//使用模型工厂来创建模型实例
//    protected $fillable = [
//        'name',
//        'password',
//    ];

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }

    //返回一个包含自定义声明的关联数组。
    public function getJWTCustomClaims()
    {
        return ['role => WdwUserRegisterModel'];
    }

    //检查账号是否存在
    public static function WdwUserCheckNumber($student_ID){
        try {
            $count = WdwUserRegisterModel::select('student_ID')
                ->where('student_id', $student_ID)
                ->count();
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    public static function WdwcreateUser($userdata)
    {
        try {
            $data = WdwUserRegisterModel::insert([
                'student_ID' => $userdata['student_ID'],
                'name' => $userdata['name'],
                'password' => $userdata['password'],
                'major' => $userdata['major'],
                'class' => $userdata['class'],
                'token' => $userdata['token'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return $data;

        } catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    //存放token
    public static function token($user){
        try{
            $d = WdwUserRegisterModel::where('student_ID',$user['student_ID'])
                ->update([
                'token' => $user['token'],
            ]);
            return $d;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    //老师删除学生账号
    public static function userdelete($user)
    {
        try {
            $data1 = WdwUserRegisterModel::where('major',$user['major'])
                ->where('class',$user['class'])
                ->where('student_ID',$user['student_ID'])
                ->where('name',$user['name'])
                ->delete();

            return $data1;
//            $data2 = WdwRegistrationModel::where('major',$user['major'])
//                ->where('class',$user['class'])
//                ->where('student_id',$user['student_id'])
//                ->where('name',$user['name'])
//                ->delete();
//            var_dump($data2);
//
//            if($data1 && $data2){
//                WdwRegistrationModel::total_sign_up($user);
//                return true;
//            }else{
//                return false;
//            }

        } catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}

