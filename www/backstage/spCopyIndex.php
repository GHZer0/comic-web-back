<?php
//$arg1 = $base_path ,$arg2 = $main_file_store_path, $arg3 = $sp_path = "..",$arg4 = "ԴĿ���ļ���"
//spCopyIndex($GLOBALS['base_path'],$GLOBALS['main_file_store_path'],"..","..");


function spCopyIndex($arg1,$arg2,$arg3,$arg4) 
{
	//echo $GLOBALS['base_path']."::".$arg1; 

	$my_base_path = $arg3."/".$arg1."/"."index.php";
	//"../comic_store/fuck"
	
	$my_main_file_store_path = $arg2;
	//"/comic_store/fuck/_1_hua"����

	$catgory_path = $arg4."/"."catgory.php";
	$read_page_path = $arg4."/"."read_page.php";

	//echo $catgory_path."<br>";
	//echo $my_base_path."<br>";

	$catgory_cp = exec("cp -f $catgory_path  $my_base_path")."<br>";

	if(file_exists($my_base_path))
	{}
	else
	{
		die("catgory copy fail");
	}

	$count = count($my_main_file_store_path);
	for($i = 0;$i<$count;$i++)
	{
		$temp_aim_path = $arg3."/".$my_main_file_store_path[$i]."/"."index.php";

		$read_page_cp = exec("cp -f $read_page_path $temp_aim_path");

		if(file_exists($temp_aim_path))
		{
			continue;
		}
		else
		{
			die("read_page copy fail in $i ");
		}
	}

	$GLOBALS['catgory_store_path'] = $arg1."/"."index.php";

	//------------ɨ��last_hua----
	$scan_last_hua = new FileDeal($arg4."/".$arg1);

	$last_hua_name = end($scan_last_hua->addFolderList());
	$last_hua_num = intval(explode("_",$last_hua_name)[1]);

	
	
	if(!$last_hua_num)
	{
		die("get last hua unsuccess");
	}else{};

	$GLOBALS['last_hua'] = $last_hua_num;

	
	return true;
	

}
?>