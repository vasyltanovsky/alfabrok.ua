// JavaScript Document
$(function() {
	$("#comparing-sort").sortable({
		update:  function (event, ui) {
			comparisonSetSorted(buildSortArray("kod"));
		}
	});
	$("#comparing-sort").disableSelection();
	$(".colp").click(function() {
		comparisonRemoveItem($(this).attr("id").replace(/comparing-remove-item-/g, ""));
		$("#comparing-item-" + $(this).attr("id").replace(/comparing-remove-item-/g, "") ).remove();
		if($("#comparing-sort li").length === 0) {
			$(".comparing-list").remove();
			$(".comparing-no-item-list").show();
		}
		return false;
	});
	$("#articleTitle").change(function () {
		$("#articleTitle").syncTranslit({destination: "slug"});
	})
	$("#articleTitle").syncTranslit({destination: "slug"});
	
	$(".param-list .params a").click(function () {
		return false;
	});
	$(".param-list .params span").click(function() {
		if($(this).attr("class") == "from") 
			comparisonSortParamFrom($(this).parent("a").attr("class"));
		else 
			comparisonSortParamTo($(this).parent("a").attr("class"));
		$(this).addClass( "sort" );

	});
	comparisonHideEmptyAndLargeParam();	
	$(".item-list").css("height", $(".param-list").height() + 20);
	if($("#comparing-sort li").length <= 5)
		$(".item-list").css("overflow-x", "hidden");
});