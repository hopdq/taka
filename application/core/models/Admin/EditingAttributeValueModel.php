<?php
require_once 'system/core/Model.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//
/**
* 
*/
class EditingAttributeValueModel extends CI_Model
{
	//public $editingVal;
	public function __construct() {
		//parrent::__construct();
	}
	//
	public function EditValue($valId, $newVal) {
		$attNewVal = array(
	        'Id' => $valId,
	        'Value' => $newVal
	     );
		$this->load->database('default');
		$this->db->set($attNewVal);
		$this->db->where('Id', $valId);
		$this->db->update('AttributeValue');
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
}