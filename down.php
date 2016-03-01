<?php
//変数定義
        $path_dir=$_POST['pd'];
        $path_dir=trim($path_dir," ");
        $server=$_POST['pp'];
        $server=trim($server," ");
        $file_name=$_POST['pf'];
        $file_name=trim($file_name," ");
//ゴミ文字を空白へ変換
        $file_name = str_replace( "\xc2\xa0", " ", $file_name );
        $file_name = trim($file_name);
        $full_name=$path_dir ."/" .$file_name;
	$ng_download_file=0;

//除外ファイルread
	$fp = fopen("conf/exclude.conf","r");
	while ($line = fgets($fp)) {
		$line=trim($line);
		if(strstr($full_name,$line)){
        		$ng_download_file=1;
		}
	}

	fclose($fp);

//禁止メッセージ
	if($ng_download_file == 1){
	        print "ダウンロード禁止ファイルのためダウンロードできません!!\n";
	}else{
//ダウンロード

	$out = shell_exec("

		eval `ssh-agent` > /dev/null
		ssh-add ~/.ssh/id_rsa >/dev/null
		scp $server:$path_dir/$file_name log/$file_name >/dev/null
	        ssh-agent -k >/dev/null
	");

	$file_array="log/"."$file_name";
	$file_array=trim($file_array," ");

	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.$file_name.'"');
	header('Content-Length: '.filesize("$file_array"));
	readfile("$file_array");
	unlink("$file_array");

	}
?>
