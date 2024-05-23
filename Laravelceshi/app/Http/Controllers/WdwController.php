<?php

namespace App\Http\Controllers;
use App\Models\WdwAdminRegisterModel;
use App\Models\WdwProjectModel;
use App\Models\WdwRegistrationModel;
use App\Models\WdwUserRegisterModel;
use Illuminate\Http\Request;

class WdwController extends Controller
{
    //学生注册
    protected function WdwUserRegister(Request $request){
        $userdata['student_ID'] = $request['student_ID'];
        $userdata['name'] = $request['name'];
        $userdata['password'] = bcrypt($request['password']);
        $userdata['major'] = $request['major'];
        $userdata['class'] = $request['class'];
        $userdata['token'] = '';

        $student_ID =  $userdata['student_ID'];
        $count = WdwUserRegisterModel::WdwUserCheckNumber($student_ID);
        if($count == 0){
            $dm = WdwUserRegisterModel::WdwcreateUser($userdata);
            if($dm){
                var_dump('账号创建成功');
            }else{
                var_dump('账号创建失败');
            }
        }else{
            var_dump('账号存在，请尝试登录！');
        }
    }

    //学生登录
    protected function WdwUserLogin(Request $request){
        $user['student_ID'] = $request['student_ID'];
        $user['password'] = $request['password'];
        $user['token'] = auth('student')->attempt($user);

        if($user['token']){
            $p = WdwUserRegisterModel::token($user);
            //var_dump($p);
            if($p){
                var_dump('账号登录成功!');
                var_dump($user['token']);
            }else{
                var_dump('token有问题');
            }
        }else{
            var_dump('账号登录失败!');
        }
    }

    //学生登出有问题
//    protected  function UserLogout(){
//        //$dm = $request['judge'];
//       // var_dump($dm);
//       // if($dm){
//            auth('student')->logout();
//            return var_dump('登出成功！');
//      //  }else{
//        //    return var_dump('登出失败！');
//       // }
//    }

    protected function UserLogout(Request $request)
    {
        try {
            // 获取JWT令牌
            //$token = $request->bearerToken();
            $token = $request['token'];
            if ($token) {
                // 尝试使令牌失效
                auth('student')->logout(true); // 参数true确保令牌立即失效

                return response()->json(['message' => '登出成功！'], 200);
            } else {
                return response()->json(['message' => '未找到令牌，登出失败！'], 400);
            }
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => '登出失败，令牌解析错误：' . $e->getMessage()], 500);
        }
    }



    //学生报名项目
    protected  function WdwUserProjectIncrease(Request $request)
    {
        $user['project_type'] = $request['project_type'];
        $user['project_name'] = $request['project_name'];
        $user['major'] = $request['major'];
        $user['student_ID'] = $request['student_ID'];
        $user['name'] = $request['name'];


        //每个项目报名人数限制50人
        //$project_number_total =
        //if () {
            //报名项目不能超过4个
            $p = WdwRegistrationModel::Numberofjudgments($user);
            if ($p < 4) {
                //不能重复报名项目
                $q = WdwRegistrationModel::Sametimes($user);
                if ($q == 1) {
                    var_dump('此项目不能重复报名');
                } else {
                    $d = WdwRegistrationModel::increase($user);
                    if ($d) {
                        var_dump('报名成功');
                        WdwRegistrationModel::total_sign_up($user);
                    } else {
                        var_dump('报名失败');
                    }
                }
            } else {
                var_dump('已报名4个项目了，不能再报名了！');
            }
        //} else {
         //   var_dump('该项目已报满');
        //}
    }

    //学生删除报名项目
    protected  function WdwUserProjectDelete(Request $request){
        $user['project_type'] = $request['project_type'];
        $user['project_name'] = $request['project_name'];
        $user['major'] = $request['major'];
        $user['student_ID'] = $request['student_ID'];
        $user['name'] = $request['name'];

        $dm = WdwRegistrationModel::userprojectdelete($user);
        var_dump($dm);
        if($dm){
            var_dump('项目删除成功');
            WdwRegistrationModel::total_sign_up($user);
        }else{
            var_dump('项目删除失败');
        }
    }
        //老师注册
    protected function WdwAdminRegister(Request $request){
        $admindata['major'] = $request['major'];
        $admindata['account'] = $request['account'];
        $admindata['password'] = bcrypt($request['password']);
        $admindata['token'] = '';
        $account =  $admindata['account'];

        $count = WdwAdminRegisterModel::WdwAdminCheckNumber($account);
        if($count == 0){
            $dm2 = WdwAdminRegisterModel::WdwcreateAdmin($admindata);
            if($dm2){
                var_dump('账号创建成功！');
            }else{
                var_dump('账号创建失败！');
            }
        }else{
            var_dump('账号存在，请尝试登录！');
        }
    }

    //老师登录
    protected function WdwAdminLogin(Request $request){
        $admin['account'] = $request['account'];
        $admin['password'] = $request['password'];
        $admin['token'] = auth('administrator')->attempt($admin);

        if( $admin['token']){
            $p = WdwAdminRegisterModel::token($admin);
            if($p){
                var_dump('账号登录成功!');
                var_dump( $admin['token']);
            }else{
                var_dump('token有问题');
            }
        }else{
            var_dump('账号登录失败!');
        }
    }

    //老师增添比赛项目
    protected  function WdwProjectIncrease(Request $request){
        $project['project_type'] = $request['project_type'];
        $project['project_name'] = $request['project_name'];
        $project['total'] = $request['total'];
        $dm = WdwProjectModel::peojectincrease($project);

        if($dm){
            var_dump('项目添加成功！');
        }else{
            var_dump('项目添加失败！');
        }

        //$d = WdwProjectModel::total($project);


    }

    //老师删除比赛项目
    protected function WdwProjectDelete(Request $request){
        $project['project_type'] = $request['project_type'];
        $project['project_name'] = $request['project_name'];

        $dm = WdwProjectModel::peojectdelete($project);
        if($dm){
            var_dump('比赛项目删除成功！');
        }else{
            var_dump('比赛项目删除失败！');
        }
    }

    //老师查询单个学生报名项目接口
    protected function WdwAdminInquire(Request $request){
        $user['student_ID'] = $request['student_ID'];
        $user['name'] = $request['name'];
        $user['major'] = $request['major'];
        $dm = WdwRegistrationModel::admininquireUser($user);
        //var_dump($dm);
        if($dm->isEmpty()){
            return '未查询到该学生报名信息';
        } else {
            return $dm;
        }
    }

    //老师删除本专业学生的账号
    protected function WdwAccountDelete(Request $request){
        $user['student_ID'] = $request['student_ID'];
        $user['name'] = $request['name'];
        $user['class'] = $request['class'];
        $user['major'] = $request['major'];

        $project = WdwRegistrationModel::inquireuserproject($user);
        var_dump($project);
        dd(1);

        //在删除之前需要知道该学生报名了哪些比赛项目
        $dm1 = WdwRegistrationModel::adminuserprojectdelete($user);
        $dm2 = WdwRegistrationModel::total_sign_up2($user);

        //var_dump($dm);
        if($dm1 && $dm2){

             WdwUserRegisterModel::userdelete($user);
             var_dump('账号删除成功');
        }else{
            var_dump('账号删除失败');
        }
    }

    //老师登出接口
    protected function AdminLogout(Request $request)
    {
        try {
            // 获取JWT令牌
            //$token = $request->bearerToken();
            $token = $request['token'];
            if ($token) {
                // 尝试使令牌失效
                auth('administrator')->logout(true); // 参数true确保令牌立即失效

                return response()->json(['message' => '登出成功！'], 200);
            } else {
                return response()->json(['message' => '未找到令牌，登出失败！'], 400);
            }
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['message' => '登出失败，令牌解析错误：' . $e->getMessage()], 500);
        }
    }
}
