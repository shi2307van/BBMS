<?php 
    include_once "../connection.php";
    if(!isset($_SESSION['user'])){
        header('Location:../login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBMS | My profile</title>
  <link rel="shortcut icon" href="dist/img/logo.jpg" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

  <!-- Navbar -->
  <?php include_once "topnav.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once "sidenav.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">My Profile</h1>
          </div><!-- /.col -->
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
      <div class="container-fluid pt-3">
        <!-- Small boxes (Stat box) -->
          <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#updateProfileModal" id="update"><i class="fa-solid fa-pen-to-square"></i>Update Profile</button>     

            <!-- update profile modal -->
            <div class="modal fade" id="updateProfileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                        <label for="ename">Admin name</label>
                        <input type="text" class="form-control" id="ename">
                      </div>
                      <div class="form-group">
                        <label for="eemialid">Email</label>
                        <input type="email" class="form-control" id="eemailid">
                      </div>
                      <div class="form-group">
                        <label for="ephno">Contact no.</label>
                        <input type="text" class="form-control" id="ephno">
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <label for="egender">Gender</label>
                          <select name="txtgender" id="egender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <!-- <input type="text" class="form-control" id="gender" value="'.$data['gender'].'" disabled> -->
                        </div>
                        <div class="col-sm-6">
                          <label for="egroup">Blood Group</label>
                                            <select class="form-select form-control" name="txtgroup" aria-label="" id="egroup">
                                              <option value="" selected>---Select---</option>
                                              <?php 
                                                $str=$conn->prepare("select * from tblbloodgroup");
                                                $str->execute();
                                                $data=$str->fetchAll();
                                                foreach($data as $datas){
                                               ?>
                                              <option value="<?php echo $datas['blood_type'] ?>"><?php echo $datas['blood_type'] ?></option>
                                              
                                          <?php } ?>
                                            </select>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnUpdate">Save changes</button>
                  </div>
                </div>
              </div>
            </div>




<!-- ------------------------------------------ update profile photo --------------------------------------------------->
            <div class="modal fade" id="updateProfilePhoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Profile Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="" method="post" enctype="multipart/form-data" id="upimg">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="img">Admin Photo</label>
                        <input type="file" class="form-control" id="img" accept="image/jpeg, image/png" name="img">
                      </div>
                      
                      
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnImage">Save Image</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
<!-- ------------------------------------------------------------------------------------------------------------------- -->
          
        <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">My Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">

                      <?php 
                        $str=$conn->prepare("select * from tbluser where id=".$_SESSION['user']['id']);
                        $str->execute();
                        $data=$str->fetch();
                       ?>

                      <?php if($data['user_img']==''){ ?>
                      <img src="dist/img/defaultAvatar.png" class="rounded-circle m-0" style="object-fit: cover;" alt="" height="300px" width="300px"><?php }else{ ?>
                      <img src="../upload/<?php echo $data['user_img']; ?>" height="300px" width="300px" style="object-fit: cover;" class="rounded-circle m-0" alt=""><?php } ?>
                      <div class="text-center"><button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target="#updateProfilePhoto">Update Image</button></div>
                      
                    </div>
                    <div class="col-md-8" id="profile">
                      
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

               <!--  <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div> -->
              </form>
            </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once "footer.php"; ?>
 <!--  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>

  function dispayprofile(){
    $.ajax({
      url: 'Exec/Exec_myProfile.php?action=display',
      type: 'POST',
      success:function(data){
        $('#profile').html(data);
      }
    });
    
    
  }
  $(document).ready(function(){
    dispayprofile();

    $(document).on('click','#update',function(){
      $.ajax({
        url: 'Exec/Exec_myProfile.php?action=fetch',
        type: 'POST',
        dataType: 'json',
        success:function(data){
          $('#ename').val(data.name);
          $('#eemailid').val(data.email_id);
          $('#ephno').val(data.phno);
        }
      });
      
      
    });
    // ---------------------------------------------------update-------------------------------------------
    $(document).on('click','#btnUpdate',function(){
      var admin_id=$('#admin_id').val();
      var name=$('#ename').val();
      var email=$('#eemailid').val();
      var phno=$('#ephno').val();
      var gender=$('#egender').val();
      var group=$('#egroup').val();
      $.ajax({
        url: 'Exec/Exec_myProfile.php?action=update',
        type: 'POST',
        dataType: 'json',
        data: {
          id:admin_id,
          name:name,
          email:email,
          phno:phno,
          gender:gender,
          group:group,
        },
        success:function(data){
          Swal.fire({
            // position: 'top-end',
            title:data.title,
            icon: data.type,
            title: data.messages,
            showConfirmButton: false,
            timer: 3000
          });
          $('#updateProfileModal').find('form').trigger('reset');
          $('#updateProfileModal').modal('hide');
          dispayprofile();
        }
      });
    });



    //---------------------------------------------update image------------------------------
    $("#upimg").on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url: 'Exec/Exec_myprofile.php?action=image',
        type: 'POST',
        dataType: 'json',
        contentType:false,
        processData:false,
        data: new FormData(this),
        success: function(data){
            Swal.fire(
              data.title,
              data.messages,
              data.type
            ).then((result)=>{
              if(result.isConfirmed){
                location.reload();    
              }
            })
            
          }  
    });
});
  });
</script>
</body>
</html>
