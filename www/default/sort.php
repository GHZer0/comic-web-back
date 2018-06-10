<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <?php include "./include_css.php"; ?>

  <title>Sorts</title>
 </head>
 <body>
 <?php include "./head.php"; ?>

 <div id="sorts" class="row_flex_box sort_sorts">

   <nav id="select" class="sort_select center_text row_flex_box left_text">
     <ul  class="no_list_style full_width relative">
	   <li id="type">类型</li>
       <li id="author">作者</li>
	   <li id="press">出版社</li>
	   <li id="country">国家</li>
	   <li id="year">年份</li>
	   <li id="modify">修改</li>
     </ul>
	</nav>

	<div id="show" class="sort_show left_text">
	  <ul class="no_list_style">
	    <a href="#1" ><li>fuck</li></a>
		<a href="#2" ><li>bitch</li></a>
		<a href="#3" ><li>What a fuck</li></a>
	  </ul>
	  <br/><!--  -->
	</div>

	<div name="sort_sorts_select_page" class="sort_select_page white_back">
	    <button name="first_page" class="page_button cover_pre">首页</button>
        <button name="pre_page" class="page_button cover_pre">上一页</button>

	    <select class="page_button select cover_pre">
	      <option value=""></option>
	      <option value="1">1</option>
	    </select>

	    <button name="next_page" class="page_button cover_pre">下一页</button>
	    <button name="last_page" class="page_button cover_pre">末页</button> 
	</div>
 </div>

 <div id="title" class="sort_sp_width sort_title white_back full_shadow">
   <div name="sort_title_select" class="to_pre_top small_bottom_margin">
	    <button name="title_first_page" class="page_button cover_pre">首页</button>
        <button name="title_pre_page" class="page_button cover_pre">上一页</button>

	    <select class="page_button select cover_pre">
	      <option value=""></option>
	      <option value="1">1</option>
	    </select>

	    <button name="title_next_page" class="page_button cover_pre">下一页</button>
	    <button name="title_last_page" class="page_button cover_pre">末页</button> 
   </div>

   
   <div id="sort_title_show"  class="sort_title_show full_width">
     <ul class="sort_title_ul full_width row_flex_box">
	   <li>
	     <span>
	       <a href="#"><img src="/cat_images/1.jpg" alt="let's fuck"/></a>
		 </span>
		 <span class="left_padding">
		   <a title="let's fuck??????????????????????????????????????????????????????????????????????????????????????????????????????">let's fuck??????????????????????????????????????????????????????????????????????????????????????????????????????</a>
		   <a title="作者">作者</a>
		   <a title="年份">年份</a>
		   <a title="出版社">出版社</a>
		   <a title="国家">国家</a>
		   <a title="修改">修改</a>
		   <a title="状态">状态</a>
		 </span>
	   </li>
	   <li>
	     <span class="left_padding">
	       <a href="#"><img src="/cat_images/2.jpg" alt="let's fuck"/></a>
		 </span>
		 <span class=>
		   <a>let's fuck</a>
		   <a title="作者">作者</a>
		   <a title="年份">年份</a>
		   <a title="出版社">出版社</a>
		   <a title="国家">国家</a>
		   <a title="修改">修改</a>
		   <a title="状态">状态</a>
		 </span>
	   </li>

	 </ul>
   </div>

   <div name="sort_title_select" class="to_last_bottom">
	    <button name="title_first_page" class="page_button cover_pre">首页</button>
        <button name="title_pre_page" class="page_button cover_pre">上一页</button>

	    <select class="page_button select cover_pre">
	      <option value=""></option>
	      <option value="1">1</option>
	    </select>

	    <button name="title_next_page" class="page_button cover_pre">下一页</button>
	    <button name="title_last_page" class="page_button cover_pre">末页</button> 
   </div>
 </div>

 <div id="footer" class="sort_sp_width sort_footer">
 ???????????????????????????????????
 </div>
 



 <?php include "./include_js.php"; ?>
 </body>
</html>
