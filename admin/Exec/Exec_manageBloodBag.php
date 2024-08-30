<?php 
	include_once "../../connection.php";

	if($_REQUEST['action']=='exit'){
		$id=$_POST['id'];

		$today=date('Y-m-d');
		// echo $today;
		// echo "update tblmanagebag set date=".date('Y-m-d')." where blood_bag_id='$id'";
		// die();
		
		$str=$conn->prepare("update tblbloodbag set status='2' where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			$s=$conn->prepare("update tblmanagebag set date='$today' where blood_bag_id='$id'");
			$s->execute();

			echo json_encode(array('title'=>'Exit!','messages'=>'Blood Bag is gone!...','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}
	}

 ?>