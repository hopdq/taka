<?php
require_once 'application/helpers/StringHelper.php';
require_once 'system/core/Model.php';
class ProductDa extends CI_Model{
	public function GetProductList_Paging($listPaging,$filter){
		$this->load->database('default');
		$sql = "call Product_GetAll_Paging (?, ?, ?, ?, ?);";
        $query = $this->db->query($sql, array($filter->keyword,$filter->categoryId,$filter->status,$listPaging->PageModel->Page,$listPaging->PageModel->PageSize));
		$listPaging->ListItem = $query->result('ProductBaseInfo');
		if(count($listPaging->ListItem) > 0){
			$product = $listPaging->ListItem[0];
			if($product->TotalPage > 0){
				$listPaging->PageModel->TotalPages = $product->TotalPage;
			}
		}
		$this->db->close();
	}
	public function GetSingleItem($productId){
		$this->load->database('default');
		$this->db->select('Id, Code, Name, CategoryId, Price, Summary, Description, PromotionValue, IsPercentPromotion, PromotionDesc, Status, ProviderId');
		$this->db->where("Id", $productId);
		$query = $this->db->get('Product');
		$result = $query->result();
		$this->db->close();
		if(count($result) > 0)
		{
			return $result[0];
		}
		return null;
	}
	public function DeleteByListId($arrId){
		if(count($arrId) > 0){
			$this->load->database('default');

		}
	}
	public function GetNextProductId(){
		$this->load->database('default');
		$this->db->select("Id");
		$this->db->order_by("CAST(Id AS SIGNED) DESC");
		$query = $this->db->get("Product", 1);
		$resultData = $query->result();
		$this->db->close();
		$result = 1;
		if(count($resultData) > 0){
			$resultRow = $resultData[0];
			if(isset($resultRow)){
				$result = $resultRow->Id;
			}
		} 
		return $result + 1;
	}
	public function InsertProduct($product){
		$product->Id = $this->GetNextProductId();
		$product->CreateDate = date('Y-m-d H:i:s');
		$product->UpdateDate = date('Y-m-d H:i:s');
		$this->load->database('default');
		$this->db->insert('Product', $product);
		$effectedRows = $this->db->affected_rows();
		$this->db->close();
		return $effectedRows > 0 ? $product->Id : 0;
	}
	public function UpdateProduct($product){
		$this->load->database('default');
		$product->UpdateDate = date('Y-m-d H:i:s');
		$this->db->where('Id', $product->Id);
		$this->db->update('Product', $product);
		$result = $this->db->affected_rows();
		$this->db->close();
		return $result;
	}
	public function checkCodeExist($code){
		$this->load->database('default');
		$this->db->select('count(*) as cnt');
		$this->db->where('Code', $code);
		$query = $this->db->get('Product');
		$resultData = $query->result();
		$this->db->close();
		$resultCnt = count($resultData) > 0 ? $resultData[0]->cnt : 0;
		return $resultCnt > 0;
	}
	public function delProductByListId($lstId){
		if(isset($lstId))
		{
			$whereClause = 'Id in ('.$lstId.')';
			$this->load->database('default');
			$this->db->where($whereClause);
			$this->db->delete('Product');
			$result = $this->db->affected_rows();
			$this->db->close();
			return $result;
		}
		return 0;
	}
	public function getProductByCategorySort($categoryId, $sorter, $limit){
		$this->load->database('default');
		$this->db->select('p.Id,p.Code,p.Name,ga.Path as ImagePath,p.Price,p.PromotionValue, p.PromotionPrice,p.IsPercentPromotion,p.PromotionDesc,p.Status');
		$this->db->join('Category c', 'c.Id = p.CategoryId');
		$this->db->join('ProductImage pi', 'p.Id = pi.ProductId');
		$this->db->join('Gallery ga', 'pi.ImageId = ga.Id');
		$this->db->join('Category c2', 'c.ParentId = c2.Id', 'left');
		$this->db->where('pi.IsDefault = 1');
		if(isset($categoryId))
		{
			$this->db->where('( c.Id = '.$categoryId.' or c.ParentId = '.$categoryId.' or c2.ParentId = '.$categoryId.' )');
		}
		switch ($sorter) {
			case 'PRICE_DESC':
				$this->db->order_by('p.Price DESC');
				break;
			case 'PRICE_ASC':
				$this->db->order_by('p.Price ASC');
				break;
			case 'NEW_OLD': default:
				$this->db->order_by('p.CreateDate DESC');
				break;
			case 'PROMOTION':
				$this->db->order_by('p.IsPercentPromotion DESC, p.PromotionValue DESC');
				break;
		}
		if(isset($limit) && $limit > 0){
			$this->db->limit($limit);
		}
		$query = $this->db->get('Product p');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	private function conditionGetProductsFilter($filter){
		$this->db->join('Category c', 'c.Id = p.CategoryId');
		$this->db->join('Provider pr', 'p.ProviderId = pr.Id', 'left');
		if(isset($filter))
		{
			if(isset($filter->categoryId))
			{
				$this->db->join('Category c2', 'c2.Id = c.ParentId', 'left');
				$this->db->where('( c.Id = '.$filter->categoryId.' or c.ParentId = '.$filter->categoryId.' or c2.ParentId = '.$filter->categoryId.' )');
			} 
			if(isset($filter->providerId)){
				$this->db->where('p.ProviderId', $filter->providerId);
			}
			if(isset($filter->price)){
				$this->db->where('p.PromotionPrice >=', $filter->price->from);
				$this->db->where('p.PromotionPrice <=', $filter->price->to);
			}
			if(isset($filter->attrValues)){
				if(count($filter->attrValues) > 0)
				{
					$attrCondition = '(';
					$cnt = 0;
					foreach ($filter->attrValues as $attrValue) {
						if($cnt == 0)
						{
							$attrCondition = $attrCondition.$attrValue->value;	
						}
						else
						{
							$attrCondition = $attrCondition.','.$attrValue->value;
						}
						$cnt ++;
						//$this->db->where('av.Id', $attrValue->value);
					}
					$attrCondition = $attrCondition.')';
					$subQuery = '( select A.ProductId from
									(
										select pa.ProductId, pa.AttributeValueId from ProductAttrValue pa
										where pa.AttributeValueId in '.$attrCondition.') A group by A.ProductId
									having count(*) = '.count($filter->attrValues).' ) B';
					$this->db->join($subQuery, 'p.Id = B.ProductId');
				}
			}
		}
	}
	private function conditionGetFilters($filter, $type){
		$this->db->join('Category c', 'c.Id = p.CategoryId');
		$this->db->join('Provider pr', 'p.ProviderId = pr.Id', 'left');
		if(isset($filter))
		{
			if(isset($filter->categoryId)){
				$this->db->join('Category c2', 'c.ParentId = c2.Id', 'left');
				$this->db->where('( c.Id = '.$filter->categoryId.' or c.ParentId = '.$filter->categoryId.' or c2.ParentId = '.$filter->categoryId.' )');
			}
			if(isset($filter->providerId)  && $type != 'provider'){
				$this->db->where('p.ProviderId', $filter->providerId);
			}
			if(isset($filter->price) && $type != 'price'){
				$this->db->where('p.PromotionPrice >=', $filter->price->from);
				$this->db->where('p.PromotionPrice <=', $filter->price->to);
			}
			if(isset($filter->attrValues) && count($filter->attrValues) > 0 && (count($filter->attrValues) > 1 || $filter->attrValues[0]->attrId != $type)){
				$attrCondition = '(';
				$cnt = 0;
				foreach ($filter->attrValues as $attrValue) {
					if($attrValue->attrId != $type)
					{
						if($cnt == 0)
						{
							$attrCondition = $attrCondition.$attrValue->value;	
						}
						else
						{
							$attrCondition = $attrCondition.','.$attrValue->value;
						}
						$cnt ++;
					}
					//$this->db->where('av.Id', $attrValue->value);
				}
				$attrCondition = $attrCondition.')';
				$subQuery = '( select A.ProductId from
								(
									select pa.ProductId, pa.AttributeValueId from ProductAttrValue pa
									where pa.AttributeValueId in '.$attrCondition.') A group by A.ProductId
								having count(*) = '.$cnt.' ) B';
				$this->db->join($subQuery, 'p.Id = B.ProductId');
			}
		}
	}
	public function getFilters($filter){
		$this->load->database('default');
		$this->db->select('pr.Id, pr.Name, count(*) as Cnt');
		$this->conditionGetFilters($filter, 'provider');
		$this->db->where('ifnull(pr.Id, 0) != ', 0);
		$this->db->order_by('pr.Name ASC');
		$this->db->group_by('pr.Id, pr.Name');
		$queryProvider = $this->db->get('Product p');

		$this->db->select('max(p.PromotionPrice) as maxPrice, min(p.PromotionPrice) as minPrice');
		$this->conditionGetFilters($filter, 'price');
		$queryPrice = $this->db->get('Product p');
		$attributeValues = array();
		if(count($filter->attrValues) > 0)
		{
			foreach ($filter->attrValues as $attrValue) {
				$this->db->select('av.Id, av.Value, attr.Id as AttributeId, attr.Name as AttributeName, attr.Code as AttributeCode, count(*) as Cnt');
				$this->conditionGetFilters($filter, $attrValue->attrId);
				$this->db->join('ProductAttrValue pa', 'pa.ProductId = p.Id');
				$this->db->join('AttributeValue av', 'av.Id = pa.AttributeValueId');
				$this->db->join('Attributes attr', 'av.AttributeId = attr.Id');
				$this->db->where('attr.Id',  $attrValue->attrId);
				$this->db->group_by('av.Id, av.Value, attr.Id, attr.Name, attr.Code');
				$queryAttributeValue = $this->db->get('Product p');
				$attributeValueItem = $queryAttributeValue->result();
				if(isset($attributeValueItem) && count($attributeValueItem) > 0){
					array_push($attributeValues, $attributeValueItem);
				}
			}
		}
		$this->db->select('av.Id, av.Value, attr.Id as AttributeId, attr.Name as AttributeName, attr.Code as AttributeCode, count(*) as Cnt');
		$this->conditionGetFilters($filter, 'attr');
		$this->db->join('ProductAttrValue pa', 'pa.ProductId = p.Id');
		$this->db->join('AttributeValue av', 'av.Id = pa.AttributeValueId');
		$this->db->join('Attributes attr', 'av.AttributeId = attr.Id');
		if(count($filter->attrValues) > 0)
		{
				$attrCondition = '(';
				$cnt = 0;
				foreach ($filter->attrValues as $attrValue) {
					if($cnt == 0)
					{
						$attrCondition = $attrCondition.$attrValue->attrId;	
					}
					else
					{
						$attrCondition = $attrCondition.','.$attrValue->attrId;
					}
					$cnt ++;
				}
				$attrCondition = $attrCondition.')';
				$this->db->where('attr.Id not in '.$attrCondition);
			// }	
			// else{
			// 	$this->db->where('attr.Id !=',  $filter->attrValues[0]->attrId );
			// }
		}
		$this->db->group_by('av.Id, av.Value, attr.Id, attr.Name, attr.Code');
		$queryAttributeValue = $this->db->get('Product p');
		$otherAttributeValues = $queryAttributeValue->result();
		$providers = $queryProvider->result();
		$prices = $queryPrice->row();
		$this->db->close();
		$result = array(
		 	'providers' => $providers,
		 	'prices' => $prices,
			'attributeValues' => $attributeValues,
			'otherAttributeValues' => $otherAttributeValues);
		return $result;
	}
	public function getFilterByProvider($filter){
		$this->load->database('default');
		$this->db->select('max(p.PromotionPrice) as maxPrice, min(p.PromotionPrice) as minPrice');
		$this->conditionGetFilters($filter, 'price');
		$queryPrice = $this->db->get('Product p');
		$attributeValues = array();
		if(count($filter->attrValues) > 0)
		{
			foreach ($filter->attrValues as $attrValue) {
				$this->db->select('av.Id, av.Value, attr.Id as AttributeId, attr.Name as AttributeName, attr.Code as AttributeCode, count(*) as Cnt');
				$this->conditionGetFilters($filter, $attrValue->attrId);
				$this->db->join('ProductAttrValue pa', 'pa.ProductId = p.Id');
				$this->db->join('AttributeValue av', 'av.Id = pa.AttributeValueId');
				$this->db->join('Attributes attr', 'av.AttributeId = attr.Id');
				$this->db->where('attr.Id',  $attrValue->attrId);
				$this->db->group_by('av.Id, av.Value, attr.Id, attr.Name, attr.Code');
				$queryAttributeValue = $this->db->get('Product p');
				$attributeValueItem = $queryAttributeValue->result();
				if(isset($attributeValueItem) && count($attributeValueItem) > 0){
					array_push($attributeValues, $attributeValueItem);
				}
			}
		}
		$this->db->select('av.Id, av.Value, attr.Id as AttributeId, attr.Name as AttributeName, attr.Code as AttributeCode, count(*) as Cnt');
		$this->conditionGetFilters($filter, 'attr');
		$this->db->join('ProductAttrValue pa', 'pa.ProductId = p.Id');
		$this->db->join('AttributeValue av', 'av.Id = pa.AttributeValueId');
		$this->db->join('Attributes attr', 'av.AttributeId = attr.Id');
		if(count($filter->attrValues) > 0)
		{
			$attrCondition = '(';
			$cnt = 0;
			foreach ($filter->attrValues as $attrValue) {
				if($cnt == 0)
				{
					$attrCondition = $attrCondition.$attrValue->attrId;
				}
				else
				{
					$attrCondition = $attrCondition.','.$attrValue->attrId;
				}
				$cnt ++;
			}
			$attrCondition = $attrCondition.')';
			$this->db->where('attr.Id not in '.$attrCondition);
			// }
			// else{
			// 	$this->db->where('attr.Id !=',  $filter->attrValues[0]->attrId );
			// }
		}
		$this->db->group_by('av.Id, av.Value, attr.Id, attr.Name, attr.Code');
		$queryAttributeValue = $this->db->get('Product p');
		$otherAttributeValues = $queryAttributeValue->result();
		$prices = $queryPrice->row();
		$this->db->close();
		$result = array(
			'prices' => $prices,
			'attributeValues' => $attributeValues,
			'otherAttributeValues' => $otherAttributeValues);
		return $result;
	}
	public function getProductsFilterSortPaging($filter, $sorter, $paging){
		$this->load->database('default');
		$this->db->select('count(*) as cnt');
		$this->conditionGetProductsFilter($filter);
		$queryTotal = $this->db->get('Product p');

		$this->db->select('p.Id,p.Code,p.Name, pr.Name as ProviderName ,ga.Path as ImagePath,p.Price,p.PromotionValue, p.PromotionPrice,p.IsPercentPromotion,p.PromotionDesc,p.Status');
		$this->conditionGetProductsFilter($filter);
		$this->db->join('ProductImage pi', 'p.Id = pi.ProductId');
		$this->db->join('Gallery ga', 'pi.ImageId = ga.Id');
		$this->db->where('pi.IsDefault = 1');
		if(isset($paging)){
			$this->db->limit($paging->itemsGet, $paging->startIndex);
		}
		switch ($sorter) {
			case 'PRICE_DESC':
				$this->db->order_by('ifnull(p.Price, "0") DESC');
				break;
			case 'PRICE_ASC':
				$this->db->order_by('ifnull(p.Price, "0") ASC');
				break;
			case 'NEW_OLD': default:
				$this->db->order_by('p.CreateDate DESC');
				break;
			case 'PROMOTION':
				$this->db->order_by('p.IsPercentPromotion DESC, p.PromotionValue DESC');
				break;
		}
		$query = $this->db->get('Product p');
		$resultTotal = $queryTotal->row();
		if(isset($resultTotal)){
			$paging->totalItems = $resultTotal->cnt;
		}
		$resultProducts = $query->result();
		$this->db->close();
		$result = array('paging' => $paging , 'products' => $resultProducts);   
		return $result;
	}
	public function getProductDetail($productId){
		$this->load->database('default');
		$this->db->select('p.Id,
			p.Code,
			p.Name, 
			pr.Name as ProviderName ,
			p.Price,
			p.PromotionValue,
			p.PromotionPrice,
			p.IsPercentPromotion,
			p.PromotionDesc,
			p.Status,
			p.Summary,
			p.Description');
		$this->db->join('Provider pr', 'p.ProviderId = pr.Id', 'left');
		$this->db->where('p.Id', $productId);
		$query = $this->db->get('Product p');
		$result = $query->row();
		$this->db->close();
		return $result;
	}
	public function getRelateProduct($productId, $categoryId){
		$this->load->database('default');
		$this->db->select('p.Id,
			p.Code,
			p.Name, 
			pr.Name as ProviderName ,
			ga.Path as ImagePath,
			p.Price,p.PromotionValue, 
			p.PromotionPrice,
			p.IsPercentPromotion,
			p.PromotionDesc,p.Status');
		$this->db->join('Category c', 'c.Id = p.CategoryId');
		$this->db->join('Provider pr', 'p.ProviderId = pr.Id', 'left');
		$this->db->join('ProductImage pi', 'p.Id = pi.ProductId');
		$this->db->join('Gallery ga', 'pi.ImageId = ga.Id');
		$this->db->where('pi.IsDefault = 1');
		$this->db->limit(4, 1);
		$this->db->where('c.Id', $categoryId);	
		$this->db->where('p.Id != ', $productId);
		$this->db->order_by('p.CreateDate DESC');
		$query = $this->db->get('Product p');
		$result = $query->result();
		$this->db->close();
		return $result;
	}
	public function getShortInfor($productId){
		$this->load->database('default');
		$this->db->select('p.Id,
			p.Code,
			p.Name, 
			p.ProviderId,
			p.CategoryId');
		$this->db->where('p.Id', $productId);
		$query = $this->db->get('Product p');
		$result = $query->row();
		$this->db->close();
		return $result;
	}
}