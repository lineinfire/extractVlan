<?php
$switchid = trim($_POST["switchid"]);
$modulecode = trim($_POST['modulecode']);
$connect= new mysqli("localhost","root","","multi-admin") or die("ERROR:could not connect to the database!!!");
 
//select users data
$query=$connect->query("SELECT * FROM `role_rights` WHERE `rr_rolecode` like '$switchid' AND `rr_modulecode` like '$modulecode' AND `rr_create` IN ('yes', 'no') AND `rr_edit` IN ('yes', 'no') AND `rr_delete` IN ('yes', 'no') AND `rr_view` IN ('yes', 'no')");
 
//fetch data
$result=$query->fetch_array();
 
?>

 <link rel="icon" sizes="192x192" href="img/touch-icon.png" /> 
  <link rel="apple-touch-icon" href="img/touch-icon-iphone.png" /> 
  <link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png" /> 
  <link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png" />
  
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.min.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

 <div class="container wells" style="margin-top: 3.8%; width: 98%; height:auto;  border-color: silver;">
      
     



  





<br>



<br>


<hr>
  <h5 style="text-align: center;">Current Status</h5>
  <hr>
  <br>
    <div class="row" >
     <div class="col-xs-3">
       <p style="color:#ccc;"><label><u><b>Add Information* </label></p></u></b>

      <input type="radio" name="select1" value="yes" <?php if($result['rr_create']=="yes"){ echo "checked";}?>/> Yes <br>
<input type="radio" name="select1" value="no" <?php if($result['rr_create']=="no"){ echo "checked";}?>/> No <br>

      
     </div>
     <div class="col-xs-3">
       <p style="color:#ccc;"><label><u><b>Delete Information* </label></p></u></b>
       <input type="radio" name="select2" value="yes" <?php if($result['rr_delete']=="yes"){ echo "checked";}?>/> Yes <br>
<input type="radio" name="select2" value="no" <?php if($result['rr_delete']=="no"){ echo "checked";}?>/> No <br>
       
     </div>
     <div class="col-xs-3">
      <p style="color:#ccc;"><label><u><b>View Information * </label></p></u></b>
      <div id="view"></div>
      <input  type="radio" name="select3" value="yes" <?php if($result['rr_view']=="yes"){ echo "checked";}?>/> Yes <br>
<input type="radio" name="select3" value="no" <?php if($result['rr_view']=="no"){ echo "checked";}?>/> No <br>
    </div>
    <div class="col-xs-3" id="edit">
      <p style="color:#ccc;"><label><u><b>Edit Information* </label></p></u></b>
      <input type="radio" name="select4" value="yes" <?php if($result['rr_edit']=="yes"){ echo "checked";}?>/> Yes <br>
<input type="radio" name="select4" value="no" <?php if($result['rr_edit']=="no"){ echo "checked";}?>/> No <br>
    </div>

    
    
    


    <style type="text/css">
      #bootstrapSelectForm .selectContainer .form-control-feedback {
        /* Adjust feedback icon position */
        right: -15px;
      }
    </style>


  </legend>
</fieldset>

<br>
<hr>
<div class="form-group col-md-6">
 <div class="input-group">
  <br>

</fieldset>

<div id="error" class="form-group col-md-12"> </div>
</div>
</div>

</form>
