<?php

use App\Http\Controllers\FirstController;
use App\Http\Controllers\ControllerName;
use App\Http\Controllers\YourControllerName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\Login_C;
use App\Http\Controllers\lianxi_C;
use App\Http\Controllers\WdwController;
use App\Http\Controllers\Controllers;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('add',[YourControllerName::class,'index1']);
Route::post('add1',[FirstController::class,'index2']);
Route::post('add2',[ControllerName::class,'index3']);

Route::post('register',[DemoController::class,'register']);
Route::post('Jwtceshi_C',[Login_C::class,'register2']);


Route::post('ceshi',[lianxi_C::class,'lianxi']);
Route::post('login',[lianxi_C::class,'login']);

//界面传入参数
Route::post('add/{id}',function ($id){
    return \App\Models\YourModelName::FindDate($id);
});

//Route::post('first',[WdwController::class,'index3']);

//学习路由的包裹

//Route::post('add', function () {
//    return App\Models\YourModelName::all();
//});

//Route::post('hello',function (){
//    return 'hello laravel';
//})
//mhw
Route::post('/user/register1',[\App\Http\Controllers\CeshiController::class,'add']);

//wdw学生注册
Route::post('/user/register',[WdwController::class,'WdwUserRegister']);
//wdw学生登录
Route::post('/user/login',[WdwController::class,'WdwUserLogin']);
//wdw学生登出
Route::post('/user/logout',[WdwController::class,'UserLogout']);
//wdw学生报名比赛
Route::post('/user/increase',[WdwController::class,'WdwUserProjectIncrease']);
//wdw学生报名项目删除
Route::post('/user/project/delete',[WdwController::class,'WdwUserProjectDelete']);

//wdw老师注册
Route::post('/admin/register',[WdwController::class,'WdwAdminRegister']);
//wdw老师登录
Route::post('/administrator/login',[WdwController::class,'WdwAdminLogin']);

//老师增加比赛项目接口
Route::post('/project/increase',[WdwController::class,'WdwProjectIncrease']);
//老师删除比赛项目接口
Route::post('/project/delete',[WdwController::class,'WdwProjectDelete']);
//老师查询单个学生报名信息
Route::post('/admin/inquire',[WdwController::class,'WdwAdminInquire']);
//老师登接口
Route::post('/admin/logout',[WdwController::class,'AdminLogout']);
//老师删除学生账号(还没实现)
Route::post('/admin/user/account/delete',[WdwController::class,'WdwAccountDelete']);

//表关联
Route::post('/relative/getOne',[Controllers::class,'getOne']);
