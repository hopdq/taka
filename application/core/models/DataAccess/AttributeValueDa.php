<?php 
require_once 'system/core/Model.php';
require_once 'application/helpers/StringHelper.php';
class AttributeValueDa extends CI_Model{
	public function getListByProductId($productId){
		$this->load->database('default');
		$sql = "call productAttributes_Get4ProductManager (?);";
        $query = $this->db->query($sql, array($productId));
 		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function getListAttributes(){
		$this->load->database('default');
		$this->db->select("Id,Name,Code");
		$query = $this->db->get("Attributes");
 		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function updateAttributeValues($productId, $listAttrValues){
		if(count($listAttrValues) > 0){
			$lstStr = StringHelper::concatArray2Str($listAttrValues, ',');
			$this->load->database('default');
			$sql = "call productAttributeValue_InsertUpdate (?, ?);";
	        $query = $this->db->query($sql, array($productId, $lstStr));
			$this->db->close();
			return 1;
		}
		return 0;
	}
}