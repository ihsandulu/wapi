
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
        <div class="col-md-8" >
            <h1 class="text-bold">Detail Tanya Jawab</h1>
        </div>
        
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchatusaha?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Usaha</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchatcontact?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Kontak</a></div>
        <div align="right" class="col-md-1 m-0 mb-3 p-1"><a href="<?= url("/layananchathistory?id=".$_GET['id']."&cat=".$_GET['cat']) ;?>" class="btn btn-secondary width100"> Pesan</a></div>
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
                </div>
                <div class="mb-3 mt-3">
                    <label for="uname" class="form-label">Jawab:</label>
                    <input type="tel" class="form-control" id="chatdata_jawab" placeholder="Enter Answer" name="chatdata_jawab" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button onclick="bersih()" type="button" class="btn btn-warning">Clear</button>
                <button id="submit" name="submit" value="insert" type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" id="chatdata_id" name="chatdata_id"/>
                <input type="hidden" name="tranprod_id" value="<?=$_GET["id"];?>"/>
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