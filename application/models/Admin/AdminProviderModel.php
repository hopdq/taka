<?php
require_once 'Object/Admin/ProviderBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//

class AdminProviderModel extends CI_Model {
	public $providersList;
	function __construct() {
		parent::__construct();
		$this->providersList = array();
	}
	//
	public function Init() {
		$this->load->database('default');
		$this->db->select('Id, Name, Code, LogoUrl, Description');
		$query = $this->db->get('Provider');
		$result = $query->result('ProviderBaseInfo');
		$this->db->close();
		$this->providersList = $result;
	}
}