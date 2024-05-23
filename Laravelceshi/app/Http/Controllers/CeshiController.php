<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CeshiModel;


class CeshiController extends Controller
{
    public function add(Request $request)
    {
        $data['project_type'] = $request['project_type'];
        $data['project_name'] = $request['project_name'];
        $data ['major'] = $request['major'];
        $data['student_ID'] = $request['student_ID'];
        $data ['name'] = $request['name'];

        $dame = CeshiModel::FindDate($data);
        if ($dame){
            var_dump('报名成功！');
        }else{
            var_dump('报名失败！');
        }

    }

}
