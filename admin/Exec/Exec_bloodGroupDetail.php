<?php 
	include_once "../../connection.php";

// ---------------------------------------all-------------------------------------------------
	if($_REQUEST['action']=='all'){
		$str=$conn->prepare("select * from tblbloodgroup");
		$str->execute();
		$data=$str->fetchAll();
		$output='';
		$i=1;
		foreach($data as $datas){
			$output.='<tr>
				<td>'.$i.'.'.'</td>
				<td>'.$datas['blood_type'].'</td>
				<td>'.$datas['donate_blood_to'].'</td>
				<td>'.$datas['receive_blood_from'].'</td>
				<td>
                    <a href="#" class="btn btn-success update" data-id="'.$datas['id'].'"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" class="btn btn-danger delete" data-id="'.$datas['id'].'"><i class="fa-solid fa-trash-can"></i></a>
                </td>
			</tr>';
			$i++;
		}
		echo $output; 
	}

// ----------------------------------------------add-----------------------------------------------
	if($_REQUEST['action']=='add'){
		$blood=strtoupper($_POST['txtblood']);
		$to=strtoupper($_POST['txtto']);
		$from=strtoupper($_POST['txtfrom']);
		
		$str=$conn->prepare("select * from tblbloodgroup where blood_type=:blood_type");
		$str->bindparam(":blood_type",$blood);
		$str->execute();
		if($str->rowCount()>0){
			echo json_encode(array('title'=>'Oops!','messages'=>'This data is already exist','type'=>'error','status'=>400));
		}else{
			$sql=$conn->prepare("insert into tblbloodgroup(blood_type,donate_blood_to,receive_blood_from)values(:blood_type,:donate_blood_to,:receive_blood_from)");
			$sql->bindparam(":blood_type",$blood);
			$sql->bindparam(":donate_blood_to",$to);
			$sql->bindparam(":receive_blood_from",$from);
			if($sql->execute()){
				echo json_encode(array('title'=>'Good job','messages'=>'Record inserted successfully...','type'=>'success','status'=>200));
			}else{
				echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
			}
		}
	}

// ----------------------------------------delete-----------------------------------------------
	if($_REQUEST['action']=='delete'){
		$id=$_POST['id'];
		$str=$conn->prepare("delete from tblbloodgroup where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Deleted!','messages'=>'Your data has been deleted..','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}
	}


// -----------------------------------------fetch---------------------------------------------------
	if($_REQUEST['action']=='fetch'){
		$id=$_POST['id'];
		$str=$conn->prepare("select * from tblbloodgroup where id=:id");
		$str->bindparam(":id",$id);
		$str->execute();
		$data=$str->fetch();
		echo json_encode($data);
	}


// ---------------------------------------------update-------------------------------------------------
	if($_REQUEST['action']=='update'){
		$id=$_POST['txtid'];
		$blood=strtoupper($_POST['txtblood']);
		$to=strtoupper($_POST['txtto']);
		$from=strtoupper($_POST['txtfrom']);
		$str=$conn->prepare("update tblbloodgroup set blood_type=:blood_type,donate_blood_to=:donate_blood_to,receive_blood_from=:receive_blood_from where id=:id");
		$str->bindparam(':id',$id);
		$str->bindparam(':blood_type',$blood);
		$str->bindparam(':donate_blood_to',$to);
		$str->bindparam(':receive_blood_from',$from);
		if($str->execute()){
			echo json_encode(array('title'=>'Updated!','messages'=>'Record updated successfully...','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}

	}
 ?>