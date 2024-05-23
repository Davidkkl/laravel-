<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guestinfo extends Model
{
    use HasFactory;
    // 设置Guest模型对应的数据表
    protected $table = 'guestinfo';
    // 关闭create_time和update_time字段自动管理
    public $timestamps = false;
    // 设置与guestinfo的关联方法，方法名建议使用被关联表的名字
    public function guest(){
        // hasOne(被关联的名命空间，关联外键，关联的主键)
//        belongsTo
//用途：belongsTo 用于定义当前模型属于另一个模型的关系。通常用于表示多对一关系中的“多”方，或一对一关系中的从属方。
//外键位置：外键在当前模型中。
//方向：当前模型指向另一个模型。
        return $this->belongsTo('App\Models\Guest','user_id','id');
    }
}

