<?php
class sitemapController extends aControllerClass {
	public function index($param) {
		$model = new sitemapModelClass ( new sitemapProviderClass ( "" ) );
		$model->getSiteMap ();
		return $this->view ( array(
				"Model" => $model) );
	}
	public function build() {
		if (! $this->checkIssetSitemapFile ()) {
			$sitemapfiledata = $this->buildSitemapFile ();
			$this->saveSitemapFile ( $sitemapfiledata );
		}
		header ( "Content-Type: text/xml" );
		echo $this->getSitemapFile ();
		$this->isPartial = true;
	}
	/**
	 * проверка на существование файла и время его жизни
	 *
	 * @return boolean
	 */
	private function checkIssetSitemapFile() {
		$isset = false;
		if (file_exists ( DOC_ROOT . "sitemap.xml" )) {
			$cachelink_time = filemtime ( DOC_ROOT . "sitemap.xml" );
			if (time () > strtotime ( date ( 'Y-m-d', $cachelink_time ) . ' + 5 days' )) {
				$isset = false;
				$this->deleteSitemapFile ();
			} else
				$isset = true;
		}
		return $isset;
	}
	private function deleteSitemapFile() {
		unlink ( DOC_ROOT . "sitemap.xml" );
	}
	/**
	 * строит sitemap файл
	 *
	 * @return string
	 */
	private function buildSitemapFile() {
		global $arWords;
		$model = new immovablesModelClass ( new immovablesProviderClass ( "immovables", "im_id" ) );
		$model->getList ( array(
				"hide" => "show",
				"limit" => 10) );
		
		$model = new sitemapModelClass ( new sitemapProviderClass ( "" ) );
		$model->getSiteMap ();
		
		$urlset = array(
				"@attributes" => array(
						'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
						'xsi:schemaLocation' => 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd',
						'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9'),
				"url" => array());
		
		if ($model->pagesList) {
			foreach ( $model->pagesList as $key => $value ) {
				$urlset["url"][] = array(
						"loc" => sprintf ( "http://%s%s", $_SERVER['HTTP_HOST'], $value["page_url"] ),
						"lastmod" => date ( "Y-m-d H:i:s" ),
						"changefreq" => "weekly",
						"priority" => ($value["controller"] == "index" && $value["action"] == "index" ? 1 : 0.9));
				$pagexml = null;
				$pagexml = appHtmlClass::dataAction ( $value["controller"], "sitemapxml", array(
						"action" => $value["action"],
						"priority" => $value["priority"]) );
				if (! empty ( $pagexml )) {
					$urlset["url"] = array_merge ( $urlset["url"], $pagexml );
				}
			}
		}
		Array2XML::init ( "1.0", "UTF-8", true, "http://alfabrok.loc/files/xml/sitemap.xsl" );
		$xml = Array2XML::createXML ( 'urlset', $urlset );
		return $xml->saveXML ();
	}
	/**
	 * получени содержимого файла
	 *
	 * @return string
	 */
	private function getSitemapFile() {
		return file_get_contents ( DOC_ROOT . "sitemap.xml" );
	}
	/**
	 * сохранение данных в файл на серевере
	 *
	 * @param rssfile $data        	
	 */
	private function saveSitemapFile($data) {
		$fp = fopen ( DOC_ROOT . "sitemap.xml", 'w' );
		fwrite ( $fp, $data );
		fclose ( $fp );
	}
}