<?php
  $name = $_GET['name'];
  $arrContextOptions=array(
    "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
      ),
    );  

  $response = file_get_contents('https://192.168.7.1:4444/webconsole/APIController?reqxml=%3CRequest%20APIVersion=%221702.1%22%3E%3CLogin%3E%3CUsername%3Esarojstha%3C/Username%3E%3CPassword%3E12345%3C/Password%3E%3C/Login%3E%3CGet%3E%3CIphost%3E%3C/Iphost%3E%3C/Get%3E%3C/Request%3E', false, stream_context_create($arrContextOptions));
  $items = simplexml_load_string($response);
  // echo $response;
  
  /* This returns the Status Code */
  /********************************
  $sxml = $items->xpath("//Status");
  echo $sxml[0]->attributes()->code;
  *********************************/
?>
<table cellpadding="2" border="1">
  <thead>
    <tr>
      <th>Name</th>
      <th>IP Family</th>
      <th>Host Type</th>
      <th>IP Address</th>
    </tr>
  </thead>

  <tbody>
  <?php 
    foreach ($items->children() as $node) 
    {
      if ((($node ->HostType) != 'System Host') || (strlen($node ->Name)!= 0))
      {
        if (strcmp($node->Name, $name) == 0)
        {
  ?>
      <tr>

        <td><?php echo ucwords($node->Name); ?></td>
        <td><?php echo $node->IPFamily; ?></td>
        <td><?php echo $node->HostType; ?></td>
        <td><?php echo $node->IPAddress; ?></td>
      </tr>
      <?php } } } ?>
  </tbody>
</table>