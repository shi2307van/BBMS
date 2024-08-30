<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>
  <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <style>
.error input {
    border-color: red;
    border-width: 2px;
}

.success input {
    border-color: green;
    border-width: 2px;
}

.error span {
    color:red;
}

.success span {
    color: green;
}

span.error{
    color: red;
}
  </style>
</head>


<body >
<div class="wrapper">
 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Product Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add product Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <div id="message"></div>
           <form method="post" id="upload" name="upload" enctype="multipart/form-data">
             
              <div class="container">
                <h1></h1>
                <div class="row form-group">
                 
                    <div class="col-md-6 mt-4">
                        <label for="pname">Enter Product Name </label>
                        <input type="text" class="form-control " id="pname" name="pname"  >
                        <span class="error" id="parr"> </span>
                   
                    </div>
                    <div class="col-md-6 mt-4 ">
                        <label for="ptag">Enter Product Tags </label>
                        <input type="text" class="form-control " id="ptag" name="ptag"  >
                        <span class="error" id="tagarr"> </span>
                    </div>
                </div> 

               <div class="row form-group">
                    <div class="col-md-6 ">
                        <label for="p_tax">Enter Product tax </label>
                        <input type="text" class="form-control" id="p_tax" name="p_tax" > 
                        <span class="error" id="taxerr"> </span>
                    </div>
                    <div class="col-md-6 ">
                        <label for="p_discount">Enter Product discount </label>
                        <input type="text" class="form-control" id="p_discount" name="p_discount" >
                        <span class="error" id="disarr"> </span>
                    </div>
                </div> 

                <div class="row form-group">
                    <div class="col-md-6 ">
                        <label for="price">Enter Product price </label>
                        <input type="text" class="form-control" id="price" name="price" >
                        <span class="error" id="prarr"> </span>
                    </div>
                    <div class="col-md-6 ">
                        <label for="keyword">Enter Product keywords </label>
                        <input type="text" class="form-control" id="keyword" name="keyword" >
                        <span class="error" id="keyarr"> </span>
                    </div>
                </div> 

                 <div class="row form-group">
                    <div class="col-md-12">
                        <label for="p_desc">Enter Product description </label>
                        <textarea  rows="4" cols="50"  class="form-control" id="p_desc" name="p_desc"></textarea>
                        <span class="error" id="descarr"> </span>
                    </div>
                </div>

                 
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="cat">Enter Category  </label>
                         <select name="cat" id="cat" class="form-control" >
                          <option value="-1">--select Category--</option>
                          
                            <option value=""></option>
                            
                         </select>
                         <span class="error" id="catarr"> </span>
                    </div>
                    <div class="col-md-6 SubCat">
                        
                    </div>
                </div> 

                <div class="row form-group">
                    <div class="col-md-12 ">
                    <label for="p_slug">Enter Product Slug </label>
                        <input type="text" class="form-control" id="p_slug" name="p_slug" >
                        <span class="error" id="slugarr"> </span>
                    </div>
                </div >

                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="img">Enter Product image </label>
                            <input type="file" accept="image/jpeg, image/png"  class="form-control" id="img" name="img" >
                            <span class="error" id="imgarr"> </span>
                        </div>
                        <div class="col-md-6">
                            <label for="img2">Enter Product image </label>
                            <input type="file" accept="image/jpeg, image/png"  class="form-control" id="img2" name="img2" >
                            <span class="error" id="imgarr2"> </span>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="img3">Enter Product image </label>
                            <input type="file" accept="image/jpeg, image/png"  class="form-control" id="img3" name="img3" >
                            <span class="error" id="imgarr3"> </span>
                        </div>
                        <div class="col-md-6">
                            <label for="img4">Enter Product image </label>
                            <input type="file" accept="image/jpeg, image/png"  class="form-control" id="img4" name="img4" >
                            <span class="error" id="imgarr4"> </span>
                        </div>
                    </div>
              
             
                   <div class="row">
                      <div class="col-md-6">
                      <input type="submit"  id="btnAdd" name="btnAdd" value="Add" class="btn btn-primary pl-5 pr-5">
                      </div>
                   </div>
              
          </form>
            </div>
              
       

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<!-- Page specific script -->
<script>
 
// $(document).ready(function(){
//         $("#upload").on("submit",function(e){
//          e.preventDefault();
//           var form_data= new FormData(this);
//           console.log(form_data);
//           alert("hey");
//            $.ajax({
//                  type:"POST",
//                  url:"insertPro.php",
//                  data:form_data,
//                  dataType:'json',
//                  contentType:false,
//                  processData:false,
//                  success:function(data){
//                   //var a = JSON.parse(response);
//                   console.log(data.success);
//                    if(data.success==1){
//                     alert("done");
//                     location.reload();   
//                    }
//                    else{
//                     alert("No");
//                    }
                 
              
//                  }
//           });
         
       
//           });
// });

$(document).ready(function(){
 
    $('#pname').on('input', function () {
        checkpname();
    });
    $('#ptag').on('input', function () {
        checktag();
    });
    $('#p_tax').on('input', function () {
        checktax();
    });
    $('#p_discount').on('input', function () {
        checkdisc();
    });
    $('#price').on('input', function () {
        checkprice();
    });
    $('#keyword').on('input', function () {
        checkkeyword();
    });
    $('#cat').on('input', function () {
        checkcat();
    });
    $('#p_slug').on('input', function () {
        checkslug();
    }); 
    $('#p_desc').on('input', function () {
        checkdesc();
    });
    $('#img').on('input', function () {
        checkimg();
    });
     $('#img2').on('input', function () {
        checkimg2();
    }); 
    $('#img3').on('input', function () {
        checkimg3();
    }); 
    $('#img4').on('input', function () {
        checkimg4();
    }); 

    $("#upload").on("submit",function(e){
        e.preventDefault();
  
        if (!checkpname() && !checktag() && !checktax() && !checkdisc() && !checkprice() && !checkkeyword() && !checkcat()&& !checkslug()&& !checkdesc()&& !checkimg() && !checkimg2() && !checkimg3() && !checkimg4()) {
            console.log("er1");
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
        } else if (!checkpname() || !checktag() || !checktax() || !checkdisc() || !checkprice() || !checkkeyword() ||!checkcat() || !checkslug() || !checkdesc() || !checkimg() || !checkimg2() || !checkimg3() ||!checkimg4()) {
            $("#message").html(`<div class="alert alert-warning">Please fill all required field</div>`);
            console.log("er");
        }
        else {
          e.preventDefault();
          
           // alert("done");
            $("#message").html("");
            var form_data= new FormData(this);
            console.log(form_data);
            $.ajax({
              type:"POST",
                 url:"insertPro.php",
                 data:form_data,
                 dataType:'json',
                 contentType:false,
                 processData:false,
                beforeSend: function () {
                    $('#btnAdd').html('<i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#btnAdd').attr("disabled", true);
                    $('#btnAdd').css({ "border-radius": "50%" });
                },

                success: function (data) {
                  if(data.success==1){
                    $("#message").html(`<div class="alert alert-success">Insert Data Successfully</div>`);
                    
                   }
                   else{
                    $('#message').html(`<div class="alert alert-danger">OOps Some error occure!!!</div>`);
                   }
                   
                },
                complete: function () {
                    setTimeout(function () {
                        $('#upload').trigger("reset");
                        $('#btnAdd').html('Submit');
                        $('#btnAdd').attr("disabled", false);
                        $('#btnAdd').css({ "border-radius": "4px" });
                         location.reload(); 
                    }, 2000);
                }
            });
        }
    });

    $('#cat').on('change', function() {
          var cat_id = this.value;
          console.log(cat_id);
          $.ajax({
          url: "fetch_subCategory.php",
          type: "POST",
          data: {
          cat_id: cat_id
          },
          cache: false,
          success: function(result){
          $(".SubCat").html(result);
          }
          });
    });
});


function checkpname() {
    var pattern = /^[A-Za-z,0-9 ]+$/;
    var user = $('#pname').val();
    console.log(user);
    var validuser = pattern.test(user);
 
    if (user=="") {
        $('#parr').html('Product Name can not be empty');
        return false;
    } 
    else if(!validuser){
      $('#parr').html('Product name should be a-z ,A-Z only');
        return false;
    }
    else {
        $('#parr').html('');
        return true;
    }
}
function checktag() {
    var pattern = /^[A-Za-z, ]+$/;
    var user = $('#ptag').val();
    console.log(user);
    var validuser = pattern.test(user);
 
    if (user=="") {
        $('#tagarr').html('Product Tag can not be empty');
        return false;
    } 
    else if(!validuser){
      $('#tagarr').html('Product Tag should be a-z ,A-Z only');
        return false;
    }
    else {
        $('#tagarr').html('');
        return true;
    }
}
function checktax() {
  if($("#p_tax").val()==""){
    $("#taxerr").html("product tax is Not empty");
        return false;
  }
  else if(!$.isNumeric($("#p_tax").val())) {
        $("#taxerr").html("only number is allowed");
        return false;
    }
    else {
        $("#taxerr").html("");
        return true;
    }
}
function checkdisc() {
    if($("#p_discount").val()==""){
      $("#disarr").html("product discount is Not empty");
        return false;
    }
    else if (!$.isNumeric($("#p_discount").val())) {
        $("#disarr").html("only number is allowed");
        return false;
    }
    else {
        $("#disarr").html("");
        return true;
    }
}
function checkprice() {
  if($("#price").val()==""){
      $("#prarr").html("product price is Not empty");
        return false;
    }
  else if (!$.isNumeric($("#price").val())) {
        $("#prarr").html("only number is allowed");
        return false;
    }
    else {
        $("#prarr").html("");
        return true;
    }
}
function checkkeyword() {
  var pattern = /^[A-Za-z, ]+$/;
    var user = $('#keyword').val();
    console.log(user);
    var validuser = pattern.test(user);
 
    if (user=="") {
        $('#keyarr').html('Product Keyword can not be empty');
        return false;
    } 
    else if(!validuser){
      $('#keyarr').html('Product Keyword should be a-z ,A-Z only');
        return false;
    }
    else {
        $('#keyarr').html('');
        return true;
    }
}
function checkcat() {
 
    var user = $('#cat').val();
    console.log(user);
    
   if(user == -1){
      $('#catarr').html('Product category not empty');
        return false;
    }
    else {
        $('#catarr').html('');
        return true;
    }
}
function checkslug() {
  var pattern = /^[A-Za-z, ]+$/;
    var user = $('#p_slug').val();
    console.log(user);
    var validuser = pattern.test(user);
 
    if (user=="") {
        $('#slugarr').html('Product slug can not be empty');
        return false;
    } 
    else if(!validuser){
      $('#slugarr').html('Product slug should be a-z ,A-Z only');
        return false;
    }
    else {
        $('#slugarr').html('');
        return true;
    }
}
function checkdesc() {
  var pattern = /^[A-Za-z0-9, ]+$/;
    var user = $('#p_desc').val();
    console.log(user);
    var validuser = pattern.test(user);
 
    if (user=="") {
        $('#descarr').html('Product description can not be empty');
        return false;
    } 
    else if(!validuser){
      $('#descarr').html('Product description should be a-z ,A-Z only');
        return false;
    }
    else {
        $('#descarr').html('');
        return true;
    }
}
function checkimg() {
    var user = $('#img').val();
    console.log(user);
  
    if (user=="") {
        $('#imgarr').html('Product img can not be empty');
        return false;
    } 
 
    else {
        $('#imgarr').html('');
        return true;
    }
}
function checkimg2() {
 
    var user = $('#img2').val();
    console.log(user);

 
    if (user=="") {
        $('#imgarr2').html('Product img can not be empty');
        return false;
    } 

    else {
        $('#imgarr2').html('');
        return true;
    }
}
function checkimg3() {
  
    var user = $('#img3').val();
    console.log(user);
 
 
    if (user=="") {
        $('#imgarr3').html('Product img can not be empty');
        return false;
    } 
  
    else {
        $('#imgarr3').html('');
        return true;
    }
}
function checkimg4() {

    var user = $('#img4').val();
    console.log(user);
    
 
    if (user=="") {
        $('#imgarr4').html('Product img can not be empty');
        return false;
    } 
   
    else {
        $('#imgarr4').html('');
        return true;
    }
}
</script>
</body>
</html>
