<?php
    require('library/php-excel-reader/excel_reader2.php');
    require('library/SpreadsheetReader.php');

    ini_set('max_execution_time', -1);
    $dbHost = "localhost";
    $dbDatabase = "prabhupay";
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
            $html.="<tr><th>S.No.</th><th>Date</th><th>Customer ID</th><th>Name</th><th>Cell Phone</th><th>Email</th><thDevice Type</th><th>Account Status</th></tr>";

    		/* For Loop for all sheets */
            $count = 0;

            for($i=0;$i<$totalSheet;$i++)
            {
                $Reader->ChangeSheet($i);
                foreach ($Reader as $Row)
                {
                    $html.="<tr>";
                    $Id = isset($Row[0]) ? $Row[0] : '';
                    $date = isset($Row[1]) ? $Row[1] : '';
                    $date = date("Y-m-d H:i:s", strtotime($date));
                    $cusId = isset($Row[2]) ? $Row[2] : '';
                    $name = isset($Row[3]) ? $Row[3] : '';
                    $cell = isset($Row[4]) ? $Row[4] : '';
                    $email = isset($Row[5]) ? $Row[5] : '';
                    $address = isset($Row[6]) ? $Row[6] : '';
                    $device = isset($Row[7]) ? $Row[7] : '';
                    $status = isset($Row[8]) ? $Row[8] : '';

                    $html.="<td>".$Id."</td>";
                    $html.="<td>".$date."</td>";
                    $html.="<td>".$cusId."</td>";
                    $html.="<td>".$name."</td>";
                    $html.="<td>".$cell."</td>";
                    $html.="<td>".$email."</td>";
                    $html.="<td>".$device."</td>";
                    $html.="<td>".$status."</td>";

                    $html.="</tr>";

                    $query = "insert into customer(sno,  date,   cus_id,   name,  cell,    email, os,  status) values('".$Id."','".$date."','".$cusId."','".$name."','".$cell."','".$email."','".$device."','".$status."')";
                    $mysqli->query($query);
                    echo $count." records inserted successfully.<br>";
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