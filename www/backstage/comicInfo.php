<?php
function comicInfo($arg4,$arg1,$arg2="./temp",$arg3=".")
{
	if(!file_exists($arg2))
	{
		mkdir($arg2);
	}else{}
	

    $base_path = $arg4."/";
	$temp_base_path = $arg2;
	$store_base_path = $arg1;
	$sp_base_path = $arg3;													//$sp_base_path 从数据库提取的数据的绝对路径->相对路径转换前缀
	
	$show_handler = new FileHandler($GLOBALS["show"]);
	$main_file_handler = new Filehandler($GLOBALS["main_file"]);

	$show_deal = new FileDeal("./temp");
	$main_file_deal  = new FileDeal("./temp");


	if($GLOBALS["show_error"] > 0 || $GLOBALS["main_file_error"] > 0)
	{																							
		$file_error = die("Up load file unsuccess,please use correct file and try again");
	}else{}

	//																		     //上传文件大小是否合理由js进行判断


	$show_base_path = $store_base_path."/".$GLOBALS['title_en'];				//$show_base_path与$main_file_base_path相同
	$main_file_base_path = $show_base_path;									   //"../comic_store/title_en

	if(!file_exists($show_base_path))
	{
	  mkdir($show_base_path);
    }else{}
	if(!file_exists($show_base_path))
	{
		die("title_en path not create success");
	}else{}

	//------temp操作-----------------------------------------------------------------------------------------------------------------------
	$main_file_md5 = $main_file_handler->tmpFileMd5();
	//echo $main_file_md5."<br>";
	
	$temp_main_file_path = $temp_base_path."/".$main_file_md5;		// "./temp/md5#####"

	if(!file_exists($temp_main_file_path))
	{
		mkdir($temp_main_file_path);
	}else{}
		
	$temp_main_file_store_path = $main_file_handler->saveFile("compress",$temp_main_file_path,1000000000,$main_file_md5,true);//"./temp/md5###/md5###.zip"

	if(!file_exists($temp_main_file_store_path))
	{
		$main_file_deal->deleteDir($temp_main_file_path,true);
		die("file not save success");
	}else{}
	
	$main_file_ext = $main_file_handler->getExtension();  //zip
	
	$error_unpackBag = $main_file_deal->unpackBag($temp_main_file_path,$temp_main_file_store_path);
	if($error_unpackBag == false)
	{
		$main_file_deal->deleteDir($temp_main_file_path,true);
		die("unpack unsuccess");
	}else{}

	unlink($temp_main_file_store_path);

	$main_file_deal->renameDir($GLOBALS['before'].'_','_'.$GLOBALS['after'],$GLOBALS['start_num']-1,$temp_main_file_path);

	$main_file_list = $main_file_deal->addFolderList($temp_main_file_path);

	$count_main_file_list = count($main_file_list);

	if($count_main_file_list != $GLOBALS['all_num'])
	{
		$main_file_deal->deleteDir($temp_main_file_path,true);
		echo "<br><br>".$temp_main_file_path."<br>";
		die("File all number not equal to what you input ");
	}else{}
	
	//--------------store操作-------------------------------------------------------------------------------------------------------------
    
	$GLOBALS['base_path'] = $base_path.$GLOBALS['title_en'];											//$GLOBALS['base_path'] "/comic_store/title_en" 

	$show_store_path = $show_handler->saveFile("image",$show_base_path,1000000000,$GLOBALS['title_en'],true);

	//------------------------------------------------------------------------------------------------	//特别函数
		
		function tempExtHas($list)									//判断是否是图片，是则true 否则false
		{
			if(
				array_key_exists('jpg',$list)  ||
				array_key_exists('jpeg',$list) ||
				array_key_exists('gif',$list)  ||
				array_key_exists('png',$list)
			  )
			{
				return true;
			}
			else 
			{
				return false;
			}
		}


	//-----------------------------------------------------------------------------------------------
	for($i = 0;$i<$count_main_file_list;$i++)
	{
		
		$full_temp_main_file_path = $temp_main_file_path.'/'.$main_file_list[$i];
		//------------------------------------------------------------------------------------------//判断压缩包解压后格式是否正确
		exec("sudo chmod -R 0777 ".$full_temp_main_file_path);

		$temp_dir_list = $main_file_deal->addFolderList($full_temp_main_file_path);
		$temp_ext_list = $main_file_deal->addExtList(0,$full_temp_main_file_path);
		if(count($temp_dir_list) > 0 || count($temp_ext_list) != 1)
		{
			$main_file_deal->deleteDir($temp_main_file_path,true);
			die("Compress method not true or the type of image is not all same");
		}else{}
		
		if(!tempExtHas($temp_ext_list))
		{
			$main_file_deal->deleteDir($temp_main_file_path,true);
			die("File is not image");
		}else{}
		
		//-------------------------------------------------------------------		
		//1、预留压缩图片																	
		//2、预留重命名图片
		//-------------------------------------------------------------------

		$full_main_file_store_path = $main_file_base_path;

		
		if(file_exists($full_main_file_store_path."/".$main_file_list[$i]))
		{
			$main_file_deal->deleteDir($full_main_file_store_path."/".$main_file_list[$i],true);
		}else{}
		
		//$temp_mv_rm = exec("rm -rf"." ".$full_main_file_store_path);//删除原重复文件夹

		$temp_mv = exec("sudo mv -f ".$full_temp_main_file_path." ".$full_main_file_store_path);

		/*
		echo "----------------full_main_file_store_path-------------------<br>-";
		echo $full_main_file_store_path."<br>";
		echo "<br>";
		echo "---------------------------------------------------------<br>";
		*/

		//--------------------------

		$need_main_file_store_path = $base_path.$GLOBALS['title_en'].'/'.$main_file_list[$i];

		array_push($GLOBALS['main_file_store_path'],$need_main_file_store_path);

		//echo "<br>".$need_main_file_store_path."<br><br>";
		//echo "~~~~~~~~~~~~~<br>";
	}

    $main_file_deal->deleteDir($temp_main_file_path,true);

	//print_r($GLOBALS['main_file_store_path']);

	//--------------------------------------------------------$GLOBALS['show_store_path']---------------

	$GLOBALS['show_store_path'] = $base_path.$GLOBALS['title_en']."/".$GLOBALS['title_en'].".".$show_handler->getExtension();	

	return true;

	//------------------------------------------------------------需要路径整理-------------------------------------------------- 
	//	$GLOBALS['base_path']  '/comic_store/title_en'  //main_path
	//	$GLOBALS['show_store_path']  //comic_store/title_en/title_en.jpg'
	//	$GLOBALS['main_file_store_path']  array('/comic_store/fuck/_1_hua','/comic_store/fuck/_2_hua','/comic_store/fuck/_3_hua');

	//uploader在postBaseVar里
}

?>