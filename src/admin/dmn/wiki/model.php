<?php
class DMN_Wiki extends Controller {
	public $dictionaries;
	public function getDictionaris() {
		// бъявляем класс словаря
		$this->dictionaries = new dictionaries ();
		// ормируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		// ормируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}
	public function getPage($array) {
		$provider = new WikiProvider ( 'wiki' );
		$provider->GetItemList ( $array );
		$tListData = $this->Template ( "/dmn/wiki/template/list.phtml", array(
				'Data' => $provider->resTable) );
		$tAction = $this->Template ( "/dmn/wiki/template/action.phtml", array(
				'Data' => "",
				"array" => $array) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array(
				'tListData' => $tListData,
				"tAction" => $tAction) );
	}
	public function getItem($array) {
		$Data = NULL;
		$provider = new WikiProvider ( 'wiki' );
		if (isset ( $array["id"] )) {
			$Data = $provider->GetItem ( $array['id'] );
			$provider = new WikiProvider ( 'wiki_articles' );
			$provider->GetArticleList ( array(
					"wiki_id" => $Data["id"]) );
		}
		return $this->Template ( "/dmn/wiki/template/form.phtml", array(
				'Data' => $Data,
				"Articles" => $provider->resTable) );
	}
	public function saveItem($array) {
		$return['success'] = true;
		$provider = new WikiProvider ( 'wiki' );
		if ($array['type_save'] == "new") {
			$ret = $provider->SaveItem ( $array );
			$return["newActionID"] = $ret["id"];
			if ($ret["error"]) {
				$return['generalError'] = $ret["error"];
				$return['success'] = false;
			}
		}
		if ($array['type_save'] == "edit") {
			$arr_update = array(
					"w_menu_name" => "'" . $array['w_menu_name'] . "',",
					"w_w_title" => "'" . $array['w_w_title'] . "',",
					"w_w_keywords" => "'" . $array['w_w_keywords'] . "',",
					"w_w_description" => "'" . $array['w_w_description'] . "',",
					"w_synonyms" => "'" . $array['w_synonyms'] . "'");
			$provider->UpdateItem ( $array['id'], $arr_update );
			$return["newActionID"] = $array['id'];
			$return['success'] = true;
		}
		return $return;
	}
	public function delete($array) {
		$sql = "delete from wiki where id= '{$array['id']}'";
		if (! mysql_query ( $sql )) {
			$return['success'] = false;
			$return['error'] = "error {$sql}";
			return $return;
		}
		$sql = "delete from wiki_articles where wiki_id= '{$array['id']}'";
		if (! mysql_query ( $sql )) {
			$return['success'] = false;
			$return['error'] = "error {$sql}";
			return $return;
		}
		$return['conf'] = "DMN_Wiki";
		$return['success'] = true;
		return $this->getPage ( array() );
	}
	public function getArticles($array) {
		$provider = new WikiProvider ( 'wiki_articles' );
		$provider->GetArticleList ( $array );
		$tListData = $this->Template ( "/dmn/wiki/template/list.articles.phtml", array(
				'Data' => $provider->resTable) );
		$provider = new WikiProvider ( 'wiki' );
		$provider->GetItemList ( $array );
		$tAction = $this->Template ( "/dmn/wiki/template/action.articles.phtml", array(
				'wikiList' => $provider->resTable,
				"array" => $array) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array(
				'tListData' => $tListData,
				"tAction" => $tAction) );
	}
	public function getArticle($array) {
		$Data = NULL;
		if (isset ( $array["id"] )) {
			$provider = new WikiProvider ( 'wiki_articles' );
			$Data = $provider->GetArticle ( $array['id'] );
		}
		$provider = new WikiProvider ( 'wiki' );
		$provider->GetItemList ( array() );
		return $this->Template ( "/dmn/wiki/template/form.articles.phtml", array(
				'Data' => $Data,
				"WikiList" => $provider->resTable,
				"array" => $array) );
	}
	public function saveArticle($array) {
		$return['success'] = true;
		$provider = new WikiProvider ( 'wiki' );
		if ($array['type_save'] == "new") {
			$ret = $provider->SaveArticle ( $array );
			$return["newActionID"] = $ret["id"];
			if ($ret["error"]) {
				$return['generalError'] = $ret["error"];
				$return['success'] = false;
			}
		}
		if ($array['type_save'] == "edit") {
			$arr_update = array(
					"wiki_id" => "'" . $array['wiki_id'] . "',",
					"wa_title" => "'" . $array['wa_title'] . "',",
					"wa_summary" => "'" . $array['wa_summary'] . "'");
			$provider->UpdateArticle ( $array['id'], $arr_update );
			$return['success'] = true;
			$return["newActionID"] = $array['id'];
		}
		return $return;
	}
	public function deleteArticle($array) {
		$sql = "delete from wiki_articles where id= '{$array['id']}'";
		if (! mysql_query ( $sql )) {
			$return['success'] = false;
			$return['error'] = "error {$sql}";
			return $return;
		}
		$return['conf'] = "DMN_Wiki";
		$return['act'] = "getArticle";
		$return['success'] = true;
		return $this->getPage ( array() );
	}
}
?>