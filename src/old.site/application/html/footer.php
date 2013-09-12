<div id="DivRequestQuery"></div>
<div class="DivFooter">
	&copy; 2010-2012 <?php echo $_SERVER['HTTP_HOST'];?> All rights reserved 
</div>
<script type="text/javascript">
	$(document).ready(function(){
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