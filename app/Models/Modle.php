<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class Modle extends Model
{
    public  function index($fungsi)
    {    
        $role=method_exists($this, $fungsi);
        $roles = array();
        if($role){     
            $request = Request();       
            $roles = $this->$fungsi($request);
            if(!isset($roles["message"])){
                $roles["message"]="";
            }
        }else{
            $roles["message"]="";
        }
       
        return $roles;
    }
    public function layanandetail($request){
        $role = array();
        $role["message"]="";
        if(isset($_POST["forward_number"])){
            $input["forward_number"]=$request->post("forward_number");
            $input["tranprod_id"]=$request->post("tranprod_id");
            $forward=DB::table("forward")
            ->insertGetId($input);
            if($forward){
                $role["message"]="Nomor berhasil diinput.";
            }else{
                $role["message"]="Nomor gagal diinput.";
            }
        }
        
        if(isset($_POST["delete"])){
            $forward=DB::table("forward")     
            ->where("forward_id",$request->post("forward_id"))
            ->delete();
            if($forward){
                $role["message"]="Nomor berhasil Didelete.";
            }else{
                $role["message"]="Nomor gagal Didelete.";
            }
        }

        return $role;
    }
    public function layananchataidetail($request){
        $role = array();
        $role["message"]="";            
        $table="chatdata";

        if (request()->has("submit")) {
            $input = array();
            foreach (request()->post() as $e => $f) {
                if ($e != "submit" && $e != $table."_id") {
                    $input[$e] = request()->post($e);
                }
            }
            if(request()->post("submit")=="insert"){
                $query=DB::table($table)
                ->insertGetId($input);
                if($query){
                    $role["message"]="Data berhasil diinput.";
                }else{
                    $role["message"]="Data gagal diinput.";
                }
            }
            if(request()->post("submit")=="update"){
                $where[$table."_id"] = request()->post($table."_id");
                $query = DB::table($table)
                ->where($where)
                ->update($input);
                // dd($where)  ;
                if($query){
                    $role["message"]="Data berhasil diinput.";
                }else{
                    $role["message"]="Data gagal diinput.";
                }
            }
        }
        
        if(isset($_POST["delete"])){
            $forward=DB::table($table)     
            ->where($table."_id",$request->post($table."_id"))
            ->delete();
            if($forward){
                $role["message"]="Data berhasil Didelete.";
            }else{
                $role["message"]="Data gagal Didelete.";
            }
        }

        return $role;
    }
    public function layananchatcontact($request){
        $role = array();
        $role["message"]="";            
        $table="chatcontact";

            // dd($request);
        if (request()->has("submit")) {
            $input = array();
            foreach (request()->post() as $e => $f) {
                if ($e != "submit" && $e != $table."_id") {
                    $input[$e] = request()->post($e);
                }
            }
            if(request()->post("submit")=="insert"){
                $query=DB::table($table)
                ->insertGetId($input);
                if($query){
                    $role["message"]="Data berhasil diinput.";
                }else{
                    $role["message"]="Data gagal diinput.";
                }
            }
            if(request()->post("submit")=="update"){
                $where[$table."_id"] = request()->post($table."_id");
                $query = DB::table($table)
                ->where($where)
                ->update($input);
                // dd($where)  ;
                if($query){
                    $role["message"]="Data berhasil diinput.";
                }else{
                    $role["message"]="Data gagal diinput.";
                }
            }
        }
        
        if(isset($_POST["delete"])){
            $forward=DB::table($table)     
            ->where($table."_id",$request->post($table."_id"))
            ->delete();
            if($forward){
                $role["message"]="Data berhasil Didelete.";
            }else{
                $role["message"]="Data gagal Didelete.";
            }
        }

        return $role;
    }
    
    public function layananchatusaha($request){
        $role = array();
        $role["message"]="";            
        $table="chatusaha";

            // dd($request);
        if (request()->has("submit")) {
            $input = array();
            foreach (request()->post() as $e => $f) {
                if ($e != "submit" && $e != $table."_id") {
                    $input[$e] = request()->post($e);
                }
            }
            
            $input1["tranprod_id"]=request()->post("tranprod_id");
            $builder=DB::table($table)
            ->where($input1);
            // dd($builder->toSql());
            // dd(request()->post("tranprod_id"));
            $chatusaha=$builder->get();
            if($chatusaha->count()>0){
                foreach ($chatusaha as $value) {
                    $idn=$table."_id";
                    $where[$table."_id"] = $value->$idn;
                    $query = DB::table($table)
                    ->where($where)
                    ->update($input);
                    // dd($where)  ;
                    if($query){
                        $role["message"]="Data berhasil diinput.";
                    }else{
                        $role["message"]="Data gagal diinput.";
                    }
                }
            }else{
                $query=DB::table($table)
                ->insertGetId($input);
                if($query){
                    $role["message"]="Data berhasil diinput.";
                }else{
                    $role["message"]="Data gagal diinput.";
                }
            }
        }
        
        if(isset($_POST["delete"])){
            $forward=DB::table($table)     
            ->where($table."_id",$request->post($table."_id"))
            ->delete();
            if($forward){
                $role["message"]="Data berhasil Didelete.";
            }else{
                $role["message"]="Data gagal Didelete.";
            }
        }

        return $role;
    }
    public function daftar($request){
        $data = array();
        $data["message"] = "";

        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
            'username' => 'required|min:5'
        ]);
        if ($credentials) {
            $input = array(
                'user_email' => $request->email,
                'password' => Hash::make($request->password),
                'user_name' => $request->username,
                'position_id' => 2,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                
            );
           /*  if(request()->file($table.'_picture')){
                $file = request()->file($table.'_picture'); 
                $this->proses_upload($file,$table.'_picture');
                $input[$table.'_picture']=$file->getClientOriginalName();
            } */
             /*  
            $input[$table."_date"] = date("Y-m-d");
            $input["created"] = date("Y-m-d H:i:s");
            $input["updated"] = date("Y-m-d H:i:s"); */
            $data["success"]=0;
            $where["user_email"]=$request->email;
            $cari = DB::table("user")->where($where)->get()->count();
            if($cari == 0){
                $query = DB::table("user")->insert($input);
                if($query > 0){
                    $data["data"]=implode(", ",$input);
                    $data["success"]=1;
                }else{                    
                    $data["message"]="Gagal Register! Silahkan coba lagi!";
                }
            }else{                
                $data["message"]="Email telah terpakai!";
            }
            
            // echo DB::getLastQuery();
            // die;
        }        
        return $data;
    }
    public function cpassword($request){
        $data = array();
        $data["message"] = "";

        $credentials = $request->validate([
            'password' => 'required|min:8'
        ]);
        if ($credentials) {
            $input = array(
                'password' => Hash::make($request->password),
                'updated_at' => date("Y-m-d H:i:s"),
                
            );
           /*  if(request()->file($table.'_picture')){
                $file = request()->file($table.'_picture'); 
                $this->proses_upload($file,$table.'_picture');
                $input[$table.'_picture']=$file->getClientOriginalName();
            } */
             /*  
            $input[$table."_date"] = date("Y-m-d");
            $input["created"] = date("Y-m-d H:i:s");
            $input["updated"] = date("Y-m-d H:i:s"); */
            $data["success"]=0;
            $where["id"]=$request->user_id;
            $cari = DB::table("user")->where($where)
            // ->get()
            ->count();
            // ->toSql();
            // echo dd($cari);
            if($cari > 0){
                // DB::enableQueryLog();
                $query = DB::table("user")->where($where)->update($input);
                // $query = DB::getQueryLog();  
                // dd($query);
                if($query > 0){
                    $data["data"]="User =".$request->user_name.", Email = ".$request->user_email.", Date = ".$input["updated_at"];
                    $data["success"]=1;
                }else{                    
                    $data["message"]="Password gagal dirubah! Silahkan coba lagi!";
                }
            }else{                
                $data["message"]="Akses ditolak!";
            }
            
            // echo DB::getLastQuery();
            // die;
        }        
        return $data;
    }
    public function defaultnya($table){
        $data = array();
        $data["message"] = "";

        //aktifkan layanan
        if(isset($_POST["aktifkan"])){
            $this->aktifkan();  
            $data["message"] = "Activated Success";          
        }
        // DB::enableQueryLog();
        //delete
        if (request()->post("delete") == "OK") {
            $usr_id = request()->post($table."_id");
            DB::table($table)            
            ->where($table."_id",$usr_id)
            ->delete();
            
            $data["message"] = "Delete Success";
        }
        // $query = DB::getQueryLog(); dd($query);
        //insert
        if (request()->post("create") == "OK") {
            
            //penomoran
            /* $nom = DB::
                table($table)
                ->where($table."_date", date("Y-m-d"))
                ->orderBy($table."_id", "DESC")
                ->limit("1")
                ->get();
            if ($nom->count() > 0) {
                $table_no=$table."_no";
                $noakhir = $nom->first()->$table_no;
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
            $nomor[1] = "NMR";
            $nomor[2] = date("Ymd");
            $nomor[3] = $noa;
            $nomoran = implode(".", $nomor); */

            foreach (request()->post() as $e => $f) {
                if ($e != 'create' && $e != $table.'_id') {
                    $input[$e] = request()->post($e);
                }
            }
           /*  $input[$table."_no"] = $nomoran;
            $input[$table."_date"] = date("Y-m-d");
            $input["created"] = date("Y-m-d H:i:s");
            $input["updated"] = date("Y-m-d H:i:s"); */

            if(request()->file($table.'_picture')){
                $file = request()->file($table.'_picture'); 
                $this->proses_upload($file,$table.'_picture');
                $input[$table.'_picture']=$file->getClientOriginalName();
            }
            DB::table($table)->insert($input);
            // echo DB::->getLastQuery();
            // die;
            $data["message"] = "Insert Data Success";
            
        }
        //echo $_POST["create"];die;

        //update
        if (request()->post("change") == "OK") {
            foreach (request()->post() as $e => $f) {
                if ($e != 'change' && $e != $table.'_picture') {
                    $input[$e] = request()->post($e);
                }
            }
            // $input["updated"] = date("Y-m-d H:i:s");
            if(request()->file($table.'_picture')){
                $file = request()->file($table.'_picture'); 
                $this->proses_upload($file,$table.'_picture');
                $input[$table.'_picture']=$file->getClientOriginalName();
            }
            DB::table($table)
            ->where($table."_id",request()->post($table."_id"))
            ->update($input);
            $data["message"] = "Update Success";
            //echo DB::->last_query();die;
        }

        
        //cek data
        if (request()->post($table."_id")) {
            $usrd[$table."_id"] = request()->post($table."_id");
        } else {
            $usrd[$table."_id"] = 0;
        }
        $us = DB::table($table)
            ->where($usrd)
            ->get();
        //echo $this->akunting->getLastquery();
        //die;
        if ($us->count() > 0) {
            foreach ($us as $usr) {
                foreach (DB::getSchemaBuilder()->getColumnListing($table) as $field) {
                    $data[$field] = $usr->$field;
                }
            }
        } else {
            foreach (DB::getSchemaBuilder()->getColumnListing($table) as $field) {
                $data[$field] = "";
            }
        }
        return $data;
    }
    
    public function proses_upload($file,$upload){
 
		// menyimpan data file yang diupload ke variabel $file
		// $file = request()->file('file');
 
      	        // nama file
		// echo 'File Name: '.$file->getClientOriginalName();
		// echo '<br>';
 
      	        // ekstensi file
		// echo 'File Extension: '.$file->getClientOriginalExtension();
		// echo '<br>';
 
      	        // real path
		// echo 'File Real Path: '.$file->getRealPath();
		// echo '<br>';
 
      	        // ukuran file
		// echo 'File Size: '.$file->getSize();
		// echo '<br>';
 
      	        // tipe mime
		// echo 'File Mime Type: '.$file->getMimeType();
 
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'images/'.$upload;
 
                // upload file
		$file->move($tujuan_upload,$file->getClientOriginalName());
	}
    public function semua($item)
    {
        $datathrow = DB::table($item)->orderBy($item . '_id',"DESC")->paginate(5);
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

    private function aktifkan(){
        //cek apakah baru langganan atau perpanjangan
        $inputss["tranprod_id"]=request()->post("tranprod_id");
        $tranprodp=DB::table("tranprodp")
        ->where($inputss)
        ->get()
        ->count();

        $inputs["tranprod_id"]=request()->post("tranprod_id");
        $tranprods=DB::table("tranprod")
        ->leftJoin("product","product.product_id","=","tranprod.product_id")
        ->where($inputs)
        ->get();
        foreach($tranprods as $tranprod){
            $sekarang=date("Y-m-d");
            if($tranprodp==0){
                $input["tranprod_activedate"]=date("Y-m-d");
                $input["tranprod_date"]=date("Y-m-d");
            }elseif($sekarang>$tranprod->tranprod_outdate){
                $input["tranprod_activedate"]=date("Y-m-d");
                $input["tranprod_date"]=date("Y-m-d");
            }else{
                $input["tranprod_activedate"]=$tranprod->tranprod_outdate;
                $input["tranprod_date"]=$tranprod->tranprod_outdate;
            }

            //aktifkan layanan
            $transaction_id=request()->post("transaction_id");
            $inputtr["transaction_status"]=0;
            $inputtr["updated_at"]=date("Y-m-d H:i:s");
            $wheretr["transaction_id"]=$transaction_id;
            DB::table('transaction')
            ->where($wheretr)
            ->update($inputtr);

            //waktu perpanjangan
            $perpanjangan=$tranprod->product_waktu." ".$tranprod->product_masa;
            $input["tranprod_outdate"] = date('Y-m-d', strtotime($input["tranprod_activedate"]. ' + '.$perpanjangan));
            // $input["tranprod_outdate"]=date("Y-m-d",strtotime("+".$perpanjangan,strtotime($input["tranprod_activedate"])));
            $input["tranprod_active"]=1;
            $input["updated_at"]=date("Y-m-d H:i:s");
            $where["tranprod_id"]=$tranprod->tranprod_id;
            DB::table('tranprod')
            ->where($where)
            ->update($input);

            //insert history
            $inputp["tranprod_id"]=$tranprod->tranprod_id;
            $inputp["tranprodp_awal"]=$input["tranprod_activedate"];
            $inputp["tranprodp_akhir"]=$input["tranprod_outdate"];
            $inputp["tranprodp_nominal"]=$tranprod->product_sell;
            $where["tranprod_id"]=$tranprod->tranprod_id;
            DB::table('tranprodp')
            ->insert($inputp);
        }

        $data=$input;
        return $data;
    }

    private function deleteserver(){
         $input["tranprod_active"]=2;
            $where["tranprod_id"]=request()->post("tranprod_id");
            DB::table('tranprod')
            ->where($where)
            ->delete();
            $data["message"]="Server di delete.";
            return $data;
    }

    private function aktifkanserver(){
         $input["tranprod_active"]=1;
            $where["tranprod_id"]=request()->post("tranprod_id");
            DB::table('tranprod')
            ->where($where)
            ->update($input);
            $data["message"]="Server di aktifkan.";
            return $data;
    }

    private function deactiveserver(){
         $input["tranprod_active"]=0;
            $where["tranprod_id"]=request()->post("tranprod_id");
            DB::table('tranprod')
            ->where($where)
            ->update($input);
            $data["message"]="Server di non aktifkan.";
            return $data;
    }

    
    public function layanans()
    {
        if(isset($_POST["submit"])){
            $data= $this->aktifkan();            
        }elseif(isset($_POST["delete"])){
            $data= $this->deleteserver();            
        }elseif(isset($_POST["aktif"])){
            $data= $this->aktifkanserver();            
        }elseif(isset($_POST["deactive"])){
            $data= $this->deactiveserver();            
        }else{
            $data=array();
        }
        return $data;
    }
    
    public function products()
    {
        if(isset($_POST["beli"])){
            $user_id = auth()->user()->id;
            $product_id = $_POST["product_id"];
            $tranprod_date=date("Y-m-d");
            $tranprod_outdate=date('Y-m-d', strtotime('+1 month', strtotime($tranprod_date)));
            //penomoran
            $nom = DB::table("tranprod")
                ->where("tranprod_date", date("Y-m-d"))
                ->orderBy("tranprod_id", "DESC")
                ->limit("1")
                ->get();
            if ($nom->count() > 0) {
                $noakhir = $nom->first()->tranprod_no;
                $noakh = explode("-", $noakhir);
                if ($noakh[2] > 999) {
                    $noak = 1;
                } else {
                    $noak = $noakh[2] + 1;
                }
                $noa = str_pad($noak, 2, "0", STR_PAD_LEFT);
            } else {
                $noa = str_pad(1, 2, "0", STR_PAD_LEFT);
            }
            $nomor = array();
            $nomor[1] = "TRP";
            $nomor[2] = date("Ymd");
            $nomor[3] = $noa;
            $nomoran = implode("-", $nomor);
            $id = DB::table('tranprod')->insertGetId(
                array('user_id' => $user_id, 'product_id' => $product_id, 'tranprod_no' => $nomoran,'tranprod_date'=>$tranprod_date,'tranprod_outdate'=>$tranprod_outdate)
            );
            //print_r(DB::getQueryLog());
            $data["redirect"]="perpanjangan?id=".$id;
            return $data;
        }else{
            return array();
        }
    }

    
    public function wablast(){
        // dd("ok");
        $data = array();
        $data["message"] = "";
        $table="wablast";

        //aktifkan layanan
        if(isset($_POST["aktifkan"])){
            $this->aktifkan();  
            $data["message"] = "Activated Success";          
        }

        //delete
        if (request()->post("delete") == "OK") {
            $usr_id = request()->post($table."_id");
            DB::table($table)            
            ->where($table."_id",$usr_id)
            ->delete();
            $data["message"] = "Delete Success";
        }

        //insert
        if (request()->post("create") == "OK") { 
            foreach (request()->post() as $e => $f) {
                if ($e != 'create' && $e != $table.'_id') {
                    $input[$e] = request()->post($e);
                }
            }

            $wablast_messagewa = $input["wablast_message"];
            $wablast_messagewa = preg_replace('/<p>\s*(.*?)\s*<\/p>/', '$1', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<bold>\s*(.*?)\s*<\/bold>/', '*$1* ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<b>\s*(.*?)\s*<\/b>/', '*$1* ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<strong>\s*(.*?)\s*<\/strong>/', '*$1* ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<i>\s*(.*?)\s*<\/i>/', '_$1_ ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<em>\s*(.*?)\s*<\/em>/', '_$1_ ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<strike>\s*(.*?)\s*<\/strike>/', '~$1~ ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<span style="text-decoration: line-through;">\s*(.*?)\s*<\/span>/', '~$1~ ', $wablast_messagewa);
            $input["wablast_messagewa"]=$wablast_messagewa;

            // echo $output; 

            if(request()->file($table.'_picture')){
                $file = request()->file($table.'_picture'); 
                $this->proses_upload($file,$table.'_picture');
                $input[$table.'_picture']=$file->getClientOriginalName();
            }
            DB::table($table)->insert($input);
            // echo DB::->getLastQuery();
            // die;
            $data["message"] = "Insert Data Success";
            
        }
        //echo $_POST["create"];die;

        //update
        if (request()->post("change") == "OK") {
            foreach (request()->post() as $e => $f) {
                if ($e != 'change' && $e != $table.'_picture') {
                    $input[$e] = request()->post($e);
                }
            }

            $wablast_messagewa = $input["wablast_message"];
            $wablast_messagewa = preg_replace('/<p>\s*(.*?)\s*<\/p>/', '$1', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<bold>\s*(.*?)\s*<\/bold>/', '*$1* ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<b>\s*(.*?)\s*<\/b>/', '*$1* ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<strong>\s*(.*?)\s*<\/strong>/', '*$1* ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<i>\s*(.*?)\s*<\/i>/', '_$1_ ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<em>\s*(.*?)\s*<\/em>/', '_$1_ ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<strike>\s*(.*?)\s*<\/strike>/', '~$1~ ', $wablast_messagewa);
            $wablast_messagewa = preg_replace('/<span style="text-decoration: line-through;">\s*(.*?)\s*<\/span>/', '~$1~ ', $wablast_messagewa);
            $input["wablast_messagewa"]=$wablast_messagewa;

            if(request()->file($table.'_picture')){
                $file = request()->file($table.'_picture'); 
                $this->proses_upload($file,$table.'_picture');
                $input[$table.'_picture']=$file->getClientOriginalName();
            }
            // dd($input);
            DB::table($table)
            ->where($table."_id",request()->post($table."_id"))
            ->update($input);
            $data["message"] = "Update Success";
            //echo DB::->last_query();die;
        }

        
        //cek data
        if (request()->post($table."_id")) {
            $usrd[$table."_id"] = request()->post($table."_id");
        } else {
            $usrd[$table."_id"] = 0;
        }
        $us = DB::table($table)
            ->where($usrd)
            ->get();
        //echo $this->akunting->getLastquery();
        //die;
        if ($us->count() > 0) {
            foreach ($us as $usr) {
                foreach (DB::getSchemaBuilder()->getColumnListing($table) as $field) {
                    $data[$field] = $usr->$field;
                }
            }
        } else {
            foreach (DB::getSchemaBuilder()->getColumnListing($table) as $field) {
                $data[$field] = "";
            }
        }
        return $data;
    }
}
