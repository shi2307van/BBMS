<?php 
	include_once "../../connection.php";


	//--------------------------------------------All------------------------------------
	if($_REQUEST['action']=='all'){
		$str=$conn->prepare("select * from tbluser where status in (0,1) and user_type='donor'");
		$str->execute();
		$data=$str->fetchAll();
		$output='';
		foreach($data as $datas){
			$output.='
			<div class="col-xs-12 col-sm-6 col-md-4 mt-5">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">
                                    <p>';
                                    	if($datas['user_img']!=''){ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="../upload/'.$datas['user_img'].'" alt="card image">';
                                   }else{ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="dist/img/defaultAvatar.png" alt="card image">';
                                       }                            
                            $output.='<p class="text-center">'.$datas['donor_id'].'</p>
                            <h4 class="text-center">'.ucwords( $datas['name']).'</h4>
                                    <p class="card-text">'.$datas['email_id'].'</p>';

                        if($datas['status']==1){
                            $output.='<button class="btn btn-info hide" data-id="'.$datas['id'].'"><i class="fa-solid fa-eye-slash"></i></button>
                            ';
                        }
                        if($datas['status']==0){ 
                            $output.='<button class="btn btn-info public" data-id="'.$datas['id'].'"><i class="fa-solid fa-eye"></i></button>
                            ';
                        }
                            $output.='<button class="btn btn-success display" data-toggle="modal" data-target="#displayModal" data-id="'.$datas['id'].'"><i class="fa-solid fa-user-pen"></i></button>
                                    <button class="btn btn-danger delete" data-id="'.$datas['id'].'"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
		}
		echo $output; 
	} 


	// ----------------------------------------------search------------------------------------------------
	if($_REQUEST['action']=='search'){
		$search=$_POST['search'];
		if(empty($search)){
			$str=$conn->prepare("select * from tbluser where status in (0,1) and user_type='donor'");
			$str->execute();	
		}else{
			$str=$conn->prepare("SELECT * FROM `tbluser` WHERE user_type='donor' AND email_id LIKE '%".$search."%' and status in (0,1)");
			$str->execute();
		}
		$data=$str->fetchAll();
		$output='';
		foreach($data as $datas){
			$output.='
			<div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card">
                                <div class="card-body text-center">';
                                           
                                    	if($datas['user_img']!=''){ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="../upload/'.$datas['user_img'].'" alt="card image">';
                                   }else{ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="dist/img/defaultAvatar.png" alt="card image">';
                                       }                            
                            $output.='<h4 class="text-center">'.ucwords( $datas['name']).'</h4>
                                    <p class="card-text">'.$datas['email_id'].'</p>';

                        if($datas['status']==1){
                            $output.='<button class="btn btn-info hide" data-id="'.$datas['id'].'"><i class="fa-solid fa-eye-slash"></i></button>
                            ';
                        }
                        if($datas['status']==0){ 
                            $output.='<button class="btn btn-info public" data-id="'.$datas['id'].'"><i class="fa-solid fa-eye"></i></button>
                            ';
                        }
                            $output.='<button class="btn btn-success display" data-toggle="modal" data-target="#displayModal" data-id="'.$datas['id'].'"><i class="fa-solid fa-user-pen"></i></button>
                                    <button class="btn btn-danger delete" data-id="'.$datas['id'].'"><i class="fa-solid fa-trash-can"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
		}
		echo $output; 
	} 



	// --------------------------------------------- delete -------------------------------------------------
	if($_REQUEST['action']=='delete'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tbluser set status='-1' where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Deleted!','messages'=>'Your data has been deleted..','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}
	}

	// --------------------------------------------hide------------------------------------------------------
	if($_REQUEST['action']=='hide'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tbluser set status=0 where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Done!','messages'=>'Information hide','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}

	}


	// --------------------------------------------show------------------------------------------------------
	if($_REQUEST['action']=='show'){
		$id=$_POST['id'];
		$str=$conn->prepare("update tbluser set status=1 where id=:id");
		$str->bindparam(":id",$id);
		if($str->execute()){
			echo json_encode(array('title'=>'Done!','messages'=>'Information Show','type'=>'success','status'=>200));
		}else{
			echo json_encode(array('title'=>'Opps!','messages'=>'Something went wrong...','type'=>'error','status'=>400));
		}

	}


	// ---------------------------------------------------fetch-----------------------------------------------
	if($_REQUEST['action']=='fetch'){
		$id=$_POST['id'];
		$str=$conn->prepare("select * from tbluser where id=:id");
		$str->bindparam(":id",$id);
		$str->execute();
		$data=$str->fetch();
		echo json_encode($data);
	}
 ?>