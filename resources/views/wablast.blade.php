
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
        .red {
        background-color: orange;
        color: white !important;
    }

    .white {
        background-color: none;
        color: black;
    }
    th{text-align: center;}
    </style>
@endsection
@section('container')
{{-- @dd($posts) --}}

<div class="container mt-5 mainbody">
    <?php
    $now = date("Y-m-d");
    if (isset($_GET['from'])) {
        $from = $_GET['from'];
        $to = $_GET['to'];
    } else {
        $from = date("Y-m-d", strtotime("-1 months", strtotime($now)));
        $to = $now;
    }
    if (isset($_GET['branchid'])) {
        $branchid = $_GET['branchid'];
    } else {
        $branchid = 0;
    }
    ?>
    <div class="row">
        <?php if (!isset($_GET['wablast_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
            $coltitle = "col-6";
        } else {
            $coltitle = "col-10";
        } ?>
        <div class="<?= $coltitle; ?>">
            <h4 class="card-title"></h4>
        </div>       
        <form method="get" action="layanan" class="col-2 mb-2">
            @csrf
            <div class="d-grid gap-2">
                <button class="btn btn-secondary btn-lg" value="OK" style="">Layanan</button>
            </div>
        </form>       
        <form method="get" action="layanandetail" class="col-2 mb-2">
            @csrf
            <div class="d-grid gap-2">
                <button class="btn btn-secondary btn-lg" value="OK" style="">Server</button>
                <input type="hidden" name="id" value="<?=$_GET["layananid"];?>" />
                <input type="hidden" name="layananid" value="<?=$_GET["layananid"];?>" />
                <input type="hidden" name="layananname" value="<?=$_GET["layananname"];?>" />
            </div>
        </form>     
        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
            <form method="post" class="col-2 mb-2">
                @csrf
                <div class="d-grid gap-2">
                    <button name="new" class="btn btn-info btn-lg" value="OK" style="">New</button>
                    <input type="hidden" name="wablast_id" />
                </div>
            </form>
        <?php } ?>
    </div>

    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
        <div class="row">
            <?php if (isset($_POST['edit'])) {
                $namabutton = 'name="change"';
                $judul = "Update Kategori WA Blast";
            } else {
                $namabutton = 'name="create"';
                $judul = "Add Kategori WA Blast";
            } ?>
            <div class="col-md-12">
                <h3><?= $judul; ?></h3>
            </div>
            <form class="col-md-12" action="" method="post" enctype="multipart/form-data">
                @csrf     
                <div class="mb-3 mt-3">
                    <label for="mcategory_id" class="form-label">Kategori Member:</label>
                    <select class="form-control" id="mcategory_id" name="mcategory_id">
                        <option value="" <?=$posts["mcategory_id"]==""?"selected":"";?>>Pilih Kategori</option>
                        <?php $mcategory=DB::table("mcategory")
                        ->where("tranprod_id",$_GET["layananid"])
                        ->get();
                        foreach($mcategory as $mcategory){?>
                        <option value="<?=$mcategory->mcategory_id;?>" <?=$posts["mcategory_id"]==$mcategory->mcategory_id?"selected":"";?>><?=$mcategory->mcategory_name;?></option>
                        <?php }?>
                    </select>
                </div>     
                <div class="mb-3 mt-3">
                    <?php 
                    $wablast_picture=$posts["wablast_picture"];
                    ?>
                    <label class="form-label" for="wablast_picture">Gambar:</label>
                    <input type="file" class="form-control" id="wablast_picture" placeholder="Enter Picture" name="wablast_picture" value="<?=$wablast_picture;?>"><br/>
                    <?php 
                    if($wablast_picture!=""){
                        $user_image="images/wablast_picture/".$wablast_picture;
                    }else{
                        $user_image="images/wablast_picture/notfound.png";
                        }?>
                    <img id="image_image" width="100" height="100" src="<?=url($user_image);?>"/>
                    <script>
                    function readURL(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                                $('#image_image').attr('src', e.target.result);
                            }                                            
                            reader.readAsDataURL(input.files[0]);
                        }
                    }                                            
                    $("#wablast_picture").change(function () {
                        readURL(this);
                    });
                </script>
                </div>    
                <div class="mb-3 mt-3">
                    <label for="wablast_caption" class="form-label">Caption Gambar:</label>
                    <input type="text" class="form-control" id="wablast_caption" placeholder="Enter Caption" name="wablast_caption" value="<?=$posts["wablast_caption"];?>">
                </div>  
                <div class="mb-3 mt-3">
                    <label for="wablast_message" class="form-label">Pesan:</label>
                    <textarea id="wablast_message" name="wablast_message"><?=$posts["wablast_message"];?></textarea>
                    <script>                        
                        tinymce.init({
                        selector: 'textarea#wablast_message',
                        height: 500,
                        menubar: false,
                        plugins: [
                            'advlist autolink lists link image charmap print preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount emoticons'
                        ],
                        toolbar: 'undo redo | ' +
                        'bold italic strikethrough | emoticons ' ,
                        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
                        });
                    </script>

                    <!-- <div id="test"></div>
                    <input type="hidden" class="form-control" id="wablast_message" placeholder="Enter Message" name="wablast_message" value="<?=$posts["wablast_message"];?>"><br />
                    <div onfocusout="getWhatAppFormattedContent()" id="wablast_message1"></div>                     -->
                </div>
                <div class="mb-3 mt-3">
                    <label for="wablast_delaymin" class="form-label">Delay Min (detik):</label>
                    <input type="number" class="form-control" id="wablast_delaymin" placeholder="Enter Delay Number" name="wablast_delaymin" value="<?=$posts["wablast_delaymin"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="wablast_delaymax" class="form-label">Delay Max (detik):</label>
                    <input type="number" class="form-control" id="wablast_delaymax" placeholder="Enter Delay Number" name="wablast_delaymax" value="<?=$posts["wablast_delaymax"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="wablast_perkirim" class="form-label">Jml Pesan Perkali Kirim Pesan:</label>
                    <input type="number" class="form-control" id="wablast_perkirim" placeholder="Enter Messages Number" name="wablast_perkirim" value="<?=$posts["wablast_perkirim"];?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="wablast_perkirimdelay" class="form-label">Delay setelah Max Pesan (detik):</label>
                    <input type="number" class="form-control" id="wablast_perkirimdelay" placeholder="Enter Delay Number" name="wablast_perkirimdelay" value="<?=$posts["wablast_perkirimdelay"];?>">
                </div>

                <div class="mb-3 mt-3">
                    <label for="wablast_time" class="form-label">Jadwal Pengiriman Pesan:</label>
                    <input type="datetime-local" class="form-control" id="wablast_time" placeholder="Enter Date Time" name="wablast_time" value="<?=$posts["wablast_time"];?>">
                </div>
                <input type="hidden" name="wablast_id" value="<?= $posts["wablast_id"]; ?>" />
                <input type="hidden" name="tranprod_id" value="<?= $_GET["layananid"]; ?>" />
                <input type="hidden" name="tranprod_no" value="<?= $_GET["layananname"]; ?>" />
                <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                <button type="button" class="btn btn-warning col-md-offset-1 col-md-5" onClick="pindah()">Back</button>
                <script>
                    function pindah() {
                        window.location.href = '<?= $url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>';
                    }
                </script>
            </form>
        </div>
    <?php } else { ?>
        <?php if ($posts["message"] != "") { ?>
            <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?= $posts["message"]; ?></strong>
                </div>
            </div>
            </div>
        <?php } ?>
       <!--  <div class="well">
            <form class="form-inline" action="">
                <label for="from" class="mr-sm-2">From:</label>
                <input type="date" class="form-control mb-2 mr-sm-2" id="from" name="from" value="<?= $from; ?>">
                <label for="to" class="mr-sm-2">To:</label>
                <input type="date" class="form-control mb-2 mr-sm-2" id="to" name="to" value="<?= $to; ?>">  
                <button type="submit" class="btn btn-primary ml-2 mb-2">Search</button>
            </form>
        </div> -->
        
        <div class="row mb-5  mt-5 border">
            <div class="col-md-12">
                <table id="example" class="table table-hover table-stripped table-bordered mt-3" >
                    <thead class="">
                        <tr class="text-center">
                            <?php if (!isset($_GET["report"])) { ?>
                                <th class="col-md-1 text-center">Action</th>
                            <?php } ?>
                            <th class="col-md-1 text-center">No.</th>
                            <th class="text-center">Tgl</th>
                            <th class="text-center">Server</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Pesan</th>
                            <th class="text-center">Jadwal</th>
                            <th class="col-md-1 text-center">Delay(detik)</th>
                            <th class="text-center">Max Pesan</th>
                            <th class="text-center">Delay setelah Max Pesan (detik)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                 
                        $usr = DB::table("wablast")
                        ->leftJoin("tranprod","tranprod.tranprod_id","wablast.tranprod_id")
                        ->leftJoin("mcategory","mcategory.mcategory_id","wablast.mcategory_id")
                        ->orderBy("wablast_id","DESC")
                        ->get();
                        $no = 1;
                        foreach ($usr as $usr) {
                        ?>
                            <tr id="d<?= $usr->wablast_id; ?>">
                                <?php if (!isset($_GET["report"])) { ?>
                                    <td>
                                        <div style="" class="row">
                                            <form method="post" class="btn-action col-md-6 d-grid" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-danger btn-block delete" onclick="return confirm('You want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                <input type="hidden" name="wablast_id" value="<?= $usr->wablast_id; ?>" />
                                            </form>
                                            <form method="post" class="btn-action col-md-6" style="">
                                            @csrf
                                                <button class="btn btn-sm btn-warning btn-block " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                <input type="hidden" name="wablast_id" value="<?= $usr->wablast_id; ?>" />
                                            </form>
                                        </div>
                                    </td>
                                <?php } ?>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= $usr->wablast_datetime; ?></td>
                                <td class="text-center"><?= $usr->tranprod_no; ?></td>
                                <td class="text-center"><?= $usr->mcategory_name; ?></td>
                                <td class="text-center"><?= $usr->wablast_message; ?></td>
                                <td class="text-center"><?= $usr->wablast_time; ?></td>
                                <td class="text-center"><?= $usr->wablast_delaymin; ?> - <?= $usr->wablast_delaymax; ?></td>
                                <td class="text-center"><?= $usr->wablast_perkirim; ?></td>
                                <td class="text-center"><?= $usr->wablast_perkirimdelay; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?> 
</div>

      
@endsection
@section('footer')    
    <script>
    $(".card-title").html("WA Blast <?=ucfirst($_GET["layananname"]);?>");
    // alert();
    </script>
    
         <script type="text/javascript">
            var editor;
            $(function () {
                     editor = $("#wablast_message").whatsappEditor();
                     editor1 = $("#wablast_message1").whatsappEditor();
            });

            function getWhatAppFormattedContent() {
                $("#test").html(editor1.getFormattedContent());
                     $("#wablast_message").val(editor1.getFormattedContent());
                     return false;
            }
         </script>
@endsection
