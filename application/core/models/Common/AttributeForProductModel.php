<?php
require_once 'application/models/DataAccess/AttributeValueDa.php';
class AttributeForProductModel {
	public $listAttributes;
	public function __construct($productId){
		$attributeValueDa = new AttributeValueDa();
		$this->listAttributes = $attributeValueDa->getListAttributes();
		$listAttrValues = $attributeValueDa->getListByProductId($productId);
		if(count($this->listAttributes) > 0 && count($listAttrValues) > 0){
			foreach($this->listAttributes as $attr){
				$attr->listAttrValues = array();
				foreach($listAttrValues as $attrValue){
					if($attr->Id == $attrValue->AttributeId){
						$attrValue->Checked = $attrValue->Checked == 1 ? true : false;
						array_push($attr->listAttrValues, $attrValue);
					}
				}
			}
		}
	}
}