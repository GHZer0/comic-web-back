<?php
//--------------------我是一条华丽的分割线------文件处理者--------------
class FileHandler
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

	function __construct($arg1)
	{
		$this->file_var = $_FILES[$arg1];

		$this->file_name = $this->file_var['name'];
		$this->file_type = $this->file_var['type'];
        $this->file_size = $this->file_var['size'];
        $this->file_tmp = $this->file_var['tmp_name'];
        
        $this->file_error = $this->file_var['error'];

        $this->image_file = array('gif','jpeg','jpg','png');
        $this->compress_file = array('zip','7z','tar','rar');//
        $this->mp4_file = array('mp4');


	}
//--------------------我是一条华丽的分割线------错误捕捉---------------------------

    private function errorHandler()//need????
    {
        if($this->file_error > 0)
        {
            echo "Up Load Error Code:"."[".$this->file_error."]";
            return false;
        }
    }
//--------------------我是一条华丽的分割线------捕捉后缀名---------------------------

    function getExtension()
    {
        if($this->file_error > 0)
        {
            die("File Error:".$this->file_error);
        }

        $ext = explode('.',$this->file_name);
		$ext = end($ext);
        $ext = strtolower($ext);
        return $ext;
    }
//--------------------我是一条华丽的分割线------判断文件是否合法---------------------------

    private function whatFile()
    {
        if($this->file_error > 0)
        {
            
			die("File Error:".$this->file_error);
        }


        $ext = $this->getExtension();
        
        if(
            $this->file_type == "image/gif"
          ||$this->file_type == "image/jpeg"
          ||$this->file_type == "image/jpg"
          ||$this->file_type == "image/pjpeg"
          ||$this->file_type == "image/x-png"
          ||$this->file_type == "image/png"
          &&  in_array($ext,$this->image_file)
          )
        {
              return 'image';
        }

        else if(
                $this->file_type == "application/octet-stream"
              ||$this->file_type == "application/x-zip-compressed"
              &&  in_array($ext,$this->compress_file)
            )
              {
                  /*
				  if($ext == '7z')
                  {
                      return '7z';
                  }
                  else if($ext == 'zip')
                  {
                      return 'zip';
                  }
                  else if($ext == 'rar')
                  {
                      return 'rar';
                  }
                  else if($ext == 'tar')
                  {
                      return 'tar';
                  }
				  */
				  return "compress";
              }
		else if(
				$this->file_type == 'video/mp4'
			  &&  in_array($ext,$this->mp4_file)
			)
			{
				  return 'mp4';
			}
		else 
		{
			return false;
		}

    }
//--------------------我是一条华丽的分割线------计算文件MD5值---------------------------

	function tmpFileMd5()
	{
		return md5_file($this->file_tmp);
	}

//--------------------我是一条华丽的分割线------储存文件---------------------------
//php默认对文件有限制

	function saveFile($arg1,$arg2,$arg3=1000000000,$arg4='#',$arg5=false)
	{
		$sort = $arg1;
		$save_path = $arg2.'/';
		$max_size = $arg3;

		$what_file = $this->whatFile();

		if($arg4 == '#')
		{
			$this->file_name = $this->tmpFileMd5().".".$this->getExtension();
		}
		else
		{
			$this->file_name = $arg4.".".$this->getExtension();
		}


		if($sort == $what_file && $this->file_size <= $max_size)
		{
			if($arg5 == false)
			{
				if(file_exists($save_path.$this->file_name))
				{
					echo "file is already exists";
					return $save_path.$this->file_name;
				}
				else //if($sort == $what_file && $this->file_size <= $max_size)
				{
					move_uploaded_file($this->file_tmp,$save_path.$this->file_name);
					return $save_path.$this->file_name;
				}
			}
			else if($arg5 == true)
			{
				move_uploaded_file($this->file_tmp,$save_path.$this->file_name);
				return $save_path.$this->file_name;
			}
		}
		else
		{
			echo "upload have some error,type is not true.<br/>"."<br/>File:$this->file_name<br/>Path:$save_path";
			return false;
		}
		
	}

//--------------------我是一条华丽的分割线------demo---------------------------


//--------------------我是一条华丽的分割线------demo---------------------------
/*
	function demo() // 
	{
		echo $this->saveFile('compress','./compressed/',100000000,'fuck.zip');

	}
*/

}
//---------------------------------------------------------------------------------------------------------------


?>