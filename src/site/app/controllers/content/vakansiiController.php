<?php
class vakansiiController extends aControllerClass {
	public function index($param) {
		$model = new vakansiiModelClass ( new vakansiiProviderClass ( "vacancii", "v_id" ) );
		if (empty ( $param["type_id"] ))
			$this->redirect ( sprintf ( "ru/vakansii/index/%s", $model->typeVakansiiList[0]["dict_id"] ) );
		$param["hide"] = true;
		$model->getList ( $param );
		$this->appDataObj->setStringNavigation ( $model->typeVakansiiList[0]["dict_name"] );
		$this->appDataObj->setPAction ( "index" );
		return $this->View ( array(
				"Model" => $model) );
	}
	public function item($param) {
		$model = new vakansiiModelClass ( new vakansiiProviderClass ( "vacancii", "v_id" ) );
		$model->getItem ( $this->routingObj->getParamItem ( "url" ) );
		if (empty ( $model->item ))
			$this->redirectToErrorPage ();
		if ($model->item) {
			$this->appDataObj->setTitle ( $model->item["w_title"] );
			$this->appDataObj->setKeyw ( $model->item["w_keywords"] );
			$this->appDataObj->setDesc ( $model->item["w_description"] );
			$this->appDataObj->setStringNavigation ( sprintf ( ' <a href="/ru/vakansii/index/%s" title="">%s</a><span class="next">~»~</span>%s', $model->item["type_id"], $model->dictionaries->buld_table[$model->item["type_id"]]["dict_name"], $model->item["title"], $model->item["title"] ) );
			$this->appDataObj->setPAction ( "index" );
		}
		return $this->View ( array(
				"Model" => $model) );
	}
	
	/* sitemap */
	public function sitemap($param) {
		$this->isPartial = true;
		if ($param["action"] == "index") {
			$model = new vakansiiModelClass ( new vakansiiProviderClass ( "vacancii", "v_id" ) );
			return $this->partialView ( array(
					"Model" => $model,
					"level" => $param["level"]), "vakansii/sitemap/index" );
		}
	}
	public function sitemapxml($param) {
		$this->isPartial = true;
		if ($param["action"] == "index") {
			$model = new vakansiiModelClass ( new vakansiiProviderClass ( "vacancii", "id" ) );
			$array = null;
			if ($model->typeVakansiiList) {
				foreach ( $model->typeVakansiiList as $key => $value ) {
					$array[] = array(
							"loc" => sprintf ( "http://%s/ru/vakansii/index/%s", $_SERVER['HTTP_HOST'], $value["dict_id"] ),
							"lastmod" => date ( "Y-m-d H:i:s" ),
							"changefreq" => "weekly",
							"priority" => $param["priority"]);
					$model->getList ( array(
							"hide" => true,
							"type_id" => $value['dict_id']) );
					if ($model->list) {
						foreach ( $model->list as $ikey => $ivalue ) {
							$array[] = array(
									"loc" => sprintf ( "http://%s/ru/vakansii/item/%s", $_SERVER['HTTP_HOST'], $ivalue["url"] ),
									"lastmod" => date ( "Y-m-d H:i:s" ),
									"changefreq" => "weekly",
									"priority" => $param["priority"]);
						}
					}
				}
			}
			return $array;
		}
	}
}