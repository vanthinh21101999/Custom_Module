<?php

namespace AHT\Portfolio\Block\Adminhtml\Portfolio\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     */
    protected $authorRepository;

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
   
    }

    /**
     * Return Author page ID
     *
     * @return int|null
     */
    public function getPortfolioId()
    {
        try {
            return  $this->context->getRequest()->getParam('id');
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
