<?php
require_once 'Object/Common/ProductStatus.php';
class ProductStatusHelper{
	public static function Init(){
		$listStatuses = array(1 => new ProductStatus("CONHANG", "Còn hàng"), 
							2 => new ProductStatus("HETHANG", "Hết hàng"), 
							3 => new ProductStatus("NHAPHANG", "Nhập hàng"));
		return $listStatuses;
	}
	public static function GetListStatuses(){
		return ProductStatusHelper::Init();
	}
	public static function GetNameById($id){
		$listStatuses = ProductStatusHelper::Init();
		$result = "";
		foreach($listStatuses as $stt){
			if($stt->Id == $id){
				$result = $stt->Name;
				break;
			}
		}
		return $result;
	}
}