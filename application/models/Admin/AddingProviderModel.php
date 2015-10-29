<?php
require_once 'Object/Admin/ProviderBaseInfo.php';
require_once 'application/models/Admin/AdminMasterModel.php';
//

class AddingProviderModel extends CI_Model {
	public $newPro;
	function __construct() {
		parent::__construct();
		$this->newPro= new ProviderBaseInfo();
	}
	//
	public function Init($newProData) {
		$this->newPro->Code = $newProData->Code;
		$this->newPro->Name = $newProData->Name;
		$this->newPro->LogoUrl = $newProData->LogoUrl;
		$this->newPro->Description = $newProData->Description;
	}
	//
	public function Update2Db() {
		$this->load->database('default');
		$this->db->select('max(cast(Id as decimal)) as MaxId');
		$query = $this->db->get('Provider');
		$row = $query->row();
		if(isset($row))
		{
			$this->newPro->Id = $row->MaxId + 1;
		}
		else{
			$this->newPro->Id = 1;
		}
		$this->db->close();
		$this->load->database('default');
		$proData = array(
				'Id' => $this->newPro->Id,
				'Code' => $this->newPro->Code,
				'Name' => $this->newPro->Name,
				'LogoUrl' => $this->newPro->LogoUrl,
				'Description' => $this->newPro->Description
		);
		$this->db->insert('Provider', $proData);
		$result = $this->db->affected_rows();
		$this->db->close();
		if ($result == 1) {
			return 1;
		} else {
			return -1;
		}
	}

}