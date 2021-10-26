<?php

namespace AHT\Salesagents\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Directory\Model\Currency;

class Commissiontype extends Column
{

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface
     */
    private $_storeManager;

    /**
     * Constructor
     *
     * @param Currency $currency
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $components = [],
        Currency $currency = null,
        array $data = []
    ) {
        $this->_storeManager = $storeManager;
        $this->currency = $currency ?: \Magento\Framework\App\ObjectManager::getInstance()
            ->create(Currency::class);
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        $currencyCode = $this->_storeManager->getStore()->getCurrentCurrency()->getCode();
        $basePurchaseCurrency = $this->currency->load($currencyCode);

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {
                /* echo "<pre>";
                var_dump($items); */
                if ($items['sa_commission_type'] == 1) {
                    $items['result_commission'] = $basePurchaseCurrency
                        ->format($items['sa_commission_value'], [], false);
                    
                    $items['product_price_final1'] = $basePurchaseCurrency
                        ->format($items['product_price_final'], [], false);
                        

                    $items['sa_commission_type'] = '<span class="grid-severity-notice"><span>' . 'Fixel' . '</span></span>';
                    $items['sa_commission_value'] = $basePurchaseCurrency
                        ->format($items['sa_commission_value'], [], false);
                }
                if ($items['sa_commission_type'] == 2) {
                    $items['result_commission']  =
                        $basePurchaseCurrency
                        ->format(($items['sa_commission_value'] * $items['product_price_final'] / 100), [], false);
                    $items['sa_commission_value'] = number_format(($items['sa_commission_value']), 2,".",",").'%';
                    $items['product_price_final1'] = number_format(($items['product_price_final']), 2,".",",").'%';
                    $items['sa_commission_type'] = '<span class="grid-severity-minor"><span>' . 'Percent' . '</span></span>';
                }
            }
        }
        return $dataSource;
    }
}