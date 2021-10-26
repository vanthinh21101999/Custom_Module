<?php
namespace AHT\Salesagents\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;


class Salesagent extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource implements OptionSourceInterface
{
    protected $_optArray;
    protected $_customer;
    protected $_customerFactory;
    public function __construct(\Magento\Customer\Model\CustomerFactory $customerFactory, \Magento\Customer\Model\Customer $customers)
    {
        $this->_customerFactory = $customerFactory;
        $this->_customer = $customers;
    }
    /** *@return array|null  @return Post Category */ public
    function getAllOptions()
    {
        if ($this->_optArray === null) {
            $this->_optArray = [
                [
                    'label' => "None",
                    'value' => ""
                ]
            ];
            $collection = $this->_customerFactory->create()->getCollection()->addFieldToFilter('is_sales_agent', 1);
            foreach ($collection as $item) {
                $this->_optArray[] = [
                    'label' => ' ' . $item->getFirstname() . ' ' . $item->getMiddlename() . ' ' . $item->getLastname(),
                    'value' => $item->getEntityId()
                ];
            }
        }
        return $this->_optArray;
    }
}