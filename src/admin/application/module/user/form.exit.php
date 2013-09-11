<div id="FormExit">
	<a href="/user.html"><?php echo $arWords['user_private_cab'];?></a>
    <a href="#" id="UserExitBtn"><?php echo $arWords['user_exit_btn'];?></a>
</div>
<a class="UserImFavoritesId" href="/user/1favorit.html" alt="<?php echo $arWords['user_favorits'];?>" title="<?php echo $arWords['user_favorits'];?>"><?php echo $arWords['user_favorits'];?> <span id="UserImFavoritesId"></span></a>	

<script type="text/javascript">
$(document).ready(function(){
	//
	$('#UserImFavoritesId').load('/application/module/user/template.data.retention.php?retention=GetImFavoritesCount');
	
	  var optionsExitUser = { 
			target: "#FormExit",
			url:'/application/module/user/form.exit.validator.php',
			success: RequeryUserExit
		  };					   
	
	//  запуск аякса для добавления   
		$('#UserExitBtn').bind("click", function(){
		  $('#FormExit').ajaxSubmit(optionsExitUser); 
		return false;
		});
		
		// вызов после получения ответа 
		function showResponse(responseText, statusText)  { 
			if(responseText == '<?php echo $arWords["user_add_ok"];?>')
		 	{
				$("#loading").ajaxStart(function(){
  				$(this).show();});
				$('#UserLogoListRequery').load('/application/module/user/template.requery.list.logo.php');
				$("#loading").ajaxComplete(function(){
  				$(this).hide();});
				$('#DivFormAddLogo').hide();
			}
			return;
		}

		function RequeryUserExit()
		{
			window.location = "/index.html"; 
		}
		
});
</script>

