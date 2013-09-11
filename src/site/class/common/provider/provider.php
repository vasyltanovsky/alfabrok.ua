<?php 
/**
 * @author K53E
 *
 */
abstract class abstractProviderClass {
	public $table;
	public $order;
	public $limit;
	public $id;
	
	public $resTable;
	public $resBuildTable;
	
	/**
	 * @param unknown_type $table
	 * @param unknown_type $order
	 * @param unknown_type $limit
	 * @param unknown_type $id
	 */
	public function __construct($table, $order = "", $limit = "", $id = "") {
		global $tbl;
		$this->table = $table;
		$this->order = (empty($order) ? $tbl[$table]['order'] : $order );
		$this->limit = (empty($limit) ? $tbl[$table]['limit'] : $limit );
		$this->id = (empty($id) ? $tbl[$table]['id'] : $id );
		
		$this->resTable;
		$this->resBuildTable;
	}
	
	public function SetValue( $field, $value ) {
		$this->$field = $value;
	}
}