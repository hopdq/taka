<?php
class ProductItemModel extends CI_Model{
	public $Id;
	public $Code;
	public $Name;
	public $Price;
	public $PromotionPrice;
	public $PromotionValue;
	public $IsPercentPromotion;
	public $PromotionDesc;
	public $Status;
	public $ImagePath;
	public $PromotionValueDecrease;
	public $DetailUrl;
	public function __construct(){
		$this->load->helper('url');
	}
	public function init($product){
		if(isset($product)){
			$this->Id = $product->Id;
			$this->Code = $product->Code;
			$this->Name = $product->Name;
			$this->Price = $product->Price;
			$this->Price = $product->Price;
			$this->PromotionValue = $product->PromotionValue;
			$this->PromotionPrice = $product->PromotionPrice;
			$this->IsPercentPromotion = $product->IsPercentPromotion;
			$this->PromotionDesc = $product->PromotionDesc;
			$this->ImagePath = base_url($product->ImagePath);
			$this->DetailUrl = base_url('/san-pham/'.$this->Id);
			switch ($product->Status) {
				case 'CONHANG':
					$this->Status = 'Còn hàng';
					break;
				case 'HETHANG' : default:
					$this->Status = 'Hết hàng';
					break;
			}
			$this->PromotionValueDecrease = $this->Price - $this->PromotionPrice;
		}
	}
}