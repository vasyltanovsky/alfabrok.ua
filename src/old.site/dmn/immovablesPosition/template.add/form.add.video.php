<?php
	if(empty($_POST['im_id'])) $_POST['im_id'] = $_GET['im_id'];
?>

<form name="FormAddVi" id="FormAddVi" action="template.save.some.php" method="post" enctype="multipart/form-data">
  <fieldset>
    <b>Добавление видео</b><br>
    <label>Видео-файл</label>
    <input type="file" name="video" />
    <input type="hidden" name="im_id" value="<?php echo $_POST['im_id'];?>" />
    <input type="hidden" name="retention" value="add_video" />
    <input id="submitVi" value="Сохранить" name="Submit" onClick="" type="submit" class="button" />
  </fieldset>
</form>
