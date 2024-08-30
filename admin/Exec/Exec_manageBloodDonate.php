<?php 
	include_once "../../connection.php";



//--------------------------------------------All------------------------------------
	if($_REQUEST['action']=='all'){
		$str=$conn->prepare("select * from tblblooddonate");
		$str->execute();
		$data=$str->fetchAll();
		$output='';
		$i=1;
		foreach($data as $datas){
			$sql=$conn->prepare("select * from tbluser where id=".$datas['donor_id']);
            $sql->execute();
            $did=$sql->fetch();

            $s=$conn->prepare("select * from tblbloodcamp where id=".$datas['camp_id']);
            $s->execute();
            $cid=$s->fetch();
			$output.='<tr>
				<td>'.$i.'.'.'</td>
				<td>'.$did['name'].'</td>';
				if($datas['camp_id']==0){
			$output.='<td>'.$datas['donate_date'].'(Self)</td>';
				}else{
			$output.='<td>'.$cid['date_of_camp'].'</td>';
				}
			$output.='<td>'.$datas['disease'].'</td>
				<td>'.$datas['units_of_blood'].'</td>
				<td>'.$datas['reg_time'].'</td>';
				if($datas['status']==1){
			$output.='<td>
                    Accepted
                </td>';
            }
            if($datas['status']=='-1'){
			$output.='<td>
                    Rejected
                </td>';
            }
			if($datas['status']==0){
			$output.='<td>
                    <a href="#" class="text-success accept" data-id="'.$datas['id'].'">Accept</a> / 
                    <a href="#" class="text-danger reject" data-id="'.$datas['id'].'">Reject</a>
                </td>';
				}
			$output.='</tr>';
			$i++;
		}
		echo $output; 
	} 

// ------------------------------------------------- insert-----------------------------------------------------------
		if($_REQUEST['action']=='insert'){
			$disease=$_POST['disease'];
			$camp=$_POST['camp'];
			$unit=$_POST['unit'];
			$doc=$_POST['doc'];
			$donor=$_SESSION['user']['id'];
			$str=$conn->prepare("insert into tblblooddonate(donor_id,camp_id,disease,units_of_blood,donate_date)values (:donor_id,:camp_id,:disease,:units_of_blood,:date)");
        $str->bindparam(':donor_id',$donor);
        $str->bindparam(':camp_id',$camp);
        $str->bindparam(':disease',$disease);
        $str->bindparam(':units_of_blood',$unit);
        $str->bindparam(':date',$doc);
       
        if($str->execute()){
        	echo json_encode(array('title'=>'Good job','messages'=>'Your blood donate request has been sent registered successfully...','type'=>'success','status'=>200));
        }else{
        	echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
        }
		}


// -------------------------------------------------------accept-----------------------------------------------------
	if($_REQUEST['action']=='accept'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tblblooddonate set status=1 where id=:id");
		$str->bindparam(":id",$id);
		$str->execute();

		$q1=$conn->prepare("select * from tblblooddonate where id=:id");
		$q1->bindparam(":id",$id);
		$q1->execute();
		$data1=$q1->fetch();
		$did=$data1['donor_id'];
		$unit=$data1['units_of_blood'];

		// echo $did;
		$q2=$conn->prepare("select * from tbluser where id=:id");
		$q2->bindparam(':id',$did);
		$q2->execute();
		$data2=$q2->fetch();
		$bgroup=$data2['blood_group'];

		
		// echo $bgroup;
		$valid_date=date('Y-m-d',strtotime('+42 days'));
	for($i=1;$i<=$unit;$i++){

		$sql=$conn->prepare("insert into tblbloodbag(donor_id,blood_group,valid_upto)values(:donor_id,:blood_group,:valid_date)");
		$sql->bindparam(':donor_id',$did);
		$sql->bindparam(':blood_group',$bgroup);
		$sql->bindparam(':valid_date',$valid_date);
		if($sql->execute()){
			$lid=$conn->lastInsertID();
			// echo date('Ymd').$did.$lid;
			// echo "update tblbloodbag set blood_bag_id=".date('Ymd').$did.$lid." where id='$lid'";
			
			$str=$conn->prepare("update tblbloodbag set blood_bag_id=".date('Ymd').$did.$lid." where id='$lid'");
			$str->execute();
			if($str->execute()){
				echo json_encode(array('title'=>'Done!','messages'=>'Blood bag Accepted','type'=>'success','status'=>200));
			}else{
				echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
			}
		
		}

	}	
	echo json_encode(array('title'=>'Done!','messages'=>'Blood bag Accepted','type'=>'success','status'=>200));	

	}

// --------------------------------------------- delete -------------------------------------------------
	if($_REQUEST['action']=='reject'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tblblooddonate set status='-1' where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Rejected!','messages'=>'Request Rejected','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}
	}

 ?>