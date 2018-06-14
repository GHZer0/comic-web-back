<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <?php include "./include_css.php"; ?>
<!-- 提交表单 -->

  <title>UpLoader</title>
 </head>
 <body>
 <?php include "./head.php"; ?>

   <div id="form_post" class="up_form full_shadow out_radius inline-block">
     <form action="./backstage/comic_info_upload.php" method="post" id="main_info" enctype="multipart/form-data">
	   <ul id="file_info"><!-- 上传文件信息 -->
	     <li><span>抬头源:</span><input type="text" name="title_or" placeholder="must"/></li>
	     <li><span>抬头中文:</span><input type="text" name="title_zh" placeholder="must"/></li>
	     <li><span>抬头英文或拼音:</span><input type="text" name="title_en" placeholder="must"/></li>
		 <li>
		   <!-- <span>是否特别</span>
		   <select name="sp">
		     <option selected value="false">否</option>
			 <option value="true">是</option>
		   </select> -->
		 <li  id="up_before"><span>前缀</span>
		   <select name="before">
		     <option selected value="">第</option>
		     <option value="sp">特别篇</option>
			 <option value="extra">番外</option>
		   </select>
		 </li>

		 <li>
		   <span>后缀：</span>
		   <select name="after">
		     <option selected value="hua">话</option>
			 <option value="juan">卷</option>
			 <option value="pian">篇</option>
		   </select>
		 </li>
		 <li>
		   <span>起始话数:</span><input type="number" name="start_num" placeholder="must"/>
		   <span>总数:<span style="color:red;font-size:0.8em;">上传最终话-起始话+1</span></span><input type="number" name="all_num" placeholder="must"/>
		 </li>
		 <li><span>作者:</span><input type="text" name="author" placeholder="must"/></li>
		 <li><span>出版社:</span><input type="text" name="company" placeholder="must"/></li>
		 <li><span>国家:</span>
		   <select name="country">
		     <option value="false">I need some</option>
		     <option value="ch">天朝</option>
		     <option value="jp">霓虹</option>
		     <option value="us">米国</option>
		     <option value="ka">整容专家</option>
		     <option value="other">火星</option>
		   </select>
		 </li>
		 <li>
		   <span>起始年份:</span><input type="number" name="start_year" placeholder="must"/>
		   <span>终止年份:</span><input type="text" name="end_year" placeholder="状态为连载则非必需" style="width:15%;"/>
		 </li>
		 <li>
		   <span>状态</span>
		   <select name="status">
		     <option value="false">I need some</option>、
		     <option value="ing">连载中</option>、
		     <option value="end">完结~</option>
		   </select>
		 </li>
		 <li><span>修改:</span><input type="text" name="modify" placeholder="must"></li>
		 
		 <li>
		   <span title="提示">类型:</span>

		   <select name="type01">
		     <option value="false">I need some</option>
			 <?php include "optgroup.php"; ?>
		   </select>

		   <select name="type02">
		     <option value="false">I need some</option>
			 <?php include "optgroup.php"; ?>
		   </select>

		   <select name="type03">
		     <option value="false">I need some</option>
			 <?php include "optgroup.php"; ?>
		   </select>
		 </li>
	   </ul>
	   <!-- <br/> -->
	   <div>
	     <textarea name="details" placeholder="简介(800字以内)" maxlength="800"></textarea>
	   </div>
<!--  --> 
	 <!-- </form> -->

     <!-- <form action="./backstage/comic_info_upload.php" method="post" id="main_file" enctype="multipart/form-data" class="up_file_form"> -->
	   <ul>
	     <li><span>封面:</span><input type="file" name="show" placeholder="must"></li>
		 <li><span>打包文件:</span><input type="file" name="main_file" placeholder="must"></li>
	   </ul>
	 </form>
    <input type="button" name="submit" id="up_submit" value="Submit" onclick="upSubmit()">
   </div>

   <div id="footer" class="up_footer">   
   </div>


 <!-- <?php include "./include_js.php"; ?> -->
   <script src="/jquery-3.2.1.min.js"></script>
   <script src="/jquery.color-2.1.2.min.js"></script>
   <script src="/upload.js"></script>
<script>
function upSubmit(){  
   var tform2 = document.getElementById("main_info");
   tform2.submit();
}
</script> 
 </body>
</html>
