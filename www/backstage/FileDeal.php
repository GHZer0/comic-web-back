<?php
class FileDeal
{
	var $get_path;//  /#/@@/$$$
	var $get_name;// name  (/#/@@/$$$/$get_name)
	var $get_list;
	var $folder_list;
	var $file_list;
	var $ext_list;
	//var $file_ext_list;//2维列表

//------------------------我是一条华丽的分割线----------------------------------------------
	function __construct($arg1,$arg2=false)
	{
		$this->get_path = $arg1;
		$this->get_name = $arg2;

		$this->get_list = array();
		$this->file_list = array();
		$this->folder_list = array();
		$this->ext_list = array();

		if(!file_exists($this->get_path))
		{
			die("Not such dir or file");
		}
	}

//------------------------我是一条华丽的分割线-------创建文件夹-----------------------------

	function makeDir($arg1 = '#')
	{
		if($arg1 != '#')
		{
			$this->get_path = $arg1;
		}
		else
		{}

		$test_file = file_exists($this->get_path);
		$test_folder = is_dir($this->get_path);
		
		if($test_file && $test_folder)
		{
			return true;
		}
		else
		{
			$x = mkdir($this->get_path,0777,true);
			return $x;//ture:false
		}
	}

//------------------------我是一条华丽的分割线-------得到当前目录文件夹列表，文件列表-----------------------------
	
	function addList($arg1 = '#')
	{
		$this->folder_list = array();
		$this->file_list = array();
		$this->ext_list = array();
		
		if($arg1 != '#')
		{

			if(!file_exists($arg1))
			{
				return false;
			}
			else
			{
				$this->get_path = $arg1;
			}
		}
		else
		{
		}

		$this->get_list = scandir($this->get_path,0);
		natsort($this->get_list);
		$this->get_list = array_values($this->get_list);

		//print_r($this->get_list);
		//echo '<br/>';

		$count_get_list = count($this->get_list);

		for($i = 0;$i<$count_get_list;$i++)
		{
			$name = $this->get_list[$i];
			$full_path = $this->get_path.'/'.$name;

			$tmp = explode(".",$name);
			$ext = strtolower(end($tmp));
			

			if(is_dir($full_path) && $name!='.' && $name!='..')
			{
				array_push($this->folder_list,$name);
				//sort($this->folder_list);
			}
			else if(is_file($full_path) && $name!='.' && $name!='..')
			{
				array_push($this->file_list,$name);
				array_push($this->ext_list,$ext);
				//sort($this->file_list);
				
			}
			else
			{}
		}

		natsort($this->folder_list);
		natsort($this->file_list);

		$this->ext_list = array_unique($this->ext_list);
		$this->ext_list = array_flip($this->ext_list);
		foreach($this->ext_list as $key=>$value)
		{
			$this->ext_list[$key] = 0;
		}



		/*
		print_r($this->folder_list);
		echo "<br/>";
		print_r($this->file_list);
		echo "<br/>";
		print_r($this->ext_list);
		*/

		return true;
	}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	function addFolderList($arg1 = '#')
	{
		$this->folder_list = array();

		if($arg1 != '#')
		{

			if(!file_exists($arg1))
			{
				return false;
			}
			else
			{
				$this->get_path = $arg1;
			}
		}

		$this->get_list = scandir($this->get_path,0);
		natsort($this->get_list);
		$this->get_list = array_values($this->get_list);

		$count_get_list = count($this->get_list);
		

		for($i = 0;$i<$count_get_list;$i++)
		{
			$name = $this->get_list[$i];
			$full_path = $this->get_path.'/'.$name;

			//$tmp = explode(".",$name);
			//$ext = strtolower(end($tmp));
			

			if(is_dir($full_path) && $name!='.' && $name!='..')
			{
				array_push($this->folder_list,$name);
				//sort($this->folder_list);
			}
		}

		natsort($this->folder_list);
		return $this->folder_list;
		//print_r($this->folder_list);
	}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	function addFileList($arg1 = '#')
	{
		$this->file_list = array();

		if($arg1 != '#')
		{

			if(!file_exists($arg1))
			{
				return false;
			}
			else
			{
				$this->get_path = $arg1;
			}
		}

		$this->get_list = scandir($this->get_path,0);
		natsort($this->get_list);
		//print_r($this->get_list);
		$this->get_list = array_values($this->get_list);


		$count_get_list = count($this->get_list);
		

		for($i = 0;$i<$count_get_list;$i++)
		{
			$name = $this->get_list[$i];
			$full_path = $this->get_path.'/'.$name;

			//$tmp = explode(".",$name);
			//$ext = strtolower(end($tmp));
			

			if(is_file($full_path) && $name!='.' && $name!='..')
			{
				array_push($this->file_list,$name);
				//sort($this->file_list);
			}
		}

		natsort($this->file_list);
		return $this->file_list;
		//print_r($this->file_list);
	}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
	function addExtList($arg2=0,$arg1 = '#')
	{
		$this->ext_list = array();

		if($arg1 != '#')
		{
			if(!file_exists($arg1))
			{
				return false;
			}
			else
			{
				$file_list = $this->addFileList($arg1);
			}
		}
		else
		{
			$file_list = $this->addFileList();
		}

		$count_file_list = count($file_list);

		for($i=0;$i<$count_file_list;$i++)
		{
			$tmp = explode('.',$file_list[$i]);
			$ext = strtolower(end($tmp));

			array_push($this->ext_list,$ext);
		}

		$this->ext_list = array_unique($this->ext_list);

		$this->ext_list = array_flip($this->ext_list);

		foreach($this->ext_list as $key=>$value)
		{
			$this->ext_list[$key] = $arg2;
		}

		return $this->ext_list;

		//print_r($this->ext_list);

	}

//------------------------我是一条华丽的分割线-------解包-----------------------------
	
	function unpackBag($arg1 = '#',$arg2 = '#')
	{
		if($arg1 != '#')
		{
			if(!file_exists($arg1))
			{
				die("Not such dir or file from unpackBag()");
			}
			else
			{
				$this->addFileList($arg1);
			}
		}
		else
		{
			$this->addFileList();
		}
		if($arg2 != '#')
		{
		  $bag_list = array($arg2);	
		}
		else
		{
			$bag_list = $this->file_list;
		}

		$count_bag_list = count($bag_list);

		for($i = 0;$i<$count_bag_list;$i++)
		{
			$x = explode('.',$bag_list[$i]);
			$ext = end($x);
			$ext = strtolower($ext);
			if($arg2 != '#')
			{
				$full_path = $arg2;
				if(!file_exists($arg2) || !is_file($arg2))
				{
					echo "<br>unpackBag() Line:312 false";
					return false;
				}else{}
				
			}
			else
			{

				$full_path = $this->get_path.'/'.$bag_list[$i];
			}

			if($ext == 'zip')
			{
				return exec("sudo 7z x ".$full_path." -o".$this->get_path);
				//echo "I am zip(From FileDeal) : $full_path<br/><br/>";
			}
			else if($ext == 'rar')
			{
				return exec("sudo 7z x ".$full_path." -o".$this->get_path);
				//echo "I am rar(From FileDeal) : $full_path<br/><br/>";
			}
			else if($ext == '7z')
			{
				return exec("sudo 7z x ".$full_path." -o".$this->get_path);
				//echo "I am 7z(From FileDeal) : $full_path<br/><br/>";
			}
			else if($ext == 'tar')
			{
				return exec("sudo 7z x ".$full_path." -o".$this->get_path);
				//echo "I am tar(From FileDeal) : $full_path<br/><br/>";
			}
			else
			{
				//echo "I am not in need <br/>";
				return false;
			}
		}
	}


//------------------------我是一条华丽的分割线-------重命名当前目录文件夹-----------------------------
	
	function renameDir($arg2 = '',$arg3 = '',$arg4=0,$arg1 = '#')
	{
		

		if($arg1 != '#')
		{
			
			if(!file_exists($arg1))
			{
				die("Not such dir or file from renameDir()");
			}
			else
			{
				$this->addFolderList($arg1);
			}

		}
		else
		{
			$this->addFolderList();
		}
		$folder_list = $this->folder_list;
		//$file_list = $this->file_list;

		$count_folder_list = count($folder_list);
		$count_dir = $arg4+1;

		for($i = 0;$i<$count_folder_list;$i++)
		{
			
			//$count_dir = $i+1;

			$old_name = $this->get_path.'/'.$folder_list[$i];


			$new_name = $this->get_path.'/'.$arg2."$count_dir".$arg3;

			if(!file_exists($new_name) && $old_name != $new_name )
			{
				rename($old_name,$new_name);
			}

			$count_dir++;
		}

		//unset($this->file_list);
		//unset($this->folder_list);
		return $this->get_path.'/'.$arg2."$count_dir".$arg3;//是否修改count

	}

//------------------------我是一条华丽的分割线-------重命名当前目录文件-----------------------------
	
	function renameFile($arg2 = '',$arg4 = '',$arg5=0,$arg1 = '#',$arg3=false)
	{
		
		if($arg1 != '#')
		{
			if(!file_exists($arg1))
			{
				die("Not such dir or file from renameFile()");
			}
			else
			{
				//$this->addFileList($arg1);
				$this->addExtList($arg5,$arg1);
			}
		}
		else
		{
			//$this->addFileList();
			$this->addExtList($arg5);
		}

		//$folder_list = $this->folder_list;
		$file_list = $this->file_list;
		$ext_list = $this->ext_list;

		$count_file_list = count($file_list);

		for($i = 0;$i<$count_file_list;$i++)
		{
			$tmp = explode(".",$file_list[$i]);
			$ext_origin = end($tmp);
			$ext = strtolower(end($tmp));

			$old_name = $this->get_path.'/'.$file_list[$i];


			$new_name = $this->get_path.'/'.$arg2.($ext_list[$ext]+1).$arg4.'.'.$ext;


			if($arg3 == false)
			{
				if(!file_exists($new_name) && $old_name!=$new_name)
				{
					rename($old_name,$new_name);
				}
			}
			
			else if($arg3 == true)
			{
				rename($old_name,$new_name);
			}
			


			$ext_list[$ext] +=1;
			
		}

		//unset($this->file_list);
		//unset($this->folder_list);
		//$this->renameFile();
		return $this->get_path.'/'.$arg2.($ext_list[$ext]+1).$arg4.'.'.$ext;//(count_file)
	}


//------------------------我是一条华丽的分割线-------删除整个目录下所有文件-----------------------------
	function deletFile($arg2 = '#')
	{

		if($arg2 != '#')
		{
			if(!file_exists($arg2))
			{
				die("Path is incorrect from deletFile()");
			}
			else
			{
				$file_list = $this->addFileList($arg2);
			}
		}
		else
		{
			$file_list = $this->addFileList();
		}

		$count_file_list = count($file_list);

		for($i=0;$i<$count_file_list;$i++)
		{
			$full_path = $this->get_path.'/'.$file_list[$i];
			unlink($full_path);
		}
		
	}

//------------------------我是一条华丽的分割线-------移除整个目录-----------------------------

	function deleteDir($arg2,$arg1=false)
	{
		
		if($arg1 == false)
		{
			if(!file_exists($arg2))
			{
				die('Incorrect Path form deldctDir()');
			}
			else
			{
				rmdir($arg2);
			}
		}

   //以下为linux命令行移除，mv至tmep目录，rm下不了手
		else if($arg1 == true)
		{

			if(!file_exists("./del_tmp"))
			{
				mkdir("./del_tmp");
			}else{}

			if(!file_exists($arg2))
			{
				die('Incorrect Path form deldctDir()');
			}
			else
			{
				
				$tmp = explode(" ",$arg2);
				if(count($tmp)>1)
				{
					die("Path Too more space");
					return false;
				}
				
				//print_r($this_dir);
				//以下liunx命令
				$commd = 'mv -f  ';//!!!!!!!!!!!!!!!!!!!
				$del_tmp = "./del_tmp";

				$important_command = $commd.$arg2." ".$del_tmp;
				exec("sudo ".$important_command);

				$important_rm = "rm -rf ".$del_tmp;

				if($important_rm == "rm -rf ./del_tmp")
				{
					exec("sudo ".$important_rm);
				}
				else
				{
					die("rm command have some problem");
				}
			}
		}
		else
		{}
		

	
	}

//------------------------我是一条华丽的分割线------------------------------------

}

//------------------------------------------------------------
//小心

//$x = new FileDeal("D:/Desktop/llf");
//$x->renameFile();
/*
print_r($x->addFolderList());
echo "<br/>";
print_r($x->addFileList());
echo "<br/>";
print_r($x->addExtList(1));
*/
/*
$x->renameDir('_','',2);//1时计数值从2开始
$x->renameFile('','',2);//2时从3开始
*/
/*
$fuck = $x->addFolderList();
print_r($fuck);
echo "<br/>";
echo "<br/>";
$bitch = $x->addFileList();
echo "<br/>";
*/

//print_r($x->addFolderList("D:/Desktop/llf"));
//echo "<br><br>";
//print_r($x->addFileList("D:/Desktop/llf"));
//echo "<br><br>";
//print_r($x->addExtList("D:/Desktop/llf"));
//echo "<br><br>";
//$x->deletFile("D:/Desktop/llf");
//$x->deletDir("D:/Desktop/llf",true);

?>