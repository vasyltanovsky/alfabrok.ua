<?php

class dictionaryTreeClass {
	public $buildList = null;
	public $dictClass = null;
	public $selectedList = null;
	public $bufferList = null;
	public $return = null;
	public $selectedBuild = NULL;
	
	function __construct($buildList = null, $dictClass = null, $selectedList = null) {
		$this->buildList = $buildList;
		$this->dictClass = $dictClass;
		$this->selectedList = $selectedList;
	}
	
	//	формирует дерево вхождений
	public function buildDictionaryTree($parent_id = "NULL") {
		$this->bufferList = $this->buildList;
		//перемещение если работа производиться с перемещением киева
		$this->doReposition ();
		$this->return ["child"] = $this->searchChildrenElements ( $parent_id );
		return;
	}
	//перемещение если работа производиться с перемещением киева
	public function doReposition() {
		$buffer = $this->bufferList [0];
		for($i = 1; $i < count ( $this->bufferList ); $i ++) {
			if ($this->bufferList [$i] [0] == "4c3eb839f144e") {
				$val = $this->bufferList [$i];
				$this->bufferList [$i] = $buffer;
				$this->bufferList [0] = $val;
				return;
			}
		
		}
	}
	
	//	формирует дерево вхождений
	public function searchChildrenElements($parent_id, $marge = 0) {
		$return = array ();
		$flag = false;
		foreach ( $this->bufferList as $key => $value ) {
			if ($parent_id == $value [1]) {
				//перемещение если работа производиться с перемещением киева
				if ($value [0] == "4c3eb839f144e") {
					$marge = 1;
					$flag = true;
				}
				$value [2] = $value [2] + $marge;
				if (isset ( $this->selectedList [$value [0] . '_' . $value [2]] ))
					$this->selectedBuild [count ( $this->selectedBuild )] = array_merge ( $value, $this->dictClass->buld_table [$value [0]] );
				unset ( $this->bufferList [$key] );
				$child = $this->searchChildrenElements ( $value [0], $marge );
				
				//перемещение если работа производиться с перемещением киева
				if ($flag) {
					$flag = false;
					$marge = 0;
				}
				
				//$return [count ( $return )] = array_merge ( $value, $this->dictClass->buld_table [$value [0]] );
				$checked = (isset ( $this->selectedList [$value [0] . '_' . $value [2]] ) ? "true" : "");
				if (count ( $child ) > 0)
					$return [count ( $return )] = array_merge ( $value, $this->dictClass->buld_table [$value [0]], array ("checked" => $checked, "child" => $child ) );
				else
					$return [count ( $return )] = array_merge ( $value, $this->dictClass->buld_table [$value [0]], array ("checked" => $checked ) );
			
			}
		}
		return $return;
	}
}