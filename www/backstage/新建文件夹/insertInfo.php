<?php
function insertInfo($server_name,$usr_name,$passwd,$dbname)
{


	$conn = new mysqli($server_name,$usr_name,$passwd,$dbname);
	
	if($conn->connect_error)
	{
		die("Connect error : ".$conn->connect_error);
	}
	else{}

	$conn->query("SET AUTOCOMMIT=0");
	$conn->query("BEGIN");

	//comic_info
	//echo "line 18";
	if(!is_int($GLOBALS['end_year']))
	{
		$sql_comic_info = '
		replace into comic_info (
		title_or,
		title_zh,
		title_en,
		author,
		company,
		country,
		start_year,
		status,
		modify,
		type01,
		type02,
		type03,
		details,
		base_path,
		show_store_path,
		catgory_store_path,
		last_hua
		)
		values(
		'.'"'.$GLOBALS['title_or'].'"'.','.' '.
		'"'.$GLOBALS['title_zh'].'"'.','.' '.
		'"'.$GLOBALS['title_en'].'"'.','.' '.
		'"'.$GLOBALS['author'].'"'.','.' '.
		'"'.$GLOBALS['company'].'"'.','.' '.
		'"'.$GLOBALS['country'].'"'.','.' '.
		'"'.$GLOBALS['start_year'].'"'.','.' '.
		'"'.$GLOBALS['status'].'"'.','.' '.
		'"'.$GLOBALS['modify'].'"'.','.' '.
		'"'.$GLOBALS['type01'].'"'.','.' '.
		'"'.$GLOBALS['type02'].'"'.','.' '.
		'"'.$GLOBALS['type03'].'"'.','.' '.
		'"'.$GLOBALS['details'].'"'.','.' '.
		'"'.$GLOBALS['base_path'].'"'.','.' '.
		'"'.$GLOBALS['show_store_path'].'"'.','.' '.
		'"'.$GLOBALS['catgory_store_path'].'"'.','.' '.
		'"'.$GLOBALS['last_hua'].'"'.' '.');';
	}
	else
	{
		$sql_comic_info = '
		replace into comic_info (
		title_or,
		title_zh,
		title_en,
		author,
		company,
		country,
		start_year,
		end_year,
		status,
		modify,
		type01,
		type02,
		type03,
		details,
		base_path,
		show_store_path,
		catgory_store_path,
		last_hua
		)
		values(
		'.'"'.$GLOBALS['title_or'].'"'.','.' '.
		'"'.$GLOBALS['title_zh'].'"'.','.' '.
		'"'.$GLOBALS['title_en'].'"'.','.' '.
		'"'.$GLOBALS['author'].'"'.','.' '.
		'"'.$GLOBALS['company'].'"'.','.' '.
		'"'.$GLOBALS['country'].'"'.','.' '.
		'"'.$GLOBALS['start_year'].'"'.','.' '.
		'"'.$GLOBALS['end_year'].'"'.','.' '.
		'"'.$GLOBALS['status'].'"'.','.' '.
		'"'.$GLOBALS['modify'].'"'.','.' '.
		'"'.$GLOBALS['type01'].'"'.','.' '.
		'"'.$GLOBALS['type02'].'"'.','.' '.
		'"'.$GLOBALS['type03'].'"'.','.' '.
		'"'.$GLOBALS['details'].'"'.','.' '.
		'"'.$GLOBALS['base_path'].'"'.','.' '.
		'"'.$GLOBALS['show_store_path'].'"'.','.' '.
		'"'.$GLOBALS['catgory_store_path'].'"'.','.' '.
		'"'.$GLOBALS['last_hua'].'"'.' '.');';
	}


	//print_r($GLOBALS['end_year']);echo "whaft___________.<br>";


	//echo $sql_comic_info."<br>";

	if($conn->query($sql_comic_info)=== true)
	{
		//echo "insert comic info success<br>";
	}
	else
	{
		$conn->query("ROLLBACK");
		die("insert comic info fail:".$conn->error);
	}

	//echo "I am after line 60<br>";

	$main_file_store_path = $GLOBALS['main_file_store_path'];

	$count_main_file_store_path = count($main_file_store_path);
	for($i = 0;$i<$count_main_file_store_path;$i++)
	{
		$hua_temp_temp = explode("/",$GLOBALS['main_file_store_path'][$i]);
		$hua_temp = intval(explode("_",end($hua_temp_temp))[1]);

		if(is_int($hua_temp) || $hua_temp === 0)
		{}
		else
		{
			die("hua temp have error");
		}

		$sql_uploader = '
		replace into uploader_info (
		uploader,
		title_or,
		title_zh,
		title_en,
		hua,
		hua_path
		) 
		values('.'"'.$GLOBALS['uploader'].'"'.','.' '.
		'"'.$GLOBALS['title_or'].'"'.','.' '.
		'"'.$GLOBALS['title_zh'].'"'.','.' '.
		'"'.$GLOBALS['title_en'].'"'.','.' '.
		$hua_temp.','.' '.
		'"'.$GLOBALS['main_file_store_path'][$i].'"'.' '.');';

		//echo $sql_uploader."<br>";
		if($conn->query($sql_uploader) === true)
		{
			
			//echo "Insert into uploader success <br>";
		}
		else
		{
			$conn->query("ROLLBACK");
			die("Insert into uploader fail : ".$conn->error." in ".$i);
		}

	}

	$conn->query("COMMIT");
	$conn->close();

	return true;

}
?>