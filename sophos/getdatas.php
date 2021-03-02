<?php
  include_once("sophos_credentials.php");

  $arrContextOptions=array(
    "ssl"=>array(
      "verify_peer"=>false,
      "verify_peer_name"=>false,
    ),
  );  

  $opt = 'https://192.168.7.1:4444/webconsole/APIController?reqxml=<Request%20APIVersion="1702.1"><Login><Username>'.USERNAME.'</Username><Password>'.PASSWORD.'</Password></Login><Get><Iphost></Iphost></Get></Request>';
  $response = file_get_contents($opt, false, stream_context_create($arrContextOptions));

  $xml = new SimpleXMLElement($response);
  foreach ($xml->IPHost as $book) 
  {
    if (empty($book->IPAddress)) {
    
    }
    else 
    {
      $name = $book->Name;    
      $ipfamily = $book->IPFamily;    
      $hosttype = $book->HostType;    
      $ipaddress =  $book->IPAddress;

      //$bis = preg_replace('/NULL/', "0", $ipaddress);
      $trigger = '<form action="editIPHost.php" method="POST"><div class="modal fade" id="'.str_replace(' ', '_', $book->Name).'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Edit Host</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-sm-6"><div class="form-group"><label for="recipient-name" class="col-form-label">Emp Name:</label><input type="text" class="form-control" id="name" name="name" value="'.$book->Name.'" readonly></div></div><div class="col-sm-6"><div class="form-group"><label for="recipient-name" class="col-form-label">IP Address:</label><input type="text" class="form-control" id="ipaddress" name="ipaddress" value="'.$book->IPAddress.'"  required pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$"></div></div></div></div><div class="modal-footer"><button type="submit" class="btn btn-primary">Submit Query</button><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div></div></div></div></form>';
      $trigger .= '<button type="button" class="bghimire btn btn-primary" data-toggle="modal" data-target="#'.str_replace(' ', '_', $book->Name).'" data-whatever="@getbootstrap" id="modal">Edit &raquo;';
      $act = '<a href="#'.$book->Name.'" class="bghimire" id="custId" data-toggle="modal" data-formid="'.$book->Name.'">Edit</a>';

      $data[] = array("name"=>$name, "ipfamily"=>$ipfamily,"hosttype"=>$hosttype, "ipaddress"=>$ipaddress, "action"=>$trigger);
    }
  }
  echo json_encode($data);
?>