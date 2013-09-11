<label class='zpFormLabel'>Область</label>
<input class="zpFormRequired" type="text" size="40" name="im_region_id_auto" value="<?php echo $dictionaries->buld_table[$active_id['im_region_id']]['dict_name']?>" id="im_region_id_auto"/>
<input type="hidden" name="im_region_id" value="<?php echo $active_id['im_region_id'];?>" id="im_region_id"/>
<br />
<label class='zpFormLabel'>Район области</label>
<input class="zpForm" type="text" size="40" name="im_a_region_id_auto" value="<?php echo $dictionaries->buld_table[$active_id['im_a_region_id']]['dict_name']?>" id="im_a_region_id_auto"/>
<input type="hidden" name="im_a_region_id" value="<?php echo $active_id['im_a_region_id'];?>" id="im_a_region_id"/>
<br />
<label class='zpFormLabel'>Город (поселок)</label>
<input class="zpFormRequired" type="text" size="40" name="im_city_id_auto" value="<?php echo $dictionaries->buld_table[$active_id['im_city_id']]['dict_name']?>" id="im_city_id_auto"/>
<input type="hidden" name="im_city_id" value="<?php echo $active_id['im_city_id'];?>" id="im_city_id"/>
<br />  
<label class='zpFormLabel'>Район города (поселка)</label>
<input class="zpForm" type="text" size="40" name="im_area_id_auto" value="<?php echo $dictionaries->buld_table[$active_id['im_area_id']]['dict_name']?>" id="im_area_id_auto"/>
<input type="hidden" name="im_area_id" value="<?php echo $active_id['im_area_id'];?>" id="im_area_id"/>
<br />  
<label class='zpFormLabel'>Массив города (поселка)</label>
<input class="zpForm" type="text" size="40" name="im_array_id_auto" value="<?php echo $dictionaries->buld_table[$active_id['im_array_id']]['dict_name']?>" id="im_array_id_auto"/>
<input type="hidden" name="im_array_id" value="<?php echo $active_id['im_array_id'];?>" id="im_array_id"/>
<br />        
<label class='zpFormLabel'>Улица</label>
<input class="zpForm" type="text" size="40" name="im_adress_id_auto" value="<?php echo $dictionaries->buld_table[$active_id['im_adress_id']]['dict_name']?>" id="im_adress_id_auto"/>
<input type="hidden" name="im_adress_id" value="<?php echo $active_id['im_adress_id'];?>" id="im_adress_id_text"/>
<br />     


<script type="text/javascript">
$(document).ready(function(){
	$( "#im_region_id_auto" ).autocomplete({
		source: "../wdictionaries/template.data.retention.php?retention=GetJsonDicts&ld_id=11",
		minLength: 2,
		select: function( event, ui ) {
			$( "#im_region_id" ).val(ui.item.id);
		}
	});
	$( "#im_a_region_id_auto" ).autocomplete({
		source: "../wdictionaries/template.data.retention.php?retention=GetJsonDicts&ld_id=24",
		minLength: 2,
		select: function( event, ui ) {
			$( "#im_a_region_id" ).val(ui.item.id);
		}
	});
	$( "#im_city_id_auto" ).autocomplete({
		source: "../wdictionaries/template.data.retention.php?retention=GetJsonDicts&ld_id=12",
		minLength: 2,
		select: function( event, ui ) {
			$( "#im_city_id" ).val(ui.item.id);
		}
	});
	$( "#im_area_id_auto" ).autocomplete({
		source: "../wdictionaries/template.data.retention.php?retention=GetJsonDicts&ld_id=13",
		minLength: 2,
		select: function( event, ui ) {
			$( "#im_area_id" ).val(ui.item.id);
		}
	});
	$( "#im_array_id_auto" ).autocomplete({
		source: "../wdictionaries/template.data.retention.php?retention=GetJsonDicts&ld_id=15",
		minLength: 2,
		select: function( event, ui ) {
			$( "#im_array_id" ).val(ui.item.id);
		}
	});
	$( "#im_adress_id_auto" ).autocomplete({
		source: "../wdictionaries/template.data.retention.php?retention=GetJsonDicts&ld_id=14",
		minLength: 2,
		select: function( event, ui ) {
			$( "#im_adress_id_text" ).val(ui.item.id);
		}
	});
});
</script/> 
    
 <!--  
    
     <select name="im_region_id" class="zpFormRequired">
      <option value="">--select--</option>
      <?php echo sel_parent_standart($im_region_id_add, $active_id['im_region_id'], 'dict_id', 'dict_name');?>
    </select>
    <br />
    <label class='zpFormLabel'>Район области</label>
    <select name="im_a_region_id" class="zpForm">
      <option value="">--select--</option>
      <?php echo sel_parent_standart($im_a_region_add, $active_id['im_a_region_id'], 'dict_id', 'dict_name');?>
    </select>
    <br />
     <label class='zpFormLabel'>Город (поселок)</label>
    <select name="im_city_id" id="im_city_id" class="zpFormRequired">
      <option value="">--select--</option>
      <?php echo sel_parent_standart($im_city_id_add, $active_id['im_city_id'], 'dict_id', 'dict_name');?>
    </select>
    <br />
     <label class='zpFormLabel'>Район города (поселка)</label>
    <select name="im_area_id" class="zpForm">
      <option value="">--select--</option>
      <?php echo sel_parent_standart($im_area_id_add, $active_id['im_area_id'], 'dict_id', 'dict_name');?>
    </select>
    <br />
    
       <label class='zpFormLabel'>Массив города (поселка)</label>
    <select name="im_array_id" class="zpForm">
      <option value="">--select--</option>
      <?php echo sel_parent_standart($im_array_id_add, $active_id['im_array_id'], 'dict_id', 'dict_name');?>
    </select>
    <br />
    
     -->  