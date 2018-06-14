
//前缀选择显示
/*
$(document).ready(function(){
  $("[name='sp']").change(function(){
  var sp = $(this).val();
  
  if(sp == "true")
  {
	  $("#up_before").css("visibility","visible");
  }
  else 
  {
	  $("#up_before").css("visibility","hidden");
  }
	
  });
}
);
*/
//json
/*
$(document).ready(function(){
  $("#up_submit").click(function(){
	var title_or_0 = $("[name='title_or']").val();
	var title_zh_0 = $("[name='title_zh']").val();
	var title_en_0 = $("[name='title_en']").val();
	var sp_0 = $("[name='sp']").val();
	var before_0 = $("[name='before']").val();
	var after_0 = $("[name='after']").val();
	var start_num_0 = $("[name='start_num']").val();
	var all_num_0 = $("[name='all_num']").val();
	var author_0 = $("[name='author']").val();
	var company_0 = $("[name='company']").val();
	var country_0  = $("[name='country']").val();
	var start_year_0 = $("[name='start_year']").val();
	var end_year_0 = $("[name='end_year']").val();
	var status_0 = $("[name='status']").val();
	var modify_0 = $("[name='modify']").val();
	var type01_0 = $("[name='type01']").val();
	var type02_0 = $("[name='type02']").val();
	var type03_0 = $("[name='type03']").val();
	var details_0 = $("[name='details']").val();
	var up_need_json = {
						"title_or" : title_or_0, 
						"title_zh" : title_zh_0, 
						"title_en" : title_en_0,
						"sp" : sp_0,
						"before" : before_0,
						"after" : after_0,
						"start_num" : start_num_0,
						"all_num" : all_num_0, 
						"author" : author_0,
						"company" : company_0, 
						"country" : country_0,
						"start_year" : start_year_0,
						"end_year" : end_year_0, 
						"status" : status_0, 
						"modify" : modify_0,
						"type01" : type01_0,
						"type02" : type02_0,
						"type03" : type03_0,
						"details" : details_0
					} ;
	alert(up_need_json);

	$.post("./backstage/demo.php",{info:up_need_json},function(data,status){alert(data+":"+status);});

  });
}
);*/