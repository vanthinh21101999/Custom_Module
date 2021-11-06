<?php 
namespace AHT\Portfolio\Block\Frontend\Portfolio;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use AHT\Portfolio\Model\ResourceModel\Portfolio\Grid\CollectionFactory;

class Detail extends Template
{
    protected $_pageFactory;
    protected $_coreRegistry;
    protected $_portfolioCollectionFactory;
    public $_storeManager;
    
     public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Registry $coreRegistry,
        CollectionFactory $portfolioCollectionFactory, 
        array $data = []
     )
     {
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $coreRegistry;
        $this->_portfolioCollectionFactory = $portfolioCollectionFactory;
        return parent::__construct($context,$data);
     }
 
     public function execute()
     {
        return $this->_pageFactory->create();   
     }

     public function getEditRecord()
     {  
        $id = $this->_coreRegistry->registry('editRecordId');
        $data = $this->_portfolioCollectionFactory->create();
        $result = $data->addFieldToFilter('id',$id);
        $portfolio = $result->getData();
        return $portfolio[0];
     }
}