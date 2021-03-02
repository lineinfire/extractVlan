<?php
include ("../control/modified.php");
 $server = '192.168.7.1';
    $user ='admin';
    $pass = 'bghimire';
    $telnet = new PHPTelnet();
  $telnet->Connect('192.168.7.1', 'admin', 'bghimire');
  $telnet->DoCommand("admin",$out);
   $telnet->DoCommand("bghimire",$out);
   print_r($out);

?>