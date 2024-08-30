<?php 
	
	include_once "../../connection.php";

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	include_once '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
	include_once '../../vendor/phpmailer/phpmailer/src/Exception.php';
	include_once '../../vendor/phpmailer/phpmailer/src/SMTP.php';
	include_once '../../vendor/autoload.php';

	function sendMail($email,$otp,$name){
		// echo $email;
		$mail = new PHPMailer();

		try {
			//Server settings
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = 'sem3b.04.tmtbca@gmail.com';                     //SMTP username
			$mail->Password   = 'ttdygxhkqvxvapsj';                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
		
			//Recipients
			$mail->setFrom('sem3b.04.tmtbca@gmail.com', 'BBMS');
			$mail->addAddress($email);     //Add a recipient
			
		
			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = 'BBMS Login Credentials';
			$mail->Body    = '<html>
	<body style="width:700px; margin: auto;">
		<table>
			<tr>
				<h1 style="background-color: lightblue; text-align: center;">Verification Mail</h1>
			</tr>
			<tr>
				<p>Dear '.$name.', <br/>
				Please <a href="http://localhost/BBMS/login.php?action='.base64_encode($email).'">click hear</a> to reset your password.
				Your OTP is '.$otp.'.
				<br/>
				Regards,
				BBMS
			</p>
			</tr>
			<tr>
				
			</tr>
		</table>
		
	</body>
</html>';
			$mail->send();
			return true;
		} catch (Exception $e) {
			return $e;
		}
	}



	if($_REQUEST['action']=='sendOTP'){
		$uname=$_POST['uname'];
		$str=$conn->prepare("select * from tbluser where email_id='$uname'");
		$str->execute();
		$data=$str->fetch();
		if($str->rowCount()==1){
			$otp=rand(111111,999999);
			$_SESSION['OTP']=$otp;
			// echo $_SESSION['OTP'];
			sendMail($uname,$otp,$data['name']);	
			echo json_encode(array('title'=>'Good job','messages'=>'An OTP and Password Reset link has been successfully sent to your Email.','type'=>'success','status'=>200));
		}
		else{
			echo json_encode(array('title'=>'Sorry','messages'=>'Oops! Email id is not Exist','type'=>'error','status'=>400));
		}
	}


	if($_REQUEST['action']=='reset'){
		$cotp=$_POST['otp'];
		$uname=$_POST['uname'];
		$npwd=$_POST['npwd'];

		if($_SESSION['OTP']==$cotp){
			$hash=password_hash($npwd, PASSWORD_DEFAULT);
			$str=$conn->prepare("update tbluser set password='$hash' where email_id='$uname'");
			if($str->execute()){
				echo json_encode(array('title'=>'Good job','messages'=>'Password Changed..','type'=>'success','status'=>200));
			}
			else{
				echo json_encode(array('title'=>'Opps!','messages'=>'Please try again..','type'=>'error','status'=>400));
			}
		}
		else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Please enter correct OTP...','type'=>'error','status'=>400));
		}		
	}
 ?>