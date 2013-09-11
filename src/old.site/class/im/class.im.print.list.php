<?php
/*
 * 
 *  
 *
 * @version class.catalog.php,v 1.0 2010/08/10
 * @author <AlexTsurkin/>
 * @license GNU GPLv3
 */
class ImListPrint {
	public $SqlQuery;
	public $ModuleTemplate;
	public $Settings;
	public $dict;
	public $lang;
	
	function __construct($SqlQuery = NULL, $ModuleTemplate = NULL, $Settings = NULL, $dict = NULL, $lang = NULL) {
		
		$this->SqlQuery = $SqlQuery;
		$this->ModuleTemplate = $ModuleTemplate;
		$this->Settings = $Settings;
		$this->dict = $dict;
		$this->lang = $lang;
	}
	
	public function GetSqlData() {
		$ClassImSelect = new mysql_select ( 'immovables', $this->SqlQuery );
		$ClassImSelect->select_table ( "im_id" );
		return $ClassImSelect->table;
	}
	
	public function GetContent($mod_id, $title, $set_id) {
		$ImData = $this->GetSqlData ();
		if (empty ( $ImData ))
			return;
		
		$ModIm = new ModuleSiteIm ( $this->ModuleTemplate, $this->lang, $this->dict );
		$Content = $ModIm->Handler_Template_Html ( $mod_id, $ImData, $this->Settings [$set_id] );
		
		$ModHeder = new ModuleSite ( $this->ModuleTemplate );
		$Content = $ModHeder->For_HTML ( $Content, $title );
		return $Content;
	}
}
?>