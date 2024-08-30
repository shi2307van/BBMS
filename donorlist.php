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


    <!------------------------------- display modal ------------------------------------->
            <div class="modal fade" id="displayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="" method="post" id="DisplayForm">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-danger">
                      <h5 class="modal-title" id="exampleModalLabel"><b style="color:white;">Donor Profile</b></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        
                        <div class="col-sm-12">
                          <table class="table table-borderd" style="width: 500px; margin:auto;">
                          <tr>
                              <!-- <th>User Image</th> -->
                              <td colspan="2" class="text-center"><img class="img-fluid rounded-circle" src="" id="img" alt="card image" style="width:150px;height:150px;object-fit:cover;"/></td>
                            </tr>
                            <!-- <tr>
                              <th>Donor Id</th>
                              <td id="did"></td>
                            </tr> -->
                            <tr>
                              <th>Name</th>
                              <td id="name"></td>
                            </tr>
                            <tr>
                              <th>Email-Id</th>
                              <td id="email"></td>
                            </tr>
                            <tr>
                              <th>Gender</th>
                              <td id="gender"></td>
                            </tr>
                            <tr>
                              <th>Blood Group</th>
                              <td id="blood"></td>
                            </tr>
                            <tr>
                              <th>Contact No.</th>
                              <td id="phno"></td>
                            </tr>
                            <tr>
                              <th>Address</th>
                              <td id="address"></td>
                            </tr>
                          </table>
                   
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </form>
            </div>



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
                            <div class="card mb-5" style="box-shadow:10px 10px 10px 10px gray;">
                                <div class="card-body text-center ">
                                    <p>
                                      <?php if($datas['user_img']!=''){ ?>
                                      <img class=" img-fluid rounded-circle" style="height: 150px; width:150px;" src="upload/<?php echo $datas['user_img'] ?>" alt="card image">
                                    <?php }else{ ?>
                                      <img class=" img-fluid rounded-circle" style="height: 150px; width:150px;" src="admin/dist/img/defaultAvatar.png" alt="card image">
                                      <?php } ?>
                                    </p>

                                  
                                    <h4 class="text-center mt-4"><?php echo ucwords( $datas['name'])?></h4>
                                    <p class="card-text mt-2"><?php echo $datas['blood_group']?></p>
                                                            
                                    <button class="btn btn-success display mt-3" data-toggle="modal" data-target="#displayModal" data-id="<?php echo $datas['id']?>"><i class="fa-solid fa-user-pen"></i></button>
                                   
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

  function displayalldata(){
    $.ajax({
      url: 'admin/Exec/Exec_donorlist.php?action=all',
      type: 'POST',
      success: function(data){
        $('#all').html(data);
      }
    });   
  }
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
          url: 'admin/Exec/Exec_manageDonors.php?action=show',
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
      url: 'admin/Exec/Exec_manageDonors.php?action=fetch',
      type: 'POST',
      dataType: 'json',
      data: {id:id},
      success: function(data){
        // $('#did').html(data.donor_id);
        $('#name').html(data.name);
        $('#email').html(data.email_id);
        $('#gender').html(data.gender);
        $('#blood').html(data.blood_group);
        $('#phno').html(data.phno);
        $('#address').html(data.address);
        if(data.user_img==''){
          $('#img').attr('src','admin/dist/img/defaultAvatar.png');
        }else{
          $('#img').attr('src','upload/'+data.user_img);
        }
      }
    });
  });


//--------------------------------------------------search-------------------------------------------
  $('#search').keyup(function() {
    var search=$(this).val();
    console.log(search);
    $.ajax({
      url: 'admin/Exec/Exec_donorlist.php?action=search',
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
