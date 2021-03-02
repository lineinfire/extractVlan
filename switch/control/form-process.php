<?php

$errorMSG = "";


require ('modified.php');
$switchid = $_POST['switchid'];
 $vlanid = $_POST['vlanid'];
  $ipaddress = $_POST['ipaddress'];
   $subnet = $_POST['subnet'];
   

if ($switch = $_POST['switchid']) {
  $success ="Vlan Creation Successful!!!";
$vlanid = $_POST['vlanid'];
$ipaddress = $_POST['ipaddress'];
$subnet = $_POST['subnet'];

 $host = $switch;
  $user = "cisco";
  $pass = "sanjana#123";

  $telnet = new PHPTelnet();

 $telnet->Connect($host, $user, $pass);

  if ($switch == '192.168.7.129' || $switch =='192.168.7.222') {

 $telnet->DoCommand("configure terminal", $out);

  $telnet->DoCommand("vlan ".$vlanid, $out); 

   $telnet->DoCommand("exit", $out); 
  

  echo $success;


}
 else {
 
   $telnet->enable('ATI#123');
   $telnet->DoCommand("configure terminal", $out);

$telnet->DoCommand("vlan ".$vlanid, $out);
   $telnet->DoCommand("int vlan ".$vlanid, $out); 
  
   $telnet->DoCommand("ip address ".$ipaddress.' '.$subnet, $out); 
 
   $telnet->DoCommand("exit", $out); 
   

        
    echo $success;    
    


   sleep(1);

  
    $telnet->Disconnect(); 
  }
}
 

        
    
  












































else 
{

echo "Plese select the correct Ip";

}
?>

</div>
