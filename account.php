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
                        <label for="img">User Photo</label>
                        <input type="file" class="form-control" id="img" accept="image/jpeg, image/png" name="img">
                        <input class="form-control" id="old_img" type="hidden" name="old_img" value="<?php echo $data['user_img'];?>"/>
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
<div class="form-box mt-5  mb-5">
<div id="message"></div>

  <h1>Edit Your Account</h1>
 
 
  <form action="" method="post" name="edit_account" id="edit_account"  >
    
    <div class="form-group">
    <label for="name">Name </label>
      <input class="form-control" id="name" type="text" name="name" value="<?php echo $data['name'];?>" required>
    </div>
    <div class="form-group">
      <label for="email">Email </label>
      <input class="form-control" id="email" type="email" name="email" value="<?php echo $data['email_id'];?>" required>
    </div>
    <div class="form-group">
      <label for="phno">Phone Number</label>
      <input class="form-control" id="phno" type="text" name="phno" value="<?php echo $data['phno'];?>" required>
    </div>
    <div class="form-group">
      <label for="age">Age</label>
      <input class="form-control" id="age" type="text" name="age" value="<?php echo $data['age'];?>" required>
    </div>
    <div class="form-group">
      <label for="add">Address</label>
      <input class="form-control" id="add" type="text" name="add" value="<?php echo $data['address'];?>" required>
    </div>
    <div class="form-group">
      <label for="gender">Gender</label>
      <select name="gender" id="gender" class="form-control">
        <?php
        if($data['gender']=='Female'){
          echo '<option value="Female">Female</option>';
          echo '<option value="Male">Male</option>';
        }else{
          echo '<option value="Male">Male</option>';
          echo '<option value="Female">Female</option>';
        }
        ?>
      </select>
    </div>
    <div class="form-group">
    <label for="bldgrp">Blood Group</label>
                                            <select class="form-select form-control" name="bldgrp" aria-label="" id="bldgrp">
                                              <option value="<?php echo $data['blood_group'];?>" selected disabled><?php echo $data['blood_group'];?></option>
                                              <?php 
                                                $str=$conn->prepare("select * from tblbloodgroup");
                                                $str->execute();
                                                $dat=$str->fetchAll();
                                                foreach($dat as $datas){
                                               ?>
                                              <option value="<?php echo $datas['blood_type'] ?>"><?php echo $datas['blood_type'] ?></option>
                                              
                                          <?php } ?>
                                            </select>
    </div>
  
    
    <input class="form-control" id="id" type="hidden" name="id" value="<?php echo $datas['id'];?>"/>  
    <input class="form-control" id="bld" type="hidden" name="bld" value="<?php echo $data['blood_group'];?>"/>
                                        
                                      
    <input class=" offset-5 btn btn-primary w-25"  type="submit" value="Submit" />
    <button type="button" class="btn btn-success w-25" data-toggle="modal" data-target="#updateProfilePhoto">Update Image</button>

    </div>
  </form>
  
</div>
<?php include_once('footer.php');?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>

    $("#edit_account").submit(function(e) {
        e.preventDefault();
        var form = $('form').serialize();
       console.log(form);
      $.ajax({
        url: 'update_account.php',
        method: 'post',
        data: $('form').serialize(),
        
		// success: function(data){
    //     if(data.success==0){  
    //         $('#message').html(`<div class="alert alert-danger">OOps Some error occure!!!</div>`);
               
    //     }
    //     else{
    //         $("#message").html(`<div class="alert alert-success">Update Data Successfully</div>`);
              
    //     }
       						

    //     }
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
                      $("#message").html(`<div class="alert alert-success">Update Data Successfully</div>`);    
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
      });
    });
    
    $("#upimg").on('submit',function(e){
       e.preventDefault();
      $.ajax({
        url: 'update_account.php?action=image',
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
</script>
</body>
</html>