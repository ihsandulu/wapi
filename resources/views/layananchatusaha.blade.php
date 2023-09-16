
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
<?php //dd($posts["message"]);?>
<hr/>
<div class="container mt-5">
    <?php if($posts["message"]){?>
    <div class="alert alert-success">
        <strong>Success!</strong> <?=$posts["message"];?>.
    </div>
    <?php }?>
    <div class="row mb-3">
        <div class="col-md-8" >
            <h1 class="text-bold">Detail Usaha</h1>
        </div>
        
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchatcontact?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Kontak</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchatdata?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Data</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchathistory?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Pesan</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="{{ url('/layanan') }}" class="btn btn-warning width100"> Kembali</a></div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="post" class="was-validated">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="contactcategory_id" class="form-label">Nama Usaha:</label>
                    <input type="text" class="form-control" id="chatusaha_name" placeholder="Enter Answer" name="chatusaha_name" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="chatusaha_csname" class="form-label">Nama CS:</label>
                    <input type="text" class="form-control" id="chatusaha_csname" placeholder="Enter Answer" name="chatusaha_csname" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="chatusaha_apitoken" class="form-label">API Token Chat GPT:</label>
                    <input type="text" class="form-control" id="chatusaha_apitoken" placeholder="Enter Answer" name="chatusaha_apitoken" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button onclick="bersih()" type="button" class="btn btn-warning">Clear</button>
                <button id="submit" name="submit" value="insert" type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" id="chatusaha_id" name="chatusaha_id"/>
                <input type="hidden" id="tranprod_id" name="tranprod_id" value="<?=$_GET["id"];?>"/>
            </form>
        </div>
        <div class="col-12 mt-5">
            <table id="example" class="table table-hover table-stripped table-bordered" >
                <thead>
                    <tr>
                        <th class="col-1">Action</th>
                        <th>Nama Usaha</th>
                        <th>CS</th>
                        <th>Token</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $chatusaha=DB::table("chatusaha")
                    ->where("tranprod_id",$_GET["id"])
                    ->get();
                    foreach ($chatusaha as $chatusaha) {?>
                    <tr>
                        <td class="">
                            <div class="row">
                                <form method="post" class="btn-action col-md-6" style="">
                                @csrf
                                    <button onclick="editform('<?=$chatusaha->chatusaha_name;?>','<?=$chatusaha->chatusaha_csname;?>','<?=$chatusaha->chatusaha_cspicture;?>','<?=$chatusaha->chatusaha_apitoken;?>','<?=$chatusaha->chatusaha_id;?>')" type="button" class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                    <input type="hidden" name="chatusaha_id" value="<?= $chatusaha->chatusaha_id; ?>" />
                                </form>
                            </div>
                        </td>
                        <td><?=$chatusaha->chatusaha_name;?></td>
                        <td><?=$chatusaha->chatusaha_csname;?></td>
                        <td><?=$chatusaha->chatusaha_apitoken;?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <script>
                function bersih(){
                    $("#chatusaha_name").val("");
                    $("#chatusaha_csname").val("");
                    $("#chatusaha_cspicture").val("");
                    $("#chatusaha_apitoken").val("");
                    $("#tranprod_id").val("");
                    $("#submit").val("insert");
                }
                function editform(a,b,c,d,e){
                    $("#chatusaha_name").val(a);
                    $("#chatusaha_csname").val(b);
                    $("#chatusaha_cspicture").val(c);
                    $("#chatusaha_apitoken").val(d);
                    $("#chatusaha_id").val(e);
                    $("#submit").val("update");
                }
            </script>
        </div>
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