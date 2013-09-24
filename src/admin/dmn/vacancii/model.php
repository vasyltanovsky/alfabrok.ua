<?php
class DMN_Vacancii extends Controller {
	public $dictionaries;
	public function getPage($array) {
		$vacanciiProvider = new VacanciiProvider ( 'vacancii' );
		$vacanciiProvider->GetVacanciiList ();
		$tListData = $this->Template ( "/dmn/vacancii/template/list.phtml", array(
				'Data' => $vacanciiProvider->resTable) );
		$tAction = $this->Template ( "/dmn/vacancii/template/action.phtml", array(
				'Data' => "") );
		return $this->Template ( "/dmn/utils/templates/admin/page.phtml", array(
				'tListData' => $tListData,
				"tAction" => $tAction) );
	}
	public function getVacance($array) {
		$this->getDictionaris ();
		$this->dictionaries->do_dictionaries ( 77 );
		$typeVacancii = $this->dictionaries->my_dct;
		$Data = NULL;
		if (isset ( $array["id"] )) {
			$vacanciiProvider = new VacanciiProvider ( 'vacancii' );
			$Data = $vacanciiProvider->GetVacance ( $array['id'] );
		}
		return $this->Template ( "/dmn/vacancii/template/form.phtml", array(
				'Data' => $Data,
				"typeVacancii" => $typeVacancii) );
	}
	public function saveVacance($array) {
		$return['success'] = true;
		$vacanciiProvider = new VacanciiProvider ( 'vacancii' );
		if ($array['type_save'] == "new") {
			$error = $status = $vacanciiProvider->SaveVacance ( $array );
			if ($error) {
				$return['generalError'] = $error;
				$return['success'] = false;
			}
		}
		if ($array['type_save'] == "edit") {
			$arr_update = array(
					"hide" => ($array['hide'] ? 1 : 0) . ",",
					"title" => "'" . $array['title'] . "',",
					"description" => "'" . $array['description'] . "',",
					"text" => "'" . $array['text'] . "',",
					"url" => "'" . ($array['url'] ? $array['url'] : translitStrlover ( $array['title'] ) . "-" . $array['v_id']) . "',",
					"w_title" => "'" . $array['w_title'] . "',",
					"w_keywords" => "'" . $array['w_keywords'] . "',",
					"w_description" => "'" . $array['w_description'] . "',",
					"type_id" => "'" . $array['type_id'] . "',",
					"pos" => ($array['pos'] ? $array['pos'] : "null"));
			$vacanciiProvider->UpdateVacance ( $array['v_id'], $arr_update );
			$return['success'] = true;
		}
		return $return;
	}
	public function delete($array) {
		$sql = "delete from vacancii where v_id= '{$array['id']}'";
		if (! mysql_query ( $sql )) {
			$return['success'] = false;
			$return['error'] = "error {$sql}";
			return $return;
		}
		$return['conf'] = "DMN_Vacancii";
		$return['success'] = true;
		return $this->getPage ( array() );
	}
	public function getDictionaris() {
		// бъявляем класс словаря
		$this->dictionaries = new dictionaries ();
		// ормируем массив имени словарей
		$this->dictionaries->buid_dictionaries_list ( "list_dictionaries" );
		// ормируем массив значений словарей
		$this->dictionaries->buid_dictionaries ( "dictionaries", "WHERE lang_id = {$_COOKIE[lang_id]}" );
	}
}
?>