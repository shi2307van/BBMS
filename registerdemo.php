
<!-- register form -->


<?php
include_once "connection.php";
$message = '';
if(isset($_POST["email"]))
{
 
 $query = "
 insert into tbl_user(`fname`, `gender`, `user_img`, `email_id`, `phno`, `age`, `blood_group`, `address`, `user_type`, `password`,`lname`) values(:fname,:gender,:uimg,:email,:mobile_no,:age,:bld_grp,:address,:u_type,:password,:lname) ";
 $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
 $user_data = array(
  ':fname'=> $_POST["first_name"],
  ':lname'=> $_POST["last_name"],
  ':gender'=> $_POST["gender"],
  ':uimg'=> $_FILES['img']['name'],
  ':email'=> $_POST["email"],
  ':mobile_no'=> $_POST["mobile_no"],
  ':age'  => $_POST["age"],
  ':bld_grp'=> $_POST["blood_group"],
  ':address'=> $_POST["address"],
  ':u_type'=> $_POST["type"],
  ':password'=> $password_hash
 );
 
 $statement = $conn->prepare($query);
 if($statement->execute($user_data))
 {
  $message = '
  <div class="alert alert-success">
  Registration Completed Successfully
  </div>
  ';
  move_uploaded_file($_FILES['img']['tmp_name'],"upload/".$_FILES['img']['name']);
 }
 else
 {
  $message = '
  <div class="alert alert-success">
  There is an error in Registration
  </div>
  ';
 }
}
?>

<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Multi Step Registration Form Using JQuery Bootstrap in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  .box
  {
   width:800px;
   margin:0 auto;
  }
  .active_tab1
  {
   background-color:#fff;
   color:#333;
   font-weight: 600;
  }
  .inactive_tab1
  {
   background-color: #f5f5f5;
   color: #333;
   cursor: not-allowed;
  }
  .has-error
  {
   border-color:#cc0000;
   background-color:#ffff99;
  }
  </style>
 </head>
 <body>
 <br />
  <div class="container box">
   <br />
   <h2 align="center">Multi Step Registration Form Using JQuery Bootstrap in PHP</h2><br />
   <?php echo $message; ?>
   <form method="post" id="register_form" enctype="multipart/form-data">
    <ul class="nav nav-tabs">
     <li class="nav-item">
      <a class="nav-link active_tab1" style="border:1px solid #ccc" id="list_login_details">Login Details</a>
     </li>
     <li class="nav-item">
      <a class="nav-link inactive_tab1" id="list_personal_details" style="border:1px solid #ccc">Personal Details</a>
     </li>
     <li class="nav-item">
      <a class="nav-link inactive_tab1" id="list_contact_details" style="border:1px solid #ccc">Contact Details</a>
     </li>
    </ul>
    <div class="tab-content" style="margin-top:16px;">
     <div class="tab-pane active" id="login_details">
      <div class="panel panel-default">
       <div class="panel-heading">Login Details</div>
       <div class="panel-body">
        <div class="form-group">
         <label>Enter Email Address</label>
         <input type="text" name="email" id="email" class="form-control" />
         <span id="error_email" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Enter Password</label>
         <input type="password" name="password" id="password" class="form-control" />
         <span id="error_password" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Choose the User Type</label>
         <select name="type" id="type" class="form-control"> 
            <option value="-1">----- Select User Type ------</option>
            <option value="1">Admin</option>
            <option value="2">Client</option>
         </select>
         <span id="error_type" class="text-danger"></span>
        </div>
        <br />
        <div align="center">
         <button type="button" name="btn_login_details" id="btn_login_details" class="btn btn-info btn-lg">Next</button>
        </div>
        <br />
       </div>
      </div>
     </div>
     <div class="tab-pane fade" id="personal_details">
      <div class="panel panel-default">
       <div class="panel-heading">Fill Personal Details</div>
       <div class="panel-body">
        <div class="form-group ">
         <label>Enter First Name</label>
         <input type="text" name="first_name" id="first_name" class="form-control" />
         <span id="error_first_name" class="text-danger"></span>
        </div>
        <div class="form-group ">
         <label>Enter Last Name</label>
         <input type="text" name="last_name" id="last_name" class="form-control" />
         <span id="error_last_name" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Enter Age</label>
         <input type="text" name="age" id="age" class="form-control" />
         <span id="error_age" class="text-danger"></span>
        </div>
        <div class="form-group">
            <label for="blood_group">Blood Group</label>
           <select name="blood_group" id="blood_group" class="form-control">
                <option value="-1">------ Select Blood Group ------</option>
                <option value="1"> O+ </option>
                <option value="2"> A+ </option>
                <option value="1"> B+ </option>
                <option value="2"> AB+ </option>
                <option value="1"> O- </option>
                <option value="2"> AB- </option>
           </select>
           <span id="error_bldgrp" class="text-danger"></span>
        </div>
    
        <div class="form-group">
            <label for="img">Enter User Image </label>
            <input type="file" accept="image/jpeg, image/png"  class="form-control" id="img" name="img" >
            <span class="text-danger" id="error_img"> </span>
        </div>

        <div class="form-group">
         <label>Gender</label>
         <label class="radio-inline">
          <input type="radio" name="gender" value="male" checked> Male
         </label>
         <label class="radio-inline">
          <input type="radio" name="gender" value="female"> Female
         </label>
        </div>
        <br />
        <div align="center">
         <button type="button" name="previous_btn_personal_details" id="previous_btn_personal_details" class="btn btn-default btn-lg">Previous</button>
         <button type="button" name="btn_personal_details" id="btn_personal_details" class="btn btn-info btn-lg">Next</button>
        </div>
        <br />
       </div>
      </div>
     </div>
     <div class="tab-pane fade" id="contact_details">
      <div class="panel panel-default">
       <div class="panel-heading">Fill Contact Details</div>
       <div class="panel-body">
        <div class="form-group">
         <label>Enter Address</label>
         <textarea name="address" id="address" class="form-control"></textarea>
         <span id="error_address" class="text-danger"></span>
        </div>
        <div class="form-group">
         <label>Enter Mobile No.</label>
         <input type="text" name="mobile_no" id="mobile_no" class="form-control" />
         <span id="error_mobile_no" class="text-danger"></span>
        </div>
        <br />
        <div align="center">
         <button type="button" name="previous_btn_contact_details" id="previous_btn_contact_details" class="btn btn-default btn-lg">Previous</button>
         <button type="button" name="btn_contact_details" id="btn_contact_details" class="btn btn-success btn-lg">Register</button>
        </div>
        <br />
       </div>
      </div>
     </div>
    </div>
   </form>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 
 $('#btn_login_details').click(function(){
  
  var error_email = '';
  var error_password = '';
  var error_type = '';
 
  var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  
  if($.trim($('#email').val()).length == 0)
  {
   error_email = 'Email is required';
   $('#error_email').text(error_email);
   $('#email').addClass('has-error');
  }
  else
  {
   if (!filter.test($('#email').val()))
   {
    error_email = 'Invalid Email';
    $('#error_email').text(error_email);
    $('#email').addClass('has-error');
   }
   else
   {
    error_email = '';
    $('#error_email').text(error_email);
    $('#email').removeClass('has-error');
   }
  }
  
  if($.trim($('#password').val()).length == 0)
  {
   error_password = 'Password is required';
   $('#error_password').text(error_password);
   $('#password').addClass('has-error');
  }
  else
  {
   error_password = '';
   $('#error_password').text(error_password);
   $('#password').removeClass('has-error');
  }

  if($('#type').val() == -1)
  {
    error_type = 'User Type is required';
   $('#error_type').text(error_type);
   $('#type').addClass('has-error');
  }
  else
  {
    error_type = '';
   $('#error_bldgrp').text(error_type);
   $('#type').removeClass('has-error');
  }

  

  if(error_email != '' || error_password != '' || error_type !='')
  {
   return false;
  }
  else
  {
   $('#list_login_details').removeClass('active active_tab1');
   $('#list_login_details').removeAttr('href data-toggle');
   $('#login_details').removeClass('active');
   $('#list_login_details').addClass('inactive_tab1');
   $('#list_personal_details').removeClass('inactive_tab1');
   $('#list_personal_details').addClass('active_tab1 active');
   $('#list_personal_details').attr('href', '#personal_details');
   $('#list_personal_details').attr('data-toggle', 'tab');
   $('#personal_details').addClass('active in');
  }
 });
 
 $('#previous_btn_personal_details').click(function(){
  $('#list_personal_details').removeClass('active active_tab1');
  $('#list_personal_details').removeAttr('href data-toggle');
  $('#personal_details').removeClass('active in');
  $('#list_personal_details').addClass('inactive_tab1');
  $('#list_login_details').removeClass('inactive_tab1');
  $('#list_login_details').addClass('active_tab1 active');
  $('#list_login_details').attr('href', '#login_details');
  $('#list_login_details').attr('data-toggle', 'tab');
  $('#login_details').addClass('active in');
 });
 
 $('#btn_personal_details').click(function()
 {
  var error_first_name = '';
  var error_last_name = '';
  var error_age = '';
  var error_bldgrp = '';
  var error_img = '';
  
  if($.trim($('#first_name').val()).length == 0)
  {
   error_first_name = 'First Name is required';
   $('#error_first_name').text(error_first_name);
   $('#first_name').addClass('has-error');
  }
  else
  {
   error_first_name = '';
   $('#error_first_name').text(error_first_name);
   $('#first_name').removeClass('has-error');
  }
  
  if($.trim($('#last_name').val()).length == 0)
  {
   error_last_name = 'Last Name is required';
   $('#error_last_name').text(error_last_name);
   $('#last_name').addClass('has-error');
  }
  else
  {
   error_last_name = '';
   $('#error_last_name').text(error_last_name);
   $('#last_name').removeClass('has-error');
  }

  if($.trim($('#age').val()).length == 0)
  {
   error_age = 'Age is required';
   $('#error_age').text(error_age);
   $('#age').addClass('has-error');
  }
  else
  {
   error_age = '';
   $('#error_age').text(error_age);
   $('#age').removeClass('has-error');
  }

  if($('#blood_group').val() == -1)
  {
    error_bldgrp = 'blood group is required';
   $('#error_bldgrp').text(error_bldgrp);
   $('#blood_group').addClass('has-error');
  }
  else
  {
    error_bldgrp = '';
   $('#error_bldgrp').text(error_bldgrp);
   $('#blood_group').removeClass('has-error');
  }
  if($.trim($('#img').val()).length == 0)
  {
    error_img = 'Image is required';
   $('#error_img').text(error_img);
   $('#password').addClass('has-error');
  }
  else
  {
    error_img = '';
   $('#error_img').text(error_img);
   $('#img').removeClass('has-error');
  }
  if(error_first_name != '' || error_last_name != ''|| error_age !='' || error_bldgrp != '' || error_img != '')
  {
   return false;
  }
  else
  {
   $('#list_personal_details').removeClass('active active_tab1');
   $('#list_personal_details').removeAttr('href data-toggle');
   $('#personal_details').removeClass('active');
   $('#list_personal_details').addClass('inactive_tab1');
   $('#list_contact_details').removeClass('inactive_tab1');
   $('#list_contact_details').addClass('active_tab1 active');
   $('#list_contact_details').attr('href', '#contact_details');
   $('#list_contact_details').attr('data-toggle', 'tab');
   $('#contact_details').addClass('active in');
  }
 });
 
 $('#previous_btn_contact_details').click(function(){
  $('#list_contact_details').removeClass('active active_tab1');
  $('#list_contact_details').removeAttr('href data-toggle');
  $('#contact_details').removeClass('active in');
  $('#list_contact_details').addClass('inactive_tab1');
  $('#list_personal_details').removeClass('inactive_tab1');
  $('#list_personal_details').addClass('active_tab1 active');
  $('#list_personal_details').attr('href', '#personal_details');
  $('#list_personal_details').attr('data-toggle', 'tab');
  $('#personal_details').addClass('active in');
 });
 
 $('#btn_contact_details').click(function(){
  var error_address = '';
  var error_mobile_no = '';
  var mobile_validation = /^\d{10}$/;
  if($.trim($('#address').val()).length == 0)
  {
   error_address = 'Address is required';
   $('#error_address').text(error_address);
   $('#address').addClass('has-error');
  }
  else
  {
   error_address = '';
   $('#error_address').text(error_address);
   $('#address').removeClass('has-error');
  }
  
  if($.trim($('#mobile_no').val()).length == 0)
  {
   error_mobile_no = 'Mobile Number is required';
   $('#error_mobile_no').text(error_mobile_no);
   $('#mobile_no').addClass('has-error');
  }
  else
  {
   if (!mobile_validation.test($('#mobile_no').val()))
   {
    error_mobile_no = 'Invalid Mobile Number';
    $('#error_mobile_no').text(error_mobile_no);
    $('#mobile_no').addClass('has-error');
   }
   else
   {
    error_mobile_no = '';
    $('#error_mobile_no').text(error_mobile_no);
    $('#mobile_no').removeClass('has-error');
   }
  }
  if(error_address != '' || error_mobile_no != '')
  {
   return false;
  }
  else
  {
   $('#btn_contact_details').attr("disabled", "disabled");
   $(document).css('cursor', 'prgress');
   $("#register_form").submit();
  }
  
 });
 
});
</script>

