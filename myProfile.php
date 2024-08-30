<?php 
    include_once "connection.php";
    // session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BBMS</title>
    <link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo1.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <style>
      li a{
        color:white;
       }
       li a:hover{
        color:white;
       }
    </style>
</head>
<body>
    <?php include_once('header.php');?>
    <div class="container-fuild">
        <div class="row" >
            <div style="height:auto;" class="col-md-3 col-lg-2 bg-danger text-light text-center">
            <?php
            $user = $conn->prepare("select * from tbluser where id=".$_SESSION['user']['id']);
            $user->execute();
            $u=$user->fetch();
            ?>
                <?php if(!empty($u['user_img'])){?>
                <img src="upload/<?php echo $u['user_img'] ?>" alt="" style="height: 100px; width:100px; object-fit:fill;" class=" img-fluid rounded-circle mt-5" >
            <?php    }else{?>
                <img src="admin/dist/img/defaultAvatar.png" alt="" style="height: 100px; width:100px; object-fit:fill;" class=" img-fluid rounded-circle mt-5" ><?php } ?>
                 <p>____________________</p>
                <ul class="">
                    <li class="pt-5"> 
                        <a href="myProfile.php">Dashboard</a>  
                    </li>
                    <li class="pt-5">
                        <a href="myProfile.php?account">Account</a>   
                    </li>
                    <li class="pt-5"> 
                        <a href="myProfile.php?History">History</a> 
                    </li>
                    <li class="pt-5"> 
                        <a href="myProfile.php?change_password">Change Password</a> 
                    </li>
                    <li class="pt-5 pb-5"> 
                        <a href="logout.php">Logout</a> 
                    </li>
                </ul>
            </div>
            <div class="col-md-9">
           
            <?php
                    //get user order details
                    $name=$_SESSION['user']['name'];
                    $str=$conn->prepare("select * from tblblooddonate where status=0 and donor_id=".$_SESSION['user']['id']);
                    $str->execute();
                    $data=$str->fetch();
                    
                        // $uesr_id = $row_query['user_id'];
                        if(!isset($_REQUEST['account'])){
                            if(!isset($_REQUEST['change_password'])){
                            if(!isset($_REQUEST['History'])){
                                if(!isset($_REQUEST['delete_account'])){
                                   echo '
                                   <div class="container">
                                        <div class="row text-center">
                                            <h1 style="margin-left:100px;margin-top:100px;width:1000px;border-radius:10px;" class=" bg-danger text-light">Upcoming Donation Details</h1>
                                            <table class="table table-bordered" style="width:1000px;margin-left:100px;margin-top:-7px;">';
                                            if($str->rowCount()==0){
                                        echo '<tr colspan="2">
                                                <td>No Upcoming events</td>
                                            </tr>
                                        </table>
                                        </div>
               
                                     </div>
                                   ';       
                                            }else{
                                        echo '<tr>
                                                <th>Any Disease</th>
                                                <td>'.$data['disease'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Donation</th>
                                                <td>'.$data['donate_date'].'</td>
                                            </tr>
                                            <tr>
                                                <th>Units of blood donate</th>
                                                <td>'.$data['units_of_blood'].'</td>
                                            </tr>
                                        </table>
                                        </div>
               
                                     </div>
                                   ';       
                                            }
                                            
                                   
                                }
                            }
                        }
                    }
                    
                    if(isset($_REQUEST['account'])){
                        include('account.php');
                    }
                    if(isset($_REQUEST['change_password'])){
                        include('change_password.php');
                   }
                    if(isset($_REQUEST['History'])){
                         include('History.php');
                    }
                    if(isset($_REQUEST['delete_account'])){
                         include('logout.php');
                    }
                    
            ?>
            </div>
        </div>
    </div>
    <?php include_once('footer.php');?>
</body>
<script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/grid-gallery/js/grid-gallery.min.js"></script>
    <script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
    <script src="assets/js/script.js"></script>
</html> 