/*===============	im.search.js	============*/ 
$(document).ready(function(){
	$(".regionalBlock .reginalTree").hover(function() {
	}, function() {
		$(this).hide();
	});

	$(".form-span-exchange").html("(" + $("#exchange_select_id option:selected").val() + ")");
	$("#exchange_select_id").change(function () {
		$(".form-span-exchange").html("(" + $("#exchange_select_id option:selected").val() + ")");
	});
	
	$(".regionalTextInput").click(function () {
		$(".reginalTree").toggle();
	});
	
	$(".rlist").each(function () {
		if(!$(this).hasClass("rListItem-0")) {							   
		}
	});
	
	$(".rlist .plus").click(function () {
		var input_name = $(this).attr("id").substring(10,23);
		if($(".checkbox-item-" + input_name).attr("checked")) {
			$("#plus-item-" + input_name).html("+");
			$(".parent-element-" + input_name).hide();
			removeFromRegionalTextInput(input_name);
			$(".checkbox-item-" + input_name).attr( { "checked": "" });
		}
		else {
			$("#plus-item-" + input_name).html("-");
			$(".parent-element-" + input_name).show();
			appendToRegionalTextInput(input_name);
			$(".checkbox-item-" + input_name).attr( { "checked": "checked" });
		}
	});
	$(".rlist input").click(function () {
		var input_name = $(this).attr("name").substring(0,13);	
		if($(this).attr("checked")) {
			$("#plus-item-" + input_name).html("-");
			$(".parent-element-" + input_name).show();
			appendToRegionalTextInput(input_name);
		}
		else { 
			$("#plus-item-" + input_name).html("+");
			$(".parent-element-" + input_name).hide();
			removeFromRegionalTextInput(input_name);
		}
	});
});

$(document).ready(function(){
/*
	скрывает все ненужные fieldset - ы
*/					   	
	//HideShowCheckbox("1_d");
	//HideShowCheckbox("2_d");
	//HideShowCheckbox("3_d");
	//HideShowCheckbox("4_d");
	
	var optionsSearch = { 
			target: "#DivRequest",
			beforeSubmit: valideSearch,
			url:'/application/module/immovables/get.post.hadler.php',
			success: RePage
		  };
	
	$('#4c496bd58da0d_f').hide();
	$('#0_d').hide();
	$('#1_d').hide();
	$('#2_d').hide();
	$('#3_d').hide();
	$('#4_d').hide();
	$('#DivImPropForm').hide();
	
	$('#FormSearchNameRegion').bind("click", function(){
		FieldsetClickHideShow("#0_d");
	});	
	$('#FormSearchNameRRegion').bind("click", function(){
		FieldsetClickHideShow("#1_d");
	});		
	$('#FormSearchNameCity').bind("click", function(){
		FieldsetClickHideShow("#2_d");
	});			
	$('#FormSearchNameRCIty').bind("click", function(){
		FieldsetClickHideShow("#3_d");
	});	
	$('#FormSearchNameACity').bind("click", function(){
		FieldsetClickHideShow("#4_d");
	});	
	//
	$('#SearchPropImAdviceHS').bind("click", function(){
		FieldsetClickHideShow("#DivImPropForm");
	});
});

