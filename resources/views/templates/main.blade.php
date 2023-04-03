
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Qithy Whatsapp</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
 
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/tokoqit_logo.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

      <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" media="screen">      

      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

      <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" media="screen"> 
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

      
        <!-- Core theme CSS (includes Bootstrap)-->
        <!-- <link href="css/styles.css" rel="stylesheet" /> -->


      <style>      
        .text-bold{font-weight:bold;}
        .text-default{font-weight:normal;}
        .naik{
          cursor:pointer;
          border:none;
          text-transform:uppercase;
          letter-spacing:2px;
          font-weight:bold;
          box-shadow:0px 8px 15px rgba(0,0,0,0.1);
          transition:all 0.3s ease;
        }
        .naik:hover{
          transform:translateY(-7px);
          box-shadow:0px 10px 25px rgba(46,223,229,0.445);
          cursor: pointer;
        }
        .mainbody{border-radius:5px; border:#EFEEEE solid 1px; box-shadow:#FEFEFE 0px 0px 10px 10px; padding:50px;}
      </style>
      @yield("header")
   </head>
   <!-- body -->
   <body class="main-layout">
      <div class="d-flex" id="wrapper">
      
         <!-- loader  -->
         <div class="loader_bg">
            <div class="loader"><img src="images/loading.gif" alt="#"/></div>
         </div>
         <!-- end loader -->
         @auth
         @include('templates/sidebar')
         @endauth
         <!-- Page content wrapper-->
         <div id="page-content-wrapper">               
            @include('templates/navbar')
            <!-- Page content-->
            <div class="container-fluid">
               @yield('container')
         
               <!--  footer -->
               <footer class="mt-5">
                     <div class="footer">
                        <div class="container">
                           <div class="row">
                              <div class=" col-md-3 col-sm-6">
                                 <ul class="social_icon">
                                    <li><a href="https://www.facebook.com/qithycomp"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.youtube.com/channel/UCBjGYMxAM-_N10yGXQveW7A"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.linkedin.com/in/ibadi-ichsan-208b6a32/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    <li><a href="https://www.instagram.com/qithycom/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                 </ul>
                                 <p class="variat pad_roght2">Yuk follow kami.
                                 </p>
                              </div>
                              <div class=" col-md-3 col-sm-6">
                                 <h3>LET US HELP YOU </h3>
                                 <p  class="variat pad_roght2">Pastinya perusahaan anda membutuhkan aplikasi yang membantu beban kerja karyawan. Oleh karena itu kami menawarkan bantuan pembuatan aplikasi baik web, android maupun robotik, yang dapat menyesuaikan dengan kebutuhan perusahaan anda.
                                 </p>
                              </div>
                              <div class="col-md-3 col-sm-6">
                                 <h3>INFORMATION</h3>
                                 <ul class="link_menu">
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html"> About</a></li>
                                    <li><a href="service.html">Services</a></li>
                                    <li><a href="gallery.html">Gallery</a></li>
                                    <li><a href="testimonial.html">Testimonial</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                 </ul>
                              </div>
                              <div class="col-md-3 col-sm-6">
                                 <h3>Our Spirit</h3>
                                 <p  class="variat">Percayakan perawatan aplikasi anda pada kami.
                                 </p>
                              </div>
                              <div class="col-md-6 offset-md-6">
                                 <form id="hkh" class="bottom_form">
                                    <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                                    <button class="sub_btn">subscribe</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="copyright">
                           <div class="container">
                              <div class="row">
                                 <div class="col-md-10 offset-md-1">
                                    <p>© 2019 All Rights Reserved. Powered by <a href="https://www.qithy.com/"> Qithy.com</a></p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </footer>
                  <!-- end footer -->


                  <?php 
               if(Session::get('message')){
                  $message=Session::get('message');
                  $tipe=Session::get('tipe');
                  session()->forget('message');
                  session()->forget('tipe');
                  switch ($tipe) {
                  case 'success':          
                     alert()->success('Pesan',Session::get('message'));
                  break;
                  case 'warning':          
                     alert()->warning('Pesan',Session::get('message'));
                  break;
                  case 'error':          
                     alert()->error('Pesan',Session::get('message'));
                  break;
                  default:          
                     alert()->info('Pesan',Session::get('message'));
                  break;
                  }
               }
               ?>
               @include('sweetalert::alert')
               <script>
                     $(document).ready(function() {
                        $('#example').DataTable( {
                        "lengthMenu": [[100, "All", 50, 25], [100, "All", 50, 25]]
                        } );
                     } );              
               </script>
               @yield("footer")
         
            </div>
         </div>
         <!-- Optional JavaScript; choose one of the two! -->
         <!-- Option 1: Bootstrap Bundle with Popper -->
         {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
         <!-- Option 2: Separate Popper and Bootstrap JS -->
         <!--
         <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
         -->

         <!-- Javascript files-->
         <script src="js/jquery.min.js"></script>
         <!-- <script src="js/bootstrap.bundle.min.js"></script> -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
   
         <script src="js/jquery-3.0.0.min.js"></script>
         <!-- sidebar -->
         <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
         <script src="js/custom.js"></script>

         <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
      
         <!-- Bootstrap core JS-->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
         <!-- Core theme JS-->
         <script src="js/scripts.js"></script>
      </div>
   </body>
</html>