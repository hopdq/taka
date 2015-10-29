<?php
	class ProviderBaseInfo {
		public $Id;
		public $Name;
		public $Code;
		public $LogoUrl;
		public $Description;
		//
		public function __construct() {
			//
		}
		//
		public function Init($id, $name, $code, $logoUrl, $description) {
			$this->Id = $id;
			$this->Name = $name;
			$this->Code = $code;
			$this->LogoUrl = $logoUrl;
			$this->Description = $description;
		}
	}