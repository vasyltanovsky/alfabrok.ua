<?php
class DMN_ReferenceCustomers extends Controller {
	public $dictionaries;
	
	public function getPage($array) {
		$this->getDictionaris ();
		$this->dictionaries->do_dictionaries ( 76 );
		$TypeDict = $this->dictionaries->my_dct;
		$provider = new ReferenceCustomersProvider ( 'reference_customers' );
		$provider->GetList ( $array );
		$tListData = $this->Template ( "/dmn/ReferenceCustomers/template/list.phtml", array ('Data' => $provider->resTable ) );
		$tAction = $this->Template ( "/dmn/ReferenceCustomers/template/action.phtml", array ('Data' => "", "TypeDict" => $TypeDict ) );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array ('tListData' => $tListData, "tAction" => $tAction ) );
	}
	
	public function getPageJson($array) {
		$provider = new ReferenceCustomersProvider ( 'reference_customers' );
		$provider->GetJsonList ( $array );
		$response = $provider->resTable;
		return $response;
	}
	
	public function getItem($array) {
		$this->getDictionaris ();
		$this->dictionaries->do_dictionaries ( 76 );
		$TypeDict = $this->dictionaries->my_dct;
		//
		$Data = NULL;
		if (isset ( $array ["id"] )) {
			$provider = new ReferenceCustomersProvider ( 'reference_customers' );
			$Data = $provider->GetItem ( $array ['id'] );
		}
		return $this->Template ( "/dmn/ReferenceCustomers/template/form.phtml", array ('Data' => $Data, "TypeDict" => $TypeDict ) );
	}
	
	public function saveItem($array) {
		$return ['success'] = true;
		$provider = new ReferenceCustomersProvider ( 'reference_customers' );
		if ($array ['type_save'] == "new") {
			$error = $status = $provider->SaveItem ( $array );
			if ($error) {
				$return ['generalError'] = $error;
				$return ['success'] = false;
			}
		}
		if ($array ['type_save'] == "edit") {
			$arr_update = array ("rc_fio" => "'" . $array ['rc_fio'] . "',", "rc_tel" => "'" . $array ['rc_tel'] . "',", "rc_summary" => "'" . $array ['rc_summary'] . "',", "type_id" => "'" . $array ['type_id'] ."'" );
			$provider->UpdateItem ( $array ['rc_id'], $arr_update );
			$return ['success'] = true;
		}
		return $return;
	}
	
	public function delete($array) {
		$sql = "delete from reference_customers where rc_id= {$array['id']}";
		if (! mysql_query ( $sql )) {
			$return ['success'] = false;
			$return ['error'] = "error {$sql}";
			return $return;
		}
		$return ['conf'] = "DMN_ReferenceCustomers";
		$return ['success'] = true;
		return $this->getPage ( array () );
	}
	
	public function getDictionaris() {
		#объявляем класс словаря
		$this->dictionaries = new dictionaries ( );
		#формируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		#формируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}

}