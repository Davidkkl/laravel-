<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    // 设置Guest模型对应的数据表
    protected $table = 'guest';
    // 关闭create_time和update_time字段自动管理
    public $timestamps = false;
    // 设置与guestinfo的关联方法，方法名建议使用被关联表的名字
    public function guestinfo(){
        // hasOne(被关联的名命空间，关联外键，关联的主键)
//        hasOne
//用途：hasOne 用于定义当前模型拥有另一个模型的关系。通常用于表示一对一关系中的“主”方。
//外键位置：外键在另一个模型中。
//方向：另一个模型指向当前模型。
        return $this->hasOne('App\Models\Guestinfo','user_id','id');
    }

    public function Guestbuy(){
        return $this->hasOne(Guestbuy::class,'user_id','id');
    }
}

