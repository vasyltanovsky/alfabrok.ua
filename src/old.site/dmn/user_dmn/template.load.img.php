<?php
  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

	if($_GET['id_account'])
	{
		# 	Получаем содержимое текущей страницы
			$cl_sel_pages = new mysql_select('system_accounts');
			$active_id = $cl_sel_pages -> select_table_id("WHERE id_account = '$_GET[id_account]'");
	}
	
?>

   <script>
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
			$('#DivRequestImg').load('template.dell.position.item.img.php?id_account=<?php echo $active_id['id_account'];?>&photo=<?php echo $active_id['photo'];?>');
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
			 echo "<img src=\"../../files/images/realtor/{$active_id[photo]}\">";
	?>
    </div>
        