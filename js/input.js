$(function(){
	$(".plus").click(function(){
		var cloneNo = parseInt($(this).attr("rel"));
		$(this).attr("rel",(cloneNo+1));
		var cloneFrom = $(".cloneArea_"+cloneNo);
		var cloneDoms = cloneFrom.clone();
		cloneDoms.css("display","none");
		cloneDoms.attr("class","cloneArea_"+(cloneNo+1));
		cloneDoms.children("textarea").attr("name","sagyohokokuCopy_"+(cloneNo+1));
		cloneDoms.children("textarea").attr("class","sagyohokokuCopy_"+(cloneNo+1));
		cloneDoms.children("textarea").text('');
		cloneDoms.children("textarea").attr("style","");
		cloneDoms.children("select").attr("name","gyomuitakuStaff_"+(cloneNo+1));
		cloneDoms.children("select").attr("style","");
		cloneFrom.after(cloneDoms);
		cloneFrom.children("textarea").animate({"width":"100px","height":"30px"},"1000",'',function(){
			cloneFrom.children("span.sagyosyaText").remove();
			cloneFrom.children("select").removeAttr("size");
			cloneFrom.children("select").animate({"width":"100px","height":"11px","font-size":"11px"},"1000");
			$(".cloneArea_"+(cloneNo+1)).css("display","block");
		});

	});


});