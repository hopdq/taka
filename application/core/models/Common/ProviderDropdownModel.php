<?php
require_once 'application/models/DataAccess/ProviderDa.php';
class ProviderDropdownModel{
	public $listProviders;
	public $activeId;
	public function __construct($activeId){
		$providerDa = new ProviderDa();
		$this->listProviders = $providerDa->GetListProviderBaseInfo();
		$allStt = new ProductStatus('0','-- Tất cả --');
		array_unshift($this->listProviders,$allStt);
		$this->activeId = $activeId;
	}
}