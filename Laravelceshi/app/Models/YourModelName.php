<?php

namespace App\Models;

//use App\Http\Controllers\YourControllerName;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class YourModelName extends Model{
    protected $table = "student";
    public $timestamps = false;
    protected $primaryKey = "id";
    protected $guarded = [];


    public static function FindDate($dname)
    {
        //指定删除某个用户的数据
        try {
           $data = YourModelName::where('id','=',$dname)
               ->select('name','sex')
               ->get();
           return $data;
        }catch(Exception $error){
            return 'error'.$error->getMessage();
        }
    }
}

