<?php
  // Устанавливаем соединение с базой данных
  require_once("../../config/config.php");
  // Подключаем SoftTime FrameWork
require_once DOC_ROOT . '/config/class.config.php';

 	if(isset($_POST['im_id'])) $_GET['im_id'] = $_POST['im_id'];
	if($_GET['im_id'])
	{
		# 	Получаем содержимое текущей страницы
			$cl_sel_pages = new mysql_select($tbl_im_vi);
			$active_id = $cl_sel_pages -> select_table_id("WHERE im_id = '$_GET[im_id]'");
	}
	
?>
<script type="text/javascript">
	$(document).ready(function(){
		$('#submitDellVi').bind("click", function(){
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
			$('#DivRequestVi').load('template.dell.item.vi.php?im_id=<?php echo $active_id['im_id'];?>&file_name=<?php echo $active_id['iv_id'];?>.<?php echo $active_id['iv_file_type'];?>');
			$('#DivRequestVi').load('template.add/form.add.video.php?im_id=<?php echo $active_id['im_id'];?>');
			//$("#loading").ajaxComplete(function(){
  			//$(this).hide();});
		}
		else
			return false;
	}
	</script>

<div class="eventForm"> <a href="#" title="удалить" id="submitDellVi" ><img src="../utils/images/submit/submitDell.png" width="28" height="24" /></a> </div>
<div id="d-filter">
  <table>
    <tr>
      <td><object width="350" height="275">
          <param name="allowFullScreen" value="true\" />
          <param name="allowScriptAccess" value="always" />
          <param name="wmode" value="transparent" />
          <param name="movie" value="../../files/flash/uppod.swf" />
          <param name="flashvars" value="st=../../files/flash/video54-941.txt&amp;file=../../files/video/im/<?php echo $active_id['iv_id'];?>.<?php echo $active_id['iv_file_type'];?>" />
          <embed src="../../files/flash/uppod.swf"" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="transparent" flashvars="st=../../files/flash/video54-941.txt&amp;file=../../files/video/im/<?php echo $active_id['iv_id'];?>.<?php echo $active_id['iv_file_type'];?>" width="350" height="275"> </embed>
        </object></td>
      <td><?php echo $active_id['iv_date']; ?></td>
    </tr>
  </table>
</div>
