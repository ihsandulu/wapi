<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modle extends Model
{
    public  function index($fungsi)
    {     
        if(function_exists($fungsi)){
            $fungsi();
        }else{
            return array();
        }
    }
    public  function semua($item)
    {
        $datathrow = DB::table($item)->orderBy($item . '_name')->paginate(5);
        return $datathrow;
    }
    public  function cari($item, $search)
    {
        switch ($item) {
            case "product":
                $datathrow = DB::table($item)->where('product_name', 'like', '%' . $search . '%')->orderBy('product_name')->paginate(50);
            break;
            case "layanandetail":
                $datathrow = DB::table($item)->where('product_name', 'like', '%' . $search . '%')->orderBy('product_name')->paginate(50);
            break;
            default:
                $datathrow = DB::table($item)->where($item . '_name', 'like', '%' . $search . '%')->orderBy($item . '_name')->paginate(50);
            break;
        }
        // @dd($datathrow);
        return $datathrow;
    }
    public function posisi($user_id)
    {
        $posisis = db::table('user')->where('user_id', $user_id)->get();
        $posisinya = 0;
        foreach ($posisis as $posisi) {
            $posisinya = $posisi->position_id;
        }
        return $posisinya;
    }
    public function layanandetail()
    {
        return array();
    }
}
