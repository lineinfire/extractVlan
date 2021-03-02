

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->


<style type="text/css">
table {  
    color: #333;
    font-family: Helvetica, Arial, sans-serif;
    width: 100%; 
    border-collapse: 
    collapse; border-spacing: 0; 
}

td, th {  
   
    height: 30px; 
    transition: all 0.3s;  /* Simple transition for hover effect */
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    text-align: center;
   
        background-color: #428bca;
        color: #fcfcfc;
}

td {  
    background: #FAFAFA;
    text-align: center;
     background-color: red;
}

/* Cells in even rows (2,4,6...) are one color */        
tr:nth-child(even) td { background: #F1F1F1; }   

/* Cells in odd rows (1,3,5...) are another (excludes header cells)  */        
tr:nth-child(odd) td { background: #FEFEFE; }  

tr td:hover { background: #666; color: #FFF; }  
/* Hover cell effect! */
</style>


<?php

//UPDATE `emp_info` SET `vlanid` = '20' WHERE `emp_info`.`Id` = 28;
//include ("control/modified.php");
//include ("control/PHPTelnet.php");
$servername = "localhost";
$username = "root";
$password = "";
$id = $_POST['id'];
$switchcode = $_POST['switchcode'];
$portid = $_POST['portid'];
//$newvlan = $_POST['newvlan'];






	//echo 'Update Successful';
include ("../control/modified.php");
//include ("control/PHPTelnet.php");

switch ($switchcode) {
    case '192.168.7.129':
    $server = '192.168.7.129';
    $user ='cisco';
    $pass = 'sanjana#123';
    $telnet = new PHPTelnet();
  $telnet->Connect($server, $user, $pass);
  $telnet->DoCommand("show mac address-table interface GigabitEthernet". $portid,$out);
	
$out = explode("\n",$out); 

unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[5]);

unset($out[8]);

$result = explode(" ",$out[6]); 
$res1 =  explode(" ",$out[7]); 


$mac1 = array_filter($res1, create_function('$value', 'return $value !== "";'));
$data1 = array_values($mac1);

$vlan1 = $data1[0];

$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
//$mac1 = $data1[1];
$port = $data[2];
//$port1 = $data1[2];
//$type2 = $data1[3];
$type = $data[3];
echo  '<table >';
echo '<thead>
      <tr>';
      echo '
        
        <th>Registered VLan Id</th>
        <th align="center">MAC Address</th>
        <th align="center">Port Id</th>
        <th align="center">MAC Registration Type</th>
       
    </tr>';






    echo '<tr>';
    echo '<td>'; echo $vlan; echo '</td>';
    echo '<td>'; echo $data[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);
  $p2 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

 
if (isset($data1[1]) && isset($data[1])) {






    echo '<tr>';
    echo '<td>'; echo $vlan1; echo '</td>';
    echo '<td>'; echo $data1[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

}

    } 

     else {
     	echo '<div class="alert alert-danger" role="alert">
  <strong>Khattam!</strong> No any active MAC Registration enteries found in the selected Switch.
</div>';
     }


	 



















break;

    case '192.168.7.229':
        	$server = '192.168.7.229';
    $user ='cisco';
    $pass = 'sanjana#123';
    $telnet = new PHPTelnet();
  $telnet->Connect($server, $user, $pass);
  $telnet->DoCommand("show mac address-table interface GigabitEthernet". $portid,$out);
	
$out = explode("\n",$out); 

unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[5]);

unset($out[8]);

$result = explode(" ",$out[6]); 
$res1 =  explode(" ",$out[7]); 


$mac1 = array_filter($res1, create_function('$value', 'return $value !== "";'));
$data1 = array_values($mac1);

$vlan1 = $data1[0];

$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
//$mac1 = $data1[1];
$port = $data[2];
//$port1 = $data1[2];
//$type2 = $data1[3];
$type = $data[3];
echo  '<table >';
echo '<thead>
      <tr>';
      echo '
        
        <th>Registered VLan Id</th>
        <th align="center">MAC Address</th>
        <th align="center">Port Id</th>
        <th align="center">MAC Registration Type</th>
       
    </tr>';






    echo '<tr>';
    echo '<td>'; echo $vlan; echo '</td>';
    echo '<td>'; echo $data[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);
  $p2 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

 
if (isset($data1[1]) && isset($data[1])) {






    echo '<tr>';
    echo '<td>'; echo $vlan1; echo '</td>';
    echo '<td>'; echo $data1[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

}

    } 

     else {
     	echo '<div class="alert alert-danger" role="alert">
  <strong>Khattam!</strong> No any active MAC Registration enteries found in the selected Switch.
</div>';
     }

		 


        break;
    case '192.168.7.230':
     $server = '192.168.7.230';
    $user ='cisco';
    $pass = 'sanjana#123';
    $telnet = new PHPTelnet();
  $telnet->Connect($server, $user, $pass);
  $telnet->DoCommand("show mac address-table interface FastEthernet ". $portid,$out);
	
$out = explode("\n",$out); 

unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);

unset($out[7]);
unset($out[8]);

$result = explode(" ",$out[5]); 
$res1 =  explode(" ",$out[6]); 


$mac1 = array_filter($res1, create_function('$value', 'return $value !== "";'));
$data1 = array_values($mac1);

$vlan1 = $data1[0];

$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
//$mac1 = $data1[1];
$port = $data[2];
//$port1 = $data1[2];
//$type2 = $data1[3];
$type = $data[3];
echo  '<table class="table table-bordered">';
echo '<thead>
      <tr>';
      echo '
        
        <th >Registered VLan Id</th>
        <th>MAC Address</th>
        <th>Port Id</th>
        <th>MAC Registration Type</th>
       
    </tr>';






    echo '<tr>';
    echo '<td>'; echo $vlan; echo '</td>';
    echo '<td>'; echo $data[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);
  $p2 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

 
if (isset($data1[1]) && isset($data[1])) {






    echo '<tr>';
    echo '<td>'; echo $vlan1; echo '</td>';
    echo '<td>'; echo $data1[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

}

   }  

     else {
    	echo '<div class="alert alert-danger" role="alert">
  <strong>Khattam!</strong> No any active MAC Registration enteries found in the selected Switch.
</div>';
     }





















	
		 
		 
    

        break;
    case '192.168.7.231':
    	$server = '192.168.7.231';
   		    $user ='cisco';
    $pass = 'sanjana#123';
    $telnet = new PHPTelnet();
  $telnet->Connect($server, $user, $pass);
  $telnet->DoCommand("show mac address-table interface GigabitEthernet". $portid,$out);
	
$out = explode("\n",$out); 

unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[5]);

unset($out[8]);

$result = explode(" ",$out[6]); 
$res1 =  explode(" ",$out[7]); 


$mac1 = array_filter($res1, create_function('$value', 'return $value !== "";'));
$data1 = array_values($mac1);

$vlan1 = $data1[0];

$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
//$mac1 = $data1[1];
$port = $data[2];
//$port1 = $data1[2];
//$type2 = $data1[3];
$type = $data[3];
echo  '<table >';
echo '<thead>
      <tr>';
      echo '
        
        <th>Registered VLan Id</th>
        <th align="center">MAC Address</th>
        <th align="center">Port Id</th>
        <th align="center">MAC Registration Type</th>
       
    </tr>';






    echo '<tr>';
    echo '<td>'; echo $vlan; echo '</td>';
    echo '<td>'; echo $data[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);
  $p2 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

 
if (isset($data1[1]) && isset($data[1])) {






    echo '<tr>';
    echo '<td>'; echo $vlan1; echo '</td>';
    echo '<td>'; echo $data1[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

}

    } 

     else {
     	echo '<div class="alert alert-danger" role="alert">
  <strong>Khattam!</strong> No any active MAC Registration enteries found in the selected Switch.
</div>';
     }














		break;
		  case '192.168.7.232':
    	$server = '192.168.7.232';
        $user ='cisco';
    $pass = 'sanjana#123';
    $telnet = new PHPTelnet();
  $telnet->Connect($server, $user, $pass);
  $telnet->DoCommand("show mac address-table interface GigabitEthernet". $portid,$out);
	
$out = explode("\n",$out); 

unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[5]);

unset($out[8]);

$result = explode(" ",$out[6]); 
$res1 =  explode(" ",$out[7]); 


$mac1 = array_filter($res1, create_function('$value', 'return $value !== "";'));
$data1 = array_values($mac1);

$vlan1 = $data1[0];

$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
//$mac1 = $data1[1];
$port = $data[2];
//$port1 = $data1[2];
//$type2 = $data1[3];
$type = $data[3];
echo  '<table >';
echo '<thead>
      <tr>';
      echo '
        
        <th>Registered VLan Id</th>
        <th align="center">MAC Address</th>
        <th align="center">Port Id</th>
        <th align="center">MAC Registration Type</th>
       
    </tr>';






    echo '<tr>';
    echo '<td>'; echo $vlan; echo '</td>';
    echo '<td>'; echo $data[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);
  $p2 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

 
if (isset($data1[1]) && isset($data[1])) {






    echo '<tr>';
    echo '<td>'; echo $vlan1; echo '</td>';
    echo '<td>'; echo $data1[1]; echo '</td>';
  $pattern = '/gi/';
  $p1 = preg_replace($pattern,"GigabitEthernet ",$port);





    echo '<td>'; echo $p1; echo '</td>';
    echo '<td>'; echo $type; echo '</td>';
    echo '</tr>';

}

    } 

     else {
     	echo '<div class="alert alert-danger" role="alert">
  <strong>Khattam!</strong> No any active MAC Registration enteries found in the selected Switch.
</div>';
     }


    default:
        
}

 	

?>