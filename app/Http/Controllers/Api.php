<?php

namespace App\Http\Controllers;

use App\Models\Modle;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Break_;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Api extends Controller
{
    public function index()
    {
        echo "halo";
    }
    public function aa()
    {
        // @dd($parameters);
        echo "aa";
    }
    public function bb()
    {
        echo "bb";
    }
    public function getallclientwa()
    {
        $client=DB::table('tranprod')
        ->where('tranprod_active','1')
        ->get();
        // echo $client->dd();
        return response()->json($client);
    }
    public function updateallclientwa()
    {
        $clients=DB::table('tranprod')
        ->where('tranprod_active','1')
        ->get();
        foreach ($clients as $client) {
           if(date("Y-m-d")>$client->tranprod_outdate){
            $input["tranprod_active"]=0;
            DB::table('tranprod')
            ->where('tranprod_id',$client->tranprod_id)
            ->update($input);
           }
        }        
    }    

    public function token(){
        $input["user_email"]=request()->get("email");
        $password=request()->get("password");
        $login=DB::table('user')
        ->where($input)
        ->get();
        // echo $login->count();
        if($login->count()>0){
            foreach ($login as $value) {
                if (Hash::check($password,$value->password)) {
                    $data["status"]=Hash::check($password,$value->password);
                    $data["message"]="Data Valid";
                    $data["token"]=md5(date("d").substr($value->password,6).date("Ym"));
                    return response()->json($data, 200);  
                }else{
                    $data["status"]=Hash::check($password,$value->password);
                    $data["message"]="Data Invalid";
                    return response()->json($data, 401);  
                }
            }
        }else{
            $data["status"]=Hash::check($password,$value->password);
            $data["message"]="Data tidak ditemukan!";
            return response()->json($data, 401); 
        }
    }

    public function cektoken(){
        $akses=0;
        $input["user_email"]=request()->get("email");
        $token=request()->get("token");
        $login=DB::table('user')
        ->where($input)
        ->get();
         
        if($login->count()>0){
            foreach ($login as $value) {
                $tokenasli=md5(date("d").substr($value->password,6).date("Ym"));
                if($tokenasli==$token){
                    $data["message"]="Token Valid";
                    $data["status"]=true;  
                    return response()->json($data, 200);              
                }else{
                    $data["message"]="Token tidak Valid";
                    $data["status"]=false;
                    return response()->json($data, 401);
                }
                // echo $tokenasli."==".$token;
            }
        }else{
            $data["message"]="Email tidak Valid";
            $data["status"]=false;
            return response()->json($data, 401);
        }
    }

    public function forward(){
        $input["tranprod_no"]=request()->get("tranprod_no");
        $forward=DB::table('forward')
        ->leftJoin("tranprod","tranprod.tranprod_id","=","forward.tranprod_id")
        ->where($input)
        ->get();
         
        if($forward->count()>0){
            foreach ($forward as $value) {
                $data["forward_number"][]=$value->forward_number;
            }
            $data["status"]=true;
            return response()->json($data, 200);    
        }else{
            $data["forward_number"]="";
            $data["status"]=false;
            return response()->json($data, 401);
        }
    }

    public function jadwalwablast(){
        date_default_timezone_set("Asia/Bangkok");
        $input["wablast_time"]=date("Y-m-d H:i:s");
        $wablast=DB::table('wablast')
        ->where($input)
        ->get();
        // echo $wablast->dd();
       
         
        if($wablast->count()>0){
            $no=0;
            foreach ($wablast as $value) {
                $data[$no]["timenow"]=date("Y-m-d H:i:s");
                $data[$no]["wablast_message"]=$value->wablast_messagewa;
                $data[$no]["wablast_picture"]=$value->wablast_picture;
                $data[$no]["wablast_caption"]=$value->wablast_caption;
                $data[$no]["tranprod_id"]=$value->tranprod_id;
                $data[$no]["tranprod_no"]=$value->tranprod_no;
                $data[$no]["mcategory_id"]=$value->mcategory_id;
                $data[$no]["wablast_delaymin"]=$value->wablast_delaymin;
                $data[$no]["wablast_delaymax"]=$value->wablast_delaymax;
                $data[$no]["wablast_perkirim"]=$value->wablast_perkirim;
                $data[$no]["wablast_perkirimdelay"]=$value->wablast_perkirimdelay;
                $no++;
            }
            return response()->json($data, 200);  
        }else{
            $data[0]["timenow"]=date("Y-m-d H:i:s");
            $data[0]["wablast_message"]="";
            $data[0]["wablast_picture"]="";
            $data[0]["wablast_caption"]="";
            $data[0]["tranprod_id"]="";
            $data[0]["tranprod_no"]="";
            $data[0]["mcategory_id"]="";
            $data[0]["wablast_delaymin"]="";
            $data[0]["wablast_delaymax"]="";
            $data[0]["wablast_perkirim"]="";
            $data[0]["wablast_perkirimdelay"]="";
            return response()->json($data, 200);
        }
    }

    public function memberwablast(){
        date_default_timezone_set("Asia/Bangkok");
        $input["tranprod_no"]=request()->get("tranprod_no");
        $input["mcategory_id"]=request()->get("mcategory_id");
        $member=DB::table('member')
        ->where($input)
        ->get();
        $data=array();
        $itung=0;
        if($member->count()>0){
            foreach ($member as $value) {
                $data[$itung]["member_name"]=$value->member_name;
                $data[$itung]["member_phone"]=$value->member_phone;
                $itung++;
            }
            $itung=0;
            return response()->json($data, 200);    
        }else{
            $data[0]["member_name"]="";
            $data[0]["member_phone"]="";
            return response()->json($data, 200);
        }
    }
    
    public function promptdefault(){
        date_default_timezone_set("Asia/Bangkok");
        $input["tranprod_id"]=request()->get("id"); 
        $pesan=request()->get("pesan");  
        
        $namausaha ="";
        $namacs ="";
        $gambarcs ="";
        $apitoken="";
        $data=array();

        $chatusaha=DB::table('chatusaha')
        ->where($input)
        ->get();
        if($chatusaha->count()>0){
            foreach ($chatusaha as $value) {
                $namausaha =$value->chatusaha_name;
                $namacs =$value->chatusaha_csname;
                $gambarcs =url("/images/chatusaha_cspicture/").$value->chatusaha_cspicture;
                $apitoken=$value->chatusaha_apitoken;
            }
        }

        //data awal
        $wajib ="Sekarang anda menjadi asisten saya yang bernama ".$namacs.", yaitu asisten yang sangat membantu, kreatif, pintar, dan sangat ramah abgi perusahan yang bernama".$namausaha.".";        
        $data[0]["role"]="system";
        $data[0]["content"]=$wajib;

        $chatdata=DB::table('chatdata')
        ->where($input)
        ->get();
        $no=1;
        if($chatdata->count()>0){
            foreach ($chatdata as $value) {
               /*  $data.="\nJika ada yang bertanya :".$value->chatdata_tanya.", ";
                $data.="jawab dengan kata-kata berikut namun dengan diolah lagi agar enak dilihat atau didengar: ".$value->chatdata_jawab.". "; */
                
                $data[$no]["role"]="user";
                $data[$no]["content"]=$value->chatdata_tanya;
                $data[$no+1]["role"]="assistant";
                $data[$no+1]["content"]=$value->chatdata_jawab;   
                $no+=2;
            }
        }
        
        $chatcontact=DB::table('chatcontact')
        ->where($input)
        ->get();
        $kontak="";
        if($chatcontact->count()>0){
            $kontak.="Jika kamu tidak menemukan jawaban dari pertanyaan yang menanyakan tentang produk atau perusahaan ".$namausaha.", maka kamu akan memberikan jawaban sebagai berikut (yang telah anda olah sebagus mungkin) : Maaf saya tidak dapat menjelaskan lebih tentang ini, tapi jangan khawatir anda dapat bertanya lebih lanjut dengan menelusuri tautan berikut :";
            foreach ($chatcontact as $value) {
                switch($value->contactcategory_id){
                    case "1":
                        $wa = $value->chatcontact_isi;
                        if (substr($wa, 0, 1) === "0") {
                            $wa = "62" . ltrim($wa, '0');
                        }
                        $kontak.="\n<a href:'https://whatsapp.me/".$wa."' class='fa fa-whatsapp'> Whatsapp</a>";
                    break;

                    case "2":
                        $nomor_telepon = $value->chatcontact_isi;
                        if (substr($nomor_telepon, 0, 1) === "0") {
                            $nomor_telepon = "+62" . ltrim($nomor_telepon, '0');
                        }
                        $kontak.="\n<a href:'tel:".$nomor_telepon."' class='fa fa-phone'> Telephone</a>";
                    break;

                    case "3":
                        $kontak.="\n<a href:'mailto:".$value->chatcontact_isi."' class='fa fa-mail'> Email</a>";
                    break;

                    case "4":
                        $kontak.="\n<a href:'".$value->chatcontact_isi."' class='fa fa-facebook'> Facebook</a>";
                    break;

                    case "5":
                        $kontak.="\n<a href:'".$value->chatcontact_isi."' class='fa fa-instagram'> Instagram</a>";
                    break;

                    case "6":
                        $kontak.="\n<a href:'".$value->chatcontact_isi."' class='fa fa-tiktok'> Tiktok</a>";
                    break;

                    case "7":
                        $kontak.="\n<a href:'".$value->chatcontact_isi."' class='fa fa-youtube'> Youtube</a>";
                    break;

                    case "8":
                        $kontak.="\n<a href:'".$value->chatcontact_isi."' class='fa fa-twitter'> Twitter</a>";
                    break;

                    case "9":
                        $kontak.="\n<a href:'".$value->chatcontact_isi."' class='fa fa-globe'> Website</a>";
                    break;
                }
            }
            $data[$no]["role"]="system";
            $data[$no]["content"]=$kontak;
            $no++;
        }

        $data[$no]["role"]="user";
        $data[$no]["content"]=$pesan;
            
        

        $d["isidefault"]=$data;
        $d["apitoken"]=$apitoken;
        return response()->json($d, 200);  
    }
}
