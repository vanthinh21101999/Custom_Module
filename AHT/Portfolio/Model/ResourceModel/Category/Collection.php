<?php
namespace AHT\Portfolio\Model\ResourceModel\Category;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'aht_portfolio_collection';
	protected $_eventObject = 'Portfolio_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('AHT\Portfolio\Model\Category', 'AHT\Portfolio\Model\ResourceModel\Category');
	}

}