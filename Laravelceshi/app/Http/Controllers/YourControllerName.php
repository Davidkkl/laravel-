<?php

namespace App\Http\Controllers;

use App\Models\YourModelName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YourControllerName extends  Controller{
    public function index1(Request $request){//$request 对象来获取请求参数
        $dname = $request->input('dname');//request['id'] 这行代码试图从请求参数中获取名为 id 的值。但是在 Laravel 中，推荐的方式是使用 $request->input('id') 或 $request->id 来获取请求参数。
        $res = YourModelName::FindDate($dname);
        return $res;
    }
}
