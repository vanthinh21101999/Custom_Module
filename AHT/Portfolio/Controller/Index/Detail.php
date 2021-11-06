<?php
namespace AHT\Portfolio\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\SessionFactory;

class Detail extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $_coreRegistry;

    public function __construct(
   	    \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }
    
    public function execute()
    {
        $id = $this->_request->getParam('id');
        $this->_coreRegistry->register('editRecordId', $id);
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
