
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
        $html.="<tr><th>Id</th><th>ApplicantName</th><th>PreCustomerNo</th><th>FiscalYear</th><th>LastPaid</th><th>CurrentUnit</th><th>AdvanceAmt</th><th>DueAmt</th><th>MeterStatus</th></tr>";

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
                $PreCustomerNo = isset($Row[2]) ? $Row[2] : '';
                $FiscalYear = isset($Row[3]) ? $Row[3] : '';
                $LastPaid = isset($Row[4]) ? $Row[4] : '';
                $CurrentUnit = isset($Row[5]) ? $Row[5] : '';
                $AdvanceAmt = isset($Row[6]) ? $Row[6] : '';
                $DueAmt = isset($Row[7]) ? $Row[7] : '';
                $MeterStatus = isset($Row[8]) ? $Row[8] : '';

                $html.="<td>".$Id."</td>";
                $html.="<td>".$ApplicantName."</td>";
                $html.="<td>".$PreCustomerNo."</td>";
                $html.="<td>".$FiscalYear."</td>";
                $html.="<td>".$LastPaid."</td>";
                $html.="<td>".$CurrentUnit."</td>";
                $html.="<td>".$AdvanceAmt."</td>";
                $html.="<td>".$DueAmt."</td>";
                $html.="<td>".$MeterStatus."</td>";

                $html.="</tr>";

				$query = "insert into billing(Id,  ApplicantName,   PreCustomerNo,   FiscalYear,  LastPaid,    CurrentUnit, AdvanceAmt,  DueAmt,  MeterStatus) values('".$Id."','".$ApplicantName."','".$PreCustomerNo."','".$FiscalYear."','".$LastPaid."','".$CurrentUnit."','".$AdvanceAmt."','".$DueAmt."','".$MeterStatus."')";
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