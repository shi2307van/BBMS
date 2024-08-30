<?php 

	include_once "../../connection.php";

	if($_REQUEST['action']=='insert'){
		$email=$_POST['txtemail'];
		$pwd=$_POST['txtcpwd'];
		$name=$_POST['txtname'];
		$phno=$_POST['txtphno'];
		$age=$_POST['txtage'];
		$group=$_POST['txtgroup'];
		$address=$_POST['txtaddress'];
		$gender=$_POST['txtgender'];
		$img=$_FILES['img']['name'];
		$hash=password_hash($pwd,PASSWORD_DEFAULT);

		// echo $_FILES['img']['name'];
		$str=$conn->prepare("select * from tbluser where email_id='$email' and user_type='donor' and status='1'");
		$str->execute();
		if($str->rowCount()>0){
			echo json_encode(array('title'=>'Oops!','messages'=>'User is already exist','type'=>'error','status'=>400));
		}else{
			$str=$conn->prepare("insert into tbluser(name,gender,user_img,email_id,phno,age,blood_group,address,password)values(:name,:gender,:img,:email,:phno,:age,:group,:address,:password)");
			$str->bindparam(":name",$name);
			$str->bindparam(":gender",$gender);
			$str->bindparam(":img",$img);
			$str->bindparam(":email",$email);
			$str->bindparam(":phno",$phno);
			$str->bindparam(":age",$age);
			$str->bindparam(":group",$group);
			$str->bindparam(":address",$address);
			$str->bindparam(":password",$hash);
			if($str->execute()){
			
                $filename=$_FILES['img']['name'];
				move_uploaded_file($_FILES['img']['tmp_name'],'../../upload/'.$filename);
				$sql=$conn->prepare("select * from tbluser where email_id='$email' and user_type='donor' and status='1'");
				$sql->execute();
				$data=$sql->fetch();
				// echo "update tbluser set donor_id=".date('Ymd').$data['id']." where id=".$data['id'];
				$stm=$conn->prepare("update tbluser set donor_id=".date('Ymd').$data['id']." where id=".$data['id']);
				$stm->execute();
				echo json_encode(array('title'=>'Good job','messages'=>'You are registered successfully...','type'=>'success','status'=>200));
			}else{
				echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
			}
		}


		// echo date('Ymd');
		




	}


 ?>