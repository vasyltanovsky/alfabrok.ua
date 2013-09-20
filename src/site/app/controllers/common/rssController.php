<?php
class rssController extends aControllerClass {
	public function index($param) {
		if (! $this->checkIssetRssFile ()) {
			$rssfiledata = $this->buildRssFile ();
			$this->saveRssFile ( $rssfiledata );
		}
		header ( "Content-Type: text/xml" );
		echo $this->getRssFile ();
		$this->isPartial = true;
		return;
	}
	public function build() {
	}
	/**
	 * проверка на существование файла и время его жизни
	 * 
	 * @return boolean
	 */
	private function checkIssetRssFile() {
		$isset = false;
		if (file_exists ( DOC_ROOT . "/files/rss/rss.xml" )) {
			
			$cachelink_time = filemtime ( DOC_ROOT . "/files/rss/rss.xml" );
			
			if (time () > strtotime ( date ( 'Y-m-d', $cachelink_time ) . ' + 5 days' )) {
				$isset = false;
				$this->deleteRssFile ();
			} else
				$isset = true;
		}
		return $isset;
	}
	private function deleteRssFile() {
		unlink ( DOC_ROOT . "/files/rss/rss.xml" );
	}
	/**
	 * строит rss файл
	 * 
	 * @return string
	 */
	private function buildRssFile() {
		global $arWords;
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getList ( array(
				"hide" => "show",
				"limit" => 10) );
		$rss = array(
				"@attributes" => array(
						'version' => '2.0'),
				"channel" => array(
						"title" => getLangString ( "rss_channel_title" ),
						"description" => getLangString ( "rss_channel_description" ),
						"image" => array(
								"url" => getLangString ( "rss_channel_image_url" ),
								"link" => getLangString ( "rss_channel_image_link" ),
								"title" => getLangString ( "rss_channel_image_title" ),
								"lastBuildDate" => date ( "d M Y" )),
						"item" => array()));
		if ($model->list) {
			foreach ( $model->list as $key => $value ) {
				$link = sprintf ( "http://alfabrok.ua/ru/%s/%s/1/%s", $arWords["TypeCatImNameArrIdPAge"][$value["im_catalog_id"]], ($value["im_is_sale"] ? "sale" : "rent"), $value["im_id"] );
				$rss["channel"]["item"][] = array(
						"title" => $value["im_title"],
						"link" => $link,
						"description" => $value["im_title"],
						"pubDate" => $value["im_date_add"],
						"guid" => $link);
			}
		}
		$xml = Array2XML::createXML ( 'rss', $rss );
		return $xml->saveXML ();
	}
	/**
	 * получени содержимого файла
	 * 
	 * @return string
	 */
	private function getRssFile() {
		return file_get_contents ( DOC_ROOT . "files/rss/rss.xml" );
	}
	/**
	 * сохранение данных в файл на серевере
	 * 
	 * @param rssfile $data        	
	 */
	private function saveRssFile($data) {
		$fp = fopen ( DOC_ROOT . "files/rss/rss.xml", 'w' );
		fwrite ( $fp, $data );
		fclose ( $fp );
	}
}