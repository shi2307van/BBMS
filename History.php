<?php 
    include_once "connection.php";
//     if(!isset($_SESSION['user'])){
//         header('Location:login.php');
//     }
  ?>

<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="assets/images/logo1.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
	<link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/logo1.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/plugins/grid-gallery/css/grid-gallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">

    <style>
        body {
  background: #f7f7f7;
}

.form-box {
  max-width: 800px;
  margin: auto;
  padding: 50px;
  background: #ffffff;
  border: 10px solid #f2f2f2;
}

h1, p {
  text-align: center;
}

input, textarea {
  width: 100%;
}
    </style>
</head>
<body>
<?php// include_once('header.php');?>
<!-- MultiStep Form -->

  <h1 class="mt-5 mb-5">Blood donatation Detail</h1>
 

  <table class="table table-bordered">
       <tr>
        <th>*</th>
        <th>Donar Name</th>
        <th>Disease</th>
        <th>Units_of_blood</th>
        <th>date And time</th>
       </tr>
       <tr>
        <?php
        // $name=$_SESSION['user']['name'];
        $his=$conn->prepare("select * from tblblooddonate where status=1 and donor_id=".$_SESSION['user']['id']);
        $his->execute();
        $hata=$his->fetch();?>

        <td></td>
     

        <td><?php if(isset($hata['donor_id'])){echo $_SESSION['user']['name'];}else{ echo "-" ;}?></td>
        <td><?php if(isset($hata['donor_id'])){echo $hata['disease'];}else{ echo "-" ;}?></td>
        <td><?php if(isset($hata['donor_id'])){echo $hata['units_of_blood'];}else{ echo "-" ;}?></td>
        <td><?php if(isset($hata['donor_id'])){echo $hata['donate_date'];}else{ echo "-" ;}?></td>
        
       </tr>
  </table>

<!-- <?php //include_once('footer.php');?> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

</body>
</html>