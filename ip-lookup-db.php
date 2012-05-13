<?php					
$dbhost = "127.0.0.1";
$dbname = "ipdb";
$dbuser = "YOUR_USER_HERE";
$dbpass = "YOUR_PASS_HERE";

mysql_connect($dbhost, $dbuser, $dbpass) or die("can't connect to DB");
mysql_select_db($dbname) or die("can't select DB - does it exist?");

$userip = ipAddress();
			
function ipAddress()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		$userip=$_SERVER['HTTP_CLIENT_IP'];
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   // is user on an insecure proxy?
		$userip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	else
		$userip=$_SERVER['REMOTE_ADDR'];
	return $userip;
}

$result = mysql_query("SELECT * FROM iptable WHERE ips='$userip' ") or die(mysql_error());
$count=mysql_num_rows($result);
if($count>=1){
$protected = true;
echo "success";
}
else {
echo "fail - not in db";
}
?>
