<?php
	require_once("../../../config/config.php");
require_once DOC_ROOT . '/config/class.config.php';
	require_once("../../includes/mail/template.mail.text.php");
	require_once '../../includes/module/template.module.php';

	$ImSuQClass = new mysql_select($tbl_im_su);
  	$active_id = $ImSuQClass -> select_table_id("WHERE lang_id = '{$_GET[lang_id]}' AND im_id = {$_GET[im_id]}");
?>


    <!-- Common JS files -->
    <script type='text/javascript' src="../../../js/js-zapatec/utils/zapatec.js"></script>
    <script type="text/javascript" src="../../../js/js-zapatec/lang/ru-utf8.js"></script>
    <!-- Custom includes -->	
    <script type='text/javascript' src='../../../js/js-zapatec/src/form.js'></script>
    <script type='text/javascript' src='../../../js/js-zapatec/form.js'></script>
    <!-- ALL demos need these css -->
    <link href="../../../css/css.zapatec/zpcal.css" rel="stylesheet" type="text/css">
    <link href="../../../css/css.zapatec/template.css" rel="stylesheet" type="text/css">
    <link href="../../../css/css.zapatec/winxp.css" rel="stylesheet" type="text/css">
    

    	
            


		      <form action="/application/module/user/template.data.retention.php" id='userForm' class="zpFormWinXP" method="POST">
                        <div id='errOutput' class="errOutput"></div>
                    
                        <fieldset>
                        	<br />
                            <label class='zpFormLabel'>Описание недвижимости</label>
                            <br /> 
                            <textarea name="im_su_text" cols="40" rows="10" class="zpForm"><?php echo $active_id['im_su_text'];?></textarea>
                            <br />
                        	<input class='zpForm' value="<?php echo $active_id['im_su_id'];?>" size="13" name="im_su_id" type="hidden" >
							<input class='zpForm' value="<?php echo $_GET['lang_id'];?>" size="13" name="lang_id" type="hidden" >
							<input class='zpForm' value="<?php echo $_GET['im_id'];?>" size="13" name="im_id" type="hidden" >
                            <input class='zpForm' value="edit_summary" size="13" name="retention" type="hidden" >
                            <br />
                        </fieldset>
                        
                        <input value="Редактировать" name="Submit" onClick="" type="submit" class="button" />
                </form>	


