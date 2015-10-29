<?php
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
/**
* 
*/
class AddingAttributeValueModel extends CI_Model {
	public $attrValue;
	function __construct() {
		parent::__construct();
		$this->attrValue= new AttributeValueBaseInfo();
	}
	//
	public function Init($attrId , $value) {
		$this->attrValue->AttributeId = $attrId;
		$this->attrValue->Value = $value;
	}
	//
	public function Update2Db() {
		$this->load->database('default');
		$this->db->select('max(cast(Id as decimal)) as MaxId');
		$query = $this->db->get('AttributeValue');
		$row = $query->row();
		if(isset($row))
		{
			$this->attrValue->Id = $row->MaxId + 1;
		}
		else{
			$this->attrValue->Id = 1;
		}
		$this->db->close();
		$this->load->database('default');
		$newAttr = array(
				'Id' => $this->attrValue->Id,
				'AttributeId' => $this->attrValue->AttributeId,
				'Value' => $this->attrValue->Value,
		);
		$this->db->insert('AttributeValue', $newAttr);
		$result = $this->db->affected_rows();
		$this->db->close();
		if ($result == 1) {
			return $this->attrValue->Id;
		} else {
			return -1;
		}
	}

}