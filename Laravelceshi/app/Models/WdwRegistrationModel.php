<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;//引用Authenticatable类使得DemoModel具有用户认证功能
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Exception;

class WdwRegistrationModel extends Authenticatable implements JWTSubject
{//
    protected $table = "registration";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];

    //不知道有什么用
    use HasFactory;

    //使用模型工厂来创建模型实例

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }

    //返回一个包含自定义声明的关联数组。
    public function getJWTCustomClaims()
    {
        return ['role => WdwRegistrationModel'];
    }

    public static function increase($user)
    {
        try {
            $data = WdwRegistrationModel::insert([
                'project_type' => $user['project_type'],
                'project_name' => $user['project_name'],
                'major' => $user['major'],
                'student_ID' => $user['student_ID'],
                'name' => $user['name'],
            ]);
            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    public static function total_sign_up($project)
    {
        try {
            $count = WdwRegistrationModel::select('project_name')
                ->where('project_name', $project['project_name'])
                ->count();

            WdwProjectModel::where('project_name', $project['project_name'])
                ->update([
                    'sign_up_total' => $count,
                ]);
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    public static function Numberofjudgments($user)
    {
        try {
            $count = WdwRegistrationModel::select('student_ID')
                ->where('student_ID', $user['student_ID'])
                ->count();
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    //不能重复报名同一个比赛
    public static function Sametimes($user)
    {
        try {
            $count = WdwRegistrationModel::where('student_ID', $user['student_ID'])
                ->where('project_name', $user['project_name'])
                ->count();
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    //学生删除已报名项目
    public static function userprojectdelete($user)
    {
        try {
            $data = WdwRegistrationModel::where('student_ID', $user['student_ID'])
                ->where('name', $user['name'])
                ->where('major', $user['major'])
                ->where('project_type', $user['project_type'])
                ->where('project_name', $user['project_name'])
                ->delete();
            return $data;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    //老师查询单个学生比赛报名情况
    public static function admininquireUser($user)
    {
        try {
            $data = WdwRegistrationModel::where('major', $user['major'])
                ->where('student_ID', $user['student_ID'])
                ->where('name', $user['name'])
                ->select('project_type', 'project_name', 'major', 'student_ID', 'name')
                ->get();
            return $data;

        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    //将学生参加的报名项目先存起来
    public static function inquireuserproject($user)
    {
        try {
            $data2 = WdwRegistrationModel::where('student_ID', $user['student_ID'])
                ->where('name', $user['name'])
                ->select('project_name')
                ->first();
            return $data2;

        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    //老师删除学生账号的删除学生项目
    public static function adminuserprojectdelete($user)
    {
        try {
            $data2 = WdwRegistrationModel::where('major', $user['major'])
                ->where('class', $user['class'])
                ->where('student_ID', $user['student_ID'])
                ->where('name', $user['name'])
                ->delete();
            return $data2;

        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }

    //老师删除学生账号的统计各项目剩余报名人数
    public static function total_sign_up2($user)
    {
        try {
            $count = WdwRegistrationModel::select('project_name')
                ->where('project_name', $user['project_name'])
                ->count();

            WdwProjectModel::where('project_name', $user['project_name'])
                ->update([
                    'sign_up_total' => $count,
                ]);
            return $count;
        } catch (Exception $e) {
            return 'error' . $e->getMessage();
        }
    }
}

