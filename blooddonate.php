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
<div class="form-box mt-5  mb-5">
<div id="message"></div>
  <h1>Blood donate Form</h1>
 
  <form action="" method="post" name="blood_camp" id="blood_donate">
    <div class="form-group">
      <label for="Conduct">Disease</label>
      <input type="hidden" name="camp" value="<?php if(isset($_REQUEST['camp'])){ echo $_REQUEST['camp']; }else{ echo "0";} ?>">
      <input class="form-control" id="Disease" type="text" name="disease" value="Nothing" required>
    </div>
    <div class="form-group">
      <label for="organized">Units Of Blood</label>
      <input class="form-control" id="unit" type="number" name="unit" required>
    </div>
    <div class="form-group">
      <label for="doc">Date</label>
      <?php if(isset($_REQUEST['camp'])){ 
        $str=$conn->prepare("select * from tblbloodcamp where id=".$_REQUEST['camp']);
        $str->execute();
        $date=$str->fetch();
        ?>
        <?php
            if(isset($_REQUEST['camp'])){ ?>
                <input class="form-control" id="doc" type="date" name="doc" value="<?php if(isset($_REQUEST['camp'])){echo $date['date_of_camp'];} ?>" required>
        <?php    }else if(isset($_REQUEST['blood_donate'])){ 
         ?>
         
      <input class="form-control" id="doc" type="date" name="doc" required> <?php } ?>
  <?php } ?>
    </div>
    
    <input class=" offset-9 btn btn-primary w-25"  type="submit" value="Submit" />
    </div>
  </form>
</div>
<?php include_once('footer.php');?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>

$("#blood_donate").on("submit",function(e){
        e.preventDefault();

          
           // alert("done");
            // $("#message").html("");
            var form_data= new FormData(this);
            // console.log(form_data);
            $.ajax({
              type:"POST",
                 url:"admin/Exec/Exec_manageBloodDonate.php?action=insert",
                 data:form_data,
                 dataType:'json',
                 contentType:false,
                 processData:false,
                beforeSend: function () {
                    $('#btnAdd').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#btnAdd').attr("disabled", true);
                    $('#btnAdd').css({ "border-radius": "50%" });
                },

                success: function (data) {
                    Swal.fire(
                      data.title,
                      data.messages,
                      data.type
                    ).then((result)=>{
                        if (result.isConfirmed){
                            if(data.status==200){
                              window.location="index.php";
                            }else{
                              location.reload();
                            }
                        }
                    })
                }
                
            });
    });
    // $("#blood_camp").on("submit",function(e){
    //     e.preventDefault();

          
    //        // alert("done");
    //         $("#message").html("");
    //         var form_data= new FormData(this);
    //         console.log(form_data);
    //         $.ajax({
    //           type:"POST",
    //              url:"insert_bld_camp.php",
    //              data:form_data,
    //              dataType:'json',
    //              contentType:false,
    //              processData:false,
    //             beforeSend: function () {
    //                 $('#btnAdd').html('<i class="fa-solid fa-spinner fa-spin"></i>');
    //                 $('#btnAdd').attr("disabled", true);
    //                 $('#btnAdd').css({ "border-radius": "50%" });
    //             },

    //             success: function (data) {
    //               if(data.success==1){
                  
    //                 $("#message").html(`<div class="alert alert-success">Insert Data Successfully</div>`);
                    
    //                }
    //                else{
    //                 $('#message').html(`<div class="alert alert-danger">OOps Some error occure!!!</div>`);
    //                }
                   
    //             },
    //             complete: function () {
    //                 setTimeout(function () {
    //                     $('#upload').trigger("reset");
    //                     $('#btnAdd').html('Submit');
    //                     $('#btnAdd').attr("disabled", false);
    //                     $('#btnAdd').css({ "border-radius": "4px" });
    //                      location.reload();	
    //                      window.location.href="blood_camp.php";
    //                 }, 2000);
    //             }
    //         });
    // });
    
    </script>
</body>
</html>