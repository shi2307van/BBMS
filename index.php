<?php
include 'connection.php';
?>
<!doctype html>
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
</head>
<?php 
    $str=$conn->prepare("SELECT * FROM `tblbloodcamp` where status=0 ORDER BY date_of_camp LIMIT 1");
    $str->execute();
    $data=$str->fetch();

 ?>
<body>
    <?php include_once('header.php');?>
    <!-- ################# Slider Starts Here#######################--->
    <div style="background-color: #de1f26;"><marquee style="color: white;margin-top: 5px;">The next camp will be held in  <?php echo $data['address']; ?> on <?php echo $data['date_of_camp']; ?>.</marquee></div>
    <div class="slider-detail">

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/images/slider/bg1.jpg" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5 class=" bounceInDown">Be the reason for someone’s heartbeat.</h5>
                        <p class=" bounceInLeft">Blood Donation Is The Act Of Giving Blood To Someone Who Needs It. It Is Not Just About Giving Blood, <br>But It Is An Act Of Kindness That Saves The Lives Of Hundreds Of People. These Fifteen Minutes Of Your Life Can Save Someone’s Entire Life.</p>

                        <div class=" vbh">

                            <a href="blooddonate.php" class="btn btn-success  bounceInUp"> Book Appointment </a>
                            <a href="contactus.php" class="btn btn-success  bounceInUp"> Contact Us </a>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/images/slider/slide-03.jpg" alt="Third slide">
                    <div class="carousel-caption vdg-cur d-none d-md-block">
                        <h5 class=" bounceInDown">Be a saviour just by donating your blood.</h5>
                        <p class=" bounceInLeft">You Can’t Even Imagine That Donating One Bag Of Blood Can Be So Beneficial To The Human Race. Donating The Blood Without Expecting Or Asking For Any Money Or Gesture Is A Great Act Of Kindness, And If You Are 18 Years Old Or Above, You Should Definitely Take Part In This Act Of Kindness.</p>

                        <div class=" vbh">

                            <a href="bloodrequest.php" class="btn btn-success  bounceInUp"> Blood Request </a>
                            <a href="contactus.php" class="btn btn-success  bounceInUp"> Contact Us </a>
                        </div>
                    </div>
                </div>

            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


    </div>
    <h1 class='mt-5 text-center text-danger'>LEARN ABOUT DONATION</h1>
            
            <div class="row mt-5">
                <div class="col-md-6 ">
                <img src="bbms.jpg" alt="" height="500" width="700">
                </div>
                <div class="col-md-6 ">
                
                    <table id="bloodType" class="table table-bordered table-hover" style="width:600px; margin: auto;border: 1px solid;">
                    <thead>
                    <tr>
                        <h5 style='margin-left:75px;background-color:red;color:white;width:600px;padding:10px;'>
                        Compatible Blood Type Donors
                        </h5>
                    </tr>
                    <tr>
                        
                        <th>Blood Type</th>
                        <th>Donate Blood To</th>
                        <th>Receive Blood From</th>
                        
                    </tr>
                    </thead>
                    <tbody id="bloodData">
                    <?php 
                    $str=$conn->prepare("select * from tblbloodgroup");
                    $str->execute();
                    $data=$str->fetchAll();
                    $i=1;
                    foreach($data as $datas){
                        ?>
                        <tr>
                       
                        <td style='color:red;'><?php echo $datas['blood_type']?></td>
                        <td><?php echo $datas['donate_blood_to']?></td>
                        <td><?php echo $datas['receive_blood_from']?></td>
                       
                        </tr>
                    <?php
                    $i++;
                    } 
                    ?>
                    
                    </tbody>
                    </table>
         
                </div>
            </div>
        
            <div class="mt-5">
            <h1 class='mt-5 text-center text-danger'>TYPES OF DONATION</h1>
            <p class="text-center mt-5 mb-5">The human body contains five liters of blood, which is made of several useful components i.e. <b>Whole blood</b>, <b>Platelet</b>, and <b>Plasma</b>.</br> </br>Each type of component has several medical uses and can be used for different medical treatments. your blood donation determines the best donation for you to make.</br></br>For <b>plasma</b> and <b>platelet</b> donation you must have donated whole blood in past two years.</p>
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
