<?php 
	include_once "../../connection.php";

	if($_REQUEST['action']=='display'){
		$sql=$conn->prepare("select * from tbluser where id=".$_SESSION['user']['id']);
		$sql->execute();
		$data=$sql->fetch();

		$output='<div class="form-group">
                        <input type="hidden" value="'.$data['id'].'" id="admin_id">
                        <label for="name">Admin name</label>
                        <input type="text" class="form-control" id="name" value="'.$data['name'].'" disabled>
                      </div>
                      <div class="form-group">
                        <label for="emialid">Email</label>
                        <input type="email" class="form-control" id="emailid" value="'.$data['email_id'].'" disabled>
                      </div>
                      <div class="form-group">
                        <label for="phno">Contact no.</label>
                        <input type="text" class="form-control" id="phno" value="'.$data['phno'].'" disabled>
                      </div>
                      <div class="row">
                      	<div class="col-sm-6">
                      		<label for="gender">Gender</label>
                        	<input type="text" class="form-control" id="gender" value="'.$data['gender'].'" disabled>
                      	</div>
                      	<div class="col-sm-6">
                      		<label for="group">Blood_group</label>
                        	<input type="text" class="form-control" id="group" value="'.$data['blood_group'].'" disabled>
                      	</div>
                      </div>
                      ';
        echo $output;
	}

// --------------------------------------------------- fetch--------------------------------------------------------------
	if($_REQUEST['action']=='fetch'){
		$sql=$conn->prepare("select * from tbluser where id=".$_SESSION['user']['id']);
		$sql->execute();
		$data=$sql->fetch();
		echo json_encode($data);
	}


// ------------------------------------------------------------ update -------------------------------------------------------
	if($_REQUEST['action']=='update'){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$email=$_POST['email'];
		$phno=$_POST['phno'];
		$gender=$_POST['gender'];
		$group=$_POST['group'];
		if(!empty($id)){
			$sql=$conn->prepare("update tbluser set name='$name',email_id='$email',phno='$phno',gender='$gender',blood_group='$group' where id='$id'");
			if($sql->execute()){
				echo json_encode(array('title'=>'Good job','messages'=>'Profile updated successfully..','type'=>'success'));
			}else{
				echo json_encode(array('title'=>'Opps!','messages'=>'Please try again.','type'=>'error'));
			}

		}
		
	}

// -----------------------------------------------image-----------------------------------------
	if($_REQUEST['action']=='image'){
		$img=$_FILES['img']['name'];
		$str=$conn->prepare("update tbluser set user_img='$img' where id=".$_SESSION['user']['id']);
		if($str->execute()){
			$filename=$_FILES['img']['name'];
			move_uploaded_file($_FILES['img']['tmp_name'],'../../upload/'.$filename);
			echo json_encode(array('title'=>'Good job','messages'=>'Profile image updated successfully..','type'=>'success'));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Please try again.','type'=>'error'));
		}
	}
 ?>