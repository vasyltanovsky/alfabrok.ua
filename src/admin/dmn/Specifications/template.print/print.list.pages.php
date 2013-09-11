<?php
		function f_ty_prop($type)
		{
			if($type == 'standard') return "Стандартная";
			else return "Расширенная";
 		}
 		
 	#	формирование таблици контенка
		for($i=0; $i<count($cl_sel_pages->table); $i++)
		{

			$im_prop_id 			= $cl_sel_pages->table[$i]['im_prop_id'];
			$im_prop_name 			= $cl_sel_pages->table[$i]['im_prop_name'];
			$im_catalog_id 			= $dictionaries->buld_table[$cl_sel_pages->table[$i]['catalog_id']]['dict_name']; 
			$im_prop_value_dict_id 	= $dictionaries->buld_table[$cl_sel_pages->table[$i]['im_prop_value_dict_id']]['dict_name'];
			$im_prop_style_id 		= $dictionaries->buld_table[$cl_sel_pages->table[$i]['im_prop_style_id']]['dict_name'];
			$is_show_form			= $CMSImagesNum[$cl_sel_pages->table[$i]['is_show_form']];
			$type_prop 				= f_ty_prop($cl_sel_pages->table[$i]['type_prop']);
			$hide 					= $CMSImages[$cl_sel_pages->table[$i]['hide']];
			$ld_id 					= $cl_sel_dict->buld_table[$cl_sel_pages->table[$i]['ld_id']]['ld_name'];
		
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
			$pagesReturn .= "<tr {$tRclass}>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$im_prop_id}\" name=\"im_prop_id\"/></td>";
				$pagesReturn .=	"<td>{$im_prop_id}</td>";
				$pagesReturn .=	"<td>{$im_prop_name}</td>";
				$pagesReturn .=	"<td>{$im_prop_value_dict_id}</td>";
				$pagesReturn .=	"<td>{$im_catalog_id}</td>";
				$pagesReturn .=	"<td>{$ld_id}</td>";
				$pagesReturn .=	"<td>{$type_prop}</td>";
				$pagesReturn .=	"<td>{$im_prop_style_id}</td>";
				$pagesReturn .=	"<td>{$is_show_form}</td>";
				$pagesReturn .=	"<td>{$hide}</td>";
			$pagesReturn .= "</tr>";
		}
?>
<script type="text/javascript">
 DD_roundies.addRule('#d-dialog-in', '10px', true);
 DD_roundies.addRule('.t-dialog', '10px', true);
</script>

	<table cellpadding="0" cellspacing="0" border="0" class="table-list">
	<tr class="headings">
		<td width=10 ></td>
		<td width=50>ID</td>
		<td>Имя характеристики</td>
		<td>Значения характеристики</td>
		<td>Каталог</td>
		<td>Словарь</td>
		<td>Тип характеристики</td>
		<td>Вид в форме</td>
		<td width="150">Отображается в форме</td>
		<td width="100">Отображаеться</td>
	</tr>
		<?php echo $pagesReturn;?>
	</table>
