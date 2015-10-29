<?php
require_once 'Object/Admin/ProviderBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//

class EditingProviderModel extends CI_Model {
	public $curPro;
	function __construct() {
		parent::__construct();
	}
	//
	public function Init($id) {
		$this->load->database('default');
		$this->db->select('Id, Code, Name, LogoUrl, Description');
		$this->db->where('Id', $id);
		$query = $this->db->get('Provider');
		$result = $query->result('ProviderBaseInfo');
		$this->curPro = $result[0];
	}
	//
	public function Update2Db($id, $code, $name, $logoUrl, $descript) {
		$newPro = array(
				'Code' => $code,
				'Name' => $name,
				'LogoUrl' => $logoUrl,
				'Description' => $descript
		);
		$this->load->database('default');
		$this->db->set($newPro);
		$this->db->where('Id', $id);
		$this->db->update('Provider', $newPro);
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}

}