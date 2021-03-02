

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
    transition: all 1s;  /* Simple transition for hover effect */
}

th {  
    background: #DFDFDF;  /* Darken header a bit */
    font-weight: bold;
    text-align: center;
   
        background-color: #428bca;
        color: #fcfcfc;
}
.blink_me {
    -webkit-animation-name: blinker;
    -webkit-animation-duration: 6s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
    
    -moz-animation-name: blinker;
    -moz-animation-duration: 6s;
    -moz-animation-timing-function: linear;
    -moz-animation-iteration-count: infinite;
    
    animation-name: blinker;
    animation-duration: 16s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    font-size: 15px;
}

@-moz-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {  
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
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
$servername = "localhost";
$username = "root";
$password = "";
$id = $_POST['id'];
//$switchcode = $_POST['switchcode'];
$macid = $_POST['macid'];
include ("../control/publicclass.php");

// switch 129
    $server = '202.166.220.218';
    $user ='cisco';
    $pass = 'sanjana#123';
    $telnet = new PHPTelnet();
  $telnet->Connect($server, $user, $pass);
  $telnet->DoCommand("show mac address-table address ". $macid,$out);
  $out = explode("\n",$out); 


unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[7]);
unset($out[8]);
$result = explode(" ",$out[6]); 
$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];
if(isset($data[1])) {
$macaddr = $data[1];
$port = $data[2];
$pattern = '/^gi1/';
$pattern1 = '/^gi2/';
$pattern2 = '/^gi3/';
$pattern3 = '/^gi4/';
if (preg_match("/\bgi25\b/i", $port) || preg_match("/\bgi26\b/i", $port) || preg_match("/\bgi27\b/i", $port) || preg_match("/\bgi28\b/i", $port)) {

$host = '192.168.7.230';

$telnet->DoCommand("telnet ". $host,$out);
$telnet->DoCommand("cisco",$out);
$telnet->DoCommand("sanjana#123",$out);
$telnet->DoCommand("show mac address-table address ". $macid,$out);

$out = explode("\n",$out); 


unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[7]);
unset($out[8]);
$result = explode(" ",$out[5]); 
$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);

$vlan = $data[0];
if(isset($data[1])) {
$macaddr = $data[1];
$port = $data[2];
$pattern = '/^gi1/';
$pattern1 = '/^gi2/';
$pattern2 = '/^gi3/';
$pattern3 = '/^gi4/';
if (preg_match("/\bgi1\b/i", $port) || preg_match("/\bgi2\b/i", $port) || preg_match("/\bgi3\b/i", $port) || preg_match("/\bgi4\b/i", $port)) {



$host = '192.168.7.232';

$telnet->DoCommand("telnet ". $host,$out);
$telnet->DoCommand("cisco",$out);
$telnet->DoCommand("sanjana#123",$out);
$telnet->DoCommand("show mac address-table address ". $macid,$out);
$out = explode("\n",$out); 


unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[7]);
unset($out[8]);
$result = explode(" ",$out[6]); 
$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
$port = $data[2];
$pattern = '/^gi1/';
$pattern1 = '/^gi2/';
$pattern2 = '/^gi3/';
$pattern3 = '/^gi4/';
if (preg_match("/\bgi25\b/i", $port) || preg_match("/\bgi26\b/i", $port) || preg_match("/\bgi27\b/i", $port) || preg_match("/\bgi28\b/i", $port)) {



$host = '192.168.7.232';

$telnet->DoCommand("telnet ". $host,$out);
$telnet->DoCommand("cisco",$out);
$telnet->DoCommand("sanjana#123",$out);
$telnet->DoCommand("show mac address-table address ". $macid,$out);
$out = explode("\n",$out); 


unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[7]);
unset($out[8]);
$result = explode(" ",$out[6]); 
$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
$port = $data[2];
$pattern = '/^gi1/';
$pattern1 = '/^gi2/';
$pattern2 = '/^gi3/';
$pattern3 = '/^gi4/';
if (preg_match("/\bgi25\b/i", $port) || preg_match("/\bgi26\b/i", $port) || preg_match("/\bgi27\b/i", $port) || preg_match("/\bgi28\b/i", $port)) {


$host = '192.168.7.229';

$telnet->DoCommand("telnet ". $host,$out);
$telnet->DoCommand("cisco",$out);
$telnet->DoCommand("sanjana#123",$out);
$telnet->DoCommand("show mac address-table address ". $macid,$out);
$out = explode("\n",$out); 
unset($out[0]);
unset($out[1]);
unset($out[2]);
unset($out[3]);
unset($out[4]);
unset($out[7]);
unset($out[8]);
$result = explode(" ",$out[6]); 
$mac = array_filter($result, create_function('$value', 'return $value !== "";'));
$data = array_values($mac);
$vlan = $data[0];

if(isset($data[1])) {
$macaddr = $data[1];
$port = $data[2];
$pattern = '/^gi1/';
$pattern1 = '/^gi2/';
$pattern2 = '/^gi3/';
$pattern3 = '/^gi4/';


echo $macaddr;
}
}
}
}
else {

  echo 'This may be for 221';

}


}


else {
echo 'T';
}
}
else {

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
    $port = $data[2];
    $pattr = '/^fa/';
      $p1 = preg_replace($pattr,"FasttEthernet ",$port);
 echo '<td>'; echo $p1; echo '</td>';
  $pattr1 = '/^dynamic/';
      $p2 = preg_replace($pattr1,"Dynamic ",$data[3]);
 echo '<td>'; echo $p2; echo '</td>';

}

}

else {
 echo 'Thai';

}
 }
else {

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
    $port = $data[2];
    $pattr = '/^gi/';
      $p1 = preg_replace($pattr,"GigabitEthernet ",$port);
 echo '<td>'; echo $p1; echo '</td>';
  $pattr1 = '/^dynamic/';
      $p2 = preg_replace($pattr1,"Dynamic ",$data[3]);
 echo '<td>'; echo $p2; echo '</td>';
}

}




























 	

?>