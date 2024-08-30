<?php
  include_once "connection.php";
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BBMS</title>
    <link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
   <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
  <style>
    .invalid-feedback{
      font-weight: 550;
    }
  </style>
</head>
<body class="jumbotron">
    <section class="content" style="margin-top: 100px">
      <div class="container align-items-center justify-content-center">
        <div class="row">
          <div class="col-md-4 offset-md-4">
            <div class="card card-primary ">
              <form id="loginForm" method="post">
                <h3 class="text-center pt-3"><b>Log In</b></h3>
                <div class="card-body">
                  <div class="form-group">
                    <label for="emailid">Username</label>
                    <input type="email" name="txtemail" class="form-control" id="emailid" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="txtpwd" class="form-control" id="password" placeholder="Password">
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block mb-2" name="btnLogin">Log In</button>
                  <a href="forgotPassword.php" data-toggle="modal" data-target="#forgotPasswordModal">I Forgot my password</a>
                  <p>Not register?<a href="register.php" >Create an account</a></p>
                </div>
              </form>
            </div>
            </div>
        </div>
      </div>
    </section>

    <!------------------------------------- forgot password modal ----------------------------------->
            <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <form action="#" method="POST" id="forgotForm">
                        <div class="form-group">
                        <label for="uname">Email-Id</label>
                        <input type="email" class="form-control" name="txtuname" id="uname" placeholder="abc123@xyz.com">
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="sentOtp" style="border-radius: 20px;">Send OTP</button>
                      </div>
                      </form>
                      <div class="text-danger mt-2">
                        <b>Note:</b>Please check you Inbox & Spam folders of email id for OTP.
                      </div>
                  </div>
                </div>
              </div>
            </div>

    <!------------------------------- reset password modal ------------------------->
            <div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <form action="#" method="POST" id="resetForm">
                        <div class="form-group">
                          <label for="otp">OTP Code:</label>
                          <input type="text" class="form-control" name="txtotp" id="otp">
                        </div>
                        <div class="form-group">
                          <label for="npwd">New Password:</label>
                          <input type="password" class="form-control" name="txtnpwd" id="npwd">
                        </div>
                        <div class="form-group">
                          <label for="cpwd">Confirm Password:</label>
                          <input type="password" class="form-control" name="txtcpwd" id="cpwd">
                        </div>
                        <div class="text-center">
                          <button type="submit" class="btn btn-primary" id="btnReset" style="border-radius: 20px;">Reset Password</button>
                        </div>
                      </form>
                  </div>
                </div>
              </div>
            </div> 
    <!-- jQuery -->
<script src="admin/plugins/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="admin/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="admin/dist/js/adminlte.min.js"></script>


<script type="text/javascript">
  $(function () {
//--------------------------------------- reset password-------------------------------------------------
    if(window.location.href.indexOf("action") >-1){
      $('#resetPasswordModal').modal('show');
      // QS=window.location.search;
      // console.log(QS);
      const params = new URLSearchParams(window.location.search);
      // var ac = params.get('action');
      var action=atob(params.get('action'));
      // console.log(action);

      $('#resetForm').validate({
    rules: {
      txtotp: {
        required: true,
        digits:true,
        maxlength: 6 
      },
      txtnpwd: {
        required: true,
        minlength: 8
      },
      txtcpwd: {
        required: true,
        minlength:8,
        equalTo: "#npwd",
      },
    },
    messages: {
      txtotp: {
        required: "Please enter an OTP",
      },
      txtnpwd: {
        required: "Please provide a new password",
        minlength: "Your password must be at least 8 characters long"
      },
      txtcpwd: {
        required: "Please provide a confirm password",
        minlength: "Your password must be at least 8 characters long",
        equalTo: "Password and confirm password must be same."
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
      var otp=$('#otp').val();
      var npwd=$('#npwd').val();

      jQuery.ajax({
        url: 'admin/Exec/Exec_forgotPassword.php?action=reset',
        type: 'POST',
        dataType: 'json',
        data: {
          uname:action,
          otp:otp,
          npwd:npwd
        },
        success: function(data) {
          Swal.fire({
            // position: 'top-end',
            title:data.title,
            icon: data.type,
            title: data.messages,
            showConfirmButton: false,
            timer: 3000
          });
          if(data.status==200){
            $('#resetPasswordModal').modal('hide');
          }
          else{
            $('#resetPasswordModal').find('form').trigger('reset');
            // $('#resetPasswordModal').modal('hide');
          }
          }
        });
        
      
    }
  });
 }

 // -----------------------------------------------Log In-------------------------------------------
  $('#loginForm').validate({
    rules: {
      txtemail: {
        required: true,
        email: true,
      },
      txtpwd: {
        required: true,
        minlength: 8
      },
      terms: {
        required: true
      },
    },
    messages: {
      txtemail: {
        required: "Please enter a email address",
        email: "Please enter a valid email address"
      },
      txtpwd: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long"
      },
      terms: "Please accept our terms"
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
      var email=$("#emailid").val();
      var password=$("#password").val();

      jQuery.ajax({
        url: 'admin/Exec/Exec_login.php',
        type: 'POST',
        dataType: 'json',
        data: {
          email:email,
          password:password
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
            if(data.user=='admin'){
              window.location="admin/dashboard.php";
            }else{
              window.location="index.php";
            }
          }
          }
        });  
    }
  });

// ----------------------------------------------forgot password--------------------------------------------------
  $('#forgotForm').validate({
    rules:{
      txtuname:{
        required: true,
        email: true
      },
    },
    messages:{
      txtuname:{
        required:"Please enter a email address",
        email: "Please enter a valid email address"
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
      var uname=$("#uname").val();

      jQuery.ajax({
        url: 'admin/Exec/Exec_forgotPassword.php?action=sendOTP',
        type: 'POST',
        dataType: 'json',
        data: {
          uname:uname
        },
        success: function(data) {
          $('#forgotPasswordModal').find('form').trigger('reset');
          $('#forgotPasswordModal').modal('hide');
          Swal.fire(
            data.title,
            data.messages,
            data.type
          )
          }
        });
        
      
    }
  });
});
</script>
</body>
</html>

