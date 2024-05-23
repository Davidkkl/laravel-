<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Exception;
use Illuminate\Support\Facades\DB;

class FirstModel extends Model
{
    //表名
    protected $table = "jwtceshi2";
    //时间戳
    public $timestamps = true;
    //主健
    protected $primaryKey = "id";
    //白名单
    protected $guarded = [];

    public static function FindDate($dname)
    {
//        try{
//            $data = DB::table('raw_test')
//                ->select('id','name','sex')
//                ->get();
//            return $data;
//        }catch (Exception $e){
//            return 'error'.$e->getMessage();
//        }
//        try{
//            $data = DB::table('raw_test')
//                ->where('id','=','2')
//                ->delete();
//            return $data;
//        }catch (Exception $e){
//            return 'error'.$e->getMessage();
//        }
//        try{
//            $data = DB::table('raw_test')
//                ->where('id', '=', '3')
//                ->get();
//            return $data;
//        }catch (Exception $e){
//            return 'error'.$e->getMessage();
//        }
//        try{
//            $data = DB::table('raw_test')
//                ->insert([
//                    'id' => '2',
//                    'name' => 'kill',
//                    'sex' => '1',
//                ]);
//            return $data;
//        }catch (Exception $e){
//            return 'error'.$e->getMessage();
//        }
//    }
//        try{
//            $data = DB::table('raw_test')
//                ->get();
//            return $data;
//        }catch (Exception $e){
//            return 'error'.$e->getMessage();
//        }
//        try{
//            $data = DB::table('raw_test')
//                ->select('id','name','sex')
//                ->where('id','=','4')
//                ->get();
//            return $data;
//        }catch(Exception $e){
//            return 'erroe'.$e->getMessage();
//        }
//    $data = DB::table('raw_test')
//        ->get();
//    return $data;
//        $data = DB::table('raw_test')
//        ->insert([
//            'id' => '1',
//            'name' => 'david',
//            'sex' => '1',
//    ]);
//        return $data;
        $data = DB::table('jwtceshi2')
            ->where('id','3')
            ->update([
                'name'=>'tom'
            ]);
        return $data;

    }
}
