<?php
class wikiModelClass extends modelClass {
	public $articlesList;
	public $immovablesList;
	public function getItem($w_menu_name) {
		$this->item = $this->provider->getItem ( $w_menu_name );
	}
	public function getList($param) {
		$res = $this->provider->getList ( $param );
		$this->list = $res ["resTable"];
		$this->listData = $res ["resBuildTable"];
	}
	public function getItemArticleList($param) {
		$this->articlesList = $this->provider->getArticleList ( $param );
	}
	public function getItemImmovableList($param) {
		$this->immovablesList = $this->provider->getImmovablesList ( $param );
	}
}
function convertWikiItemImmovablesFromProperties() {
	$mysql = new mysql_select ();
	$mysql->select_table_query ( "select * from im_properties_list" );
	if ($mysql->table) {
		foreach ( $mysql->table as $key => $value ) {
			$insertQuery = sprintf ( "INSERT INTO `wiki`(`w_menu_name`, `w_w_title`, `w_w_keywords`, `w_w_description`) VALUES ('%s','%s','%s','%s')", $value ["im_prop_name"], $value ["im_prop_name"], $value ["im_prop_name"], $value ["im_prop_name"] );
			$wiki_id = $mysql->insert ( $insertQuery );
			$insertQuery = sprintf ( "INSERT INTO `wiki_item_properties`(`wiki_id`, `im_prop_id`) VALUES (%s,'%s')", $wiki_id, $value ["im_prop_id"] );
			$mysql->insert ( $insertQuery );
		}
	}
}
function updateWikiSynonyms() {
	$mysql = new mysql_select ( "wiki" );
	$mysql->select_table_query ( "select w.* from wiki w", "id" );
	$wikiList = $mysql->table;
	foreach ( $mysql->table as $key => $value ) {
		$synonyms = sprintf ( "%s, %s", $value ["w_menu_name"], mb_convert_case ( $value ["w_menu_name"], MB_CASE_LOWER, "UTF-8" ) );
		$mysql->update_table ( "where id= $value[id]", array (
				"w_synonyms" => "'" . $synonyms . "'" 
		) );
	}
}
function checkWikiImmovables() {
	$mysql = new mysql_select ();
	$mysql->select_table_query ( "select s.* from immovables_summary s
							      	left join wiki_immovables w on s.im_id = w.im_id
									where w.im_id is null
									order by s.im_id desc", "im_su_id" );
	// and s.im_id = 3530
	$summaryList = $mysql->table;
	if ($summaryList) {
		$mysql->select_table_query ( "select w.* from wiki w", "id" );
		$wikiList = $mysql->table;
		$mysql = new mysql_select ( "immovables_summary" );
		foreach ( $summaryList as $key => $value ) {
			if (! empty ( $value ["im_su_text"] ))
				wikiReplaceTextWordsToLink ( $value ["im_su_text"], $wikiList, $value ["im_id"] );
		}
	}
}
function wikiReplaceTextWordsToLink($text, $itemArray = "", $im_id = null) {
	$mysql = new mysql_select ();
	if (empty ( $text ))
		return $text;
	if (empty ( $im_id )) {
		$provider = new wikiProviderClass ( "wiki" );
		$res = $provider->getList ( null );
		if (empty ( $res ["resTable"] ))
			return $text;
		$itemArray = $res ["resTable"];
	}
	$wikiLink = '<a class="wiki-target-link" target="_blank" href="/ru/wiki/item/%s" title="%s">%s</a>';
	foreach ( $itemArray as $key => $value ) {
		$replace = false;
		$synonyms = explode ( ", ", $value ["w_synonyms"] );
		foreach ( $synonyms as $skey => $svalue ) {
			if (strpos ( $text, $svalue )) {
				$text = str_replace ( $svalue, sprintf ( $wikiLink, $value ["w_menu_name"], $svalue, $svalue ), $text, $count );
				$replace = true;
			}
		}
		if ($replace && $im_id) {
			$mysql->insert ( sprintf ( "insert into wiki_immovables (wiki_id, im_id) VALUES (%s, %s) ON DUPLICATE KEY UPDATE im_id = %s;", $value ["id"], $im_id, $im_id ) );
		}
	}
	// devLogs::_echo($flagReturn);
	if ($im_id)
		return array (
				"text" => $text,
				"replace" => $replace 
		);
	else
		return $text;
}