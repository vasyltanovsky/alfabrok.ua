<?php
class wikiController extends aControllerClass {
	public function index($param) {
		$model = new wikiModelClass ( new wikiProviderClass ( "wiki", "id" ) );
		$model->getItemArticleList ( array(
				"limit" => 10) );
		return $this->View ( array(
				"Model" => $model) );
	}
	public function menu($param) {
		$model = new wikiModelClass ( new wikiProviderClass ( "wiki", "id" ) );
		$model->getList ( $param );
		return $this->partialView ( array(
				"Model" => $model), "wiki/menu" );
	}
	public function item($param) {
		$model = new wikiModelClass ( new wikiProviderClass ( "wiki" ) );
		$model->getItem ( htmlspecialchars ( urldecode ( $this->routingObj->getParamItem ( "id" ) ) ) );
		if (empty ( $model->item ))
			$this->redirectToErrorPage ();
		$model->getItemArticleList ( array(
				"wiki_id" => $model->item["id"]) );
		$model->getItemImmovableList ( array(
				"wiki_id" => $model->item["id"]) );
		if ($model->item) {
			$this->appDataObj->setTitle ( $model->item["w_synonyms"] );
			$this->appDataObj->setKeyw ( $model->item["w_synonyms"] );
			$this->appDataObj->setDesc ( $model->item["w_synonyms"] );
			$this->appDataObj->setStringNavigation ( $model->item["w_menu_name"] );
			$this->appDataObj->setPAction ( "index" );
		}
		return $this->View ( array(
				"Model" => $model) );
	}
	
	/* sitemap */
	public function sitemap($param) {
		$this->isPartial = true;
		if ($param["action"] == "index") {
			$model = new wikiModelClass ( new wikiProviderClass ( "wiki", "id" ) );
			$model->getList ( array() );
			return $this->partialView ( array(
					"Model" => $model,
					"level" => $param["level"]), "wiki/sitemap/index" );
		}
	}
	public function sitemapxml($param) {
		$this->isPartial = true;
		if ($param["action"] == "index") {
			$model = new wikiModelClass ( new wikiProviderClass ( "wiki", "id" ) );
			$model->getList ( array() );
			$array = null;
			if ($model->list) {
				foreach ( $model->list as $key => $value ) {
					$array[] = array(
							"loc" => sprintf ( "http://%s/ru/wiki/item/%s", $_SERVER['HTTP_HOST'], $value["w_menu_name"] ),
							"lastmod" => date ( "Y-m-d H:i:s" ),
							"changefreq" => "weekly",
							"priority" => $param["priority"]);
				}
			}
			return $array;
		}
	}
}