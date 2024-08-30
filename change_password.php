<?php 
    include_once "connection.php";
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
    }
 ?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo1.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

    <style>
      
        body {
          background: #f7f7f7;
        }

.form-box {
  max-width: 800px;
  margin: auto;
  padding: 50px;
  background: #ffffff;
  border: 10px solid #f2f2f2;
}

h1, p {
  text-align: center;
}

input, textarea {
  width: 100%;
}
.error input {
    border-color: red;
    border-width: 2px;
}

.success input {
    border-color: green;
    border-width: 2px;
}

.error span {
    color:red;
}

.success span {
    color: green;
}

span.error{
    color: red;
}
    </style>
</head>
<body>
<?php include_once('header.php');?>
<!-- MultiStep Form -->
<?php 
    $str=$conn->prepare("select * from tbluser where id=".$_SESSION['user']['id']);
    $str->execute();
    $data=$str->fetch();
  ?>

<div class="form-box mt-5  mb-5">
<div id="message"></div>

  <h1>Change Password</h1>
    <form action="" method="post" name="change_password" id="change_password"  >
    
    <div class="form-group">
                    <label for="opwd">Old Password</label>
                    <input type="password" name="oldpassword" class="form-control" id="opwd" placeholder="Enter old password" >
                    <span class="error" id="errold"> </span>
                  </div>
                  <div class="form-group">
                    <label for="npwd">New Password</label>
                    <input type="password" name="newpassword" class="form-control" id="npwd" placeholder="Enter new password" >
                    <span class="error" id="errnew"> </span>
                  </div>
                  <div class="form-group">
                    <label for="cpwd">Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control" id="cpwd" placeholder="Enter confirm password" >
                    <span class="error" id="errcnew"> </span>
                  </div>
    
                                        
                                      
    <input class=" offset-5 btn btn-primary w-25"  type="submit" value="Submit" />
    

    </div>
  </form>
  
  
</div>
<?php include_once('footer.php');?>
<script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/grid-gallery/js/grid-gallery.min.js"></script>
    <script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
    <script src="assets/js/script.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
  $(document).ready(function(){
    $('#opwd').on('input', function () {
        checkopwd();
    });
    $('#npwd').on('input', function () {
        checknpwd();
    });
    $('#cpwd').on('input', function () {
        checkcpwd();
    });

    $("#change_password").submit(function(e) {
        e.preventDefault();
  
 
        if (!checkopwd() && !checknpwd() && !checkcpwd()) {
            console.log("er1");
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
        } else if (!checkopwd() || !checknpwd() || !checkcpwd()) {
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
            console.log("er");
        }else{
          var opwd=$("#opwd").val();
          var npwd=$("#npwd").val();
          var cpwd=$("#cpwd").val();
        
          $.ajax({
            url: 'changePassword.php',
            method: 'post',
            data: {
              opwd:opwd,
              npwd:npwd,
              cpwd:cpwd
            },
            beforeSend: function () {
                $('#btnAdd').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                $('#btnAdd').attr("disabled", true);
                $('#btnAdd').css({ "border-radius": "50%" });
            },

            success: function (data) {
              if(data.success==0){  
                $('#message').html(`<div class="alert alert-danger">OOps Some error occure!!!</div>`);            
                }
                else{
                  $("#message").html(`<div class="alert alert-success">Password Change Successfully.</div>`);  
                }
            },

            complete: function () {
                setTimeout(function () {
                    $('#upload').trigger("reset");
                    $('#btnAdd').html('Submit');
                    $('#btnAdd').attr("disabled", false);
                    $('#btnAdd').css({ "border-radius": "4px" });
                      location.reload();	
                }, 2000);
            }
            // success: function(data) {
              //called when successful
              // Swal.fire("Good job!", "Data Updated Successfully!", "success",2000,false);
              // Swal.fire(data.title,data.messages,data.type);
              // if(data.type=='success'){
              //   location.reload(dashboard.php);
              // }
            
            // }
              
          });
        }
    });
});
     
  
function checkopwd() {
    var user = $('#opwd').val();
    console.log(user);
    
   if(user == ''){
    
      $('#errold').html('Please enter a old password.');
        return false;
    }
    else if(user.length<8){
      $('#errold').html('Old Password Must be Contain 8 Characters.');
        return false;
    }
    else {
        $('#errold').html('');
        return true;
    }
}

function checknpwd() {
  var user = $('#npwd').val();
    console.log(user);
    
   if(user == ''){
    
      $('#errnew').html('Please enter a new password.');
        return false;
    }
    else if(user.length<8){
      $('#errnew').html('New Password Must be Contain 8 Characters.');
        return false;
    }
    else {
        $('#errnew').html('');
        return true;
    }
}

function checkcpwd() {
  var v1 = $('#npwd').val();
  var v2 = $('#cpwd').val();
    console.log(v2);
    
   if(v2 == ''){
    
      $('#errcnew').html('Please enter a confirm password.');
        return false;
    }
    else if(v1 != v2){
      $('#errcnew').html('Please enter the same password as above.');
        return false;
    }
    else {
        $('#errcnew').html('');
        return true;
    }
}

  </script>
</body>
</html>