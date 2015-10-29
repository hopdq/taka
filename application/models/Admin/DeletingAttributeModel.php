<?php
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
/**
* 
*/
class DeletingAttributeModel extends CI_Model {
	//
	public $id;
	//
	function __construct() {
		parent::__construct();
	}
	//
	public function Init($id) {
		$this->id = $id;
	}
	//
	public function DeleteAttribute() {
		$this->load->database('default');
		$this->db->select('Id');
		$this->db->where('Id', $this->id);
		$this->db->delete('Attributes');
		$result1 = $this->db->affected_rows();
		$this->DeleteAllValues();
		$result2 = $this->db->affected_rows();
		$this->db->close();
		return $result1 + $result2;
	}
	//
	public function DeleteAllValues() {
		$this->load->database('default');
		$this->db->select('AttributeId');
		$this->db->where('AttributeId', $this->id);
		$this->db->delete('AttributeValue');
	}

}