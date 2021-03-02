<?php
$connect= new mysqli("localhost","root","","demo") or die("ERROR:could not connect to the database!!!");
 
//select users data
$query=$connect->query("select * from update_radio_button_value");
 
//fetch data
$result=$query->fetch_array();
 
?>
 
<style>
 
input{width:250px}
 
input[type=submit]{width:120px; height:25px}
 
table{padding:5px}
 
</style>
 
<form method="post" action="update.php">
 
<table style="background:#F8F8F8" border="0" align="center">  
  
  <tr>
 
    <td height="35">Name</td>
 
    <td><input type="text" name="n" value="<?php echo $result['name'];?>" /></td>
 
  </tr>
  
  <tr>
 
    <td width="58" height="40">Email</td>
 
    <td width="256"><input readonly="readonly" type="email" name="eid" value="<?php echo $result['email'];?>" /></td>
 
  </tr>
 
  <tr>
 
    <td height="42">Mobile</td>
 
    <td><input type="number" name="mob" value="<?php echo $result['mobile'];?>" /></td>
 
  </tr>
 
  <tr>
 
    <td height="70">Gender</td>
 
    <td>
 
   Male
     <input type="radio" name="gen" value="m" <?php if($result['gender']=="m"){ echo "checked";}?>/>
 
     <BR/>
 
   Female
     <input type="radio" name="gen" value="f" <?php if($result['gender']=="f"){ echo "checked";}?>/>
 
      </td>
 
  </tr>
 
    <tr>
 
    <td colspan="2" align="center">
 
 <input type="submit" value="Update My Profile" name="update"/>
 
 </td>
 
  </tr>
  
</table>
 
</form>