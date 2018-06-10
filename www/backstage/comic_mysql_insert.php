<?php
//-------重写ToMySql()类------
class ComicCatgoryToMysql extends ToMySql
{
	//temp---
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
		title_en INT(500) PRIMARY KEY,
		title_or VARCHAR(500),
		title_zh VARCHAR(500),
		main_path VARCHAR(500) NOT NULL,
		show_path VARCHAR(500) NOT NULL,
		author VARCHAR(500) NOT NULL,
		uploader VARCHAR(500) NOT NULL,
		company VARCHAR(500) NOT NULL,
		country VARCHAR(500) NOT NULL,
		start_year VARCHAR(500) NOT NULL,
		end_year VARCHAR(500),
		status VARCHAR(500) NOT NULL,
		modify VARCHAR(500),
		type01 VARCHAR(500) NOT NULL,
		type02 VARCHAR(500) NOT NULL,
		type02 VARCHAR(500) NOT NULL,
		details VARCHAR(800) NOT NULL,
		data TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
}

//---------------times--------------------
class ComicTimesToMysql extends ToMySql
{
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
		id INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		title_en VARCHAR(500) NOT NULL,
		time_en VARCHAR(500) NOT NULL,
		time_zh VARCHAR(500) NOT NULL,
		time_path  VARCHAR(500) NOT NULL,
		data TIMESTAMP NOT NULL DEFAULT 
		CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
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
}

//----------------------------
function comicMysqlInsert()
{
	//
}
?>