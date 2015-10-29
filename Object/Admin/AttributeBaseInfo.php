<?php
require_once 'Object/Admin/AttributeValueBaseInfo.php';
	/**
	* 
	*/
	class AttributeBaseInfo {
		public $Id;
		public $Name;
		public $Code;
		public $AttributeValuesList;
		public function __construct() {
			$AttributeValuesList = array();
		}
		public function Init($id, $name, $code, $attributeValuesList) {
			$this->Id = $id;
			$this->Name = $name;
			$this->Code = $code;
			$this->AttributeValuesList = $attributeValuesList;
		}
	}