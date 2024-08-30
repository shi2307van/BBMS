<?php 
	include_once "../../connection.php";

// ------------------------------------------------- insert-----------------------------------------------------------
		if($_REQUEST['action']=='insert'){
			$name=$_POST['name'];
			$email=$_POST['email'];
			$age=$_POST['age'];
			$type=$_POST['type'];
			$phno=$_POST['phno'];
			$blood_group=$_POST['blood_group'];
			$gender=$_POST['gender'];

			$str=$conn->prepare("insert into tblbloodrequest(name,age,gender,requirement_type,phno,email,blood_group)values (:name,:age,:gender,:requiement_type,:phno,:email,:blood_group)");
	        $str->bindparam(':name',$name);
	        $str->bindparam(':age',$age);
	        $str->bindparam(':gender',$gender);
	        $str->bindparam(':requiement_type',$type);
	        $str->bindparam(':phno',$phno);
	        $str->bindparam(':email',$email);
	        $str->bindparam(':blood_group',$blood_group);
	        
	        if($str->execute()){
	        	$lid=$conn->lastInsertID();
	        	$s1=$conn->prepare("select * from tblbloodrequest where id=".$lid);
	        	$s1->execute();
	        	$data1=$s1->fetch();
	        	$group=$data1['blood_group'];

	        	if($group=='AB+'){
	        		$str=$conn->prepare("select * from tblbloodbag where status=0 order by valid_upto limit 1");
	        		$str->execute();
	        		if($str->rowCount()<1){
	        			echo json_encode(array('title'=>'Opps!','messages'=>'Required Blood is not available...','type'=>'error','status'=>400));
	        		}else{
	        			$bag=$str->fetch();
		        		$bid=$bag['id'];

		        		$str=$conn->prepare("update tblbloodrequest set status=1 where id='$lid'");
	        			$str->execute();
		        		$sql=$conn->prepare("update tblbloodbag set status=1 where id=$bid");
		        		if($sql->execute()){
		        			$s=$conn->prepare("insert into tblmanagebag(blood_bag_id,request_id)values(:bid,:rid)");
		        			$s->bindparam(':bid',$bid);
		        			$s->bindparam(':rid',$lid);
		        			if($s->execute()){
		        				echo json_encode(array('title'=>'Greate','messages'=>'Blood is available...','type'=>'success','status'=>200));
		        			}
		        		}else{
		        			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		        		}
	        		}
	        		
	        	}else{
	        		$q2=$conn->prepare("select * from tblbloodgroup where blood_type='$group'");
				  $q2->execute();
				  $data2=$q2->fetch();

				  // print_r($data2);

				  $blood=$data2['receive_blood_from'];
				  // echo $blood;

				  $arr=explode(" ", $blood);
				  // print_r($arr);
				  $values=array();
				  foreach($arr as $b){
				    // echo $b."</br>";
				    $q3=$conn->prepare("select * from tblbloodbag where blood_group='$b' and status=0 order by valid_upto limit 1 ");
				    $q3->execute();
				    // $data3=$q3->fetchAll();

				    // echo "<pre>";
				    // print_r($data3);

				    // echo "fdg";
				    while ($row=$q3->fetch()) {
				      // code...
				      $value[]=$row;
				    }
				    
				  }

				// echo "<pre>";
				//     print_r($value);

				    if(!empty($value)){
				      $first=$value[0];
				      // echo "<pre>";
				      // print_r($first);
				      // $bag=$str->fetch();
		        		$bid=$value[0]['id'];

		        		$str=$conn->prepare("update tblbloodrequest set status=1 where id='$lid'");
	        			$str->execute();
		        		$sql=$conn->prepare("update tblbloodbag set status=1 where id=$bid");
		        		if($sql->execute()){
		        			$s=$conn->prepare("insert into tblmanagebag(blood_bag_id,request_id)values(:bid,:rid)");
		        			$s->bindparam(':bid',$bid);
		        			$s->bindparam(':rid',$lid);
		        			if($s->execute()){
		        				echo json_encode(array('title'=>'Greate','messages'=>'Blood is available...','type'=>'success','status'=>200));
		        			}
		        		}else{
		        			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		        		}



				    }else{
				    echo json_encode(array('title'=>'Opps!','messages'=>'Required Blood is not available...','type'=>'error','status'=>400));	
				    }
	        	}

	        	// $s2=$conn->prepare("select * from tblbloodgroup where blood_type=".$group);
	        	// $s2->execute();
	        	// $data2=$s2->fetch();
	        	// $blood=$data2['receive_blood_from'];
	        	// echo json_encode(array('title'=>'Good job','messages'=>'Blood request sent successfully...','type'=>'success','status'=>200));
	        }else{
	        	echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
	        }
		}


 ?>