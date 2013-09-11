<?
  // 
  require_once("../../config/config.php");
  //
  require_once("../utils/security_mod.php");
  //
require_once DOC_ROOT . '/config/class.config.php';
 
  $json_converter = new Services_JSON();
  $response = array();
  $response['success'] = false;
  $response['fieldErrors'] = array();

		$hide =  "hide";
		if($_POST['hide']) $hide = 'show';
		$IsShowIndex = 0;
		if($_POST['is_show_index']) $IsShowIndex = 1;
		
		//$_POST[news_summary] = addslashes($_POST[news_summary]);
		//$_POST[news_description] = addslashes($_POST[news_description]);
#	
	if($_POST['retention'] == 'edit_page')
	{
		#		
			$arr_update 		 = array("news_title" 		=> "'{$_POST[news_title]}',",
										 "news_description" => "'{$_POST[news_description]}',",
										 "news_summary" 	=> "'{$_POST[news_summary]}',",
										 "keywords_web" 	=> "'{$_POST[keywords_web]}',",
										 "description_web" 	=> "'{$_POST[description_web]}',",
										 "hide" 			=> "'{$hide}',",
										 "is_show_index" 	=> "{$IsShowIndex}");
	
		#	
			$cl_page_update  = new mysql_select($tbl_news);
			$cl_page_update	->update_table("WHERE type_id = '{$_POST[type_id]}' AND lang_id = {$_COOKIE[lang_id]}",
										   $arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
#	add  PAGE
	if($_POST['retention'] == 'add_page')
	{
		if($_COOKIE['lang_id'] == 1)
		{
			$lang_f = 2;
			$lang_t = 3;
		}
		if($_COOKIE['lang_id'] == 2)
		{
			$lang_f = 1;
			$lang_t = 3;
		}
		if($_COOKIE['lang_id'] == 3)
		{
			$lang_f = 1;
			$lang_t = 2;
		}
		
		$_POST['news_id'] 	= uniqid();
		$_POST[type_id] 	= '4b3a3e17d522a';
		$IsShowIndex		= 0;
		
		$query = "INSERT INTO $tbl_news
						 VALUES ('{$_POST[news_id]}',
								 '{$_POST[news_title]}',
								 '{$_POST[news_description]}',
								 '{$_POST[news_summary]}',
								 '',
								 NOW(),
								 '{$_COOKIE[lang_id]}',
								 '{$hide}',
								 '',
								 '{$_POST[type_id]}',
								 $IsShowIndex,
								 'news',
								 '{$_POST[keywords_web]}',
								 '{$_POST[description_web]}'),
						 		 ('{$_POST[news_id]}',
								 '{$_POST[news_title]}',
								 '{$_POST[news_description]}',
								 '{$_POST[news_summary]}',
								 '',
								 NOW(),
								 '{$lang_f}',
								 '{$hide}',
								 '',
								 '{$_POST[type_id]}',
								 $IsShowIndex,
								 'news',
								 '{$_POST[keywords_web]}',
								 '{$_POST[description_web]}');";
	
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "Error news");
		
		$response['success'] = "testststst";
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
	if($_POST['retention'] == 'add_img')
	{
		
		$extension = pathinfo($_FILES['images']['name']);
		$extension = $extension['extension'];
		
		$fileName = $_POST['news_id'].".".$extension;
		if($_FILES['images'])
			if(copy($_FILES['images']['tmp_name'], "../../files/news/".$fileName))
			{
				$arr_update 		 = array("news_image"	 		=> "'{$fileName}'");
	
				$cl_page_update  = new mysql_select($tbl_news);
				$cl_page_update	->update_table("WHERE news_id = '{$_POST[news_id]}'",
												$arr_update);
			}
	}
?>
