
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
        #keterangan{margin-top:50px;}
    </style>
@endsection
@section('container')


<hr/>
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-6" >
            <h1 class="text-bold">Rubah Password</h1>
        </div>
    </div>
   
    <div class="row">        
        <div class="col-md-12 p-1" >
            <div class="card p-3" >
                <div class="card-body mt-4">
                    <div class="d-grid gap-2">                        
                        <div class="row" id="konfirmasi">
                            <h1 class="col-md-12"> Rubah Password </h1>
                            <form method="post">
                            @csrf
                                <div class="row text-danger" >
                                    <div class="col">Hindari menggunakan : #</div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="New Password" id="password" name="password" onkeyup="sama()">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Confirm Password" id="cpassword" onkeyup="sama()">
                                    </div>
                                    <div class="col">                                        
                                        <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                                        <input type="hidden" name="user_email" value="{{Auth()->user()->user_email}}">
                                        <input type="hidden" name="user_name" value="{{Auth()->user()->user_name}}">
                                        <button type="submit" name="submit" value="OK" class="btn btn-success">Konfirmasi</button>
                                    </div>                                    
                                </div>
                                <div class="row text-danger" id="ipassword">
                                    <div class="col">Password tidak sama!</div>
                                </div>
                            </form>
                            <script>
                                function sama(){
                                    let password=$("#password").val();
                                    let cpassword=$("#cpassword").val();
                                    if(password!=cpassword){
                                        $("#ipassword").show();
                                    }else{
                                        $("#ipassword").hide();
                                    }
                                    // alert(password+'=='+cpassword);
                                }
                                sama();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
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