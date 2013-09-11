<?php
#
#		����� ���������� ������� ������ ������� ������ ���� ������� 
#		�������  ����� ��������� ID, PARENT_ID
#


class cl_build_tree {
	#����������� ������ � �������� ���� �������� ������
	public $table;
	#��� ���� 
	public $name_id;
	#��� ������ ����
	public $name_parent;
	#����������� ������ id
	public $build_tree_id;
	#����������� ������ ���� ������ ������
	//public $build_tree_array;
	#���������� ��� ��������
	public $some_j;
	#arr ���� �� ������ ������� ��������
	public $arr_id_to_parent;
	// ����������� ������
	public function __construct($table, $name_id = 'id', $name_parent = 'parent_id', $build_tree_id = array(), $some_j = 0, $in_parent = 'parent_in', $arr_id_to_parent = array()) {
		$this->table = $table;
		$this->name_id = $name_id;
		$this->name_parent = $name_parent;
		$this->build_tree_id = $build_tree_id;
		$this->some_j = $some_j;
		$this->in_parent = $in_parent;
		$this->arr_id_to_parent = $arr_id_to_parent;
	}
	
	#������� ��������� ������
	public function b_t_id() {
		for($i = 0; $i < count ( $this->table ); $i ++) {
			#�������� ������ ���� 0
			if ($this->table [$i] [$this->name_parent] == 0) {
				#���������� � ������ ���������� ����������
				$this->build_tree_id [$this->some_j] = array ($this->table [$i] [$this->name_id], $this->table [$i] [$this->in_parent] );
				#�������� ������� ������ �������� �������
				$this->b_t_id_next ( $this->table [$i] [$this->name_id] );
				#����������� �������
				$this->some_j ++;
			}
		}
		return;
	}
	
	#������� ������ �������� �������, ������ ��������� ����������� ������
	public function b_t_id_next($search_id) {
		for($i = 0; $i < count ( $this->table ); $i ++) {
			#���� ����������� ���� ����� �������� ����
			if ($this->table [$i] [$this->name_parent] == $search_id) {
				#��������� �������
				$this->some_j ++;
				#���������� � ������ ���������� ����������
				$this->build_tree_id [$this->some_j] = array ($this->table [$i] [$this->name_id], $this->table [$i] [$this->in_parent] );
				#�������� ������� ������ �������� �������
				$this->b_t_id_next ( $this->table [$i] [$this->name_id] );
			}
		}
		return;
	}
	
	#	��� ������� ������� �������� �� ����� ������ � �������� ����
	public function b_t_active_id($value_id, $value_p_id) {
		
		for($i = 0; $i < count ( $this->table ); $i ++) {
			if ($this->table [$i] [$this->name_parent] == $value_p_id) {
				$parent_id_t_parent_i = count ( $this->arr_id_to_parent );
				
				if (($this->table [$i] [$this->name_parent] != 0) or ($this->table [$i] [$this->name_id] == $value_id))
					$this->arr_id_to_parent [$parent_id_t_parent_i] = $this->table [$i] [$this->name_id];
			}
		}
		$this->b_id_too_null ( $value_id, $value_p_id );
		$this->b_t_active_children ( $value_id );
		return;
	}
	
	# ������� ������ ������ �� ��������� ���� �� ������ ������� ��������
	public function b_id_too_null($value_id, $value_p_id) {
		for($i = 0; $i < count ( $this->table ); $i ++) {
			$parent_id_t_parent_i = count ( $this->arr_id_to_parent );
			if ($this->table [$i] [$this->name_id] == $value_p_id) {
				$this->arr_id_to_parent [$parent_id_t_parent_i] = $this->table [$i] [$this->name_id];
				$this->b_id_too_null ( $this->table [$i] [$this->name_id], $this->table [$i] [$this->name_parent] );
				
				if ($this->table [$i] [$this->name_parent] == 0) {
					$this->b_t_active_children ( $this->table [$i] [$this->name_id] );
				}
			}
		}
		return;
	}
	
	#	���� ��������� ������
	public function b_t_active_children($value_id) {
		for($i = 0; $i < count ( $this->table ); $i ++) {
			$parent_id_t_parent_i = count ( $this->arr_id_to_parent );
			if ($this->table [$i] [$this->name_parent] == $value_id) {
				$this->arr_id_to_parent [$parent_id_t_parent_i] = $this->table [$i] [$this->name_id];
			}
		}
		return;
	}
	
	#������� ��������� ������
	public function NEW_b_t_id() {
		for($i = 0; $i < count ( $this->table ); $i ++) {
			#�������� ������ ���� 0
			if ($this->table [$i] [$this->name_parent] == 0) {
				#���������� � ������ ���������� ����������
				$this->build_tree_id [$this->some_j] = array ($this->table [$i] [$this->name_id], 0, $this->table [$i] ['name_page'] );
				#�������� ������� ������ �������� �������
				$this->NEW_b_t_id_next ( $this->table [$i] [$this->name_id], 0, $this->table [$i] ['name_page'] );
				#����������� �������
				$this->some_j ++;
			}
		}
		return;
	}
	
	#������� ������ �������� �������, ������ ��������� ����������� ������
	public function NEW_b_t_id_next($search_id, $in_parent, $link_str) {
		$in_parent ++;
		$double = false;
		for($i = 0; $i < count ( $this->table ); $i ++) {
			#���� ����������� ���� ����� �������� ����
			if ($this->table [$i] [$this->name_parent] == $search_id) {
				$pre = "&";
				if ($in_parent == 1)
					$pre = "?";
				
				$link_str .= $pre . "" . $in_parent . "=" . $this->table [$i] [$this->name_id];
				
				#��������� �������
				$this->some_j ++;
				#���������� � ������ ���������� ����������
				$this->build_tree_id [$this->some_j] = array ($this->table [$i] [$this->name_id], $in_parent, $link_str );
				#�������� ������� ������ �������� �������
				$this->NEW_b_t_id_next ( $this->table [$i] [$this->name_id], $in_parent, $link_str );
			}
		}
		return;
	}
	
	public function str_link($value_id, $value_p_id, $arr_build, $arr = array()) {
		$my_file = 1;
		$arr [0] = $arr_build [$value_id];
		while ( $my_file == 1 ) {
			if (empty ( $arr_build [$value_id] ['parent_id'] )) {
				$my_file = 0;
			} else {
				$value_id = $arr_build [$value_id] ['parent_id'];
				$arr [count ( $arr )] = $arr_build [$value_id];
			}
		
		}
		return $arr;
	}
	
	public function build_IPI($arr, $id, $name_id = 'sc_id', $name_parent_id = 'parent_id', $wReturn = 'str', $dictId = NULL) {
		$return = NULL;
		$return_arr_i = 0;
		$return_arr = array ();
		for($i = 0; $i < count ( $arr ); $i ++) {
			if ($arr [$i] [$name_parent_id] == $id) {
				if ($dictId) {
					if ($dictId == $arr [$i] ['dict_id']) {
						$return .= "'{$arr[$i][$name_id]}',";
						if (count ( $return_arr ) > 0)
							$return_arr_i = count ( $return_arr );
						$return_arr [$return_arr_i] = $arr [$i] [$name_id];
					}
				} else {
					$return .= "'{$arr[$i][$name_id]}',";
					if (count ( $return_arr ) > 0)
						$return_arr_i = count ( $return_arr );
					$return_arr [$return_arr_i] = $arr [$i] [$name_id];
				}
			}
		}
		if ($wReturn == 'str')
			return $return = "(" . $return . "'{$id}')";
		else
			return $return_arr;
	}
}

?>