<?php
require_once 'Object/Admin/AttributeBaseInfo.php';
require_once 'Object/Admin/AttributeValueBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
/**
* 
*/
class DeletingAttributeValueModel extends CI_Model {
	public function DeleteAttrValue($id) {
		$this->load->database('default');
		$this->db->select('Id');
		$this->db->where('Id', $id);
		$this->db->delete('AttributeValue');
		$result = $this->db->affected_rows();
		$this->db->close();
		echo $result;
	}
}