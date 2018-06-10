<?php
//namespace sql_server;
//数据库操作

class ToMysql
{
//连接
	var $server_name;
	var $user_name;
	var $passwd;
	var $dbname;
	var $table_name;
	//var $table_form;
	
	function __construct($arg1,$arg2,$arg3)
	{
		$this->server_name = $arg1;
		$this->user_name = $arg2;
		$this->passwd = $arg3;
	}
//------------------我是一条华丽的分割线---//链接库---------------------

	protected function connectMysql()
	{  
		$conn = new mysqli($this->server_name,$this->user_name,$this->passwd);
		

		if($conn->connect_error)
		{
			echo $conn->connect_error;
			return false;
		}
		else
		{
			//echo 'Connect Success'."<br/>";
			return $conn;
		}
	}

//------------------我是一条华丽的分割线---//关闭库-----------------------

	function closeMysql()
	{
		$conn = $this->connectMysql();
		$conn->close();
	}


//------------------我是一条华丽的分割线----//创建库------------------------	

	function createDatabase($arg) //默认更改库
	{
		$this->dbname = $arg;

		$conn = $this->connectMysql();
		$sql_db = "CREATE DATABASE ".$this->dbname;//空格空格
		$conn->query($sql_db);
		$conn->select_db($this->dbname);
		
		if($conn->error)
		{
			echo $conn->error;
			return false;
			
		}
		else
		{
			//echo "Create Databaes $this->dbname Success"."<br/>";
			return true;
		}

	}

//------------------我是一条华丽的分割线---//选择库------------------------
	
	function selectDatabase($arg)
	{
		$this->dbname = $arg;
	}

//------------- ----我是一条华丽的分割线-//查询某张表是否存在-----------------	
/*
	function checkTable($server_name,$user_name)
	{  
		
	}
*/
//------------------我是一条华丽的分割线----//创建表---------------------------

	function createTable($arg,$arg1='#',$arg2='#')
	{   

		if($arg1 != '#')
		{
			$this->dbname = $arg1;
		}

		$this->table_name = $arg;

		//$this->table_form = $arg2;


		$conn = $this->connectMysql();
		$conn->select_db($this->dbname);


	//默认
		$sql_tab = "CREATE TABLE ".$this->table_name." (  
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		origin VARCHAR(255) NOT NULL,
		md5 VARCHAR(255) NOT NULL,
		url VARCHAR(255) NOT NULL,
		upload_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		)";
		if($arg2 != '#')
		{
			$sql_tab = $arg2;
		}
	
		$conn->query($sql_tab);
		if($conn->error)
		{
			echo $conn->error;
			$exists = explode(" ",$conn->error);//一维列表

			if(end($exists) == "exists")
			{   
				return true;
			}
			else{}

			return false;
		}
		else
		{
			//echo "Create table ".$this->table_name;
			return true;
		}
		
	}
//------------------我是一条华丽的分割线---//选择数据表------------------

	function selectTable($arg)
	{
		$this->table_name = $arg;
	}

//------------------我是一条华丽的分割线---//插入数据------------------

	function insertData($arg1,$arg2,$arg3,$arg4='#',$arg5='#',$arg6='#')
	{
		if($arg4!='#' && $arg5!='#')
		{
			$this->dbname = $arg4;
			$this->table_name = $arg5;

		}
		
		$x = array();

		$tmp = explode("|",$arg1);
		$count_tmp = count($tmp);
		for($i=0;$i<$count_tmp;$i++)
		{
			$x[$i] = $tmp[$i];
		}

		$tmp2 = explode(",",$arg2);
		$count_tmp2 = count($tmp2);

		$tmp3 = explode(",",$arg3);
		$count_tmp3 = count($tmp3);
		for($i = 0;$i<$count_tmp3;$i++)
		{
			if($tmp3[$i] != "?")
			{
				//die("$arg3 include some is nor ? or too more ,");
				return false;
			}else{}
		}
		if($count_tmp2 != $count_tmp3 || $count_tmp != $count_tmp2 )
		{
			//die("$arg2 long not equal $arg3 or $arg1")
			return false;
		}else{}

		$conn  = $this->connectMysql();
		$conn->select_db($this->dbname);

		$sql_vol = "INSERT IGNORE INTO $this->table_name (".$arg2.") 
		VALUES(".$arg3.")";
		if($arg6 != '#')
		{
			$sql_vol = $arg6;
		}else{}


		$stmt = $conn->prepare($sql_vol);

		if(!$stmt)
		{
			echo $conn->error;
			return false;
		}else{}

		//print_r($stmt);
		$stmt->bind_param("sss",$x[0],$x[1],$x[2]);				//需要修改的地方 Where need check 至$x[$count_tmp2 - 1]
		$stmt->execute();
		
		if($conn->error)
		{
			echo $conn->error;
			return false;
		}
		else
		{
			return true;
		}
				
	}

//------------------我是一条华丽的分割线---//提取数据------------------
//提取唯一数据//

	function getData($arg2,$arg3,$arg4,$arg0='#',$arg1='#',$arg5='#')
	{
	
		if($arg0!='#' && $arg1!='#')
		{
			$this->dbname = $arg0;
			$this->table_name = $arg1;

		}

		$col = $arg2;  //需要提取的列，提取多列请用逗号分开
		$col_key = $arg3;
		$val = $arg4;

		//$sql_val = "SELECT origin FROM coser WHERE origin='bitch'";
		$sql_val = "SELECT $col FROM $this->table_name WHERE $col_key=\"$val\"";
		if($arg5 != '#')
		{
			$sql_val = $arg5;
		}

		$conn = $this->connectMysql();
		$conn->select_db($this->dbname);

		$result = $conn->query($sql_val);//obj
		if(!$result)
		{
			die($conn->error);
		}

		$rows = $result->fetch_array(MYSQLI_ASSOC);	
		//$rows = $result->fetch_all(MYSQLI_ASSOC);//

        /*暂不需要
		for($i=0;$i<count($rows);$i++)
		{
			$rows[$i] = $rows[$i];
		}
		*/
		
		//print_r($rows);
		
		if($conn->error)
		{
			echo $conn->error;
			return false;
		}
		else
		{
			return $rows;//Array ([url] => localhost/bit001 ) 
		}
	}

//------------------我是一条华丽的分割线---//更新数据------------------
	function upData($arg1,$arg2,$arg3,$arg4,$arg5='#',$arg6='#',$arg7='#')
	{
		if($arg5!='#' && $arg6 != '#')
		{
			$this->dbname = $arg5;
			$this->table_name = $arg6;

		}
		$col = $arg1;
		$up_val = $arg2;

		$col_key = $arg3;
		$val = $arg4;

		$conn = $this->connectMysql();
		$conn->select_db($this->dbname);

		$sql_up = "UPDATE $this->table_name SET $col=\"$up_val\" WHERE $col_key=\"$val\"";
		if($arg7!='#')
		{
			$sql_up = $arg7;
		}

		$conn->query($sql_up);

		if($conn->error)
		{
			echo $conn->error;
			return false;
		}
		else
		{
			return true;
		}
	}

//------------------我是一条华丽的分割线---//删除数据------------------
	function deleteData($arg1,$arg2,$arg3='#',$arg4='#',$arg5='#')
	{
		if($arg3!='#' && $arg4!='#')
		{
			$this->dbname = $arg3;
			$this->table_name = $arg4;
		}
		$col_key = $arg1;
		$val = $arg2;

		$conn=$this->connectMysql();
		$conn->select_db($this->dbname);

		$sql_del = "DELETE FROM $this->table_name WHERE $col_key=\"$val\"";
		if($arg5!='#')
		{
			$sql_del = $arg5;
		}

		$conn->query($sql_del);

		if($conn->error)
		{
			echo $conn->error;
			return false;
		}
		else
		{
			return true;
		}
	}

//------------------我是一条华丽的分割线---//显示数据表------------------

	function showTable($arg1='#')
	{
		if($arg1!='#')
		{
			$this->dbname = $arg1;
		}
		
		$conn = $this->connectMysql();
		$conn->select_db($this->dbname);

		$sql_st = "SHOW TABLES";

		
		$result = $conn->query($sql_st);
		$rows = $result->fetch_all(MYSQLI_NUM);
	
		for($i=0;$i<count($rows);$i++)
		{
			$rows[$i] = $rows[$i][0];
		}
		
		//print_r($rows);
		if($conn->error)
		{
			echo $conn->error;
			return false;
		}
		else
		{
			return $rows;//Array ( [0] => coser [1] => fgg )
		}
	}



}

//------------------我是一条华丽的分割线---//以下为运行代码------------------
/*
$x = new ToMysql("localhost","root","");
$x->createDataBase("cao");
$x->createTable("fuck","cao");

$x->insertData("fuck|your|mother","cao","fuck");
$x->insertData("fuck|your|mother","cao","fuck");
$x->insertData("fuck|your|mother","cao","fuck");
$x->insertData("fuck|your|mother","cao","fuck");

print_r($x->getData("origin","id","8"));
*/
?>