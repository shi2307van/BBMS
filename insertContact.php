
<?php
        $conn = mysqli_connect("localhost","root","","bbms") or die("Cant Connect to Database");
        if(isset($_REQUEST['name'])){
            
            $name = $_REQUEST['name'];
            $email = $_REQUEST['email'];
            $phno = $_REQUEST['phoneNumber'];
            $subject = $_REQUEST['subject'];
            $mesg = $_REQUEST['msg'];
        
            $ins = "INSERT INTO `tblcontactquery`(`name`, `email`, `phno`,`subject`,`message`) VALUES ('$name','$email','$phno','$subject','$mesg')";
            $res = mysqli_query($conn,$ins);

            if($res){
                // echo '<script>alert("Welcome to Geeks for Geeks")</script>';
                $json = json_encode(array("success" => 1));
                echo $json;
            }
            else{
                // echo '<script>alert("Welcome to Geeks for Geeks")</script>';
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
 
           
        }
    ?>