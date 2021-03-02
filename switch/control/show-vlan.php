
<style type="text/css">
    #error {
    text-align:center;
    width: 600px;
    height: 350px;
  
   
    /*margin-right: auto;
    margin-left: auto;
    */
    
}
</style>

<?PHP


require ('news.php');
$switch = $_POST['switchid'];
 


 $hostname = $switch;
  $password = "ATI#123";
  $username = "admin";



$t = new TELNET();
 
("CONNECT:".$t->Connect($hostname, $username, $password)."<br>");
("LOGIN:".(int)$t->LogIn());
 ("<br>OUTPUT:<br>");

  if ($switch == '192.168.7.129' || $switch =='192.168.7.222') {



  $array = $t->GetOutputOf("show vlan");

    print  '<pre>';
  

   



  

foreach ($array as $key => $value) 
{
  print $value;
}



echo '<style type="text/css">';
  
echo 'pre {
   font-family: "courier new", courier, monospace;
   font-size: 18px;
   text-align:justify;
   color:#3b4652;
   overflow:scroll;
  
}

</style>';

echo '</style>';

  







}
 else {


$telnet = new PHPTelnet();


    
    $telnet->Connect($hostname, $username, $password);
$telnet->enable('ATI#123');
$telnet->DoCommand("show vlan", $out);

print  '<pre>';
  

   echo '<style type="text/css">';
  
echo 'pre {
   font-family: "courier new", courier, monospace;
   font-size: 18px;
   text-align:justify;
   color:#3b4652;
   overflow:scroll;
  
}

</style>';

echo '</style>';

  

print $out;


print  '</pre></div>';
}






  

  
    
  
 

        
    

?>