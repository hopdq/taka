<?php 
require_once 'application/models/DataAccess/ProductDa.php';
class ProductBl{
	public function validationProduct($product){
		$validation = array();
		if(!isset($product)){
			$error['code'] = "product";
			$error['message'] = "Lỗi trong quá trình cập nhật";
			array_push($validation, $error);
			return $validation;
		}
		if(!isset($product->Id)){
			$productDa = new ProductDa();
			$checkCode = $productDa->checkCodeExist($product->Code);
			if($checkCode)
			{
				$error['code'] = "code";
				$error['message'] = "Mã sản phẩm đã tồn tại";
				array_push($validation, $error);
			}
		}
		if(!isset($product->Code)){
			$error['code'] = "code";
			$error['message'] = "Mã sản phẩm trống";
			array_push($validation, $error);
		}
		if(!isset($product->Name)){
			$error['code'] = "name";
			$error['message'] = "Tên sản phẩm trống";
			array_push($validation, $error);
		}
		if(!isset($product->CategoryId) || $product->CategoryId == "0"){
			$error['code'] = "categoryId";
			$error['message'] = "Danh mục chưa được chọn";
			array_push($validation, $error);
		}
		if(!isset($product->Status) || $product->Status == "0"){
			$error['code'] = "status";
			$error['message'] = "Trạng thái chưa được chọn";
			array_push($validation, $error);
		}
		if(!isset($product->Price)){
			$error['code'] = "price";
			$error['message'] = "Giá sản phẩm trống";
			array_push($validation, $error);
		}
		if(!isset($product->Summary)){
			$error['code'] = "summary";
			$error['message'] = "Mô tả ngắn trống";
			array_push($validation, $error);
		}
		if(!isset($product->Description)){
			$error['code'] = "description";
			$error['message'] = "Mô tả chi tiết trống";
			array_push($validation, $error);
		}
		return $validation;
	}
	public function dataStandardized($product){
		$product->PromotionPrice = $product->Price;
		if(isset($product->Price) && $product->Price > 0 
			&& isset($product->IsPercentPromotion)){
			if(isset($product->PromotionValue) && $product->PromotionValue > 0){
				if($product->IsPercentPromotion)
				{
					$priceDecre = ceil($product->Price * $product->PromotionValue / 100);
					$distanse = $priceDecre % 1000;
					$realPriceDecre = $priceDecre - $distanse;
					$product->PromotionPrice = $product->Price - $realPriceDecre;
				}
				else{
					$product->PromotionPrice = $product->Price - $product->PromotionValue;
				}
			}
		}
	}
	public function insertProduct($product){
		$validation = $this->dataStandardized($product);
		$validation = $this->validationProduct($product);
		if(count($validation) > 0){
			return $validation;
		}
		$productDa = new ProductDa();
		$result = $productDa->InsertProduct($product);
		return $result;
	}
	public function updateProduct($product){
		$validation = $this->dataStandardized($product);
		$validation = $this->validationProduct($product);
		if(count($validation) > 0){
			return $validation;
		}
		$productDa = new ProductDa();
		$result = $productDa->UpdateProduct($product);
		return $result;
	}
}