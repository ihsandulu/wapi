
@extends('templates/main')

@section('header')
    <style>
        .img{width: 100%; height: auto;}
        .page-left{background-color:rgba(16, 167, 74, 0.1); opacity:0.1;}
        .fixed{
            padding: 0px;
            position: fixed !important; 
            left: 0px; 
            top: 0px; 
            z-index: -10; 
            padding: 0px;
            width: inherit;
            height: inherit;
        }
        .sisi-kiri{padding: 120px;}
        .sisi-kanan{padding: 120px;}
        .top-right{position: absolute; top:10px; right:10px; width:100px; height:auto;}
        .bahaya{color:red; font-size:20px;}
        .aman{color:green; font-size:15px;}
        .iframe{height:900px; overflow: hidden;}
        .width100{width:100%!important;}
        .atas{color:black;}
        .bawah{color:grey;}
        .pl-2{padding-left: 10px!important;}
    </style>
@endsection
@section('container')
{{-- @dd($posts) --}}
<hr/>
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-10" >
            <h1 class="text-bold">Detail Layanan</h1>
        </div>
        
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="{{ url('/chathistory?layananid='.$_GET['layananid'].'&layananname='.$_GET['layananname']) }}" class="btn btn-secondary width100"> Pesan</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="{{ url('/layanan') }}" class="btn btn-warning width100"> Kembali</a></div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="post" class="was-validated">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Tanya:</label>
                    <input type="tel" class="form-control" id="chatdata_tanya" placeholder="Enter Question" name="chatdata_tanya" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <input type="hidden" name="tranprod_id" value="<?=$_GET["id"];?>"/>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Jawab:</label>
                    <input type="tel" class="form-control" id="chatdata_jawab" placeholder="Enter Answer" name="chatdata_jawab" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <input type="hidden" name="tranprod_id" value="<?=$_GET["id"];?>"/>
                </div>
                <button onclick="bersih()" type="button" class="btn btn-warning">Clear</button>
                <button id="submit" name="submit" value="insert" type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" id="chatdata_id" name="chatdata_id"/>
            </form>
        </div>
        <div class="col-12 mt-5">
            <table id="example" class="table table-hover table-stripped table-bordered" >
                <thead>
                    <tr>
                        <th class="col-1">Action</th>
                        <th>Tanya-Jawab</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $chatdata=DB::table("chatdata")
                    ->where("tranprod_id",$_GET["id"])
                    ->get();
                    foreach ($chatdata as $chatdata) {?>
                    <tr>
                        <td class="">
                            <div class="row">
                                <form method="post" class="btn-action col-md-6">      
                                    @csrf                      
                                    <button onclick="return confirm('You want to delete?');" type="submit" name="delete" class="btn btn-danger btn-xs fa fa-close"></button>
                                    <input type="hidden" name="chatdata_id" value="<?=$chatdata->chatdata_id;?>"/>
                                </form>
                                <form method="post" class="btn-action col-md-6" style="">
                                @csrf
                                    <button onclick="editform('<?=$chatdata->chatdata_tanya;?>','<?=$chatdata->chatdata_jawab;?>','<?=$chatdata->chatdata_id;?>')" type="button" class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                    <input type="hidden" name="chatdata_id" value="<?= $chatdata->chatdata_id; ?>" />
                                </form>
                            </div>
                        </td>
                        <td class="pl-2">
                            <div>
                                <div class="atas">Tanya :</div>
                                <div class="bawah"><?=$chatdata->chatdata_tanya;?></div>
                            </div>
                            <div>
                                <div class="atas">Jawab :</div>
                                <div class="bawah"><?=$chatdata->chatdata_jawab;?></div>
                            </div>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <script>
                function bersih(){
                    $("#chatdata_tanya").val("");
                    $("#chatdata_jawab").val("");
                    $("#chatdata_id").val("");
                    $("#submit").val("insert");
                }
                function editform(a,b,c){
                    $("#chatdata_tanya").val(a);
                    $("#chatdata_jawab").val(b);
                    $("#chatdata_id").val(c);
                    $("#submit").val("update");
                }
            </script>
        </div>
    </div>
   
    <div class="row  mt-5">
        <?php $products = DB::table('tranprod')
        ->leftJoin("product","product.product_id","=","tranprod.product_id")
        ->where("tranprod_id",$_GET["id"])
        ->orderBy('product_name')
        ->paginate(50);?>
        @foreach ($products as $product)
        <div class="col-md-12 p-1" >
            <div class="card p-3" >
                <img src="{{ url("/images/product_picture/".$product->product_picture) }}" class="card-img-top top-right" alt="{{ $product->product_name }}">
                <div class="card-body mt-4">
                    <h1 class="card-title text-center text-bold text-success">{{ $product->product_name }}</h1>
                    <h3 class="card-title text-center text-bold text-primary">{{ $product->tranprod_no }}</h3>
                    <div class="d-grid gap-2">
                        <div align="center">Start of Date : <b>{{ date("d M, Y",strtotime($product->tranprod_date)); }}</b></div>
                        <?php 
                        $tgl1 = strtotime(date("Y-m-d")); 
                        $tgl2 = strtotime($product->tranprod_outdate);                         
                        $jarak = $tgl2 - $tgl1;                        
                        $hari = $jarak / 60 / 60 / 24;
                        if($hari<=7){$peringatan="bahaya";}else{$peringatan="aman";}?>
                        <div align="center" class="<?=$peringatan;?>">Out of Date : <b>{{ date("d M, Y",strtotime($product->tranprod_outdate)); }}</b></div>
                        <?php if($peringatan=="bahaya"){?>
                        <a href="{{ url("/perpanjangan?id=".$product->tranprod_id) }}" class="btn btn-success btn-block">Perpanjang Lisensi {{ $product->tranprod_no }}</a>
                        <?php }else{?>
                        <div class="row" id="barcode1">
                            <?php 
                            $str=$product->product_name;
                            preg_match_all('/(?<=\b)\w/iu',$str,$matches);
                            $result=mb_strtoupper(implode('',$matches[0]));
                            $src=env('APP_URL_UTAMA').":8000/apiwa.html?server=".$product->tranprod_no."&token=".md5($tgl2)."&desc=".$product->product_name;
                            ?>
                            <iframe class="col-md-12 iframe" frameBorder="0" title="Api Whatsapp" src="<?=$src;?>" ></iframe>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
       <div class="d-flex flex-row-reverse mt-3 mb-5 col-md-12">{{ $products->links() }}</div>
    </div>
      
   
</div>
<div class="fixed row p-0">
        <div class="col-md-6 p-0  page-left">
        </div>
        <div class="col-md-6  p-0 page-right">
        </div>
</div>
@endsection
@section('footer')
    <script>
    // alert();
    </script>
@endsection