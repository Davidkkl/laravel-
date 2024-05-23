<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Guestinfo;
use App\Models\Guestbuy;


class Controllers extends Controller
{
    //
    public function getOne(Request $request){

        $data = Guest::find(2)->Guestbuy;
        return $data;
        //$username = $request['username'];
        $id = $request['id'];

        //一对一
        // 通过关联方法获取guest表中username = Tom记录在guestinfo对应的记录
        // ->guestinfo 是Guest模型文件里面定义的guestinfo方法
        //$guestInfo = Guest::firstWhere('username',$username)->guestinfo;
        // 通过关联方法获取guestinfo中id=2 记录在guest表中的对应记录
        //$data = Guestinfo::find($id)->guest;

       // dump($guestInfo->toArray());
        // 将模型转换成数组
       // dump($data->toArray());

        //一对多
        $guest = Guest::find($id);
        //dump($guest);
        $guestinfo = $guest->guestinfo;
        $gusetbuy = $guest->guestbuy;
        //var_dump($guestinfo);
        //var_dump($gusetbuy);
        dump($guestinfo->toArray());
        dump($gusetbuy->toArray());
    }
}

