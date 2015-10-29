<?php
require_once 'application/models/DataAccess/ProductDa.php';
require_once 'application/models/UI/ProductItemModel.php';
require_once 'application/models/UI/FilterItemModel.php';
require_once 'application/models/UI/AttributeFilterModel.php';	
require_once 'application/models/UI/FilterModel.php';
require_once 'application/models/UI/PriceFilterModel.php';
require_once 'DataFactory.php';
class ProductGridModel extends CI_Model{
	public $filter;
	public $sorter;
	public $filterModel;
	public $products;
	public $paging;
	public function __construct(){
		parent::__construct();
		$this->products = array();
		$this->filterModel = new FilterModel();
	}
	public function init($filter, $sorter, $paging, $type){
		$this->filter = $filter;
		$this->sorter = $sorter;
		$this->paging = $paging;
		$productDa = new ProductDa();
		$productResults = $productDa->getProductsFilterSortPaging($this->filter, $this->sorter, $this->paging);
		if(isset($productResults)){
			if(isset($productResults['paging']))
			{
				$resultPaging = $productResults['paging'];
				$paging->calTotalPages($resultPaging->totalItems);
			}
			if(isset($productResults['products'])){
				$products = $productResults['products'];
				if(count($products) > 0){
					foreach ($products as $product) {
						$productItem = new ProductItemModel();
						$productItem->init($product);
						array_push($this->products, $productItem);
					}
				}
			}
		}
		$filters = DataFactory::getFilters($type, $this->filter);
		if(isset($filters)){
			//provider filter
			if(isset($filters['providers'])){
				$providers = $filters['providers'];
				$this->filterModel->providers = array();
				if(count($providers) > 0){
					foreach ($providers as $provider) {
						$provider->isActive = $provider->Id == $this->filter->providerId;
						$provider->activeClass = $provider->isActive ? "active" : "";
						array_push($this->filterModel->providers, $provider);
					}
				}
			}
			//price filter
			if(isset($filters['prices'])){
				$prices = $filters['prices'];
				$this->filterModel->price = new PriceFilterModel($prices->minPrice, $prices->maxPrice);
			}
			$this->filterModel->attrs = array();
			//attributes filter
			if(isset($filters['attributeValues'])){
				$attributeValues = $filters['attributeValues'];
				if(count($attributeValues) > 0){
					foreach ($attributeValues as $attr) {
						$title = "";
						$code = "";
						if(isset($attr) && count($attr) > 0){
							$title = $attr[0]->AttributeName;
							$code = $attr[0]->AttributeCode;
						}
						$filterItem = new FilterItemModel();
						$filterItem->title = $title;
						$filterItem->code = $code;
						$filterItem->items = array();
						foreach ($attr as $value) {
							$item = new AttributeFilterModel($value->Id, $value->Value);
							$item->attrId = $value->AttributeId;
							$item->Cnt = $value->Cnt;
							$item->isActive = false;
							if(isset($this->filter) && isset($this->filter->attrValues))
							{
								foreach ($this->filter->attrValues as $filterAttr) {
									if($filterAttr->value == $value->Id){
										$item->isActive = true;
										break;
									}
								}
							}
							array_push($filterItem->items, $item);
						}
						array_push($this->filterModel->attrs, $filterItem);
					}
				}
			}

			//attributes filter
			if(isset($filters['otherAttributeValues'])){
				$attributeValues = $filters['otherAttributeValues'];
				if(count($attributeValues) > 0){
					$attrs = array();
					foreach ($attributeValues as $attr) {
						if(!array_key_exists($attr->AttributeId, $attrs)){
							$attrs[$attr->AttributeId] = $attr;
						}
					}
					if(count($attrs) > 0){
						foreach ($attrs as $key => $value) {
							$filterItem = new FilterItemModel();
							$filterItem->title = $value->AttributeName;
							$filterItem->code = $value->AttributeCode;
							$filterItem->items = array();
							foreach ($attributeValues as $attrValue) {
								if($attrValue->AttributeId == $key)
								{
									$item = new AttributeFilterModel($attrValue->Id, $attrValue->Value);
									$item->attrId = $attrValue->AttributeId;
									$item->Cnt = $attrValue->Cnt;
									$item->isActive = false;
									if(isset($this->filter) && isset($this->filter->attrValues))
									{
										foreach ($this->filter->attrValues as $filterAttr) {
											if($filterAttr->value == $attrValue->Id){
												$item->isActive = true;
												break;
											}
										}
									}
									array_push($filterItem->items, $item);
								}
							}
							if(count($filterItem->items) > 0)
							{
								array_push($this->filterModel->attrs, $filterItem);
							}
						}
					}
				}
			}
		}
	}
	private function getInsertIndex($code){
		if(count($this->filterModel->attrs) > 0){
			$pos = 0;
			foreach ($this->filterModel->attrs as $key => $attr) {
				if($code < $attr->code){
					$pos = $key;
					break;
				}
			}
		}
		array_splice( $original, $pos, 0, $inserted ); 
	}
}