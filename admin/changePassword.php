<?php
  include_once "../connection.php";
   if(!isset($_SESSION['user'])){
        header('Location:../login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBMS | Change Password</title>
    <link rel="shortcut icon" href="dist/img/logo.jpg" type="image/x-icon">
   <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
  <?php include_once "topnav.php"; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
   <?php include_once "sidenav.php"; ?>

   <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid pt-3">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-secondary ">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <form id="changePasswordForm" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="opwd">Old Password</label>
                    <input type="password" name="oldpassword" class="form-control" id="opwd" placeholder="Enter old password">
                  </div>
                  <div class="form-group">
                    <label for="npwd">New Password</label>
                    <input type="password" name="newpassword" class="form-control" id="npwd" placeholder="Enter new password">
                  </div>
                  <div class="form-group">
                    <label for="cpwd">Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control" id="cpwd" placeholder="Enter confirm password">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="btnChangePassword">Change Password</button>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
    </section>
   </div>
  </div>
    
    <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript">
  $(function () {
  $('#changePasswordForm').validate({
    rules: {
      oldpassword: {
        required: true, 
        minlength: 8
      },
      newpassword: {
        required: true,
        minlength: 8
      },
      confirmpassword: {
        required: true,
        minlength: 8,
        equalTo: "#npwd",
      },
    },
    messages: {
      oldpassword: {
        required: "Please provide a old password",
        minlength: "Your password must be at least 8 characters long"
      },
      newpassword: {
        required: "Please provide a new password",
        minlength: "Your password must be at least 8 characters long"
      },
      confirmpassword: {
        required: "Please provide a confirm password",
        equalTo:"New password and Confirm password must be same",
        minlength: "Your password must be at least 8 characters long"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler:function(){
      var opwd=$("#opwd").val();
      var npwd=$("#npwd").val();
      var cpwd=$("#cpwd").val();
      jQuery.ajax({
        url: 'Exec/Exec_changePassword.php',
        type: 'POST',
        dataType: 'json',
        data: {
          opwd:opwd,
          npwd:npwd,
          cpwd:cpwd
        },
        success: function(data) {
          //called when successful
          // Swal.fire("Good job!", "Data Updated Successfully!", "success",2000,false);
          // Swal.fire(data.title,data.messages,data.type);
          // if(data.type=='success'){
          //   location.reload(dashboard.php);
          // }
          Swal.fire({
            // position: 'top-end',
            title:data.title,
            icon: data.type,
            title: data.messages,
            showConfirmButton: false,
            timer: 3000
          });
          if(data.status==200){
            window.location="myprofile.php";
          }
          }
        });
     
      
    }
  });
});
</script>
</body>
</html>
