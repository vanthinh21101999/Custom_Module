<?php
namespace AHT\Checkout\Controller\Index;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface;

class SaveQuote extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    protected $maskedQuoteIdToQuoteId;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     */
    private $_quoteRepository;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory
     */
    private $_jsonFactory;

    /**
     * @param \Magento\Framework\Serialize\Serializer\Json
     */
    private $_json;

    /**
     * @param \Magento\Quote\Model\QuoteFactory
     */
    private $_quoteFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Quote\Model\QuoteFactory $quoteFactory,
        MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_quoteRepository = $quoteRepository;
        $this->_jsonFactory = $jsonFactory;
        $this->_json = $json;
        $this->_quoteFactory = $quoteFactory;
        $this-> maskedQuoteIdToQuoteId = $maskedQuoteIdToQuoteId;
        return parent::__construct($context);
    }
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getContent();
        $response = $this->_json->unserialize($data);
        // convert Json to Array

        $quoteMaskedId = $response['quoteId'];
        $quoteId = $this->getQuoteIdFromMaskedHash($quoteMaskedId);
        $quote = $this->_quoteRepository->get($quoteId); // Get quote by id

        $quote->setData('delivery_date', $response['date']); // Fill data
        $quote->setData('delivery_comment', $response['comment']); // Fill data

        $this->_quoteRepository->save($quote);
    }

    /**
     * get QuoteId by masked id.
     *
     * @return int
     * @throws LocalizedException
     */
    public function getQuoteIdFromMaskedHash($maskedHashId)
    {
        try {
            $cartId = $this->maskedQuoteIdToQuoteId->execute($maskedHashId);
        } catch (NoSuchEntityException $exception) {
            throw new LocalizedException(
                __('Could not find a cart with ID "%masked_cart_id"', ['masked_cart_id' => $maskedHashId])
            );
        }

        return $cartId;
    }
}