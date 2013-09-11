<?php
class serviceModelClass extends modelClass {
	public function getItem($id) {
		$this->item = $this->provider->getItem ( $id );
	}
	public function getList($param) {
		$res = $this->provider->getList ( $param );
		$this->list = $res ["resTable"];
		$this->listData = $res ["resTableBuild"];
	}
}