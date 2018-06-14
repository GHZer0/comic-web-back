<?php
function changeStrEncode($str,$my_encode="UTF-8",$html_sp = false)
{
	$encode_array = array("ASCII",'UTF-8',"GB2312","GBK",'BIG5',
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

	$encode_type = mb_detect_encoding($str,$encode_array);

	echo $encode_type."<br>";
	echo $my_encode."<br>";

	$content = mb_convert_encoding($str,$my_encode,$encode_type);

	if($html_sp === false)
	{
		return $content;
	}
	else if($html_sp === true)
	{
		return htmlspecialchars($content);
	}
	else
	{
		return false;
	}
};

$fu = "dsafdsfsdgfsdgdgdgfdfjdsjflkd<>><<>><><sjfsjlf";

$bi = changeStrEncode($fu,"UTF-8",true);
echo $bi."<br>";
?>