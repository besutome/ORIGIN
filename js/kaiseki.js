$(function(){
	$(".tab a").click(function(){
		var staff = $(this).attr("class");
		var lis = $("ul.tab li");
		$(".gaityuReportSwitch").css("display","block");
		for(var i=0;lis.length>=i;i++)
		{
			$(lis[i]).attr("class","");
			if($($(lis[i]).children("a")).attr("class") == staff)
			{
				$(lis[i]).attr("class","none");
			}
		}
		var datas = $("div#data div.datas");
		for(var i=0;datas.length>=i;i++)
		{
			$(datas[i]).css("display","block");				
			if(staff != 'allTab' && $(datas[i]).attr("id") != staff)
			{
				$(".gaityuReportSwitch").css("display","none");
				$(datas[i]).css("display","none");
			}
		}
		return false;
	});
	$(".gaityuReportSwitch").click(function(){
		var height = $(document).height();
		var width = $(document).width();
		$("div.fullBlack").css("height",height);
		$("div.fullBlack").css("display","block");
		$("div#kadoReportAll").css("left",(width/2-($("div#kadoReportAll").width()/2)));
		$("div#kadoReportAll").fadeIn("slow");
		return false;
	});
	$("span.close,div.fullBlack").click(function(){
		$("div.fullBlack").css("display","none");
		$("div#kadoReportAll").css("display","none");
		return false;
	});
});
