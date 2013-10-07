
<?php
		if(!isset($ImPL)) die("В данном каталоге нет позиций");
	
		for($i=0; $i<count($ImPL); $i++)
		{
			$im_id 		= $ImPL[$i]['im_id'];
			$im_photo	= $ImPL[$i]['im_photo'];
			$im_code	= $ImPL[$i]['im_code'];
			$im_catalog = $dictionaries->buld_table[$ImPL[$i][im_catalog_id]][dict_name];
			$im_adress_string = $dictionaries->buld_table[$ImPL[$i][im_region_id]][dict_name]; $im_adress_string .= " /";
			$im_adress_string .= $dictionaries->buld_table[$ImPL[$i][im_a_region_id]][dict_name]; $im_adress_string .= " /";
			$im_adress_string .= $dictionaries->buld_table[$ImPL[$i][im_city_id]][dict_name]; $im_adress_string .= " /";
			$im_adress_string .= $dictionaries->buld_table[$ImPL[$i][im_area_id]][dict_name]; $im_adress_string .= " /";
			$im_adress_string .= $dictionaries->buld_table[$ImPL[$i][im_array_id]][dict_name]; $im_adress_string .= " /";
			$im_adress_string .= $dictionaries->buld_table[$ImPL[$i][im_adress_id]][dict_name]; $im_adress_string .= " /";
			$im_adress_string .= $ImPL[$i][im_adress_house];
			
			$im_price_string = $ImPL[$i][im_prace] ." /(". $ImPL[$i][im_prace_old] .") /". $ImPL[$i][im_prace_sq] . " /$"; 
			$im_isRent = $CMSImagesNum[$ImPL[$i][im_is_rent]];
			$im_isSale = $CMSImagesNum[$ImPL[$i][im_is_sale]];  
			
			$im_date = $ImPL[$i][im_date_add];
			$hide = $CMSImages[$ImPL[$i][hide]];
			$stat = $ImPQSt ->buld_table[$ImPL[$i]['im_id']]['wiev_count'];
			
			$tRclass= "";  
		  	if ($i%2 != 0) $tRclass = "class=random";  
		  
		  	if($ImPL[$i]['im_is_special'] !=0)
		  		$tRclass = "class=error";  
		  	$style = "";
		  	if($ImTaskQ->buld_table[$im_code]) 
		  		$style = "style=\"background: #DADEDF\""; 	
		  	global $images_root;
		  	$pagesReturn .= "<tr {$tRclass} $style>";
				$pagesReturn .=	"<td><input type=\"radio\" value=\"{$ImPL[$i]['im_id']}\" name=\"im_id\"/></td>";
				$pagesReturn .=	"<td><img src=\"".$images_root."/files/images/immovables/s_{$im_photo}\"></td>";				
				$pagesReturn .=	"<td>{$im_code}</td>";
				$pagesReturn .=	"<td>{$im_catalog}</td>";
				$pagesReturn .=	"<td>{$im_adress_string}";
				if($ImTaskQ->buld_table[$im_code]) {
					$pagesReturn .= "<br><b>Задача</b>:<a style=\"\" target=\"_blank\" href=\"../../dmn/imtask/index.php?action=gettask&t_id={$ImTaskQ->buld_table[$im_code][t_id]}\">{$ImTaskQ->buld_table[$im_code][t_title]}</a>";
				}
				$pagesReturn .=	"</td>";
				$pagesReturn .=	"<td>{$im_price_string}</td>";
				$pagesReturn .=	"<td>{$im_isSale}</td>";
				$pagesReturn .=	"<td>{$im_isRent}</td>";
				$pagesReturn .=	"<td>{$hide}</td>";
				$pagesReturn .=	"<td>{$im_date}</td>";
				$pagesReturn .=	"<td align='center'><p id='p{$ImPL[$i]['im_id']}'>{$stat}</p><br /><p id='{$ImPL[$i]['im_id']}'</p></td>";
			$pagesReturn .= "</tr>";
		}
		
		$pagesReturn .=	"<input value=\"".substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?')+1, strlen($_SERVER['REQUEST_URI']))."\" name=\"requery_id\" type=\"hidden\" >";
		
		
?>
<script type="text/javascript">
	 DD_roundies.addRule('#d-dialog-in', '10px', true);
	 DD_roundies.addRule('.t-dialog', '10px', true);
	</script>

<table cellpadding="0" cellspacing="0" border="0" class="table-list">
  <tr class="headings">
    <td width="10" ></td>
    <td width="65" ></td>
    <td width="50">Код/ задача</td>
    <td width="70">Каталог</td>
    <td>Область/ Район/ Город/ Массив/ Улица</td>
    <td>Цена (за объект/(старая цена)/ за м2)</td>
    <td width="30">Продажа</td>
    <td width="30">Аренда</td>
    <td width="30">Отображать</td>
    <td>Дата внесения</td>
    <td>Просмотров</td>
  </tr>
  <?php echo $pagesReturn;?>
</table>
