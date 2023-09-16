<!-- Sidebar-->
<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light"><img src="images/tokoqit_logo.png" style="width:80px; height:inherit;"/></div>
    <div class="list-group list-group-flush">  
        @auth   
            <!-- Admin -->
            <?php if(auth()->user()->position_id==1){?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-secondary text-white disabled" href="#"> Admin </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/category?default=OK') }}"> Category </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/product?default=OK') }}"> Produk </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/layanans') }}">Layanan</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/transaction?default=OK') }}">Transaksi</a>
            <?php }?>  
            

            <!-- Layanan -->
            <?php if(isset($_GET["cat"])&&$_GET["cat"]==4){?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-secondary text-white disabled" href="#"> WA Blast </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= url("/mcategory?default=OK&layananid=".$_GET["layananid"]."&layananname=".$_GET["layananname"]) ;?>"> Kategori Member </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= url("/member?default=OK&layananid=".$_GET["layananid"]."&layananname=".$_GET["layananname"]) ;?>"> Member </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= url("/wablast?fungsi=wablast&default=OK&layananid=".$_GET["layananid"]."&layananname=".$_GET["layananname"]) ;?>"> WA Blast </a>
            <?php }?> 
            <?php if(isset($_GET["cat"])&&$_GET["cat"]==2){?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-secondary text-white disabled" href="#"> Chat AI </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= url("/layananchatusaha?id=".$_GET['id']."&layananid=".$_GET['id']."&layananname=".$_GET['layananname']."&cat=".$_GET['cat']) ;?>"> Usaha </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= url("/layananchatcontact?id=".$_GET['id']."&layananid=".$_GET['id']."&layananname=".$_GET['layananname']."&cat=".$_GET['cat']) ;?>"> Kontak </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= url("/layananchataidetail?id=".$_GET['id']."&layananid=".$_GET['id']."&layananname=".$_GET['layananname']."&cat=".$_GET['cat']) ;?>"> Data </a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="<?= url("/layananchathistory?id=".$_GET['id']."&layananid=".$_GET['id']."&layananname=".$_GET['layananname']."&cat=".$_GET['cat']) ;?>"> Pesan </a>
            <?php }?> 
            
        @endauth


        <a class="list-group-item list-group-item-action list-group-item-light p-3 bg-secondary text-white disabled" href="#"> Umum </a>      
        @auth
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/layanan') }}">Layanan</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/transactions') }}">Transaksi</a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/layanan?expired=OK') }}"> Tagihan </a>
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/password') }}">Password</a>
        @else                    
            <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ url('/berita') }}">Berita</a>
        @endauth
    </div>
</div>
            