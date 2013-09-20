<?php
class vakansiiController extends aControllerClass {
	public function index($param) {
		return $this->View ();
	}
	public function podrobno($param) {
		return $this->View (array(), "vakancii/details");
	}
}