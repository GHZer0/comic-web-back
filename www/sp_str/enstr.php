<?php

  class FuckStr 
  {
	  

	  private function fuck()
	  {
		  $bitch_str = "*******";
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

?>