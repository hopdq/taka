<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//
/**
* 
*/
class EditingAttributeModel extends CI_Model
{
	public $id;
	public function __construct() {
		parent::__construct();
	}
	//
	public function Init($id) {
		$this->id = $id;
	}
	//
	public function Update2Db($attrCode, $attrName) {
		$editingAttr = array(
				'Code' => $attrCode,
				'Name' => $attrName
			);
		$this->load->database('default');
		$this->db->set($editingAttr);
		$this->db->where('Id', $this->id);
		$this->db->update('Attributes');
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
}