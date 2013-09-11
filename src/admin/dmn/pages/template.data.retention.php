<?php
  // ������������� ���������� � ����� ������
  require_once("../../config/config.php");
  // ���������� ���� �����������
  require_once("../utils/security_mod.php");
  // ���������� SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';
 
  $json_converter = new Services_JSON();
  $response = array();
  $response['success'] = false;
  $response['fieldErrors'] = array();


	$menu_show = "hide";
	if($_POST['menu_show']) $menu_show = 'show';
	$title_show = "hide";
	if($_POST['title_show']) $title_show = 'show';
	$description_show = "hide";
	if($_POST['description_show']) $description_show = 'show';
	$summary_show =  "hide";
	if($_POST['summary_show']) $summary_show = 'show';
	$hide =  "hide";
	if($_POST['hide']) $hide = 'show';
	
	//$_POST[description] = addslashes($_POST[description]);
	//$_POST[summary] = addslashes($_POST[summary]);
		
		
#	�������������� ������� PAGE
	if($_POST['retention'] == 'edit_page')
	{
		//print_r($_POST);
		//$_POST['description'] = addslashes($_POST['description']);
		//$_POST['summary'] = addslashes($_POST['summary']);
		#	������������ ������� ��� �������	
			$arr_update 		 = array("title_web" 		=> "'{$_POST[title_web]}',",
										 "keywords_web" 	=> "'{$_POST[keywords_web]}',",
										 "description_web"  => "'{$_POST[description_web]}',",
										 "menu_show" 		=> "'{$menu_show}',",
										 "adress_template"  => "'{$_POST[adress_template]}',",
										 "dict_id"  		=> "'{$_POST[dict_id]}',",
										 "menu_words" 		=> "'{$_POST[menu_words]}',",
										 "title" 			=> "'{$_POST[title]}',",
										 "description" 		=> "'{$_POST[description]}',",
										 "summary" 			=> "'{$_POST[summary]}',",
										 "pos" 				=> "'{$_POST[pos]}',",
										 "hide" 			=> "'{$hide}'");
	
		#	����� ��� �������
			$cl_page_update  = new mysql_select($tbl_pages);
			
			$cl_page_update	->update_table("WHERE page_id = '{$_POST[page_id]}' AND lang_id = {$_COOKIE[lang_id]}",
											$arr_update);
		
		$response['success'] = true;
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
#	add ������� PAGE
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
		$query = "INSERT INTO $tbl_pages
						 VALUES ('{$_POST[page_id]}',
								 '{$_POST[title_web]}',
								 '{$_POST[keywords_web]}',
								 '{$_POST[description_web]}',
								 '{$_POST[name_page]}',
								 '{$_POST[menu_words]}',
								 '{$menu_show}',
								 'show',
								 '{$_POST[title ]}',
								 '{$title_show}',
								 '{$_POST[description]}',
								 '{$description_show}',
								 '{$_POST[summary]}',
								 '{$_POST[summary_show]}',
								  {$_POST[pos]},
								 '{$hide}',
								 '{$_POST[adress_template]}',
								 '{$_POST[parent_id]}',			 
								 '{$_COOKIE[lang_id]}',			 
								 '{$_POST[dict_id]}',
								 '{$_POST[parent_in]}'),
						 		 ('{$_POST[page_id]}',
								 '{$_POST[title_web]}',
								 '{$_POST[keywords_web]}',
								 '{$_POST[description_web]}',
								 '{$_POST[name_page]}',
								 '{$_POST[menu_words]}',
								 '{$menu_show}',
								 'show',
								 '{$_POST[title ]}',
								 '{$title_show}',
								 '{$_POST[description]}',
								 '{$description_show}',
								 '{$_POST[summary]}',
								 '{$_POST[summary_show]}',
								  {$_POST[pos]},
								 '{$hide}',
								 '{$_POST[adress_template]}',
								 '{$_POST[parent_id]}',			 
								 '{$lang_f}',			 
								 '{$_POST[dict_id]}',
								 '{$_POST[parent_in]}'),
						 		 ('{$_POST[page_id]}',
								 '{$_POST[title_web]}',
								 '{$_POST[keywords_web]}',
								 '{$_POST[description_web]}',
								 '{$_POST[name_page]}',
								 '{$_POST[menu_words]}',
								 '{$menu_show}',
								 'show',
								 '{$_POST[title ]}',
								 '{$title_show}',
								 '{$_POST[description]}',
								 '{$description_show}',
								 '{$_POST[summary]}',
								 '{$_POST[summary_show]}',
								  {$_POST[pos]},
								 '{$hide}',
								 '{$_POST[adress_template]}',
								 '{$_POST[parent_id]}',			 
								 '{$lang_t}',			 
								 '{$_POST[dict_id]}',
								 '{$_POST[parent_in]}');";
	
		if(!mysql_query($query))  throw new ExceptionMySQL(mysql_error(), $query, "������ ���������� ���������� ���������");
		
		$response['success'] = "testststst";
		header('Content-type: text/plain');
		echo $json_converter->encode($response);
	}
	
/*$response['fieldErrors']['title'] = "Passwords do not match";
if(sizeof($response['fieldErrors']) == 0)
{
	$response['success'] = true;
	header('Content-type: text/plain');
	echo $json_converter->encode($response);
} 
else
{
	
	header('Content-type: text/plain');
	echo $json_converter->encode($response);
}*/
?>
