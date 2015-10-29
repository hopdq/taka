<?php
require_once 'system/core/Model.php';
class HintOrderModel extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	//
	public function GetHintOrder($parentId) {
		$this->load->database('default');
		$this->db->select('Order');
		$this->db->where('('.$parentId.' = 0 and ifnull(ParentId, "0") = 0) or ParentId ='.$parentId);
		$this->db->order_by('Order DESC');
		$query = $this->db->get('Category', 1);
		$result = $query->result();
		$this->db->close();
		if (count($result) == 0) {
			return 1;
		} else {
			return intval(($result[0]->Order)+1);
		}
	}
}