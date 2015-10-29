<?php
	/**
	* 
	*/
	class AttributeValueBaseInfo
	{
		public $Id;
		public $AttributeId;
		public $Value;	
		public function __construct()
		{
			
		}
		//
		public function Init($id, $attributeId, $value) {
			$this->Id = $id;
			$this->AttributeId = $attributeId;
			$this->Value = $value;
		}
	}