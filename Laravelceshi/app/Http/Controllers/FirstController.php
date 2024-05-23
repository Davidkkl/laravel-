<?php

namespace App\Http\Controllers;

use App\Models\FirstModel;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function index2(Request $request)
    {
        $dname = $request['dname'];
        $res = FirstModel::FindDate($dname);
        return $res;
    }

}
