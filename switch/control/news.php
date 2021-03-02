
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>





<?php
	class TELNET
	{
		
	  private $host;
	  private $name;
	  private $pass;
	  private $port;
	  private $connected;
	  private $connect_timeout;
	  private $stream_timetout;

	  private $socket;

	  public function TELNET()
	  {
	    $this->port = 23;
	    $this->connected = false;         // connected?
	    $this->connect_timeout = 20;      // timeout while asking for connection
	    $this->stream_timeout = 38000;   // timeout between I/O operations
	  }

	  public function __destruct()
	  {
	    if($this->connected) { fclose($this->socket); }
	  }

	  // Connects to host
	  // @$_host - addres (or hostname) of host
	  // @$_user - name of user to log in as
	  // $@_pass - password of user
	  //
	  // Return: TRUE on success, other way function will return error string got by fsockopen()
	  public function Connect($_host, $_user, $_pass)
	  {
	    // If connected successfully
	    if( ($this->socket = @fsockopen($_host, $this->port, $errno, $errorstr, $this->connect_timeout)) !== FALSE )
	    {
	      $this->host = $_host;
	      $this->user = $_user;
	      $this->pass = $_pass;

	      $this->connected = true;

	      stream_set_timeout($this->socket, 0, 125000);
	      stream_set_blocking($this->socket, 1);

	      return true;
	    }
	    // else if coulnt connect
	    else return $errorstr;
	  }


	  // LogIn to host
	  //
	  // RETURN: will return true on success, other way returns false
	  public function LogIn()
	  {
	    if(!$this->connected) return false;

	    // Send name and password
	    $this->SendString($this->user, true);
	    $this->SendString($this->pass, true);

	    // read answer
	    $data = $this->ReadTo(array('#'));

	    // did we get the prompt from host?
	    if( strtolower(trim($data[count($data)-1])) == strtolower($this->host).'#' ) return true;
	    else return false;
	  }


	  // Function will execute command on host and returns output
	  //
	  // @$_command - command to be executed, only commands beginning with "show " can be executed, you can change this by adding
	  //              "true" (bool type) as the second argument for function SendString($command) inside this function (3rd line)
	  //



    function enable($pwd) {
                fputs($this->fp, "enable\n");
        fputs($this->fp, $pwd . "\n");
                $this->endPrompt="#";
                $this->GetResponseUntilPrompt($tmp);
        }

        function GetResponse(&$r) {
                $r='';
                do {
                        $r.=fread($this->fp,1000);
                        $s=socket_get_status($this->fp);
                } while ($s['unread_bytes']) ;
           if ($this->dump)
            print $r."\n";

        }





function GetResponseUntilPrompt(&$r) {
        $r='';
        do {
            $r.=fread($this->fp,1000);
            $s=socket_get_status($this->fp);
            if (preg_match("/ --More-- /", $r)) {
                $r = preg_replace("/ --More-- /", "MORE", $r);
                fputs($this->fp, " ");
            }
        } while (! preg_match("/".$this->endPrompt."$/", $r));

                $r=preg_replace("/".chr(8)."/", "", $r);
                $r=preg_replace("/MORE        /", "", $r);
                if ($this->dump)
                        print $r."\n";
    }





















	  
	 public function GetOutputOf($_command)
	  {
	    if(!$this->connected) return false;

	    $this->SendString($_command);
		

	    $output = array();
		
	    $work = true;

	    //
	    // Read whole output
	    //
	    // read_to( array( STRINGS ) ), STRINGS are meant as possible endings of outputs
	    while( $work && $data = $this->ReadTo( array("--More--","#") ) )
	    {
	      // CHeck wheter we actually did read any data
	      $null_data = true;
	      foreach($data as $line)
	      {
	        if(trim($line) != "") {$null_data = false;break;}
	      }
	      if($null_data) { break;}

	      // if device is paging output, send space to get rest
		  fputs($this->socket, " ");
	      if( trim($data[count($data)-1]) == 'More: <space>,')
	      {
	        // delete line with prompt (or  "--More--")
	        unset($data[count($data)-1]);

	        // if second line is blank, delete it
	        if( trim($data[1]) == '' ) unset($data[1]);
	        // If first line contains send command, delete it
	        if( strpos($data[0], $_command)!==FALSE ) unset($data[0]);

	        // send space
	        
	      }

	      // ak ma vystup max dva riadky
	      // alebo sme uz nacitali prompt
	      // IF we got prompt (line ending with #)
	      // OR string that we've read has only one line
	      //    THEN we reached end of data and stop reading
	      if( strpos($data[count($data)-1], '#')!==FALSE /* || (count($data) == 1 && $data[0] == "")*/  )
	      {
	        // delete line with prompt
	        unset($data[count($data)-1]);

	        // if second line is blank, delete it
	        if( trim($data[1]) == '' ) unset($data[1]);
	        // If first line contains send command, delete it
	        if( strpos($data[0], $_command)!==FALSE ) unset($data[0]);

	        // stop while cyclus
	        $work = false;
	      }

	      // get rid of empty lines at the end
	      for($i = count($data)-1; $i>0; $i--)
	      {
	        if(trim($data[$i]) == "") unset($data[$i]);
	        else break;
	      }

	      // add new data to $output
	      foreach($data as $v)
	      { $output[] = $v; }
	    }

	    // return output
	    return $output;
	  }


	  // Read from host until occurence of any index from $array_of_stops
	  // @array_of_stops - array that contains strings of texts that may be at the end of output
	  // RETURNS: output of command as array of lines
	  function ReadTo($array_of_stops)
	  {
	    $ret = array();
	    $max_empty_lines = 3;
	    $count_empty_lines = 0;

	    while( !feof($this->socket) )
	    {
	      $read = fgets($this->socket);
	      $ret[] = $read;

	      //
	      // Stop reading after (int)"$max_empty_lines" empty lines
	  //
	      if(trim($read) == "")
	      {
	        if($count_empty_lines++ > $max_empty_lines) break;
	      }
	      else $count_empty_lines = 0;

	      //
	      // Does last line of readed data contain any of "Stop" strings ??
	      $found = false;
	      foreach($array_of_stops AS $stop)
	      {
	        if( strpos($read, $stop) !== FALSE ) { $found = true; break; }
	      }
	      // If so, stop reading
	      if($found) break;
	    }

	    return $ret;
	  }



	  // Send string to host
	  // If force is set to false (default), function sends to host only strings that begins with "show "
	  //
	  // @$string - command to be executed
	  // @$force - force command? Execute if not preceeded by "show " ?
	  // @$newLine - append character of new line at the end of command?
	  function SendString($string, $force=false, $newLine=true)
	  {
	    $t1 = microtime(true);
	    $string = trim($string);

	    // execute only strings that are preceded by "show"
	    // and execute only one command (no new line characters) !
	    if(!$force && strpos($string, 'show ') !== 0 && count(explode("\n", $string)) == 1)
	    {
	      return 1;
	    }


	    if($newLine) $string .= "\n";
	    fputs($this->socket, $string);

	    $t2 = microtime(true);
	  }

	}

	


class PHPTelnet {
    var $show_connect_error = 1;

    var $use_usleep = 1;
    var $sleeptime = 380000;
    var $loginsleeptime = 500000;

    var $fp = NULL;
    var $loginprompt;
    var $endprompt = "#";

    var $conn1;
    var $conn2;

    /*
    0 = success
    1 = couldn't open network connection
    2 = unknown host
    3 = login failed
    4 = PHP version too low
    */
    function Connect($server,$user,$pass) {
        $rv=0;
        $vers=explode('.',PHP_VERSION);
        $needvers=array(4,3,0);
        $j=count($vers);
        $k=count($needvers);
        if ($k<$j) $j=$k;
        for ($i=0;$i<$j;$i++) {
            if (($vers[$i]+0)>$needvers[$i]) break;
            if (($vers[$i]+0)<$needvers[$i]) {
                $this->ConnectError(4);
                return 4;
            }
        }

        $this->Disconnect();

        if (strlen($server)) {
            if (preg_match('/[^0-9.]/',$server)) {
                $ip=gethostbyname($server);
                if ($ip==$server) {
                    $ip='';
                    $rv=2;
                }
            } else $ip=$server;
        } else $ip='127.0.0.1';

        if (strlen($ip)) {
            if ($this->fp=fsockopen($ip,23)) {
                fputs($this->fp,$this->conn1);
                $this->Sleep();

                fputs($this->fp,$this->conn2);
                $this->Sleep();
                $this->GetResponse($r);
                $r=explode("\n",$r);
                $this->loginprompt=$r[count($r)-1];

                fputs($this->fp,"$user\r");
                $this->Sleep();

                fputs($this->fp,"$pass\r");
                if ($this->use_usleep) usleep($this->loginsleeptime);
                else sleep(1);
                $this->GetResponse($r);
                $r=explode("\n",$r);
                if (($r[count($r)-1]=='')||($this->loginprompt==$r[count($r)-1])) {
                    $rv=3;
                    $this->Disconnect();
                }
            } else $rv=1;
        }

        if ($rv) $this->ConnectError($rv);
        return $rv;
    }

    function Disconnect($exit=1) {
        if ($this->fp) {
            if ($exit) $this->DoCommand('exit',$junk);
            fclose($this->fp);
            $this->fp=NULL;
        }
    }


 function enable($pwd) {
                fputs($this->fp, "enable\n");
        fputs($this->fp, $pwd . "\n");
                $this->endPrompt="#";
                
        }




    function DoCommand($c,&$r) {
         $output = array();
        if ($this->fp) {
            fputs($this->fp,"$c\n");
            $this->Sleep();
            if (!preg_match("/show /", $c)) {
              $this->GetResponse($r);
            }
            else {
              $this->GetResponse2($r);
            }
            $r=preg_replace("/^.*?\n(.*)\n[^\n]*$/","$1",$r);
        }
        return $this->fp?1:0;
    }

    function GetResponse(&$r) {
        $r='';
        do {
            $r.=fread($this->fp,2000);
            $s=socket_get_status($this->fp);
        } while ($s['unread_bytes']);                           // 'Default' GetResponse function
    }

    function GetResponse2(&$r) {

        $r='';
        do {
            $r.=fread($this->fp,2000);
            $s=socket_get_status($this->fp);
            if (preg_match("/--More--/", $r)) {
                $r=preg_replace("/--More--/", "", $r);
                fputs($this->fp, " ");
            }
        } while (!preg_match("/".$this->endprompt."$/", $r));   // 'Special' GetResponse function (for 'show' commands)
    }

    function Sleep() {
        if ($this->use_usleep) usleep($this->sleeptime);
        else sleep(1);
    }

    function PHPTelnet() {
        $this->conn1=chr(0xFF).chr(0xFB).chr(0x1F).chr(0xFF).chr(0xFB).
            chr(0x20).chr(0xFF).chr(0xFB).chr(0x18).chr(0xFF).chr(0xFB).
            chr(0x27).chr(0xFF).chr(0xFD).chr(0x01).chr(0xFF).chr(0xFB).
            chr(0x03).chr(0xFF).chr(0xFD).chr(0x03).chr(0xFF).chr(0xFC).
            chr(0x23).chr(0xFF).chr(0xFC).chr(0x24).chr(0xFF).chr(0xFA).
            chr(0x1F).chr(0x00).chr(0x50).chr(0x00).chr(0x18).chr(0xFF).
            chr(0xF0).chr(0xFF).chr(0xFA).chr(0x20).chr(0x00).chr(0x33).
            chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0x2C).chr(0x33).
            chr(0x38).chr(0x34).chr(0x30).chr(0x30).chr(0xFF).chr(0xF0).
            chr(0xFF).chr(0xFA).chr(0x27).chr(0x00).chr(0xFF).chr(0xF0).
            chr(0xFF).chr(0xFA).chr(0x18).chr(0x00).chr(0x58).chr(0x54).
            chr(0x45).chr(0x52).chr(0x4D).chr(0xFF).chr(0xF0);
        $this->conn2=chr(0xFF).chr(0xFC).chr(0x01).chr(0xFF).chr(0xFC).
            chr(0x22).chr(0xFF).chr(0xFE).chr(0x05).chr(0xFF).chr(0xFC).chr(0x21);
    }

    function ConnectError($num) {
        if ($this->show_connect_error) switch ($num) {
        case 1: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/fsockopen.php">Connect failed: Unable to open network connection</a><br />'; break;
        case 2: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/unknown-host.php">Connect failed: Unknown host</a><br />'; break;
        case 3: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/login.php">Connect failed: Login failed</a><br />'; break;
        case 4: echo '<br />[PHP Telnet] <a href="http://www.geckotribe.com/php-telnet/errors/php-version.php">Connect failed: Your server\'s PHP version is too low for PHP Telnet</a><br />'; break;
        }
    }
}








































	
?>