<div id="DivRequestQuery"></div>
<div class="DivFooter">
	&copy; 2010-2012 <?php echo $_SERVER['HTTP_HOST'];?> All rights reserved 
</div>
<script type="text/javascript">
	$(document).ready(function(){
	/*	if($("#4c3eb33182810").attr("checked")){
			$("#4c3eb33182810_f").show();
		}
		if($("#4c3eb33182812").attr("checked")){
			$("#4c496bd58da0d_f").show();
		}*/
		
		$("body").click(function(e){			
			if($(e.target).attr("class") != "SearchFormLabelList" && $(e.target).attr("class") != "DivSearchPosition" 
				//&& $(e.target).attr("id") != "4c3eb33182810"
				&& $(e.target).parent().attr("class") != "DivSearchPosition" 
				&& $(e.target).parent().attr("class") != "SearchFormLabelList"
				&& $(e.target).parent().parent().attr("class") != "DivSearchPosition"
				&& $(e.target).parent().parent().parent().attr("class") != "DivSearchPosition"
				&& $(e.target).parent().parent().attr("class") != "SearchFormLabelList"	
				&& $(e.target).parent().parent().parent().parent().parent().attr("class") != "TableSearchFormTdStandartPropCat"		
				){
				$(".DivSearchPosition").hide();
				$(".TableSearchForm tbody tr:first-child td label span").addClass("ui-icon ui-icon-triangle-1-s");
			}
		});		
	});
</script> 
</body>
</html>