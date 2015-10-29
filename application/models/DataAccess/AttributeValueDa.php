<?php 
require_once 'system/core/Model.php';
require_once 'application/helpers/StringHelper.php';
class AttributeValueDa extends CI_Model{
	public function getListByProductId($productId){
		if(!isset($productId) || $productId == "")
		{
			$productId = "0";
		}
		$this->load->database('default');
		$this->db->select('av.Id,
			av.AttributeId,
			av.Value,
			case when ifnull(pa.ProductId, "0") != "0" then true else false end as Checked ');
		$this->db->join('Attributes att', 'av.AttributeId = att.Id');
		$this->db->join('ProductAttrValue pa', 'av.Id = pa.AttributeValueId and pa.ProductId = '.$productId, 'left');
		$this->db->distinct();
		$query = $this->db->get('AttributeValue av');
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