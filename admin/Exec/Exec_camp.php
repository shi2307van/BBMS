<?php 
	include_once "../../connection.php";





// ---------------------------------------------------------------search-----------------------------------------------------
	if($_REQUEST['action']=='search'){
		$search=$_POST['search'];
		if(empty($search)){
			$str=$conn->prepare("SELECT * FROM `tblbloodcamp` WHERE `status`=0");
			$str->execute();	
		}else{
			$str=$conn->prepare("SELECT * FROM `tblbloodcamp` WHERE `status`=0 AND address LIKE '%".$search."%' ");
			$str->execute();
		}
		$data=$str->fetchAll();
		$output='';
		foreach($data as $datas){
			$output.='
            <div class="col-xs-12 col-sm-6 col-md-4 mt-5">
            <div class="image-flip" >
                <div class="mainflip flip-0">
                    <div class="frontside">
                        <div class="card mb-5" style="box-shadow:10px 10px 10px 10px gray;">
                            <div class="card-body ">
                                <div style="object-fit:cover;">
                                  <img class=" img-fluid " style="height: 200px; width:350px;" src="camp.jfif" alt="card image">
                                </div>
                        
                                <p class=" mt-4"><b>Date Of Camp :</b>'.ucwords( $datas['date_of_camp']).'</p>
                                <p class="card-text mt-2"><b> Address : </b> '.$datas['address'].'</p>
                                <p class="card-text mt-2"><b>Start Time :</b> '.$datas['start_time'].'</p>
                                <p class="card-text mt-2"><b> End Time :</b> '.$datas['end_time'].'</p>
                                                        
                                <button class="btn btn-success display mt-3" ><a href="bloodcamp.php" style="color:white;"><i class="fa-solid fa-user-pen"></i></a></button>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			';
		}
		echo $output; 
	} 



 ?>