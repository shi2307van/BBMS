<?php
	include_once "../../connection.php";
	if(isset($_POST['email'])){
		$email=$_POST['email'];
		$password=$_POST['password'];
		$str=$conn->prepare("select * from tbluser where email_id='$email'");
		$str->execute();
		$data=$str->fetch();
		if($str->rowCount() == 1){
			// $pwd=password_verify($password,$data['admin_password']);
			if(password_verify($password,$data['password'])){
				$_SESSION['user']=$data;
				if($data['user_type']=='admin'){
					echo json_encode(array('title'=>'Good job','messages'=>'You are login successfully..','type'=>'success','user'=>'admin','status'=>200));
				}
				else{
					echo json_encode(array('title'=>'Good job','messages'=>'You are login successfully..','type'=>'success','user'=>'donor','status'=>200));
				}
			}else{
				echo json_encode(array('title'=>'Opps!','messages'=>'Please enter valid password..','type'=>'error','status'=>400));
			}
			
		}else{
			echo json_encode(array('title'=>'Sorry','messages'=>'Oops! Email id is not Exist','type'=>'error','status'=>400));
		}
	}
	else{
		echo json_encode(array('title'=>'Sorry','messages'=>'Please provide email-id','type'=>'error','status'=>400));
	}
	// echo json_encode($output);
?>