<?php
interface EncodeTo
{
	var $encode_type; //保存有原来文件编码类型
    var $encode_array;	
	var $my_encode;
	var $after_encode_type;//保存之后文件编码类型

	var $file_path;
	var $str;
	var $content;

	var $str_file;//bool
	var $html_sp;//bool
	var $make_new_file;//bool
	
	var $new_file_name;


	function __construct($str,$str_file = false,$encode_to = "UTF-8");
	//$str可为字符串或文件路径，$str_file为false时为纯字符串，为true时为文件路径.
	//encode_to 选择想要转换成的字符串

//---------Encode转换输出str-----------------------

	function changeEncode($html_sp = false,$str = false);
	//$html_sp选择是否转htmlspecialchars，false不转。
	//$str纯字符串或路径，为false则为construct内$str，纯字符或路径请与construct中统一
	//返回转码后字符串

//--------------文件写入函数-------------------------

	function writeEncodeFile($html_sp = false,$new_file_path = "");
	//$arg2表示储存转码后字符串路径，不填则替换原文件
	//返回转码文件储存路径
//-----------------返回原文编码类型----------------------
	function returnOrEncode();
//-----------------返回转码后编码类型-------------------
	function returnAfterEncode();
}
?>