<?php
  $vlanid = 23;  
  $isAvailable = true;
  
  $out = '
---- -------------------------------- --------- -------------------------------
1    default                          active
5    VLAN0005                         active
9    VLAN0009                         active
10   VLAN0010                         active
11   VLAN0011                         active
13   VLAN0013                         active
15   VLAN0015                         active
25   VLAN0025                         active

---- ----- ---------- ----- ------ ------ -------- ---- -------- ------ ------

Primary Secondary Type              Ports
------- --------- ----------------- ------------------------------------------';

  $out = trim($out);
  $array = explode(' ', $out);
  $only_vlan = array();
  
  foreach ($array as $key => $value) {
      if (strpos($value, 'VLAN') !== false) 
      {
        $only_vlan[$key] = $value;
      }
  }
  array_unshift($only_vlan, "VLAN0001");
  
  foreach($only_vlan as $key => $value)
  {
    $newValue = (int)substr($value, 4);
    echo trim($newValue)."<br>";
  }
?>
