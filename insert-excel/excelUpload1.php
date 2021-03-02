
<?php
require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');

$dbHost = "localhost";
$dbDatabase = "slrec";
$dbPasswrod = "";
$dbUser = "root";
$mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
print_r($_FILES);
if(isset($_POST['Submit']))
{
    $mimes = array('application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if(in_array($_FILES["file"]["type"],$mimes))
    {
        $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);

		move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
        $Reader = new SpreadsheetReader($uploadFilePath);

		$totalSheet = count($Reader->sheets());
        echo "You have total ".$totalSheet." sheets".

		$html="<table border='1'>";
        $html.="<tr><th>Title</th><th>Description</th></tr>";

		/* For Loop for all sheets */
        $count = 0;
        for($i=0;$i<$totalSheet;$i++)
        {
            $Reader->ChangeSheet($i);
            foreach ($Reader as $Row)
            {
                $html.="<tr>";
                $Id = isset($Row[0]) ? $Row[0] : '';
                $ApplicantName = isset($Row[1]) ? $Row[1] : '';
                $District = isset($Row[2]) ? $Row[2] : '';
                $Area = isset($Row[3]) ? $Row[3] : '';
                $LoadCenter = isset($Row[4]) ? $Row[4] : '';
                $RuralMunicipality = isset($Row[5]) ? $Row[5] : '';
                $ConnectionType = isset($Row[6]) ? $Row[6] : '';
                $RequestedAmp = isset($Row[7]) ? $Row[7] : '';
                $ConnectionLocationType = isset($Row[8]) ? $Row[8] : '';
                $ThreePhase = isset($Row[9]) ? $Row[9] : '';
                $PreCustomerNo = isset($Row[10]) ? $Row[10] : '';
                $AcceptedAmp = isset($Row[11]) ? $Row[11] : '';
                $ConnectedAmp = isset($Row[12]) ? $Row[12] : '';
                $VerifiedBy = isset($Row[13]) ? $Row[13] : '';
                $MeterConnectedby = isset($Row[14]) ? $Row[14] : '';
                $LagatNo = isset($Row[15]) ? $Row[15] : '';
                $WardNo = isset($Row[16]) ? $Row[16] : '';
                $MeterNo = isset($Row[17]) ? $Row[17] : '';
                $StartNo = isset($Row[18]) ? $Row[18] : '';
                $DateNep = isset($Row[19]) ? $Row[19] : '';

                $html.="<td>".$Id."</td>";
                $html.="<td>".$ApplicantName."</td>";
                $html.="<td>".$District."</td>";
                $html.="<td>".$Area."</td>";
                $html.="<td>".$LoadCenter."</td>";
                $html.="<td>".$RuralMunicipality."</td>";
                $html.="<td>".$ConnectionType."</td>";
                $html.="<td>".$RequestedAmp."</td>";
                $html.="<td>".$ConnectionLocationType."</td>";
                $html.="<td>".$ThreePhase."</td>";
                $html.="<td>".$PreCustomerNo."</td>";
                $html.="<td>".$AcceptedAmp."</td>";
                $html.="<td>".$ConnectedAmp."</td>";
                $html.="<td>".$VerifiedBy."</td>";
                $html.="<td>".$MeterConnectedby."</td>";
                $html.="<td>".$LagatNo."</td>";
                $html.="<td>".$WardNo."</td>";
                $html.="<td>".$MeterNo."</td>";
                $html.="<td>".$StartNo."</td>";
                $html.="<td>".$DateNep."</td>";

                $html.="</tr>";

				$query = "insert into items(Id, ApplicantName, District,    Area,    LoadCenter,  RuralMunicipality,   ConnectionType,  RequestedAmp,    ConnectionLocationType,  ThreePhase,  PreCustomerNo,   AcceptedAmp, ConnectedAmp,    VerifiedBy,  MeterConnectedby,    LagatNo, WardNo,  MeterNo, StartNo, DateNep) values('".$Id."','".$ApplicantName."','".$District."','".$Area."','".$LoadCenter."','".$RuralMunicipality."','".$ConnectionType."','".$RequestedAmp."','".$ConnectionLocationType."','".$ThreePhase."','".$PreCustomerNo."','".$AcceptedAmp."','".$ConnectedAmp."','".$VerifiedBy."','".$MeterConnectedby."','".$LagatNo."','".$WardNo."','".$MeterNo."','".$StartNo."','".$DateNep."')";
                $mysqli->query($query);
                $count++;
            }
            
        }
        $html.="</table>";

            $filename = $_FILES['file']['name'];
            $records  = $count;

            $logQuery = "insert into log(filename,records) values ('$filename','$records')";
            // echo $logQuery;
            // exit;

            $res = $mysqli->query($logQuery);

            if (!$mysqli->error) {
               printf("Errormessage: %s\n", $mysqli->error);
            }


            echo "<br />$records Data Inserted in dababase";
        }
        else
        {
            die("<br/>Sorry, File type is not allowed. Only Excel file.");
        }
}
?>