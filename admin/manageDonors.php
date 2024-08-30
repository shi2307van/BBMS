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
  <title>BBMS | Manage Donors</title>
  <link rel="shortcut icon" href="dist/img/logo.jpg" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
 <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
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
            <h1 class="m-0">Manage Donors</h1>
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


    <!------------------------------- display modal ------------------------------------->
            <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="" method="post" id="DisplayForm">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-info">
                      <h5 class="modal-title" id="exampleModalLabel">Donor Profile</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <img class=" img-fluid rounded-circle" src="" id="img" alt="card image"/>
                        </div>
                        <div class="col-sm-8">
                          <div class="form-group">
                            <label for="did">Donor Id</label>
                            <input type="text" class="form-control" id="did" disabled>
                          </div>
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="" class="form-control" id="name" disabled>
                          </div>
                          <div class="form-group">
                            <label for="email">Email-Id</label>
                            <input type="text" name="" class="form-control" id="email" disabled>
                          </div>
                          <div class="row">
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="gender">Gender</label>
                                <input type="text" name="" class="form-control" id="gender" disabled>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="group">Blood Group</label>
                                <input type="text" name="" class="form-control" id="blood" disabled>
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="form-group">
                                <label for="phno">Contact No.</label>
                                <input type="text" name="" class="form-control" id="phno" disabled>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="" id="address" class="form-control" cols="25" rows="5" disabled></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>



    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="container-fluid">
        <div class="input-group">
          <div class="form-outline">
            <input type="search" id="search" class="form-control" />
          </div>
          <button type="button" class="btn btn-primary">
            <i class="fas fa-search"></i>
          </button>
        </div>
        <br>
        <div class="row" id="all">
          <?php 
            $str=$conn->prepare("select * from tbluser where user_type='donor' and status in(0,1)");
            $str->execute();
            $data=$str->fetchAll();
            foreach ($data as $datas) {
              // code...
          
          ?>
            <div class="col-xs-12 col-sm-6 col-md-4 mt-5">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card border border-info">
                                <div class="card-body text-center">
                                    <p>
                                      <?php if($datas['user_img']!=''){ ?>
                                      <img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="../upload/<?php echo $datas['user_img'] ?>" alt="card image">
                                    <?php }else{ ?>
                                      <img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="dist/img/defaultAvatar.png" alt="card image">
                                      <?php } ?>
                                    </p>

                                    <p class="text-center"><?php echo $datas['donor_id']?></p>
                                    <h4 class="text-center"><?php echo ucwords( $datas['name'])?></h4>
                                    <p class="card-text"><?php echo $datas['email_id']?></p>
                                    <?php if($datas['status']==1){?>
                                    <button class="btn btn-info hide" data-id="<?php echo $datas['id']?>"><i class="fa-solid fa-eye-slash"></i></button><?php } ?>
                                    <?php if($datas['status']==0){ ?>
                                    <button class="btn btn-info public" data-id="<?php echo $datas['id']?>"><i class="fa-solid fa-eye"></i></button><?php } ?>
                                    <button class="btn btn-success display" data-toggle="modal" data-target="#displayModal" data-id="<?php echo $datas['id']?>"><i class="fa-solid fa-user-pen"></i></button>
                                    <button class="btn btn-danger delete" data-id="<?php echo $datas['id']?>"><i class="fa-solid fa-trash-can"></i></button>
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
<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>

  function displayalldata(){
    $.ajax({
      url: 'Exec/Exec_manageDonors.php?action=all',
      type: 'POST',
      success: function(data){
        $('#all').html(data);
      }
    });   
  }


  $(document).ready(function(){
    

  // ---------------------------------------------delete data----------------------------------------
  $(document).on('click','.delete',function(){
    var id=$(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you really want to delete?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'Exec/Exec_manageDonors.php?action=delete',
          type: 'POST',
          dataType: 'json',
          data: {id:id},
          success: function(data){
            Swal.fire(
              data.title,
              data.messages,
              data.type
            )
            displayalldata();
          }
        });
      }
    })
  });


// ------------------------------------------------hide data--------------------------------------------
  $(document).on('click','.hide',function(){
    var id=$(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you really want to hidden this detail?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#b464ed',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'Exec/Exec_manageDonors.php?action=hide',
          type: 'POST',
          dataType: 'json',
          data: {id:id},
          success: function(data){
            Swal.fire(
              data.title,
              data.messages,
              data.type
            )
            displayalldata();
          }
        });
      }
    })
  });


// ------------------------------------------------show data--------------------------------------------
  $(document).on('click','.public',function(){
    var id=$(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "Do you really want to show this detail?",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#b464ed',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'Exec/Exec_manageDonors.php?action=show',
          type: 'POST',
          dataType: 'json',
          data: {id:id},
          success: function(data){
            Swal.fire(
              data.title,
              data.messages,
              data.type
            )
            displayalldata();
          }
        });
      }
    })
  });


// ---------------------------------------------------fetch----------------------------------------------
  $(document).on('click','.display',function(){
    var id=$(this).data('id');
    $.ajax({
      url: 'Exec/Exec_manageDonors.php?action=fetch',
      type: 'POST',
      dataType: 'json',
      data: {id:id},
      success: function(data){
        $('#did').val(data.donor_id);
        $('#name').val(data.name);
        $('#email').val(data.email_id);
        $('#gender').val(data.gender);
        $('#blood').val(data.blood_group);
        $('#phno').val(data.phno);
        $('#address').val(data.address);
        if(data.user_img==''){
          $('#img').attr('src','dist/img/defaultAvatar.png');
        }else{
          $('#img').attr('src','../upload/'+data.user_img);
        }
      }
    });
  });

//--------------------------------------------------search-------------------------------------------
  $('#search').keyup(function() {
    var search=$(this).val();
    $.ajax({
      url: 'Exec/Exec_manageDonors.php?action=search',
      type: 'POST',
      data: {search:search},
      success: function(data){
        $('#all').html(data);
      }
    });   
  });
});

</script>
</body>
</html>
