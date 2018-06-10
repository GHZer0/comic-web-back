<?php
class EncodeTo
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

	//str or file_path,str_file
	function __construct($arg1,$arg2 = false,$arg3 = "UTF-8")
	{
		$this->my_encode = $arg3;

		if($arg2 === false)
		{
			$this->str = $arg1;
		}
		else if($arg2 === true)
		{
			$this->file_path = $arg1;
			if(file_exists($this->file_path === false) || is_file($this->file_path) === false)//---------- 
			{
				die("file not exists in EncodeToUTF8");
			}
			else
			{}
			$this->str = file_get_contents($this->file_path);
		}

		
		if(!is_bool($arg2))
		{
			die("str_file will not bool");
		}
		else
		{}
		
		$this->str_file = $arg2;
		$this->encode_array = array("ASCII",'UTF-8',"GB2312","GBK",'BIG5',
			"UCS-4",
			"UCS-4BE",
			"UCS-4LE",
			"UCS-2",
			"UCS-2BE",
			"UCS-2LE",
			"UTF-32",
			"UTF-32BE",
			"UTF-32LE",
			"UTF-16",
			"UTF-16BE",
			"UTF-16LE",
			"UTF-7",
			"UTF7-IMAP",
			"UTF-8",
			"ASCII",
			"EUC-JP",
			"SJIS",
			"eucJP-win",
			"SJIS-win",
			"ISO-2022-JP",
			"ISO-2022-JP-MS",
			"CP932",
			"CP51932",
			"SJIS-mac",
			"SJIS-Mobile#DOCOMO",
			"SJIS-Mobile#KDDI",
			"SJIS-Mobile#SOFTBANK",
			"UTF-8-Mobile#DOCOMO",
			"UTF-8-Mobile#KDDI-A",
			"UTF-8-Mobile#KDDI-B",
			"UTF-8-Mobile#SOFTBANK",
			"ISO-2022-JP-MOBILE#KDDI",
			"JIS",
			"JIS-ms",
			"CP50220",
			"CP50220raw",
			"CP50221",
			"CP50222",
			"ISO-8859-1",
			"ISO-8859-2",
			"ISO-8859-3",
			"ISO-8859-4",
			"ISO-8859-5",
			"ISO-8859-6",
			"ISO-8859-7",
			"ISO-8859-8",
			"ISO-8859-9",
			"ISO-8859-10",
			"ISO-8859-13",
			"ISO-8859-14",
			"ISO-8859-15",
			"ISO-8859-16",
			"byte2be",
			"byte2le",
			"byte4be",
			"byte4le",
			"BASE64",
			"HTML-ENTITIES",
			"7bit",
			"8bit",
			"EUC-CN",
			"CP936",
			"GB18030",
			"HZ",
			"EUC-TW",
			"CP950",
			"BIG-5",
			"EUC-KR",
			"UHC",
			"ISO-2022-KR",
			"Windows-1251",
			"Windows-1252",
			"CP866",
			"KOI8-R",
			"KOI8-U",
			"ArmSCII-8"	
		);
	}
//---------------------Encode转换输出str-----------------------
	//html_sp,str or file_path
	function changeEncode($arg2 = false,$arg1 = false)
	{
				
		$this->html_sp = $arg2;
		if(!is_bool($this->html_sp))
		{
			die("in changeEncode ,second is not bool");
		}
		else
		{}
		
		if($arg1 === false)
		{}
		else
		{
			if($this->str_file === false)
			{
				if($arg1 !== $this->str)
				{
					$this->str = $arg1;
				}
				else
				{}
			}
			else if($this->str_file === true)
			{

				if($this->file_path !== $arg1 && $arg1 !== false)
				{
					$this->file_path = $arg1;
					if(file_exists($this->file_path) == false || is_file($this->file_path) === false)  //-------------------------
					{
						die("file not exists in changeEncode");
					}
					else
					{}
					$this->str = file_get_contents($this->file_path);
				}
				else
				{}
			}
		}
		$this->encode_type = mb_detect_encoding($this->str,$this->encode_array);
		//echo $this->encode_type;
		//echo "<br>-----------------------------<br>";
		$this->content = mb_convert_encoding($this->str,$this->my_encode,$this->encode_type);

		$this->after_encode_type = mb_detect_encoding($this->content,$this->encode_array);
		//echo $this->after_encode_type;
		//echo "<br>";
		//echo $this->content."line165<br>";

		if($this->html_sp === false)
		{
			return $this->content;
		}
		else if($this->html_sp === true)
		{
			return htmlspecialchars($this->content);
		}
		else
		{
			die("No conten return from changeEncode");
		}
	}
//--------------文件写入函数-------------------------
	// $new file name,html_sp
	function writeEncodeFile($arg1 = false,$arg2 = "")
	{
		//echo $this->file_path;
		$new_file_path = "";

		if($this->str_file === false && $arg2 === "")
		{
			die("You inter a str with no file to save");
		}
		else if($this->str_file === false && $arg2 !== "")
		{
			$new_file_path = $arg2;
		}

		else if($this->str_file === true)
		{
			if($arg2 === "")
			{
				$new_file_path = $this->file_path;
			}
			else
			{
				$new_file_path = $arg2;
			}
		}


		$this->content = $this->changeEncode($arg1);


		file_put_contents($new_file_path,$this->content);

		return $new_file_path;
	}
//-----------------返回原文编码类型----------------------
	function returnOrEncode()
	{
		return $this->encode_type;
	}
//-----------------返回转码后编码类型-------------------
	function returnAfterEncode()
	{
		return $this->after_encode_type;
	}

}
/*
$fuck = new EncodeTo("./sabi.txt",true);
$fuck->writeEncodeFile(false,"./sabi_new.txt");

echo file_get_contents("./sabi.txt");
echo "----------------------------<br>";
echo file_get_contents("./sabi_new.txt");

$moto_encode = $fuck->returnOrEncode();
$after_encode = $fuck->returnAfterEncode();

$bitch = new EncodeTo("./sabi_new.txt",true,$moto_encode);
$bitch->writeEncodeFile(false,"./sabi_new_back.txt");

echo "<br>-----------------------<br>";
echo file_get_contents("./sabi_new_back.txt");
*/
$bitch = new EncodeTo("D:/Zesty5/php/wampse/www",false);
$bitch->writeEncodeFile(true);
echo file_get_contents("./element.fuckyou");

?>