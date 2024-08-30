<?php 
    include_once "connection.php";
 ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BBMS</title>
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
        * {
        margin: 0;
        padding: 0;
        }

        body > div {
            background-color: #dbe2e8;
            font-family: "Oswald", sans-serif;
            padding-top: 120px;
            padding-bottom: 120px;
            color: #07395c;
        }

        .section-contact {
            padding: 120px;
                background-color: #fff;
        }

        .section-contact .header-section .title {
            position: relative;
            margin-bottom: 17px;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 55px;
        }

        .section-contact .header-section .title .dot {
            display: inline-block;
            position: absolute;
            bottom: 8px;
            width: 8px;
            height: 8px;
            margin-left: 3px;
            background-color: #df383f;
        }

        .section-contact .header-section .description {
/*            font-family: "Roboto", sans-serif;*/
            color: #2a6287;
        }

        .section-contact .header-section .big-title {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translate(-50%,70%);
            font-size: 120px;
            font-weight: 700;
            opacity: 0.15;
        }

        .section-contact .form-contact {

        }

        .section-contact .form-contact .single-input {
            position: relative;
            margin-top: 40px;
        }

        .section-contact .form-contact .single-input i {
            position: absolute;
            top: 5px;
            left: 15px;
            color: #de3842;
        }

        .section-contact .form-contact .single-input input,
        .section-contact .form-contact .single-input textarea {
            width: 100%;
            border: none;
            border-bottom: 2px solid #07395c;
            padding-left: 50px;
            padding-bottom: 15px;
            font-size: 15px;
/*            font-weight: 700;*/
/*            text-transform: uppercase;*/
                transition: border .3s;
        }

        .section-contact .form-contact .single-input input::placeholder,
        .section-contact .form-contact .single-input textarea::placeholder {
            color: rgba(7, 57, 92, .3);
        }

        .section-contact .form-contact .single-input input:focus,
        .section-contact .form-contact .single-input textarea:focus {
            border-color: #df383f;
        }

        .section-contact .form-contact .single-input textarea {
            height: 150px;
            min-height: 50px;
        }

        .section-contact .form-contact .submit-input input {
            margin-top: 40px;
            padding: 15px 50px;
            background-color: #de3842;
            color: #fff;
            border: none;
            font-weight: 700;
            transition: background-color .3s;
        }

        .section-contact .form-contact .submit-input input:hover {
            background-color: #07395c;
        }

        @media (max-width: 575.99px) {
            .section-contact {
                padding: 80px 60px;
            }

            .section-contact .header-section .title {
                font-size: 40px;
            }

            .section-contact .header-section .big-title {
                font-size: 80px;
            }

            .section-contact .header-section .description {
                font-size: 14px;
            }
        }

        @media (min-width: 576px) and (max-width: 767.99px) {
            .section-contact {
                padding: 80px 60px;
            }

            .section-contact .header-section .title {
                font-size: 45px;
            }

            .section-contact .header-section .big-title {
                font-size: 100px;
            }
        }

        @media (min-width: 768px) and (max-width: 991.99px) {
            .section-contact {
                padding: 80px 60px;
            }

            .section-contact .header-section .title {
                font-size: 45px;
            }

            .section-contact .header-section .big-title {
                font-size: 100px;
            }
        }
    </style>
</head>

<body>
   
     <?php include_once('header.php');?>
    
	<div>
	<!-- START CONTACT SECTION -->
 
	<div class="container">
    <!-- <div id="message"></div> -->
		<div class="section-contact">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-10 col-xl-8">
					<div class="header-section text-center">
						<h2 class="title">Get In Touch
							<span class="dot"></span>
							<span class="big-title">CONTACT</span>
						</h2>
						<!-- <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean consectetur commodo risus, nec pellentesque turpis efficitur non.</p> -->
						
					</div>
				</div>
			</div>
			<div class="form-contact">
				<form id="contactus" name="conytactus">
					<div class="row">
						<div class="col-md-6">
							<div class="single-input">
								<i class="fas fa-user"></i>
								<input type="text" name="txtname" placeholder="ENTER YOUR NAME" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="single-input">
								<i class="fas fa-envelope"></i>
								<input type="email" name="txtemail" placeholder="ENTER YOUR EMAIL" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="single-input">
								<i class="fas fa-phone"></i>
								<input type="text" name="txtphno" placeholder="ENTER YOUR PHONE NUMBER" maxlength="10" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="single-input">
								<i class="fas fa-check"></i>
								<input type="text" name="txtsub" placeholder="ENTER YOUR SUBJECT" required>
							</div>
						</div>
						<div class="col-12">
							<div class="single-input">
								<i class="fas fa-comment-dots"></i>
								<textarea placeholder="ENTER YOUR MESSAGE" name="txtmsg" required></textarea>
							</div>
						</div>
						<div class="col-12">
							<div class="submit-input text-center">
								<input type="submit" id="submit" name="submit" value="SUBMIT NOW">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- / END CONTACT SECTION -->
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
    $("#contactus").on("submit",function(e){
        e.preventDefault();

          
           // alert("done");
            // $("#message").html("");
            var form_data= new FormData(this);
            // console.log(form_data);
            $.ajax({
              type:"POST",
                 url:"admin/Exec/Exec_manageQuery.php?action=insert",
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
