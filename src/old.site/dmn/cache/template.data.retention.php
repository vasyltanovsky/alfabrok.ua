<? // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

  // Подключаем блок авторизации
  require_once("../utils/security_mod.php");
 
  	$json_converter = new Services_JSON();
  	$response = array();
  	$response['success'] = false;
  	$response['fieldErrors'] = array();


	
	
	$is_cache_on = '0';
	if($_POST['is_cache_on']) $is_cache_on = '1';
		
#	редактирование позиции PAGE
	if($_POST['retention'] == 'edit_page')
	{
		//$_POST['description'] = addslashes($_POST['description']);
		//$_POST['summary'] = addslashes($_POST['summary']);
		#	формирование массива для апдейта	
			
			$arr_update 		 = array("is_cache_on" 		=> "{$is_cache_on}");
			
			if($_POST['time_cache']) 
			$arr_update 		 = array("is_cache_on" 		=> "{$is_cache_on},",
										 "time_cache" 		=> "{$_POST[time_cache]}");

	
		#	класс для апдейта
			$cl_page_update  = new mysql_select($tbl_cache_site);
			
			$cl_page_update	->update_table("WHERE cs_id = {$_POST[cs_id]}",
											$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	if($_GET['retention'] == 'edit_cache')
	{
		$is_cache_on = '0';
		$return = "<a onclick=\"getData('../cache/template.data.retention.php?retention=edit_cache&cache=on','#cacheSite','?')\" class=\"aCecheOn\">включить кэширование</a>";
		if($_GET['cache'] == 'on')
		{
			$is_cache_on = '1';
			$return = "<a onclick=\"getData('../cache/template.data.retention.php?retention=edit_cache&cache=off','#cacheSite','?')\" class=\"aCecheOff\">отключить кэширование</a>";
		}
		
			$arr_update 		 = array("is_cache_on" 		=> "{$is_cache_on}");
		#	класс для апдейта
			$cl_page_update  = new mysql_select($tbl_cache_site);
			
			$cl_page_update	->update_table("WHERE cs_id = 1",
											$arr_update);
		
		echo $return; 
	}
?>
