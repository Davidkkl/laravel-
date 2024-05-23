<?php

namespace App\Models;

//use App\Http\Controllers\YourControllerName;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class ModelName extends Model{
    protected $table = "second";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];


    public static function FindDate($dname)
    {
        //指定删除某个用户的数据
        try {
            $data = ModelName::where('id', 1)
                ->get();
            return $data;
        }catch(Exception $error){
            return 'error'.$error->getMessage();
        }

    }
}


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DemoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

// 引入Hash类
use App\Models\WdwUserRegisterModel;
use Tymon\JWTAuth\Facades\JWTAuth;

class WdwController extends Controller
{
    // 用于用户注册和用户登录的功能，register 方法负责创建新用户并生成 JWT
    public function Wdwregister(Request $request)
    {
        $userData = [
            'student_id' => $request->student_id,
            'name' => $request->name,
            'password' => $request->password,
            'major' => $request->major,
            'class' => $request->class,
            // 'password' => Hash::make($request->password),
        ];

        // 创建新用户记录
        //DemoModel 类中并没有名为 create 的方法。 create 方法通常是 Eloquent 模型提供的一种快捷方式，
        //用于在数据库中创建新记录。但是，它并不是 DemoModel 类的成员方法。
        $dm = WdwUserRegisterModel::create($userData);
        $password = $userData['password'];
        if ($dm) {
            // 生成 token
//            $token = JWTAuth::fromSubject($dm);

            // 更新用户密码为 token 的哈希值
            $dm->update(['password' => Hash::make($password)]);

            return var_dump("账号创建成功！！！");
        }
    }
}

