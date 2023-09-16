
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
        .img-layanan{
            width:50px;
            height:auto; 
            position: relative; 
            left: 50%; 
            top: 50%; 
            transform:translate(-50%,0);
        }
        .line-3{height:50px;}
        .line-5{height:100px;}
    </style>
@endsection
@section('container')
{{-- @dd($posts) --}}
<hr/>
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-md-6" >
            <h1 class="text-bold">Layanan</h1>
        </div>
        <div align="right" class="col-md-6 m-0"><a href="{{ url('/products') }}" class="btn btn-primary fa fa-plus"> Tambah Layanan</a></div>
    </div>
    
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link categoryproduct active bg-greendark" onclick="activcategory(this)" aria-current="page" href="<?=url("/layanan");?>">Semua</a>
        </li>
        <?php 
            $categorys = DB::table('category')->get();
        ?>
        @foreach ($categorys as $category)
        <li class="nav-item">
          <a class="nav-link categoryproduct" onclick="activcategory(this)" aria-current="page" href="<?=url("/layanan?id=$category->category_id");?>">{{ $category->category_name }}</a>
        </li>
        @endforeach
    </ul>
    <script>
        function activcategory(a){
            $('.categoryproduct').removeClass('active');
            $('.categoryproduct').removeClass('bg-greendark');
            $(a).addClass('active');
            $(a).addClass('bg-greendark');
        }
    </script>
    <div class="row">
        <?php $builder = DB::table('tranprod')
        ->leftJoin("product","product.product_id","=","tranprod.product_id")
        ->where("user_id",auth()->user()->id);
        // ->where("tranprod_active",TRUE)
        if(isset($_GET["expired"])){
            $builder->where("tranprod_outdate","<=",date("Y-m-d"));
        }
        $builder->where(function($q){
            if(isset($_GET["id"])){
                $q->where("category_id",request()->get("id"));
            }elseif(auth()->user()->id!=1){
                $q->where("user_id",auth()->user()->id);
            }
        });
        $products = $builder
        ->orderBy('product_name','asc')
        ->paginate(50);?>
        <div class="d-flex flex-row-reverse mt-1 col-md-12">{{ $products->links() }}</div>
        @foreach ($products as $product)
        <div class="col-md-2 p-1" >
            <div class="card p-3" >
                <div class="line-3">
                <img class="img-layanan" src="{{ url("/images/product_picture/".$product->product_picture) }}" class="card-img-top" alt="{{ $product->product_name }}">
                </div>
                <div class="card-body mt-4">
                    <h5 class="card-title text-center line-3">{{ $product->product_name }}</h5>
                    <h5 class="card-title text-center">{{ $product->tranprod_no }}</h5>
                    <div class="d-grid gap-2">
                        <div align="center">Out of Date : <br/>
                        <?php
                        if($product->tranprod_outdate<=date("Y-m-d")){$color="danger";}else{$color="success";}
                        ?>
                        <span class="text-{{$color}}">
                        {{ date("d M, Y",strtotime($product->tranprod_outdate)); }}
                        </span>
                        </div>
                        <?php if($product->tranprod_active==1){?>

                            <?php 
                            //whatsapp server
                            if($product->category_id==1){?>
                            <a href="<?= url("/layanandetail?id=".$product->tranprod_id."&layananid=".$product->tranprod_id."&layananname=".$product->tranprod_no);?>" class="btn btn-success btn-block">Lihat Detail</a>
                            <?php }?>

                            <?php 
                            //chat ai
                            if($product->category_id==2){?>
                            <a href="<?= url("/layananchataidetail?id=".$product->tranprod_id."&cat=".$product->category_id);?>" class="btn btn-success btn-block">Lihat Detail</a>
                            <?php }?>

                            <?php 
                            //chat ai
                            if($product->category_id==3){?>
                            <a href="<?= url("/layananchataiwadetail?id=".$product->tranprod_id."&layananid=".$product->tranprod_id."&layananname=".$product->tranprod_no);?>" class="btn btn-success btn-block">Lihat Detail</a>
                            <?php }?>

                            <?php 
                            //whatsapp server
                            if($product->category_id==4){?>
                            <a href="<?= url("/layanandetail?id=".$product->tranprod_id."&layananid=".$product->tranprod_id."&layananname=".$product->tranprod_no);?>" class="btn btn-success btn-block">Lihat Detail</a>
                            <?php }?>

                        <?php }else{?>
                            <a href="<?= url("/perpanjangan?id=".$product->tranprod_id);?>" class="btn btn-warning btn-block">Bayar</a>
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