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
  <title>BBMS | Blood Group Details</title>
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
            <h1 class="m-0">Blood Group Details</h1>
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

   <!------------------------------- Add data modal ------------------------------------->
            <div class="modal fade" id="addDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="" method="post" id="addForm">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Blood Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="blood">Blood Type</label>
                        <input type="text" name="txtblood" class="form-control" id="blood" pattern="[a-zA-Z+-]*">
                      </div>
                      <div class="form-group">
                        <label for="to">Donate Blood To</label>
                        <input type="text" name="txtto" class="form-control" id="to" pattern="[a-zA-Z+-]*">
                      </div>
                      <div class="form-group">
                        <label for="from">Received Blood From</label>
                        <input type="text" name="txtfrom" class="form-control" id="from" pattern="[a-zA-Z+-]*">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary" id="btnAdd">ADD</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>


<!------------------------------- update modal ------------------------------------->
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="" method="post" id="updateForm">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-info">
                      <h5 class="modal-title" id="exampleModalLabel">Update Blood Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <input type="hidden" name="txtid" id="eid" class="form-control">
                        <label for="eblood">Blood Type</label>
                        <input type="text" name="txtblood" class="form-control" id="eblood" pattern="[a-zA-Z+-]*">
                      </div>
                      <div class="form-group">
                        <label for="eto">Donate Blood To</label>
                        <input type="text" name="txtto" class="form-control" id="eto" pattern="[a-zA-Z+-]*">
                      </div>
                      <div class="form-group">
                        <label for="efrom">Received Blood From</label>
                        <input type="text" name="txtfrom" class="form-control" id="efrom" pattern="[a-zA-Z+-]*">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-success" id="btnUpdate">Update</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <button type="button" class="btn mb-3 ml-3" data-toggle="modal" data-target="#addDataModal" id="add" style="background-color: #1be3b4;"><i class="fa-solid fa-plus"></i> Add Data </button>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Compatible Blood Type Donors</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="bloodType" class="table table-bordered table-hover" style="width:600px; margin: auto;border: 2px solid;">
                  <thead>
                  <tr>
                    <th style="width:25px;"># </th>
                    <th>Blood Type</th>
                    <th>Donate Blood To</th>
                    <th>Receive Blood From</th>
                    <th>Actions</th>
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
                      <td><?php echo $i.'.';?></td>
                      <td><?php echo $datas['blood_type']?></td>
                      <td><?php echo $datas['donate_blood_to']?></td>
                      <td><?php echo $datas['receive_blood_from']?></td>
                      <td>
                        <a href="#" class="btn btn-success update" data-toggle="modal" data-target="#updateModal" data-id="<?php echo $datas['id']?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" class="btn btn-danger delete" data-id="<?php echo $datas['id']?>"><i class="fa-solid fa-trash-can"></i></a>
                      </td>
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

  function displayalldata(){
    $.ajax({
      url: 'Exec/Exec_bloodGroupDetail.php?action=all',
      type: 'POST',
      success: function(data){
        $('#bloodData').html(data);
      }
    });   
  }


$(document).ready(function(){

  $('#bloodType').DataTable({
    "paging": false,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": false,
    "autoWidth": false,
    "responsive": true,
  });

// ----------------------------------------------add data--------------------------------------------
  $('#btnAdd').click(function() {
    $.ajax({
      url: 'Exec/Exec_bloodGroupDetail.php?action=add',
      type: 'POST',
      dataType: 'json',
      data: $('#addForm').serialize(),
      success: function(data){
        Swal.fire({
          icon: data.type,
          title: data.title,
          text: data.messages,
        });
        $('#addDataModal').find('form').trigger('reset');
        $('#addDataModal').modal('hide');
        // table.ajax.reload();
        displayalldata();
      }
    });
  });


// ---------------------------------------------delete data----------------------------------------
  $(document).on('click','.delete',function(){
    var id=$(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: 'Exec/Exec_bloodGroupDetail.php?action=delete',
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


// -------------------------------------------fetch for update modal------------------------------------------
  $(document).on('click','.update',function(){
    var id=$(this).data('id');
    $.ajax({
      url: 'Exec/Exec_bloodGroupDetail.php?action=fetch',
      type: 'POST',
      dataType: 'json',
      data: {id:id},
      success: function(data){
        $('#eid').val(data.id);
        $('#eblood').val(data.blood_type);
        $('#eto').val(data.donate_blood_to);
        $('#efrom').val(data.receive_blood_from);
      }
    });
  });


// ------------------------------------------update data--------------------------------------
  $('#btnUpdate').click(function(){
    $.ajax({
      url: 'Exec/Exec_bloodGroupDetail.php?action=update',
      type: 'POST',
      dataType: 'json',
      data: $('#updateForm').serialize(),
      success: function(data){
        Swal.fire({
          icon: data.type,
          title: data.title,
          text: data.messages,
        });
        $('#updateModal').find('form').trigger('reset');
        $('#updateModal').modal('hide');
        // table.ajax.reload();
        displayalldata();
      }
    });
  });
});
</script>
</body>
</html>
