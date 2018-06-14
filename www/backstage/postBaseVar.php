<?php
function postBaseVar()
{
	$GLOBALS["title_or"] = $_POST["title_or"];
	$GLOBALS["title_zh"] = $_POST["title_zh"];
	$GLOBALS["title_en"] = $_POST["title_en"];

	//$GLOBALS["sp"] = $_POST["sp"];
	$GLOBALS["before"] = $_POST["before"];

	$GLOBALS["after"] = $_POST["after"];
	$GLOBALS["start_num"] = $_POST["start_num"];
	$GLOBALS["all_num"] = $_POST["all_num"];

	$GLOBALS["author"] = $_POST["author"];
	$GLOBALS["uploader"] = "admin";//判断上传者身份

	$GLOBALS["company"] = $_POST["company"];
	$GLOBALS["country"] = $_POST["country"];
	$GLOBALS["start_year"] = $_POST["start_year"];

	$GLOBALS["end_year"] = $_POST["end_year"];
	$GLOBALS["status"] = $_POST["status"];

	$GLOBALS["modify"] = $_POST["modify"];
	$GLOBALS["type01"] = $_POST["type01"];
	$GLOBALS["type02"] = $_POST["type02"];
	$GLOBALS["type03"] = $_POST["type03"];
	$GLOBALS["details"] = $_POST["details"];

	//														//此处默认返回'false',竟然是个字符串
	if($GLOBALS["country"] === 'false' || 
		$GLOBALS["type01"] === 'false' ||
		$GLOBALS["type02"] === 'false' ||
		$GLOBALS["type03"] === 'false' ||
		$GLOBALS["status"] === 'false')
	{
		die('Please selected country type01 type02 or type03 or status');
	}else{}

	$globals_array = array(
							"title_or",
							"title_zh",
							"title_en",

							//"sp",
							"before",

							"after",
							"start_num",
							"all_num",

							"author",
							"uploader",

							"company",
							"country",
							"start_year",

							"end_year",
							"status",

							"modify",
							"type01",
							"type02",
							"type03",
							"details"
							);
	$count_globals_array = count($globals_array);
	//--------------------------------------------
	//文字处理函数----------------------

	function testChar($test_char)
	{
		filter_var($test_char, FILTER_SANITIZE_STRING);
		$temp_list = explode(" ",$test_char);
		$test_char = join("_",$temp_list);
		//echo $test_char."<br>";
		$test_char = trim($test_char);
		$test_char = stripslashes($test_char);
		$test_char = htmlspecialchars($test_char);
		return $test_char;
	}
	//过滤器设置---------------------
	$int_min = array(
		'options' => array
		(
			"min_range" => 0
		));
	$int_max = array(
		'options' => array
		(
			"max_range" => date("Y")
		));

	//--------------------------------------------
	for($i = 0;$i<$count_globals_array;$i++)
	{
		if( $globals_array[$i] == 'start_year' ||
			$globals_array[$i] == 'end_year'   ||
			$globals_array[$i] == 'start_num'  ||
			$globals_array[$i] == 'all_num' 
			)
		{

			if(filter_var($GLOBALS[$globals_array[$i]]) || $GLOBALS[$globals_array[$i]] === 0 || $GLOBALS[$globals_array[$i]] === '0')
			{
				//判断是否是整数，0好坑
			}
			else
			{
				if($globals_array[$i] !== 'end_year')
				{
					die($globals_array[$i].' is not int Line 110');
				}
				else
				{}
			}

			if($globals_array[$i] == 'end_year')
			{
				if($GLOBALS["status"] === 'end')
				{
					if(!intval($GLOBALS['end_year']))
					{
						die('end year is not int');
					}
					else if($GLOBALS['end_year'] > date("Y"))
					{
						die("end_year bigger than now");
					}else{}
					
					if($GLOBALS['end_year'] < $GLOBALS['start_year'])
					{
						die('end_year is smaller than start_year');
					}else{continue;}
				}
				else
				{
					if($GLOBALS['end_year'] !== '')
					{
						die("you select is still in updata in status,but you input some thing in end year");
					}
					else{continue;}
				}
			}
			else if($globals_array[$i] == 'start_num')
			{
				if($GLOBALS['start_num']<0)
				{
					die("start_num smaller than 0");
				}else{continue;}
			}
			else if($globals_array[$i] == 'start_year')
			{
				if($GLOBALS['start_year']<500)
				{
					die("start_year smaller than 500");
				}
				else{continue;}
			}
			else if($globals_array[$i] == 'all_num')
			{
				if($GLOBALS['all_num'] <1)
				{
					die("all_num is smaller than 1");
				}else{continue;}
			}
			else
			{
				continue;
			}
		}
		else
		{
			$temp_globals = testChar($GLOBALS[$globals_array[$i]]);
			$count_temp_globals = strlen($temp_globals);
			if($globals_array[$i] == 'details')
			{
				if($count_temp_globals > 800 || $count_temp_globals === 0)
				{
					die("details is over 800 char or empty");
				}else{continue;}
			}
			else if($globals_array[$i] == 'title_or' ||
					$globals_array[$i] == 'title_zh' ||
					$globals_array[$i] == 'before')			//<select name='before'><option value=''></select>
			{
				if($count_temp_globals > 300)
				{
					die($globals_array[$i]." is too long");
				}else{continue;}
			}
			else
			{
				if($count_temp_globals > 300 || $count_temp_globals === 0)
				{
					die($globals_array[$i]." is too long or empty");
				}else{continue;}
			}

		}
	}
	return true;
}


?>