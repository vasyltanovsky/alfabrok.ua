<?php
			// Объявляем объект постраничной навигации
			$obj = new pager_mysql_right($tbl_guestbook,
								   		 "WHERE hide = 'show' AND dict_id= '$_GET[dict]'",
								   		 "ORDER BY gb_date DESC",
										 10,
										 10,
										 "?dict=$_GET[dict]");
			// Получаем содержимое текущей страницы
			$guest = $obj->get_page();
			// Если имеется хотя бы одна запись - выводим
			if(!empty($guest))
			{
				$retNL = "<div class=\"DivListNews\">";
				for($i=0; $i<count($guest); $i++)
				{
					list($date, $time) = explode(" ", $guest[$i]['gb_date']);
					list($year, $month, $day) = explode("-", $date);
					$date = "$day.$month.$year ".substr($time, 0, 5);
				
					$retNL .= "<div class=\"DivListNewsOne\">";
                    	$retNL .=  "<p>";
							$retNL .=  "<span class=\"SpanNewsDate\">";
								$retNL .=  $date;
							$retNL .=  "</span>";
						
							$retNL .=  "<b>".$guest[$i][gb_user_msg]."</b>";
						
						$retNL .=  "</p>";
						$retNL .=  "<div class=\"DivListNewsOneDescription\">";
							$retNL .=  $guest[$i]['gb_answer'];
						$retNL .=  "</div>";
                   $retNL .=  "</div>";
				   
				}
				$retNL .=  "</div>";
			}
?>

<div class="DivCenterNew">
	<div class="DivCenterNewLeft">
    	<div class="DivSubPageMenu">
               <?php echo sub_menu_news($new_dct_value, $dictionaries->buld_table, $_GET['dict']);?>
        </div>
    </div>
    <div style="width:60%; float:left">
        <div class="DivCenterText">
			<div id="DivRequeryNews">
                	<?php echo $retNL; if($guest) echo $obj;?>
            </div>
		</div>
	</div>
    <div style="width:20%; float:left">
    	<table>
        	<tr>
            <td>
            	<img src="/files/images/bg/question.jpg" width="54" height="54" />
            </td>
            <td style="padding:0 5px;">
            	<?php echo $arWords['supportContText'];?>
            </td>
            </tr>
		</table>            
    </div>
</div>        
<div class="clear"></div>


    
   
