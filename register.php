<!DOCTYPE html>
<?php include_once "connection.php"; ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BBMS</title>
    <link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">


    <style>
        * {
    margin: 0;
    padding: 0;
}

html {
    height: 100%;
}

/*Background color*/
body {
    background-color: #fc0352;
}

/*form styles*/
#msform {
    text-align: center;
    position: relative;
    margin-top: 20px;
}

#msform fieldset .form-card {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    padding: 20px 40px 30px 40px;
    box-sizing: border-box;
    width: 94%;
    margin: 0 3% 20px 3%;

    /*stacking fieldsets above each other*/
    position: relative;
}

#msform fieldset {
    background: white;
    /*border: 0 none;
    border-radius: 0.5rem;*/
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

#msform fieldset .form-card {
    text-align: left;
/*    color: #9E9E9E;*/
}

/*#msform input, #msform textarea {
    padding: 0px 8px 4px 8px;
    border: none;
    border-bottom: 1px solid #ccc;
    border-radius: 0px;
    margin-bottom: 25px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    font-family: montserrat;
    color: #2C3E50;
    font-size: 16px;
    letter-spacing: 1px;
}*/

/*#msform input:focus, #msform textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: none;
    font-weight: bold;
    border-bottom: 2px solid skyblue;
    outline-width: 0;
}
*/
/*Blue Buttons*/
#msform .action-button {
    width: 100px;
/*    background: skyblue;*/
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
}

/*Previous Buttons*/
#msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
}

/*The background card*/
.card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative;
}

/*FieldSet headings*/
.fs-title {
    font-size: 25px;
/*    color: #2C3E50;*/
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
}

/*progressbar*/
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
}

#progressbar .active {
    color: #000000;
}

#progressbar li {
    list-style-type: none;
    font-size: 10px;
    width: 33.3%;
    float: left;
    position: relative;
}

/*Icons in the ProgressBar*/
#progressbar #account:before {
    font-family: FontAwesome;
    content: "\f023";
}

#progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f007";
}

#progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d";
}

#progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c";
}

/*ProgressBar before any progress*/
#progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
}

/*ProgressBar connectors*/
#progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: #b651f5;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
}

/*Color number of the step and the connector before it*/
#progressbar li.active:before, #progressbar li.active:after {
    background: #b651f5;
}

/*Imaged Radio Buttons*/
.radio-group {
    position: relative;
    margin-bottom: 25px;
}

.radio {
    display:inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor:pointer;
    margin: 8px 2px; 
}

.radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
}

.radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
}

/*Fit image in bootstrap div*/
.fit-image{
    width: 100%;
    object-fit: cover;
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
  .error{
    color: #cc0000;
  }
  input.box_error, select.box_error{
    border-color:#cc0000;
   background-color:#ffdcdc;
    /*border-color: #FF0000;
    box-shadow: inset 0px 0px 50px 2px rgb(255,0,0,0.1);*/
}
input.box_error:focus, textarea.box_error:focus {
/*    box-shadow: inset 0px 0px 50px 2px rgb(255,0,0,0.1);*/
border-color:#cc0000;
   background-color:#ffdcdc;
}
    </style>
</head>
<body>
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Sign Up</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" method="POST" enctype="multipart/form-data">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active fa-solid fa-bag-shopping" id="account"><strong>Account</strong></li>
                                <li id="personal" class="fa-solid fa-person"><strong>Personal</strong></li>
                                <li id="payment" class="fa-solid fa-image-user"><strong>Image</strong></li>
                                <!-- <li id="confirm"><strong>Finish</strong></li> -->
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-dark">Account Information</h2>
                                    <div class="form-group">
                                        <label for="emailid"><b>Email-ID</b></label>
                                        <input type="email" name="txtemail" class="form-control" id="emailid" placeholder="Enter email">
                                        <span class="error" id="erremail"> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd"><b>Password</b></label>
                                        <input type="password" name="txtpwd" class="form-control" id="pwd" placeholder="Password">
                                        <span class="error" id="errpwd"> </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="cpwd"><b>Confirm Password</b></label>
                                        <input type="password" name="txtcpwd" class="form-control" id="cpwd" placeholder="Confirm Password">
                                        <span class="error" id="errcpwd"> </span>
                                    </div>
<!--                                     <input type="email" name="email" placeholder="Email Id"/>
                                    <input type="text" name="uname" placeholder="UserName"/>
                                    <input type="password" name="pwd" placeholder="Password"/>
                                    <input type="password" name="cpwd" placeholder="Confirm Password"/> -->
                                </div>
                                <input type="button" name="next" id="btnAccount" class="btn next action-button btn-success" value="Next Step"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-dark">Personal Information</h2>
                                    <div class="form-group">
                                        <label for="name"><b>Name</b></label>
                                        <input type="text" name="txtname" class="form-control" id="name" placeholder="Full name">
                                        <span class="error" id="errname"> </span>
                                    </div>
                                    <div class="row ml-1">
                                        <label for="gender"><b>Gender</b></label>
                                    </div>
                                    <div class="row ml-1">
                                            <div class="col-sm-4 form-check">
                                                <input class="form-check-input" type="radio" name="txtgender" id="female" value="Female" > Female
                                            </div>
                                            <div class="col-sm-4 form-check">
                                                <input class="form-check-input" type="radio" name="txtgender" id="male" value="Male" checked> Male
                                            </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-sm-6">
                                            <label for="phno"><b>Contact No.</b></label>
                                            <input type="text" name="txtphno" class="form-control" id="phno" placeholder="##### #####"> 
                                            <span class="error" id="errphno"> </span>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="age"><b>Age</b></label>
                                            <input type="number" name="txtage" class="form-control" id="age" placeholder="Your age" min="18">
                                            <span class="error" id="errage"> </span>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="group"><b>Blood Group</b></label>
                                            <select class="form-select form-control" name="txtgroup" aria-label="" id="group">
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
                                            <span class="error" id="errgroup"> </span>
                                        </div>
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="address"><b>Address</b></label>
                                        <textarea name="txtaddress" id="" cols="30" rows="4" class="form-control"></textarea>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="next" id="btnPersonal" class="btn next action-button btn-success" value="Next Step"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <div class="form-group">
                                        <label for="img"><b>Profile Image</b></label>
                                        <input type="file" name="img" accept="image/jpeg, image/png" class="form-control" id="img">
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="submit" id="btnSave" class="btn next action-button btn-success" value="Confirm"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <P>Already registered? <a href="login.php">Login</a></P>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- jquery-validation -->
<script src="admin/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="admin/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="admin/dist/js/adminlte.min.js"></script>

<script>





$(document).ready(function(){
    var error = false;
var current_fs, next_fs, previous_fs; //fieldsets
var opacity;

$(".previous").click(function(){
    
    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            previous_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
});


// email validation
$("#emailid").keyup(function() {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (!emailReg.test($("#emailid").val())) {
        $("#erremail").text('Please enter an Email addres.');
        $("#emailid").addClass("box_error");
        error = true;
    } else {
        $("#erremail").text('');
        error = false;
        $("#emailid").removeClass("box_error");
    }
});

// password validation
$("#pwd").keyup(function() {
    var pass = $("#pwd").val();
    var cpass = $("#cpwd").val();

    if (pass != '') {
        $("#errpwd").text('');
        error = false;
        $("#pwd").removeClass("box_error");
    }
    if (pass != cpass && cpass != '') {
        $("#errcpwd").text('Password and Confirm Password is not matched.');
        error = true;
    } else {
        $("#errcpwd").text('');
        error = false;
    }
});

// confirm password validation
$("#cpwd").keyup(function() {
    var pass = $("#pwd").val();
    var cpass = $("#cpwd").val();

    if (pass != cpass) {
        $("#errcpwds").text('Please enter the same Password as above.');
        $("#cpwd").addClass("box_error");
        error = true;
    } else {
        $("#errcpwd").text('');
        error = false;
        $("#cpwd").removeClass("box_error");
    }
});

// name
$("#name").keyup(function() {
    var fname = $("#name").val();
    if (fname == '') {
        $("#errname").text('Enter your full name.');
        $("#name").addClass("box_error");
        error = true;
    } else {
        $("#errname").text('');
        error = false;
    }
    if (!isNaN(fname)) {
        $("#errname").text("Only Characters are allowed.");
        $("#name").addClass("box_error");
        error = true;
    } else {
        $("#name").removeClass("box_error");
    }
});


// phono
$("#phno").keyup(function() {
    var phone = $("#phno").val();
    if (phone != phone) {
        $("#errphno").text('Enter your Phone number.');
        $("#phno").addClass("box_error");
        error = true;
    } else {
        $("#errphno").text('');
        $("#phno").removeClass("box_error");
        error = false;
    }
    var pattern=/^[789][0-9]{9}$/;
    if(!pattern.test($("#phno").val())){
        $("#errphno").text('Not accept character.');
        $("#phno").addClass("box_error");
    }else {
        $("#errphno").text('');
        $("#phno").removeClass("box_error");
        error = false;
    }
    if (phone.length != 10) {
        $("#errphno").text("Mobile number must be of 10 Digits only.");
        $("#phno").addClass("box_error");
        error = true;
    } else {
        $("#errphno").text('');
        $("#phno").removeClass("box_error");
        error = false;
    }
});

// age
$('#age').change(function() {
    var age = $('#age').val();
    if(age == ''){
        $('#errage').text('Enter age');
        $('#age').addClass('box_error');
        error = true;
    }else{
        $('#errage').text('');
        $("#age").removeClass("box_error");
        error = false;
        
    }
});

// blood group
$('#group').change(function(){
    if($('#group').val() == ''){
        $('#errgroup').text('Select blood group.');
        $('#group').addClass("box_error");
        error = true;
    }else{
        $("#errgroup").text('');
        $("#group").removeClass("box_error");
        error = false;
        
    }
});

// first step validation
$("#btnAccount").click(function() {
    // email
    if ($("#emailid").val() == '') {
        $("#erremail").text('Please enter an email address.');
        $("#emailid").addClass("box_error");
        error = true;
    } else {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test($("#emailid").val())) {
            $("#erremail").text('Please insert a valid email address.');
            error = true;
        } else {
            $("#erremail").text('');
            $("#emailid").removeClass("box_error");
        }
    }
    // password
    if ($("#pwd").val() == '') {
        $("#errpwd").text('Please enter a password.');
        $("#pwd").addClass("box_error");
        error = true;
    }
    if($("#pwd").val().length<8){
        $("#errpwd").text('Password must be atleast 8 character.');
        $("#pwd").addClass("box_error");
    }
    if ($("#cpwd").val() == '') {
        $("#errcpwd").text('Please enter a Confirm password.');
        $("#cpwd").addClass("box_error");
        error = true;
    } else {
        var pass = $("#pwd").val();
        var cpass = $("#cpwd").val();

        if (pass != cpass) {
            $("#errcpwd").text('Please enter the same password as above.');
            error = true;
        } else {
            $("#errcpwd").text('');
            $("#pwd").removeClass("box_error");
            $("#cpwd").removeClass("box_error");
        }
    }
    // animation
    if (!error) {
        current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
        
    }
});



$("#phno").keyup(function() {
    var phone = $("#phno").val();
    if (phone != phone) {
        $("#errphno").text('Enter your Phone number.');
        $("#phno").addClass("box_error");
        error = true;
    } else {
        $("#errphno").text('');
        error = false;
    }
    var pattern=/^[789][0-9]{9}$/;
    if(!pattern.test($("#phno").val())){
        $("#errphno").text('Not accept character.');
        $("#phno").addClass("box_error");
        error = true;
    }else {
        $("#phno").removeClass("box_error");
        $("#errphno").text('');
        error = false;
    }
    if (phone.length != 10) {
        $("#errphno").text("Mobile number must be of 10 Digits only.");
        $("#phno").addClass("box_error");
        error = true;
    } else {
        $("#phno").removeClass("box_error");
        $("#errphno").text('');
        error = false;
    }
});

$('#btnPersonal').click(function(){
    // phno
    if ($("#phno").val() == '') {
        $("#errphno").text('Please enter Phone number.');
        $("#phno").addClass("box_error");
        error = true;
    } else {
        var pattern=/^[789][0-9]{9}$/;
        if(!pattern.test($("#phno").val())){
            $("#errphno").text('Not accept character.');
            $("#phno").addClass("box_error");
        }
        $("#errphno").text('');
        error = false;
    }

    // name
     if ($("#name").val() == '') {
        $("#errname").text('Enter your name.');
        $("#name").addClass("box_error");
        error = true;
    } else {
        var fname = $("#fname").val();
        if (fname != fname) {
            $("#errname").text('Name is required.');
            error = true;
        } else {
            $("#errname").text('');
            error = false;
            $("#name").removeClass("box_error");
        }
        if (!isNaN(fname)) {
            $("#errname").text("Only Characters are allowed.");
            error = true;
        } else {
            $("#name").removeClass("box_error");
        }
    }
    if($('#age').val() == ''){
        $('#errage').text('Enter your age.');
        $('#age').addClass("box_error");
        error = true;
    }else{
        $("#errage").text('');
        $("#age").removeClass("box_error");
        error = false;
    }

    if($('#group').val() == ''){
        $('#errgroup').text('Select blood group.');
        $('#group').addClass("box_error");
        error = true;
    }else{
        $("#errgroup").text('');
        $("#group").removeClass("box_error");
        error = false;
        
    }

    if (!error) {
        current_fs = $(this).parent();
    next_fs = $(this).parent().next();
    
    //Add Class Active
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
            // for making fielset appear animation
            opacity = 1 - now;

            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            next_fs.css({'opacity': opacity});
        }, 
        duration: 600
    });
        
    }
});


$("#msform").on('submit',function(e){
    e.preventDefault();
    $.ajax({
        url: 'admin/Exec/Exec_register.php?action=insert',
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
            )
            if(data.status==200){
              window.location="admin/dashboard.php";
            }else{
              location.reload();
            }
          }
        
    });
});
    
});
</script>
</body>
</html>