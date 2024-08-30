<?php 
    include_once "connection.php";

 ?>

<!DOCTYPE html>
<html>
<head>
    <title>BBMS</title>
    <link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
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
  <h1>Blood Request Form</h1>
 
  <form action="" method="post" name="blood_request" id="blood_request">
    <div class="form-group">
      <label for="name">Name</label>
      <input class="form-control" id="name" type="text" name="name" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" id="email" type="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="type">Requirement Type</label>
        <select name="type" id="type" class="form-control" required>
            <option value="-1">-----Select--------</option>
            <option value="urgent">Urgent</option>
            <option value="2 days">With in 2 days</option>
            <option value="7 days">With in 7 days</option>
        </select>
    </div>
    <div class="form-group">
      <label for="age">Age</label>
      <input class="form-control" id="age" type="number" min="1" name="age" required>
    </div>
    <div class="form-group">
      <label for="phno">Phone Number</label>
      <input class="form-control" id="phno" maxlength="10" type="text" name="phno" required>
    </div>
    <div class="form-group">
            <label for="blood_group">Blood Group</label>
           <select name="blood_group" id="blood_group" class="form-control" required>
                <option value="-1">---- Select Blood Group ----</option>
                <?php 
                                                $str=$conn->prepare("select * from tblbloodgroup");
                                                $str->execute();
                                                $data=$str->fetchAll();
                                                foreach($data as $datas){
                                               ?>
                                              <option value="<?php echo $datas['blood_type'] ?>"><?php echo $datas['blood_type'] ?></option>
                                              
                                          <?php } ?>
           </select>
          
        </div>
        <div class="row ml-1">
                                        <label for="gender">Gender</label>
                                    </div>
                                    <div class="row ml-1">
                                            <div class="col-sm-4 form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" > Female
                                            </div>
                                            <div class="col-sm-4 form-check">
                                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked> Male
                                            </div>
                                    </div>
    

        <input class=" offset-8 btn btn-primary w-25"  type="submit" value="Submit" />
    </div>
  </form>
</div>
<?php include_once('footer.php');?>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>

     $("#blood_request").on("submit",function(e){
        e.preventDefault();

          
           // alert("done");
            // $("#message").html("");
            var form_data= new FormData(this);
            // console.log(form_data);
            $.ajax({
              type:"POST",
                 url:"admin/Exec/Exec_manageBloodRequest.php?action=insert",
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

    // $("#blood_request").on("submit",function(e){
    //     e.preventDefault();

          
    //        // alert("done");
    //         $("#message").html("");
    //         var form_data= new FormData(this);
    //         console.log(form_data);
    //         $.ajax({
    //           type:"POST",
    //              url:"insert_bld_rqst.php",
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
    //                      window.location.href="blood_request.php";
    //                 }, 2000);
    //             }
    //         });
    // });
    
    </script>
</body>
</html>