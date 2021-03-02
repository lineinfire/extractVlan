

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

/*

  function telnetSwitch230($mac, $server, $username, $password, $telnet)
  {
    $str1 = "gi1";
    $str2 = "gi2";
    $str3 = "gi3";
    $str4 = "gi4"; 

    $servername = $server;
    $username = $username;
    $password = $password;
    $macid = $mac;

    // echo $servername, $username, $password;
    // echo $macid."<BR>";
    // $telnet = new PHPTelnet();
    
    $telnet->DoCommand("telnet ".$servername,$out);
    $telnet->DoCommand($username,$out);
    $telnet->DoCommand($password,$out);
    $telnet->DoCommand("show mac address-table address ". $macid,$out);
    // $telnet->DoCommand("show ip interface vlan7",$out);

    $out = explode("\n",$out);
    
    echo "Going to ".$servername."<br>";
    //print_r($out);
    // exit;

    unset($out[0]);
    unset($out[1]);
    unset($out[2]);
    unset($out[3]);
    unset($out[4]);
    unset($out[7]);
    unset($out[8]);

    if (isset($out[5]))
    {
      $result = explode(" ",$out[5]);

      $mac = array_filter($result, create_function('$value', 'return $value !== "";'));
      $data = array_values($mac);

      $vlan = $data[0];

      if((!empty($vlan)) || (!empty($data[1])) || (!empty($data[2]))) 
      {
        
        if (!isset($data[1]))
          $macaddr = null;
        else
          $macaddr = $data[1]; 

        if (!isset($data[2]))
          $port = null;
        else     
          $port = $data[2];

        if (preg_match("/\b".$str1."\b/i", $port) 
          || preg_match("/\b".$str2."\b/i", $port) 
          || preg_match("/\b".$str3."\b/i", $port) 
          || preg_match("/\b".$str4."\b/i", $port)) 
        {
          return false;
          exit;
        }
        else 
        {
          return true;
          exit;
        }
      }
    }
    return false;
  }

*/

  function array_find($needle, array $haystack)
  {
    foreach ($haystack as $key => $value) {
        if (false !== stripos($value, $needle)) {
            return $key;
        }
    }
    return false;
  }
  
  function telnetSwitch($mac, $server, $username, $password, $telnet, $str1, $str2, $str3, $str4)
  {

    $servername = $server;
    $username = $username;
    $password = $password;
    $macid = $mac;


    // echo $servername, $username, $password;
    // echo $macid."<BR>";
    // $telnet = new PHPTelnet();
    
    $telnet->DoCommand("telnet ".$servername,$out);
    $telnet->DoCommand($username,$out);
    $telnet->DoCommand($password,$out);
    $telnet->DoCommand("show mac address-table address ". $macid,$out);
    // $telnet->DoCommand("show ip interface vlan7",$out);

    // $owned_urls = array('website1.com', 'website2.com', 'website3.com');
    
    // exit;
    preg_match_all("/\b[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}\b/su", $out, $matches);
    $foundMac = (string)$matches[0][0];

    $out = explode("\n",$out);


    // $patch = strstr($out, '----------');
    // $final = str_replace("-","",$patch);
    // $out =  explode(" ", $final);
    // $keys = array_filter($out);
    // $array = array_values($keys);
    // $al = array_pop($array);
    // $fin = array_shift($array);

    echo "<br>Going to ".$servername."<br>";
    // print_r($out);
    // exit;

    // echo "<br>'".$out[5]."'<br>";

    // unset($out[0]);
    // unset($out[1]);
    // unset($out[2]);
    // unset($out[3]);
    // unset($out[4]);
    // unset($out[7]);
    // unset($out[8]);

    // echo $out[6]."Something";

    $key = array_find('dynamic', $out);

    // echo "<br>*************************<br>";
    // echo $key;
    // echo "<br>*************************<br>";

    if (isset($out[$key]))
    {
      $result = explode(" ",$out[$key]);

      $mac = array_filter($result, create_function('$value', 'return $value !== "";'));
      $data = array_values($mac);

      $vlan = $data[0];

      if((!empty($vlan)) || (!empty($data[1])) || (!empty($data[2]))) 
      {
        // echo "Flag not empty<br>";
        if (!isset($data[1]))
          $macaddr = null;
        else
          $macaddr = $data[1]; 

        if (!isset($data[2]))
          $port = null;
        else     
          $port = $data[2];

        // echo "<br>";
        // echo $port." Provided Port<br>";
        // echo $str2." Fixed GI Port<br>";

        
        if (preg_match("/\b".$str1."\b/i", $port)
          || preg_match("/\b".$str2."\b/i", $port)
          || preg_match("/\b".$str3."\b/i", $port)
          || preg_match("/\b".$str4."\b/i", $port))
        {
          return false;
          exit;
        }
        else 
        {
          echo "MAC <strong>$macid</strong> is found on <strong>$port</strong> in <strong>$servername</strong>";
          return true;
          exit;
        }   
      }
    }
    return false;
  }

  function macFound($mac, $server, $username, $password,$telnet, $str1, $str2, $str3, $str4)
  {
    $servername = $server;
    $username = $username;
    $password = $password;
    $macid = $mac;
    // echo $macid;

    // $telnet = new PHPTelnet();
    $telnet->Connect($servername, $username, $password);
    $telnet->DoCommand("show mac address-table address ". $macid,$out);

    preg_match_all("/\b[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}:[[:xdigit:]]{2}\b/su", $out, $matches);
    $foundMac = (string)$matches[0][0];
    // echo $foundMac."--";
    // exit;
    // print_r($matches);
    // echo "Here";
    // exit;

    $out = explode("\n",$out);

    // print_r($out);
    echo "<br>Going to ".$servername."<br>";
    
    // exit;

    // unset($out[0]);
    // unset($out[1]);
    // unset($out[2]);
    // unset($out[3]);
    // unset($out[4]);
    // unset($out[7]);
    // unset($out[8]);

    $key = array_find('dynamic', $out);
    // echo "<br>*************************<br>";
    // echo $key;
    // echo "<br>*************************<br>";
    if (isset($out[$key]))
    {
      // echo "out is set";
      $result = explode(" ",$out[$key]);

      $mac = array_filter($result, create_function('$value', 'return $value !== "";'));
      $data = array_values($mac);

      $vlan = $data[0];

      if((!empty($vlan)) || (!empty($data[1])) || (!empty($data[2]))) 
      {
        // echo "nothing is empty";
        if (!isset($data[1]))
          $macaddr = null;
        else
          $macaddr = $data[1]; 

        if (!isset($data[2]))
          $port = null;
        else     
          $port = $data[2];

        // echo "==".$port."====";
        if ($port != null)
        {
          // echo "Flag";
          if (preg_match("/\b".$str1."\b/i", $port) 
          || preg_match("/\b".$str2."\b/i", $port) 
          || preg_match("/\b".$str3."\b/i", $port) 
          || preg_match("/\b".$str4."\b/i", $port)) 
          {
            // echo "Found here";
            echo "<br>Next switch pls<br>";

            if (telnetSwitch($macid, '192.168.7.231', 'cisco', 'sanjana#123', $telnet, 'gi25','gi26','gi27','gi28'))
            {
              // echo "Found MAC in 231";
              return true;
              exit;
            } 
            else
            if (telnetSwitch($macid, '192.168.7.229', 'cisco', 'sanjana#123', $telnet, 'gi25','gi26','gi27','gi28'))
            {
              // echo "Found MAC in 229";
              return true;
              exit;
            }
            else
            if (telnetSwitch($macid, '192.168.7.230', 'cisco', 'sanjana#123', $telnet, 'gi1','gi2','gi3','gi4'))
            {
              // echo "Found MAC in 230";
              return true;
              exit;
            }
            else 
            if (telnetSwitch($macid, '192.168.7.232', 'cisco', 'sanjana#123', $telnet, 'gi25','gi26','gi27','gi28'))
            {
              // echo "Found MAC in 232";
              return true;
              exit;
            }
            
            else
              return false;
          }
          else
          {
            // echo "Found MAC in 129";
            echo "MAC <strong>$macid</strong> is found on <strong>$port</strong> in <strong>$servername</strong>";
            return true;
            exit;          
          }  
        }
        else
          // echo "MAC not found anywhere!";                  
          return false;
      }
    }        
    return false;
  }
?>

<?php
  include ("../control/publicclass.php");
  $telnet = new PHPTelnet();

  $macid = $_POST['macid'];
  
  if (macFound($macid, '202.166.220.218', 'cisco', 'sanjana#123', $telnet,'gi25','gi26','gi27','gi28'))
  {
    // echo "<br>MAC found!!!"; // in 192.168.7.129";
    exit;
  }
  else
  {
    echo "<h3>The MAC was not found!</h3>";
  }
?>