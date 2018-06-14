<?php

  class FuckStr 
  {
	  
	 
	  var $str;

	  function __construct($arg1)
	  {
		  $this->str = $arg1;
	  }
	  
	  private function fuck()
	  {
		  $bitch_str = $this->str;

		  $x = str_split($bitch_str);
		  array_unshift($x,"ldgjlro;aj;bkj;algjei;oa");//24
		  array_push($x,"uwrokljdfnkzl;w/l.gzsd;olirw");//28
		  $x_str = join("`",$x);
		  $x_str = convert_uuencode($x_str);
		  $x_str = convert_uuencode(bin2hex($x_str));
		  //$x_str = hex2bin($x_str);
		  return $x_str;
		  
	  }

	  private function bitch()
	  {
		  $bitcher = $this->fuck();
		  $bitcher = explode("`",convert_uudecode(hex2bin(convert_uudecode($bitcher))));//list
		  array_splice($bitcher,0,1);
		  array_splice($bitcher,-1,1);
		  $bitcher = join("",$bitcher);//str

		  return $bitcher;

	  }

	  function output()
	  {
		  $fucker = $this->bitch();
		  // print_r($fucker);"<br>";
		  return $fucker;
		  
	  }

  }
/*
  echo "-------------------KVS------------------<br>";
  $data_host = new FuckStr("localhost");
  echo $data_host_kvs = $data_host->output();
  echo "<br>";
  
  $data_base_usr_name = new FuckStr("root");
  echo $data_base_usr_name_kvs = $data_base_usr_name->output();
  echo "<br>";

  $data_base_passwd = new FuckStr("root");
  $data_base_passwd_kvs = $data_base_passwd->output();
  echo "<br>";

  $data_base_name = new FuckStr("comic_store");
  echo $data_base_name_kvs = $data_base_name->output();
  echo "<br>";
  echo "--------------------------------------<br>";
  */
  ?>
