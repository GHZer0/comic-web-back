<?php
interface ToMysql
{
	/*
	默认表格结构
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		origin VARCHAR(255) NOT NULL,
		md5 VARCHAR(255) NOT NULL,
		url VARCHAR(255) NOT NULL,
		upload_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";

	*/

	var $server_name;
	var $user_name;
	var $passwd;
	var $dbname;
	var $table_name;

	function __consturct($host,$user_name,$passwd);

	private function connectMysql();

	function closeMysql();

	function createDataBase($dbname);

	function selectDatabase($dbname);

	function createTable($table_name,$dbname='#',$mysql_command='#');
	//$dbname not necessary if used select*();
	//$mysql_command not necessary;

	function selectTable($table_name);

	function insertData($arg1,$arg2,$arg3,$dbname='#',$table_name='#',$mysql_command='#');//！！！！！！！！！！！！！！！！？？？？？？？？？？？？？？？
	//$arg1输入格式  "para1,para2,para3"
	//只支持插入三个参数,有需要请自行修改$mysql_command,$arg1 请用|分割数据
	//$dbname,$table_name not necessary if used select*()；
	//default：$sql_vol = "INSERT IGNORE INTO $this->table_name (origin,md5,url) VALUES(?,?,?)"
	//$mysql_command not necessary;
	//$arg1 = "value1|value2|value3|value4|value5"
	//$arg2 = "col1,col2,col3,col4,col5";  数据表结构，第一行
	//$arg3 = "?,?,?,?,?";  ?个数 == $arg2 参数个数
	//失败返回false

	function getData($col,$col_key,$val,$dbname='#',$table_name='#',$mysql_command='#');
	//提取唯一数据
	//$col为需要提取的列，提取多列请用逗号分开，where 子句 $col_key=$val（唯一）;$mysql_command not necessary
	//$mysql_command,$dbname,$table_name not necessary if used select*()；

	function upData($col,$up_val,$col_key,$val,$dbname='#',$table_name='#',$mysql_command='#');
	//$sql_up = "UPDATE $this->table_name SET $col=\"$up_val\" WHERE $col_key=\"$val\""

	function deleteData($col_key,$val,$dbname='#',$table_name='#',$mysql_command='#');
	//$sql_del = "DELETE FROM $this->table_name WHERE $col_key=\"$val\"";

	function showTable($dbname='#');
	//Array ( [0] => coser [1] => fgg ) //May in_array()
	
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
interface FileHandler  //
{
	var $file_var;

	var $file_name;
	var $file_type;
	var $file_size;
	var $file_tmp;
	var $file_error;

    var $image_file;
    var $compress_file;
    var $mp4_file;

	function __construct($file_var);
	//input name's value,<input type="file" name="$file_name"> 

	private function errorHandler();//??
	//

	function getExtension();//返回后缀名(str)，小写

	private function whatFile();
	//返回以下值(str)，image,compress,mp4中的一个

	function tmpFileMd5();

	function saveFile($sort,$save_path,$max_size=1000000000,$change_file_name='#',$arg5=false);
	//$change_file_name不需要加扩展名,若自定义
	//默认md5_file()计算文件名
	//path最后请别加'/'
	//返回./path/###.jpg
	//支持格式，image,7z,zip,rar,tar,mp4中的一个
	//分类，image，compress，mp4
	//上传默认最大1000M
	//$arg5为false文件重复会报错true为不报
	//成功则返回储存路径，否则false


}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
interface FileDeal
{
	var $get_path;// 结构 /##/###/###（最后没/，可）
	var $get_name;//暂时没有用到
	
	var $get_list;
	var $folder_list;
	var $file_list;
	var $ext_list;

	function __construct($path,$name=false);

	function makeDir($path = '#');
	//制作$path目录

	function addList($path = '#');
	//不填，则默认地址为__construct()定义目录
	//添加$path目录下的文件夹列表，文件列表
	//$count为默认循环次数，-1为自动
	
	function addFolderList($path = '#');
	function addFileList($path = '#');
	function addExtList($path = '#',$start=0);
	//返回对应列表
	//$start为起始码，默认为0，则起始自增值为1!!! 要从1开始录入数据为1，则$start = 1 - 1;
	//自然数算法排序
	//返回列表
	//addExtList 结构array("jpg"=>0);



	function unpackBag($path = '#',$full_path = '#');
	//不填，则默认地址为__construct()定义目录
	//解压过程7z
	//若$full_path != # 则最终解压路径为$full_path,$full_path包含直到文件为止，且只包含一个文件
	//返回exec()执行结果 or false

	function renameDir($before='',$after='',$start=0,$path = '#');
	//before增加前缀功能,$after怎加后缀
	//同上
	//$star = 0 时 从1开始命名
	//返回路径

	function renameFile($before='',$after='',$start=0,$path = '#',$import=false);
	//before增加前缀，$after增加后缀，根据扩展名分类命名
	//同上
	//$star = 0 时 从1开始命名
	//当$import=true时将覆盖大量原有文件
	//返回路径
	//count值$start值+1

	//#加父文件夹名字

	function deleteFile($path='#');
	//尽可能别用

	function deleteDir($path,$important=false);
    //移动文件夹至tmp目录下



}

interface FilterVar
{
	var $now_year;
	var $var;
	var $list;

	function __construct($arg1,$arg2 = array());
	
	function replaceChar($char_or,$char_re,$main_var = '#');
	//$char_or 原字符
	//$char_re 替换后字符
	//
}

//-------------我是一条华丽的分割线------------函数接口-------------------------

function comicHandler($title_zh,$title_en,$arg3 = 1,$main_path = "./tmp");			//暂无
//$start = $arg3 - 1
//批量重命名并写入数据库操作
//插入主目录 ./comic结果为1  ./comic/jilegaoliao 2  ./comic/jilegaoliao_1

//------------------正式comic-------------------------------------------------------------------------------------

//------------info-upload-----------------------------------------------------------------------------------------
function postBaseVar();
//处理一下post上来的全局基础变量
//返回true or die()

function comicInfo($base_path,$sotre_base_path,$temp_base_path="./temp",$sp_base_path=".");
//comic文件上传处理
//$base_path = /comic_store;储存数据库用  
//$store_base_path = ../comic_store;操作用,mv的目表基础路径，在此路径下mkdir()
//$temp_base_path = ./temp;临时操作用
//$sp_base_path从数据库提取的数据的绝对路径->相对路径转换前缀,基本上回是"."或者"..";
//数据库路径结构"/#####/#####";
//转换后结构"./#####/#####" || "../#####/#####"
//php mkdir()从相对目录开始操作
//返回true or die()

function comicMysqlInsert($host,$user,$passwd);
//录数据库用
?>