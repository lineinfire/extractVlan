<?php
        $file = fopen("test.txt", "r");
        $i = 0;
        $line_of_text = '';
        while (!feof($file)) {
            $line_of_text .= fgets($file);
        }
        $members = explode("\n", $line_of_text);
        fclose($file);

        foreach ($members as $value) {
        	# code...
        	$text  = trim("CONN ".trim($value)."/".trim($value)."@ptcbs\n@D:/PT_VOUCHER_DELETE_APPROVAL_PKG.sql\n");
			echo "<pre>".$text."</pre>";
			
        }
        // print_r($members);
    ?>