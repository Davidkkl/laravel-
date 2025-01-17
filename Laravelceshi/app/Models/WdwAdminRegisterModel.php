<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;

class WdwAdminRegisterModel extends Authenticatable implements JWTSubject {//
    protected $table = "administrator";
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
        return ['role => WdwAdminRegisterModel'];
    }

    public static function WdwAdminCheckNumber($account){
        try {
            $count = WdwAdminRegisterModel::select('account')
                ->where('account', $account)
                ->count();
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    public static function WdwcreateAdmin($admindata)
    {
        try {
            $data = WdwAdminRegisterModel::insert([
                'major' => $admindata['major'],
                'account' => $admindata['account'],
                'password' => $admindata['password'],
                'token' => $admindata['token'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return $data;

        } catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }

    public static function token($admin){
        try{
            $d = WdwAdminRegisterModel::where('account',$admin['account'])
                ->update([
                    'token' => $admin['token'],
                ]);
            return $d;
        }catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}

