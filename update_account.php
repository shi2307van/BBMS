<?php
 include("connection.php");
if(isset($_POST['name'])) {
    $id = $_POST['id'];
    $fn = $_POST['name'];
    $em = $_POST['email'];
    $phno = $_POST['phno'];
    $age = $_POST['age'];
    $add = $_POST['add'];
    $gen = $_POST['gender'];
    echo $gen;
    $bld = $_POST['bldgrp'];
    $b = $_POST['bld'];
    $newBld = "";
    if(empty($bld)){
        $newBld = $b ;
    }
    else{
        $newBld = $bld;
    }
    echo $bld;

    // $sql = $conn->prepare("UPDATE `tbluser` SET `name`='$fn',`gender`='$gen',`email_id`='$em',`phno`='$phno',`age`='$age',`blood_group`='$bld',`address`='$add' WHERE `id`=$id");
    $sql = $conn->prepare("update tbluser set name='$fn',gender='$gen',email_id='$em',phno='$phno',age='$age',blood_group='$newBld',address='$add' where id=".$_SESSION['user']['id']);

    if($sql->execute()){
        echo json_encode(array("success" => 1,'title'=>'Good job','messages'=>'Profile updated successfully..','type'=>'success'));
    }else{
        echo json_encode(array('title'=>'Opps!','messages'=>'Please try again.','type'=>'error'));
    }
   
  }

  if($_REQUEST['action']=='image'){
    $img=$_FILES['img']['name'];
    $oimg = $_POST['old_img'];
    $nimg = "";
    if(empty($img)){
        $nimg = $oimg;
    }else{
        $nimg = $img;
    }
    $str=$conn->prepare("update tbluser set user_img='$nimg' where id=".$_SESSION['user']['id']);
    if($str->execute()){
        $filename=$_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'],'upload/'.$filename);
        echo json_encode(array('title'=>'ok','messages'=>'User image updated...','type'=>'success'));
    }else{
        echo json_encode(array('title'=>'Opps!','messages'=>'Please try again.','type'=>'error'));
    }
}
?>