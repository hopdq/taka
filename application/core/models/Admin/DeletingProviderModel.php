<?php
require_once 'Object/Admin/ProviderBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//

class DeletingProviderModel extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	//
	public function Update2Db($id) {
		$this->load->database('default');
		$this->db->where('Id', $id);
		$this->db->delete('Provider');
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}

}