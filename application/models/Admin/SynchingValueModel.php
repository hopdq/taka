<?php
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
/**
* 
*/
class SynchingValueModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	//
	public function GetData($valId) {
		$this->load->database('default');
		$this->db->select('Id , AttributeId,Value');
		$this->db->where('Id', $valId);
		$query = $this->db->get('AttributeValue');
		$result = $query->result('AttributeValueBaseInfo');
		$val = $result[0];
		return $val->Value;
	}
}