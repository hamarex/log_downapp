<?php
echo <<< __HTML__
<html>
<head>
<title>server_list</title>
</head>
<body>
<p><a href=top.php>TOP</a></p></br>
__HTML__;

$sys=$_REQUEST["sys"];


$fp = fopen("conf/${sys}_server.conf","r");
	while ($line = fgets($fp)) {
	$linearray=explode(",",$line);
	$cnt=count($linearray);
        $cnt=$cnt-1;
	echo "$linearray[0]<br />\n";
		for ($i=1;$i<$cnt;$i++){
		print "<form method=POST action=\"list.php\">\n" ;
		    echo "<p style=\"background-color:#E3F2FB;border:1px solid #CCCCCC;padding:5px;\">";
		    //echo "$linearray[$i] "." "."<input type=\"submit\" value=\"view\">\n";
		    echo "<input type=\"submit\" value=\"view\">"."$linearray[$i] " ;
		    echo "<input type=\"hidden\" name=\"yy\" value=\"".$linearray[0]." \">\n";
		    echo "<input type=\"hidden\" name=\"yp\" value=\"".$linearray[$i]." \">\n";
                    echo "</p>";
		print "</form>";
	        }

	    echo "<br />\n";
	}

fclose($fp);

echo <<< __HTML2__
</body>
</html>
__HTML2__;

?>
