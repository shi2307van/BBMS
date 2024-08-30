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
  <h1>Blood Camp Form</h1>
 
  <form action="" method="post" name="blood_camp" id="blood_camp">
    <div class="form-group">
      <label for="Conduct">Conducted By </label>
      <input class="form-control" id="Conduct" type="text" name="conduct" required>
    </div>
    <div class="form-group">
      <label for="organized">Organized By</label>
      <input class="form-control" id="organized" type="text" name="organized" required>
    </div>
    <div class="form-group">
      <label for="doc">Date Of Camp </label>
      <input class="form-control" id="doc" type="date" name="doc" required>
    </div>
    <div class="form-group">
      <label for="address">Address</label>
      <textarea class="form-control" name="address" id="address" cols="30" rows="5"></textarea>
    </div>
    <div class="form-group">
      <label for="start_time">Start Time</label>
      <input class="form-control" id="start_time" type="datetime-local" name="start_time" required>
    </div>
    <div class="form-group">
      <label for="end_time">End Time</label>
      <input class="form-control" id="end_time" type="datetime-local" name="end_time" required>
    </div>

    <input class=" offset-9 btn btn-primary w-25"  type="submit" value="Submit" />
    </div>
  </form>
</div>
<?php include_once('footer.php');?>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
<script>
  $("#blood_camp").on("submit",function(e){
        e.preventDefault();

          
           // alert("done");
            // $("#message").html("");
            var form_data= new FormData(this);
            // console.log(form_data);
            $.ajax({
              type:"POST",
                 url:"admin/Exec/Exec_manageBloodCamp.php?action=insert",
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
    
    
    </script>
</body>
</html>