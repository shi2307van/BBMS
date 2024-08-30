<?php 
	include_once "../../connection.php";

	// ---------------------------------------all-------------------------------------------------
	if($_REQUEST['action']=='all'){
		$str=$conn->prepare("select * from tblbloodcamp where status in (0,1)");
		$str->execute();
		$data=$str->fetchAll();
		$output='';
		$i=1;
		foreach($data as $datas){
			$output.='<tr'; if($datas['date_of_camp']<date('Y-m-d')){ 
				$output.=' class="table-danger"';} 
                        if($datas['date_of_camp']>=date('Y-m-d')){
                $output.=' class="table-success"';}
                $output.='>
                      <td><b>'. $i.'.'.'</b></td>
                      <td>'.ucwords($datas['conducted_by']).'</td>
                      <td>'.ucwords($datas['organized_by']).'</td>
                      <td>'.$datas['date_of_camp'].'</td>
                      <td>'.ucwords($datas['address']).'</td>
                      <td>'.$datas['start_time'].'</td>
                      <td>'.$datas['end_time'].'</td>
                      <td>
                        <a href="#" class="btn btn-success update" data-toggle="modal" data-target="#updateModal" data-id="'.$datas['id'].'"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="#" class="btn btn-danger delete" data-id="'.$datas['id'].'"><i class="fa-solid fa-trash-can"></i></a>
                      </td>
                    </tr>';
			$i++;
		}
		echo $output; 
	}




// --------------------------------------------------------fetch---------------------------------------------------
	if($_REQUEST['action']=='fetch'){
		$id=$_POST['id'];
		$str=$conn->prepare("select * from tblbloodcamp where id=:id");
		$str->bindparam(":id",$id);
		$str->execute();
		$data=$str->fetch();
		echo json_encode($data);
	}

// ------------------------------------------------- insert-----------------------------------------------------------
		if($_REQUEST['action']=='add'){
			$conduct=$_POST['conduct'];
			$organized=$_POST['organized'];
			$doc=$_POST['doc'];
			$address=$_POST['address'];
			$start_time=$_POST['start_time'];
			$end_time=$_POST['end_time'];

			$str=$conn->prepare("insert into tblbloodcamp(conducted_by,organized_by,date_of_camp,address,start_time,end_time)values (:conducted_by,:organized_by,:date_of_camp,:address,:start_time,:end_time)");
        $str->bindparam(':conducted_by',$conduct);
        $str->bindparam(':organized_by',$organized);
        $str->bindparam(':date_of_camp',$doc);
        $str->bindparam(':address',$address);
        $str->bindparam(':start_time',$start_time);
        $str->bindparam(':end_time',$end_time);

        if($str->execute()){
        	echo json_encode(array('title'=>'Good job','messages'=>'Blood camp registered successfully...','type'=>'success','status'=>200));
        }else{
        	echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
        }
		}

	// -------------------------------------------- delete-------------------------------------------------------
	if($_REQUEST['action']=='delete'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tblbloodcamp set status='-1' where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Deleted!','messages'=>'Your data has been deleted..','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}
	}

// ------------------------------------------------ update -----------------------------------------------------
	if($_REQUEST['action']=='update'){
		$id=$_POST['txtid'];
		$conduct=ucwords($_POST['txtc']);
		$organized=ucwords($_POST['txto']);
		$date=$_POST['txtdate'];
		$address=$_POST['txtaddress'];
		$stime=$_POST['txtstime'];
		$etime=$_POST['txtetime'];
		$str=$conn->prepare("update tblbloodcamp set conducted_by=:conducted_by,organized_by=:organized_by,date_of_camp=:date_of_camp,address=:address,start_time=:start_time,end_time=:end_time where id=:id");
		$str->bindparam(':id',$id);
		$str->bindparam(':conducted_by',$conduct);
		$str->bindparam(':organized_by',$organized);
		$str->bindparam(':date_of_camp',$date);
		$str->bindparam(':address',$address);
		$str->bindparam(':start_time',$stime);
		$str->bindparam(':end_time',$etime);
		if($str->execute()){
			echo json_encode(array('title'=>'Updated!','messages'=>'Record updated successfully...','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}

	}




 ?>