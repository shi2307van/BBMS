<?php 
	include_once "../../connection.php";
	if(isset($_SESSION['user'])){
	$opwd=$_POST['opwd'];
	$npwd=$_POST['npwd'];
	$cpwd=$_POST['cpwd'];
	$str=$conn->prepare("select * from tbluser where id=".$_SESSION['user']['id']);
	$str->execute();
	$data=$str->fetch();
	// echo print_r($data);
	if(password_verify($opwd,$data['password'])){
		$hash=password_hash($npwd, PASSWORD_DEFAULT);
		$str=$conn->prepare("update tbluser set password='$hash' where id=".$data['id']);
		if($str->execute()){
			echo json_encode(array('title'=>'Good job','messages'=>'Password Changed..','type'=>'success','status'=>200));
		}
		else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Please try again..','type'=>'error','status'=>400));
		}
	}
	}
?>