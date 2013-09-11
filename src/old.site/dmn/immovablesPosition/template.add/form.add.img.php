<?php
	if(empty($_POST['cp_id'])) $_POST['cp_id'] = $_GET['cp_id'];
?>
<script type="text/javascript">
$(document).ready(function(){

	  var new_position = <?php  if(isset($_GET['new_position'])) echo "true"; else echo "false";?>;

	  if(new_position)
	  {
		  var optionsAddImg = { 
					target: "#DivRequestImg",
					url:'template.data.retention.php',
					success: afterAjaxNew,
					beforeSubmit: showRequest
				  };	
	  }
	  else
	  {
		  var optionsAddImg = { 
				target: "#DivRequestImg",
				url:'template.data.retention.php',
				success: afterAjax
			  };					   
	  }
	  
	//  запуск аякса для добавления   
		$('#submitImg').bind("click", function(){
		  $('#FormAddImg').ajaxSubmit(optionsAddImg); 
		return false;
		});
		
		function afterAjax()
		{
			$.prompt('Изображения товара добавлено.');
			$('#DivRequestImg').load('template.load.php?print=list_img&cp_id=<?php echo $_POST['cp_id'];?>');
		}

		function afterAjaxNew()
		{
			$.prompt('Изображения товара добавлено.');
			return true;
		}
		
		function showRequest(formData, jqForm, options) { 
			var value = $("#FormAddImg :images").fieldValue();
			if(value[0] == '')
			{
				$.prompt('Выберите изображение для загрузки!');
				return false; 
			}
			else return true; 
		} 
		
		
});
</script>

<form  id="FormAddImg" action="" method="post">
  <fieldset>
    <b>Добавление изображения</b><br>
    <label>Изображение</label>
    <input type="file" name="images" />
    <input type="hidden" name="cp_id" value="<?php echo $_POST['cp_id'];?>" />
    <input type="hidden" name="retention" value="add_img" />
    <input id="submitImg" value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
  </fieldset>
</form>
