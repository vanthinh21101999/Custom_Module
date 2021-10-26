<?php
namespace AHT\Checkout\Block\Adminhtml\Order;

class DeliveryForm extends \Magento\Backend\Block\Widget\Form\Container
{
   /**
     * @param \\Magento\Sales\Model\Order
     */
    private $_order;
    /**
     * @param \Magento\Framework\Data\FormFactory
     */
    private $_formFactory;

    /**
     * Data Form object
     *
     * @var \Magento\Framework\Data\Form
     */
    protected $_form;
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Model\Order $order,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        $this->_formFactory = $formFactory;
        $this->_order = $order;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_controller = 'adminhtml_order';
        $this->_mode = 'delivery';
        $this->_blockGroup = 'AHT_Checkout';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Order Delivery'));
        $this->buttonList->remove('delete');
        
    }

    public function getOrderId()
    {
        return $this->getRequest()->getParam('id');
    }

    /**
     * Form header text getter
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Delivery Information');
    }
    
    /**
     * Back button url getter
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('sales/*/view', ['order_id' => $this->getOrderId()]);
    }
}