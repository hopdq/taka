<?php
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
/**
* 
*/
class AddingAttributeModel extends CI_Model {
	public $newAttr;
	function __construct() {
		parent::__construct();
		$this->newAttr= new AttributeBaseInfo();
	}
	//
	public function Init($attrCode, $attrName) {
		$this->newAttr->Code = $attrCode;
		$this->newAttr->Name = $attrName;
	}
	//
	public function Update2Db() {
		$this->load->database('default');
		$this->db->select('max(cast(Id as decimal)) as MaxId');
		$query = $this->db->get('Attributes');
		$row = $query->row();
		if(isset($row))
		{
			$this->newAttr->Id = $row->MaxId + 1;
		}
		else{
			$this->newAttr->Id = 1;
		}
		$this->db->close();
		$this->load->database('default');
		$newAttr = array(
				'Id' => $this->newAttr->Id,
				'Code' => $this->newAttr->Code,
				'Name' => $this->newAttr->Name,
		);
		$this->db->insert('Attributes', $newAttr);
		$result = $this->db->affected_rows();
		$this->db->close();
		if ($result == 1) {
			return $this->newAttr->Id;
		} else {
			return -1;
		}
	}

}