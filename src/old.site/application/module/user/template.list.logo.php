<script type="text/javascript">
$(document).ready(function(){
	//	подгрузка аяксом списка страниц,(таблица)	
		$("#loading").ajaxStart(function(){
  		$(this).show();});
		$('#UserLogoListRequery').load('application/module/user/template.requery.list.logo.php');
		$("#loading").ajaxComplete(function(){
  		$(this).hide();});
	//	подгрузка дополнительных пунктов подменю в гланое меню	 
		 //$("#pages").append('<a href="pages">pages</a><a href="pages">pages2</a>');
	// ---- Форма -----
	//	опции для добавления нового пункта
		  var optionsAdd = { 
			target: "#UserAddLogoRequery",
			url:'application/module/user/template.add.form.php'
		  };
		  
	//  запуск аякса для добавления   
		$('#submitAdd').bind("click", function(){
		  $('#myForm').ajaxSubmit(optionsAdd); 
		return false;
		});
});
</script>
<div class="DivCenterPage">
    <h1 class="TitleStandartPage"><?php echo $pages->active_page['title']?></h1>
    <?php if($_GET[1]) {echo "<div class=\"DivNavigation\">"; $pages->navigation_string_htaccess(); echo "</div>";} ?>
    
    <table class="TableStandartCenterPage" >
    	<td  class="TSCPTdCenter">
        	<div id="loading"></div>
			<div id="UserAddLogoRequery">
				<?php if(isset($_POST['Submit'])) require_once("template.data.retention.php");?>
			</div>
        	<div id="UserLogoListRequery"></div>
        </td>
		<td  class="TSCPTdRight"><!--<a id="submitAdd" href="#" title="?php echo $arWords['user_add_logo'];?>">?php echo $arWords['user_add_logo'];?></a>--></td>
    	</tr>
	</table>
</div>