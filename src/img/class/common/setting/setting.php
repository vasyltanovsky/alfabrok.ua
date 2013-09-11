<?php
class settingClass {
	public function __construct() {
		try {
			//обрабатываем xml таблиц БД
			$xmlObj = new XmlToArray ( null );
			if (($fc = file_get_contents ( DOC_ROOT . '/config/settings.db.tables.xml' )) !== false) {
				$xmlObj->xml = $fc;
				$arrData = $xmlObj->createArray ();
				foreach ( $arrData ['tables'] ['table'] as $key => $value ) {
					$tbl [$value ['name']] = $value;
				}
			} else
				throw new Exception ( 'Error open settings.db.tables.xml.' );
				
			//	if (($fc = file_get_contents ( DOC_ROOT . '/config/settings.articles.xml' )) !== false) {
			//		print_r($fc);
			//
			//	}
			//	else throw new Exception('Error open settings.db.tables.xml.');
			if (($fc = file_get_contents ( DOC_ROOT . '/config/settings.config.xml' )) !== false) {
				$xmlObj->xml = $fc;
				$arrData = $xmlObj->createArray ();
				$CONFIG ['Email'] = $arrData ['settings'] ['Email'];
				foreach ( $arrData ['settings'] ['Module'] [0] as $key => $value ) {
					$CONFIG ["Module"] [$key] = $value;
				}
				foreach ( $arrData ['settings'] ['table_identifidation'] [0] as $key => $value ) {
					$CONFIG ['table_identifidation'] [$key] = $value;
				}
			} else
				throw new Exception ( 'Error open settings.db.tables.xml.' );
			
			if (empty ( $_COOKIE ['lang_id'] )) {
				$_COOKIE ['lang_id'] = $CONFIG ['Module'] ['ModuleLanguages'] ['default_id'];
				$_COOKIE ['lang_code'] = $CONFIG ['Module'] ['ModuleLanguages'] ['default'];
			}
		
		} catch ( Exception $exc ) {
			echo ExceptionFullGet::ExcError ( $exc );
		}
	}
}
