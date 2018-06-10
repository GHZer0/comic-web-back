<?php

/*
$arg1填入新建的文件夹名，$arg2填入新建文件夹的父目录，请勿在最后添加"\"或"/"，不填默认当前目录。
目录连接符请使用"/"
成功返回true，否则die
*/

function mkdirByArray($arg1,$arg2 = "./")
{
	$full_dir_path_array = array();


	$temp_arg2 = explode("\\",$arg2);
	if(count($temp_arg2) > 1)
	{
		$arg2 = join("/",$temp_arg2);
	}
	else
	{}

	if(file_exists($arg2) === false)
	{
		if(mkdir($arg2,0777,true))
		{}
		else
		{
			die("make first dir not success");
		}
	}
	else
	{}

	if((is_array($arg1) === false || is_dir($arg2) === false))
	{
		die("The first arg need a array,second arg need a dir");
	}
	else
	{}
	
	$main_array = array_unique($arg1);

	if((explode("/",$arg2)[0] !== "." || explode("/",$arg2)[0] !== "..") && (explode("/",$arg2)[1] === "" || explode("/",$arg2)[1] === ""))
	{
		$first_path = $arg2;
	}
	else
	{
		$first_path = $arg2."/";
	}

	foreach($main_array as $key=>$value)
	{

		$full_dir_path = $first_path.$value;
		array_push($full_dir_path_array,$full_dir_path);
		echo $full_dir_path;
		echo "<br>";
		
		if(file_exists($full_dir_path) === false)
		{
			if(mkdir($full_dir_path,0777,true))
			{}
			else
			{
				die("make last dir not success");
			}
		}
		else
		{}
				
	}
	return $full_dir_path_array;
}
/*
$fuck_array = array
(
	"北仑",
	"北仑",
	"奉化",
	"奉化",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"高新",
	"海曙",
	"江北",
	"江北",
	"江东",
	"象山",
	"象山",
	"象山",
	"象山",
	"镇海"
);

print_r(mkdirByArray($fuck_array,"./nimani"));

*/
?>