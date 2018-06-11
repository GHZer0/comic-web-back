<?php
//基础数据统计
echo "基础数据：<br/>";
echo "title_or : $title_or <br>";
echo "title_zh : $title_zh <br>";
echo "title_en : $title_en <br>";

echo "sp : ";print_r($sp);echo "<br>";
echo "before : $before <br>";

echo "after : $after <br>";
echo "start_num : $start_num <br>";
echo "all_num : $all_num <br>";

echo "author : $author <br>"; 
echo "uploader ；$author <br>";

echo "company : $company <br>";
echo "country : $country <br>";
echo "start_year : $start_year <br>";

echo "end_year : $end_year <br>";
echo "status : ";print_r($status);echo "<br>";

echo "modify : $modify <br>";
echo "type01 : $type01 <br>";
echo "type02 : $type02 <br>";
echo "type03 : $type03 <br>";
echo "details : $details <br>";

echo "show : $show <br>";
echo "main_file : $main_file <br>";

echo "show_name : $show_name <br>";
echo "show_type : $show_type <br>";
echo "show_size : $show_size <br>";
echo "show_tmp_name : $show_tmp_name <br>";
echo "show_error : $show_error <br>";//**
echo "show_md5 : $show_md5 <br>";

echo "main_file_name : $main_file_name <br>";
echo "main_file_type : $main_file_type <br>";
echo "main_file_size : $mian_file_size <br>";
echo "main_file_tmp_name : $main_file_tmp_name <br>";
echo "main_file_error : $main_file_error <br>";//**
echo "main_file_md5 : $main_file_md5 <br>";

echo "Path data:<br>";
echo "base_path : $base_path <br>";
echo "show_store_path : $show_store_path <br>";
echo "main_file_store";print_r($main_file_store_path);echo "<br>";

//result

基础数据：
title_or : fuck
title_zh : fuck
title_en : fuck
sp : true
before :
after : hua
start_num : 1
all_num : 3
author : fuck
uploader ；fuck
company : fuck
country : jp
start_year : 1999
end_year : 2008
status : end
modify : fuck
type01 : 2
type02 : 2
type03 : 2
details : fuckfuckfuck
show : show
main_file : main_file
show_name : 1.jpg
show_type : image/jpeg
show_size : 202951
show_tmp_name : /tmp/phpY5Pqwy
show_error : 0
show_md5 :
main_file_name : Testfile.zip
main_file_type : application/x-zip-compressed
main_file_size :
main_file_tmp_name : /tmp/php2uAo80
main_file_error : 0
main_file_md5 :
Path data:
base_path : /comic_store/fuck
show_store_path : /comic_store/fuck/fuck.jpg
main_file_storeArray ( [0] => /comic_store/fuck/_1_hua [1] => /comic_store/fuck/_2_hua [2] => /comic_store/fuck/_3_hua ) 

?>