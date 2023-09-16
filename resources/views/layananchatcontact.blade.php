
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
            <h1 class="text-bold">Detail Kontak</h1>
        </div>
        
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchatusaha?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Usaha</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchatdata?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Data</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchathistory?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Pesan</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="{{ url('/layanan') }}" class="btn btn-warning width100"> Kembali</a></div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="post" class="was-validated">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="contactcategory_id" class="form-label">Jenis Kontak:</label>
                    <select class="form-control" id="contactcategory_id" name="contactcategory_id" required>
                        <option value="0">Pilih Kategori</option>
                        <?php $contactcategory=DB::table("contactcategory")
                        ->get();
                        foreach ($contactcategory as $contactcategory) {?>
                            <option value="<?=$contactcategory->contactcategory_id;?>"><?=$contactcategory->contactcategory_name;?></option>
                        <?php }?>

                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="chatcontact_isi" class="form-label">Kontak:</label>
                    <input type="tel" class="form-control" id="chatcontact_isi" placeholder="Enter Answer" name="chatcontact_isi" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button onclick="bersih()" type="button" class="btn btn-warning">Clear</button>
                <button id="submit" name="submit" value="insert" type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" id="chatcontact_id" name="chatcontact_id"/>
                <input type="hidden" id="tranprod_id" name="tranprod_id" value="<?=$_GET["id"];?>"/>
            </form>
        </div>
        <div class="col-12 mt-5">
            <table id="example" class="table table-hover table-stripped table-bordered" >
                <thead>
                    <tr>
                        <th class="col-1">Action</th>
                        <th>Jenis</th>
                        <th>Isi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $chatcontact=DB::table("chatcontact")
                    ->leftJoin("contactcategory","contactcategory.contactcategory_id","=","chatcontact.contactcategory_id")
                    ->where("tranprod_id",$_GET["id"])
                    ->get();
                    foreach ($chatcontact as $chatcontact) {?>
                    <tr>
                        <td class="">
                            <div class="row">
                                <form method="post" class="btn-action col-md-6">      
                                    @csrf                      
                                    <button onclick="return confirm('You want to delete?');" type="submit" name="delete" class="btn btn-danger btn-xs fa fa-close"></button>
                                    <input type="hidden" name="chatcontact_id" value="<?=$chatcontact->chatcontact_id;?>"/>
                                </form>
                                <form method="post" class="btn-action col-md-6" style="">
                                @csrf
                                    <button onclick="editform('<?=$chatcontact->contactcategory_id;?>','<?=$chatcontact->chatcontact_isi;?>','<?=$chatcontact->chatcontact_id;?>')" type="button" class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                    <input type="hidden" name="chatcontact_id" value="<?= $chatcontact->chatcontact_id; ?>" />
                                </form>
                            </div>
                        </td>
                        <td><?=$chatcontact->contactcategory_name;?></td>
                        <td><?=$chatcontact->chatcontact_isi;?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
            <script>
                function bersih(){
                    $("#contactcategory_id").val("");
                    $("#chatcontact_isi").val("");
                    $("#chatcontact_id").val("");
                    $("#submit").val("insert");
                }
                function editform(a,b,c){
                    $("#contactcategory_id").val(a);
                    $("#chatcontact_isi").val(b);
                    $("#chatcontact_id").val(c);
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