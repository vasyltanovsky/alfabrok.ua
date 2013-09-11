<?php
	if(empty($_POST['sc_id'])) $_POST['sc_id'] = $_GET['sc_id'];
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
			$('#DivRequestImg').load('template.load.img.php?sc_id=<?php echo $_POST['sc_id'];?>');
		}
		
});
</script>
       
<form  id="FormAddImg" action="" method="post">   
	<fieldset>
    	<label>Изображение</label>
    	<input type="file" name="images" />
        <input type="hidden" name="sc_id" value="<?php echo $_POST['sc_id'];?>" />
        <input type="hidden" name="retention" value="add_img" />
        <input id="submitImg" value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
	</fieldset>
</form>

