<?php
function kvsStr($str)
{
	$x = str_split($str);
	array_unshift($x,"ldgjlro;aj;bkj;algjei;oa");
	array_push($x,"uwrokljdfnkzl;w/l.gzsd;olirw");

	  $x_str = join("`",$x);
	  $x_str = convert_uuencode($x_str);
	  $x_str = convert_uuencode(bin2hex($x_str));

	  return $x_str;
}


function unKvsStr($str)
{
	  $str = explode("`",convert_uudecode(hex2bin(convert_uudecode($bitcher))));//list
	  array_splice($bitcher,0,1);
	  array_splice($bitcher,-1,1);
	  $str = join("",$bitcher);//str

	  return $str;
}

$kvs_data_host = unKvsStr(kvsStr("localhost"));
$kvs_usr_name = unKvsStr(kvsStr("root"));
$kvs_passwd = unKvsStr(kvsStr("root"));
$kvs_data_base = unKvsStr(kvsStr("comic_store"));

echo "---------------kvs-----------<br>";
echo $kvs_data_host;
echo "<br>";
echo $kvs_usr_name;
echo "<br>";
echo $kvs_passwd;
echo "<br>";
echo $kvs_data_base;
echo "---------------------<br>";


?>