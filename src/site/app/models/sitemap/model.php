<?php
class sitemapModelClass extends modelClass {
	public $pagesList;
	public $pagesBuildList;
	public $pagesFormationList;
	public $immovablesList;
	public $servicesList;
	public $wikiList;
	public $partnersList;
	public $vacansiiList;
	public function getSiteMap() {
		$structureModel = new structureModelClass ( new structureProviderClass ( "pages_structure", "page_id" ) );
		$structureModel->getList ( array(
				"hide" => true) );
		$this->pagesList = $structureModel->list;
		$this->pagesBuildList = $structureModel->listData;
		
		$catalogHelper = new catalogClass ( $structureModel->list, $structureModel->listBuild, "", "page_id", "parent_id" );
		$this->pagesFormationList = $catalogHelper->get_arr_formation_in ( "1000000000000" );
	}
	public function getItem($id) {
		$this->item = $this->provider->getItem ( $id );
	}
	public function getList($param) {
		$res = $this->provider->getList ( $param );
		$this->list = $res["resTable"];
		$this->listData = $res["resTableBuild"];
	}
}