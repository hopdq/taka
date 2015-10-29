<?php
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
/**
* 
*/
class AdminAttributeModel extends CI_Model {
	public $attributesList;
	function __construct() {
		parent::__construct();
		$this->attributesList = array();
	}
	//
	public function Init() {
		$this->load->database('default');
		$this->db->select('Id, Name, Code');
		$query = $this->db->get('Attributes');
		$result = $query->result('AttributeBaseInfo');
		$this->db->close();
		$this->attributesList = $result;
		foreach ($this->attributesList as $attribute) {
			$id = $attribute->Id;
			$attribute->AttributeValuesList = $this->GetValuesList($id);
		}
	}
	//
	public function GetValuesList($id) {
		$this->load->database('default');
		$this->db->select('Id, AttributeId, Value');
		$this->db->where('AttributeId', $id);
		$query = $this->db->get('AttributeValue');
		$result = $query->result('AttributeValueBaseInfo');
		return $result;
	}

}