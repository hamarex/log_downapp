<?php

$command1 ="ls -ltF ";
$command2 ="|grep -v / |sed -e '1d'";
$path_dir=$_POST['yp'];
$server=$_POST['yy'];

$out = shell_exec("

	eval `ssh-agent` >/dev/null
	ssh-add ~/.ssh/id_rsa  >/dev/null
        ssh $server $command1 $path_dir $command2
	ssh-agent -k >/dev/null
");


$arrytest=explode("\n",$out);
$cnto = count($arrytest);
$cnto=$cnto-1;

echo <<< __HTML__
<html>
<head>
<title>log_list</title>
</head>
<body>
<p><a href=top.php>TOP</a></p></br>

__HTML__;


$b=split("\n",$out);
        for($i=0;$i< count($b)-1;$i++){
print "<form method=POST action=\"down.php\">";

 $c=preg_replace("/\s+/",",",$b[$i]);
 $c.="\n";
 $d=explode(",",$c);

                    echo "<p style=\"background-color:#FFE2E8;border:1px dotted #FF99CC;padding:5px;\">";
                    echo "<input type=\"submit\" value=\"Get!\">"."&nbsp;&nbsp;&nbsp;$d[8]  "." &nbsp;&nbsp;$d[5]  "."  $d[6]  "."&nbsp;&nbsp; $d[7]  "."<br />\n";
                    echo "<input type=\"hidden\" name=\"pp\" value=\"".$server." \">\n";
                    echo "<input type=\"hidden\" name=\"pd\" value=\"".$path_dir." \">\n";
                    echo "<input type=\"hidden\" name=\"pf\" value=\"".$d[8]." \">\n";
                    echo "</p>";
print "</form>";

}

echo <<< __HTML2__
</body>
</html>
__HTML2__;

?>
