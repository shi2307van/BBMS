<?php 
	include_once "../../connection.php";

	//--------------------------------------------All------------------------------------
	if($_REQUEST['action']=='all'){
		$str=$conn->prepare("select * from tblcontactquery where status in (0,1)");
		$str->execute();
		$data=$str->fetchAll();
		$output='';
		$i=1;
		foreach($data as $datas){
			$output.='<tr>
				<td>'.$i.'.'.'</td>
				<td>'.ucwords($datas['name']).'</td>
				<td>'.$datas['email'].'</td>
				<td>'.$datas['phno'].'</td>
				<td>'.ucfirst($datas['subject']).'</td>
				<td>'.ucfirst($datas['message']).'</td>
				<td>'.$datas['posting_date'].'</td>';
				if($datas['status']==1){
			$output.='<td>
                    Read / 
                    <a href="#" class="text-danger delete" data-id="'.$datas['id'].'">Delete</a>
                </td>';
				}else{
			$output.='<td>
                    <a href="#" class="text-success read" data-id="'.$datas['id'].'">Read</a> / 
                    <a href="#" class="text-danger delete" data-id="'.$datas['id'].'">Delete</a>
                </td>';
				}
			$output.='</tr>';
			$i++;
		}
		echo $output; 
	} 


// -----------------------------------------read-----------------------------------------------------
	if($_REQUEST['action']=='read'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tblcontactquery set status=1 where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Done!','messages'=>'Read','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}

	}

// --------------------------------------------- delete -------------------------------------------------
	if($_REQUEST['action']=='delete'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tblcontactquery set status='-1' where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Deleted!','messages'=>'Your data has been deleted..','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}
	}

// ---------------------------------------------- insert --------------------------------------------------------

	if($_REQUEST['action']=='insert'){
		$name = $_POST['txtname'];
        $email = $_POST['txtemail'];
        $phno = $_POST['txtphno'];
        $subject = $_POST['txtsub'];
        $msg = $_POST['txtmsg'];

        $str=$conn->prepare("insert into tblcontactquery(name,email,phno,subject,message)values (:name,:email,:phno,:subject,:msg)");
        $str->bindparam(':name',$name);
        $str->bindparam(':email',$email);
        $str->bindparam(':phno',$phno);
        $str->bindparam(':subject',$subject);
        $str->bindparam(':msg',$msg);

        if($str->execute()){
        	echo json_encode(array('title'=>'Good job','messages'=>'Your query has been sent successfully...','type'=>'success','status'=>200));
        }else{
        	echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
        }
	}
?>