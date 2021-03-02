<?php
    
    function recurseDir($dir) {
        if(is_dir($dir)) {
            if($dh = opendir($dir)){
                while($file = readdir($dh)){
                    if($file != '.' && $file != '..'){
                        if(is_dir($dir . $file)){
                            // echo $dir . $file."<br>";
                            // since it is a directory we recurse it.
                            recurseDir($dir . $file . '/');
                        }else{
                            echo $dir . $file."\t";   
                            echo date ("F d Y H:i:s.", filectime($dir . $file))."<br>";

                        }
                    }
                }
            }
            closedir($dh);         
            }
    }

    echo recurseDir("D:/ANTS_BACKUP/backup/org/");
?>