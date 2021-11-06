<?php 
namespace AHT\Portfolio\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{

	const XML_PATH_PORTFOLIO = 'portfolio/';

	public function getConfigValue($field, $storeId = null)
	{
		return $this->scopeConfig->getValue(
			$field, ScopeInterface::SCOPE_STORE, $storeId
		);
	}

	public function getPortfolioConfig($code, $storeId = null)
	{
		return $this->getConfigValue(self::XML_PATH_PORTFOLIO .'portfolio/'. $code, $storeId);
	}

	public function getConfig($config_path)
	{
    return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
	}

}