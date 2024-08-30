<?php 
    include_once "connection.php";
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBMS </title>
  <link rel="shortcut icon" href="admin/dist/img/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo1.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
 <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- Theme style -->
  <!-- <link rel="stylesheet" href="admin/dist/css/adminlte.min.css"> -->
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->



  <!-- Main Sidebar Container -->
 <?php include_once "header.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div> --><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->





    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="container">
        <div class="input-group mt-5">
          <div class="form-outline">
            <input type="search" id="search" class="form-control" />
          </div>
          <button type="button" class="btn btn-primary" style="height:40px;">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <br>
        <div class="row" id="all">
          <?php 
            $str=$conn->prepare("SELECT * FROM `tblbloodcamp` WHERE `status`=0;");
            $str->execute();
            $data=$str->fetchAll();
            foreach ($data as $datas) {
              // code...
          
          ?>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-5">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card mb-5" style="box-shadow:10px 10px 10px 10px gray;">
                                <div class="card-body ">
                                    <div style="object-fit:cover;">
                                      <img class=" img-fluid " style="height: 200px; width:350px;" src="camp.jfif" alt="card image">
                                    </div>
                                    
                                    <p class=" mt-4"><b>Date Of Camp :</b> <?php echo ucwords( $datas['date_of_camp'])?></p>
                                    <p class="card-text mt-2"><b> Address : </b><?php echo $datas['address']?></p>
                                    <p class="card-text mt-2"><b>Start Time :</b> <?php echo $datas['start_time']?></p>
                                    <p class="card-text mt-2"><b> End Time :</b> <?php echo $datas['end_time']?></p>
                                                            
                                    <button class="btn btn-success display mt-3" ><a href="blooddonate.php?camp=<?php echo $datas['id']; ?>" style="color:white;"><i class="fa-solid fa-user-pen"></i></a></button>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <!-- /.card -->

    </section>
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once "footer.php"; ?>
  <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2012-2023.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      
      <b>Version</b> 3.2.0
    </div>
  </footer>
 --></div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/grid-gallery/js/grid-gallery.min.js"></script>
    <script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
    <script src="assets/js/script.js"></script>


<script>


//--------------------------------------------------search-------------------------------------------
  $('#search').keyup(function() {
    var search=$(this).val();
    console.log(search);
    $.ajax({
      url: 'admin/Exec/Exec_camp.php?action=search',
      type: 'POST',
      data: {search:search},
      success: function(data){
        $('#all').html(data);
      }
    });   
  });

</script>

</body>
</html>
