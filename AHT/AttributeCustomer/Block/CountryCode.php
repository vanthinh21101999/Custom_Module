<?php
namespace AHT\AttributeCustomer\Block;

class CountryCode extends \Magento\Framework\View\Element\Template
{
     /**
     * @param \Magento\Directory\Model\CountryFactory
     */
    protected $_countryFactory;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,         
        \Magento\Directory\Model\CountryFactory $countryFactory,
        array $data = []
    ) {
        $this->_countryFactory = $countryFactory;
        parent::__construct($context, $data);
    }
    public function getCountryName($code) 
    {
        $country = $this->_countryFactory->create()->loadByCode($code);
        return $country->getName();
    }
}