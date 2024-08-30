<?php 
	include_once "../../connection.php";


//--------------------------------------------All------------------------------------
	if($_REQUEST['action']=='all'){
		$str=$conn->prepare("select * from tbluser where status=1 and user_type='donor'");
		$str->execute();
		$data=$str->fetchAll();
		$output='';
		foreach($data as $datas){
			$output.='
			<div class="col-xs-12 col-sm-6 col-md-4 mt-5">
          <div class="image-flip" >
              <div class="mainflip flip-0">
                  <div class="frontside">
                      <div class="card border ">
                          <div class="card-body" style="box-shadow: 5px 10px 15px 15px grey;">
                            <div class=" text-center">
                            <p>';
                                    	if($datas['user_img']!=''){ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="../upload/'.$datas['user_img'].'" alt="card image">';
                                   }else{ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 100px; width:100px;" src="dist/img/defaultAvatar.png" alt="card image">';
                                       }                            
                            $output.='</p>
                            </div>
                             <div class="ml-4">
                              <h3 class="text-center mt-5 mb-3">'.ucwords( $datas['name']).'</h3>
                              <p class="card-text"><b>Donor Id :</b>'.$datas['donor_id'].'</p>
                              <p class="card-text"><b>Email-Id :</b>'.$datas['email_id'].'</p>
                              <p class="card-text"><b>Phone No:</b>'.$datas['phno'].'</p>
                              <p class="card-text"><b>Blood Group:</b>'.$datas['blood_group'].'</p>
                              <p class="card-text"><b>Gender:</b>'.$datas['gender'].'</p>
                              <p class="card-text"><b>Age:</b>'.$datas['age'].'</p>
                              <p class="card-text"><b>Address:</b>'.$datas['address'].'</p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>';
		}
		echo $output; 
	} 


// ---------------------------------------------------------------search-----------------------------------------------------
    if($_REQUEST['action']=='search'){
        $search=$_POST['search'];
        if(empty($search)){
            $str=$conn->prepare("select * from tbluser where status=1 and user_type='donor'");
            $str->execute();    
        }else{
            $str=$conn->prepare("SELECT * FROM `tbluser` WHERE user_type='donor' AND blood_group LIKE '%".$search."%' and status in (0,1)");
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
                            <div class="card mb-5" style="box-shadow:10px 10px 10px 10px gray;">
                                <div class="card-body text-center">';
                                           
                                        if($datas['user_img']!=''){ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 150px; width:150px;" src="upload/'.$datas['user_img'].'" alt="card image">';
                                   }else{ 
                            $output.='<img class=" img-fluid rounded-circle" style="height: 150px; width:150px;" src="admin/dist/img/defaultAvatar.png" alt="card image">';
                                       }                            
                            $output.='<h4 class="text-center">'.ucwords( $datas['name']).'</h4>
                                    <p class="card-text mt-2">'.$datas['blood_group'].'</p>
                                    <button class="btn btn-success display mt-3" data-toggle="modal" data-target="#displayModal" data-id="'.$datas['id'].'"><i class="fa-solid fa-user-pen"></i></button>';
                            $output.='
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo $output; 
    } 



 ?>