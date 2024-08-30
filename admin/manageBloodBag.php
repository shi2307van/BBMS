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
  <title>BBMS | Blood Bag</title>
  <link rel="shortcut icon" href="dist/img/logo.jpg" type="image/x-icon">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
 <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h1 class="m-0">Manage Blood Bag</h1>
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
      <div class="container-fluid">
        <div class="row">
          <?php 
            $str=$conn->prepare("select * from tblbloodgroup");
            $str->execute();
            $data=$str->fetchAll();
            foreach($data as $datas){
              $blood=$datas['blood_type'];
              $sql=$conn->prepare("select * from tblbloodbag where status=0 and blood_group='$blood'");
              $sql->execute();
              $count=$sql->rowCount();
          ?>
  <div class="col-sm-3 mb-3 mb-sm-0">
    <div class="card border border-danger">
      <div class="card-body">
        <h5 class="card-title">Blood Avilability</h5>
        <p class="card-text"><?php echo $blood; ?></p>
        <p class="card-text text-right"><?php echo $count; ?></p>
      </div>
    </div>
  </div>
<?php } ?>
</div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Blood Bag</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tblquery" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:25px;">#</th>
                    <th>Blood bag Id</th>
                    <th>Donor</th>
                    <th>Blood Group</th>
                    <th>Receive date</th>
                    <th>Valid Upto</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody id="bagData">
                  <?php 
                  $str=$conn->prepare("select * from tblbloodbag");
                  $str->execute();
                  $data=$str->fetchAll();
                  $i=1;
                  foreach($data as $datas){
                    $sql=$conn->prepare("select * from tbluser where id=".$datas['donor_id']);
                    $sql->execute();
                    $data1=$sql->fetch();
                    ?>
                    <tr>
                      <td><?php echo $i.'.';?></td>
                      <td><?php echo $datas['blood_bag_id'];?></td>
                      <td><?php echo $data1['name']?></td>
                      <td><?php echo $datas['blood_group']?></td>
                      <td><?php echo $datas['receive_date']?></td>
                      <td><?php echo $datas['valid_upto']?></td>
                        <?php 
                        if($datas['status']=='-1'){
                          ?>
                        <td>
                          Expired 
                        </td>
                      <?php } ?>
                        <?php 
                        if($datas['status']==1){
                          ?>
                        <td>
                          Allocated /
                          <a href="#" class="text-danger exit" data-id="<?php echo $datas['id']?>">Exit</a>
                        </td>
                      <?php } ?>
                        <?php 
                        if($datas['status']==2){
                          ?>
                        <td>
                         Exit
                        </td>
                      <?php } ?>
                      <?php 
                        if($datas['status']==0){
                          ?>
                        <td>
                          Pending
                         <!--  <a href="#" class="text-success accept" data-id="<?php echo $datas['id']?>">Accept</a> / 
                        <a href="#" class="text-danger reject" data-id="<?php echo $datas['id']?>">Reject</a> -->
                        </td>
                      <?php }?>
                    </tr>
                  <?php
                  $i++;
                  } 
                   ?>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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

  // function displayalldata(){
  //   $.ajax({
  //     url: 'Exec/Exec_manageBloodDonate.php?action=all',
  //     type: 'POST',
  //     success: function(data){
  //       $('#queryData').html(data);
  //     }
  //   });   
  // }


$(document).ready(function(){

  $('#tblquery').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": false,
    "info": false,
    "autoWidth": false,
    "responsive": true,
  });

// ----------------------------------------------pending to read--------------------------------------------
  $(document).on('click','.exit',function(){
    var id=$(this).data('id');
    
        $.ajax({
          url: 'Exec/Exec_manageBloodBag.php?action=exit',
          type: 'POST',
          dataType: 'json',
          data: {id:id},
          success: function(data){
           Swal.fire({
            // position: 'top-end',
            title:data.title,
            icon: data.type,
            title: data.messages,
            showConfirmButton: false,
            timer: 3000
          });
            location.reload();
          }
        });
      
    });


// // ---------------------------------------------delete data----------------------------------------
//   $(document).on('click','.reject',function(){
//     var id=$(this).data('id');
//     Swal.fire({
//       title: 'Are you sure?',
//       text: "Do you really want to reject this request?",
//       icon: 'warning',
//       showCancelButton: true,
//       confirmButtonColor: '#3085d6',
//       cancelButtonColor: '#d33',
//       confirmButtonText: 'Yes, reject it!'
//     }).then((result) => {
//       if (result.isConfirmed) {
//         $.ajax({
//           url: 'Exec/Exec_manageBloodDonate.php?action=reject',
//           type: 'POST',
//           dataType: 'json',
//           data: {id:id},
//           success: function(data){
//             Swal.fire(
//               data.title,
//               data.messages,
//               data.type
//             )
//             displayalldata();
//           }
//         });
//       }
//     })
//   });

});
</script>
</body>
</html>
