<?php
  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';
  
	if(isset($_GET['im_prop_id'])) $ImgPropId = $_GET['im_prop_id'];
	if(isset($_POST['im_prop_id'])) $ImgPropId = $_POST['im_prop_id'];
	
	
?>

   <script type="text/javascript">
	$(document).ready(function(){
		$('#submitDellImg').bind("click", function(){
		  valideDell(); 
		return false;
	  	});
	});	
	//	функция проверки выбран ли пункт для удаления
	function valideDell()
	{
		$.prompt('Вы действительно хотите удалить позицию?',{ callback: mycallbackform, buttons: { Ok: 'dell', Отмена: false  } });
		return false;
	}
	//функция отменяет либо производит удаление позиции
	function mycallbackform(v,m,f){
		if(v == 'dell')
		{
			//$("#loading").ajaxStart(function(){
  			//$(this).show();});
			$('#DivRequestImg').load('template.dell.item.img.php?im_prop_id=<?php echo $ImgPropId;?>');
			//$("#loading").ajaxComplete(function(){
  			//$(this).hide();});
		}
		else
			return false;
	}
	</script>
    
	<div class="eventForm">
       	<a href="#" title="удалить" id="submitDellImg" ><img src="../utils/images/submit/submitDell.png" width="28" height="24" /></a>
   	</div>
    <div id="d-filter">
	<?php
			 echo "<img src=\"../../files/images/prop/{$ImgPropId}.png\">";
	?>
    </div>
        