<?php
//-----------main info --------------------------
$title_or = "";
$title_zh = "";
$title_en = "";

//$sp = false;
$before = "";

$after = "";
$start_num = 0;
$all_num = 0;

$author = "";
$uploader = "";

$company = "";
$country = "";
$start_year = 0;

$end_year = "";
$status = "false";

$modify = "";
$type01 = "";
$type02 = "";
$type03 = "";
$details = "";

$last_hua = 0; //new

//-----------------main file -------------------
$show = "show";
$main_file = "main_file";

$show_name = "";
$show_type = "";
$show_size = 0;
$show_tmp_name = "";
$show_error = "";
$show_md5 = "";

$main_file_name = "";
$main_file_type = "";
$main_file_size = 0;
$main_file_tmp_name = "";
$main_file_error = "";
$main_file_md5 = "";
//-------------------------table col--------------------------
$catgory = array(
					'title_en',
					'title_or',
					'title_zh',
					'main_path',
					'show_path',
					'author',
					'uploader',
					'company',
					'country',
					'start_year',
					'end_year',
					'status',
					'modify',
					'type01',
					'type02',
					'type03',
					'details',
					'date'
					);														//暂无
$main_times = array(
					'id',
					'title_en',
					'time_en',
					'time_zh',
					'time_path',
					'path',
					'date'
					);													//暂无
//------------------------path---相对路径-----------------
$base_path = "";										//数据库位置catgory main_path

//$show_base_path = "";
$show_store_path = "";									//数据库位置catgory show_path

$catgory_store_path = "";
//新加，

//$main_file_base_path = "";
$main_file_store_path = array();							   //数据库位置time time_path
//$main_file_times_path = "";
$hua_path = ""; //暂时不用


//---------------switch------------------------
?>