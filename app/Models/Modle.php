<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modle extends Model
{
    public  function index($fungsi)
    {    
        $role=method_exists($this, $fungsi);
        if($role){
            $role = $this->$fungsi();
        }else{
            $role = array();
        } 
       
        return $role;
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
    public function perpanjangan()
    {
        if(isset($_POST["submit"])){
            foreach (request()->all() as $e => $f) {
                if ($e != 'id' && $e != 'product_name' && $e != 'submit') {
                    $input[$e] = request()->get($e);
                }
            }
            //penomoran
            $nom = DB::table("transaction")
            ->where("transaction_date", date("Y-m-d"))
            ->orderBy("transaction_id", "DESC")
            ->limit("1")
            ->get();
            if ($nom->count() > 0) {
                $noakhir = $nom->first()->transaction_no;
                $noakh = explode(".", $noakhir);
                if ($noakh[2] > 9999) {
                    $noak = 1;
                } else {
                    $noak = $noakh[2] + 1;
                }
                $noa = str_pad($noak, 4, "0", STR_PAD_LEFT);
            } else {
                $noa = str_pad(1, 4, "0", STR_PAD_LEFT);
            }
            $nomor = array();
            $nomor[1] = "QTH";
            $nomor[2] = date("Ymd");
            $nomor[3] = $noa;
            $nomoran = implode(".", $nomor);
            $input["transaction_no"]=$nomoran;
            $input["transaction_status"]=2;
            $input["transaction_message"]=1;
            $input["transaction_date"]=date("Y-m-d");
            $input["updated_at"]=date("Y-m-d H:i:s");
            DB::table('transaction')->insert($input);
            $input["view0"]="kirimwa";
            $input["view1"]='number=owner&title=Konfirmasi Pembayaran&pesan=Insyaallah kami akan memverikasi pembayaran anda secepat mungkin.&message='.$input["updated_at"].'-- Konfirmasi pembayaran dari '.Auth()->user()->user_name.',  Pembayaran : '.request()->get("product_name").',  Dari Bank : '.$input['transaction_bankpengirim'].',  Ke Bank : '.$input['transaction_bankpenerima'].',  Atas Nama : '.$input['transaction_an'].',  Sejumlah : '.$input['transaction_pay'];
            $data=$input;
        }else{
            $data=array();
        }
        return $data;
    }
}
