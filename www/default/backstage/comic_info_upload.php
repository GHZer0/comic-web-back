<?php
//-----------------------------------------
//基础变量
require "../../backstage/base_var.php";
//基础变量操作
require "../../kvs/enstr.php";
require "../../backstage/output.php";
//--------require--------------------------

require "../../backstage/FileHandler.php";
require "../../backstage/FileDeal.php";
require "../../backstage/ToMysql.php";

//-------------------------------------------
																			//操作函数
require "../../backstage/postBaseVar.php";
require "../../backstage/comicInfo.php";
require "../../backstage/spCopyIndex.php";
require "../../backstage/insertInfo.php";
//-------------------------------------------------


$error_postBaseVar = postBaseVar();							//表单验证函数
if(!$error_postBaseVar)
{
	die("Line 24 post have error");
}else{}


//-----------------show,main file -------------------
$show = "show";
$main_file = "main_file";

$show_name = $_FILES[$show]["name"];
$show_type = $_FILES[$show]["type"];
$show_size = $_FILES[$show]["size"];
$show_tmp_name = $_FILES[$show]["tmp_name"];
$show_error = $_FILES[$show]["error"];

$main_file_name = $_FILES[$main_file]["name"];
$main_file_type = $_FILES[$main_file]["type"];
$main_file_size = $_FILES[$main_file]["size"];
$main_file_tmp_name = $_FILES[$main_file]["tmp_name"];
$main_file_error = $_FILES[$main_file]["error"];
//---------------------------------------------------------

$error_comicInfo = comicInfo("/comic_store","../comic_store","./temp");			//文件处理函数
if(!$error_comicInfo)
{
	die("Line:197 comicInfo unsuccess");
}else{}

/*
$error_comicMysqlInsert = comicMysqlInsert("localhost","root",$kvs_passwd);			//数据库插入函数
if(!$error_comicMysqlInsert)
{
	die('data insert unsuccess');
}
else
{
	echo "Line 59 else<br>";
}
*/
//输出数据查看

$error_spCopyIndex = spCopyIndex($GLOBALS['base_path'],$GLOBALS['main_file_store_path'],"..","..");

if(!$error_spCopyIndex)
{
	die("Line 70 spCopyIndex unsuccess");
}
else
{
	echo "Line 71";
}


echo "基础数据：<br/>";
echo "title_or : $title_or <br>";
echo "title_zh : $title_zh <br>";
echo "title_en : $title_en <br>";

echo "sp : ";print_r($sp);echo "<br>";
echo "before : $before <br>";

echo "after : $after <br>";
echo "start_num : $start_num <br>";
echo "all_num : $all_num <br>";

echo "author : $author <br>"; 
echo "uploader ：$uploader <br>";

echo "company : $company <br>";
echo "country : $country <br>";
echo "start_year : $start_year <br>";

echo "end_year : $end_year <br>";
echo "status : ";print_r($status);echo "<br>";

echo "modify : $modify <br>";
echo "type01 : $type01 <br>";
echo "type02 : $type02 <br>";
echo "type03 : $type03 <br>";
echo "details : $details <br>";

echo "show : $show <br>";
echo "main_file : $main_file <br>";

echo "show_name : $show_name <br>";
echo "show_type : $show_type <br>";
echo "show_size : $show_size <br>";
echo "show_tmp_name : $show_tmp_name <br>";
echo "show_error : $show_error <br>";//**
echo "show_md5 : $show_md5 <br>";

echo "main_file_name : $main_file_name <br>";
echo "main_file_type : $main_file_type <br>";
echo "main_file_size : $mian_file_size <br>";
echo "main_file_tmp_name : $main_file_tmp_name <br>";
echo "main_file_error : $main_file_error <br>";//**
echo "main_file_md5 : $main_file_md5 <br>";

echo "Path data:<br>";
echo "base_path : $base_path <br>";
echo "show_store_path : $show_store_path <br>";
echo "main_file_store";print_r($main_file_store_path);echo "<br>";
echo "catgory_store_path : $catgory_store_path <br>";
echo "last_hua : $last_hua <br>";

if(!insertInfo("localhost","root","root","comic_store")){
	die("Insert info unsuccess");
}




?>