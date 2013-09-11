<?php
	if(empty($_POST['id_account'])) $_POST['id_account'] = $_GET['id_account'];
?>

<script type="text/javascript">
$(document).ready(function(){
	  
	  var optionsAddImg = { 
			target: "#DivRequestImg",
			url:'template.data.retention.php',
			success: afterAjax
		  };					   
	
	//  запуск аякса для добавления   
		$('#submitImg').bind("click", function(){
		  $('#FormAddImg').ajaxSubmit(optionsAddImg); 
		return false;
		});
		
		function afterAjax()
		{
			$.prompt('Элемент добавлен.');
			$('#DivRequestImg').load('template.load.img.php?id_account=<?php echo $_POST['id_account'];?>');
		}
		
});
</script>
       
<form  id="FormAddImg" action="" method="post">   
	<fieldset>
    	<label>Фото</label>
    	<input type="file" name="images" />
        <input type="hidden" name="id_account" value="<?php echo $_POST['id_account'];?>" />
        <input type="hidden" name="retention" value="add_img" />
        <input id="submitImg" value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
	</fieldset>
</form>