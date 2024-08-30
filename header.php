<?php 
    include_once "connection.php";
 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
        <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
        <style>
            .login{
          color: #fff;
      }
      .login:hover{
        color: #fff;
      }
        </style>
    </head>
    <body>
    <header class="continer-fluid ">
            <div class="header-top">
                <div class="container">
                    <div class="row col-det">
                        <div class="col-lg-6 d-none d-lg-block">
                            <ul class="ulleft">
                                    <?php
                                        if(isset($_SESSION['user'])){
                                            echo " 
                                            <li>
                                   
                                            <h4>Welcome Our Website ".$_SESSION['user']['name']."  !!!!!  </h4>
                                    </li>
                                             
                                            ";
                                        }
                                    
                                    ?>
                                <!-- <li>
                                    <i class="far fa-envelope"></i>
                                    sales@smarteyeapps.com
                                    <span>|</span></li>
                                <li>
                                    <i class="far fa-clock"></i>
                                    Service Time : 12:AM</li> -->
                            </ul>
                        </div>
                        <div class="col-lg-5 col-md-12 ml-5">
                            <ul class="ulright">
                               <!--  <li>
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    Upload Video
                                    <span>|</span></li> -->
                                
                                   

                                    <?php
                                        if(!isset($_SESSION['user'])){
                                            echo " <li>
                                            <i class='fas fa-user'></i> <a class='login' href='login.php'>Login </a>
                                             </li>";
                                        }
                                        else{
                                            echo "  <li>
                                            <i class='fas fa-user'></i> <a class='login' href='logout.php'>Logout </a>
                                             </li>";
                                         
                                        }
                                    ?>
                                    
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="menu-jk" class="header-bottom">
                <div class="container">
                    <div class="row nav-row">
                        <div class="col-md-2 logo">
                            <!-- <img src="assets/images/logo.jpg" alt=""> -->
                            <h3 style="color: #dc3545;" class="mt-4"><b>BBMS</b></h3>
                        </div>
                        <div class="col-md-10 nav-col">
                            <nav class="navbar navbar-expand-lg navbar-light">

                                <button
                                    class="navbar-toggler"
                                    type="button"
                                    data-toggle="collapse"
                                    data-target="#navbarNav"
                                    aria-controls="navbarNav"
                                    aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="index.php">Home
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="about.php">About Us</a>
                                        </li>
                                       
                                        <li class="nav-item">
                                            <a class="nav-link" href="camp.php">Camps</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" href="donorlist.php">Donor List</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="blog.php">Blog</a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a class="nav-link" href="contactus.php">Contact US</a>
                                        </li>
                                        <?php 
                                            if(isset($_SESSION['user'])){
                                                echo " <li class='nav-item'>
                                                <a class='nav-link' href='myProfile.php'> My Profile </a>
                                            </li> ";
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </body>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/grid-gallery/js/grid-gallery.min.js"></script>
    <script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
    <script src="assets/js/script.js"></script>
</html>