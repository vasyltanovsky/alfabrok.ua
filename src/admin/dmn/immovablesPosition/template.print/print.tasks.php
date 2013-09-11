<script type="text/javascript">
		$(document).ready(function(){
			$('#DivRequestTasksList').load('template.load.php?print=list_tasks&im_id=<?php echo $_POST['im_id']?>');
			$('#DivTaskForm').hide();
			$('#showAddTask').bind("click", function(){
				$('#DivTaskForm').show();
			});
		});	
	</script>

<div class="eventForm"> <a href="#" title="Добавить задачу" id="showAddTask"><img src="../utils/images/submit/submitAdd.png" width="28" height="24" /></a> </div>
<div id="DivTaskForm">
<?php require_once 'template.add/form.add.task.php';?>
</div>

<div id="DivRequestTasksList"></div>
