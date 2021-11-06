<?php
namespace AHT\Portfolio\Model;

use AHT\Portfolio\Api\Data;
use AHT\Portfolio\Api\PortfolioRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use AHT\Portfolio\Model\ResourceModel\Portfolio as ResourcePost;
use AHT\Portfolio\Model\ResourceModel\Portfolio\CollectionFactory as PostCollectionFactory;
use AHT\Portfolio\Api\Data\PortfolioInterface;

/**
 * Class PostRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PortfolioRepository implements PortfolioRepositoryInterface
{
    /**
     * @var ResourcePost
     */
    protected $resource;

    /**
     * @var PostFactory
     */
    protected $PostFactory;

    /**
     * @var PostCollectionFactory
     */
    protected $PostCollectionFactory;

    /**
     * @var Data\PostSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @param ResourcePost $resource
     * @param PostFactory $PostFactory
     * @param Data\PortfolioInterfaceFactory $dataPostFactory
     * @param PostCollectionFactory $PostCollectionFactory
     * @param Data\PostSearchResultsInterfaceFactory $searchResultsFactory
     */
    private $collectionProcessor;

    public function __construct(
        ResourcePost $resource,
        PortfolioFactory $PostFactory,
        Data\PortfolioInterfaceFactory $dataPostFactory,
        PostCollectionFactory $PostCollectionFactory
    ) {
        $this->resource = $resource;
        $this->PostFactory = $PostFactory;
        $this->PostCollectionFactory = $PostCollectionFactory;
        // $this->searchResultsFactory = $searchResultsFactory;
        // $this->collectionProcessor = $collectionProcessor ?: $this->getCollectionProcessor();
    }

    /**
     * Save Post data
     *
     * @param  \AHT\Portfolio\Api\Data\PortfolioInterface $post
     * @return \AHT\Portfolio\Api\Data\PortfolioInterface
     */
    public function save(PortfolioInterface $post)
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }

        return $post;
    }

    /**
     * Load Post data by given Post Identity
     *
     * @param [type] $id
     * @return \AHT\Portfolio\Model\ResourceModel\Portfolio
     */
    public function getById($id)
    {
        $postId = intval($id);
        $Post = $this->PostFactory->create();
        $Post->load($postId);
        if (!$Post->getId()) {
            throw new NoSuchEntityException(__('The CMS Post with the "%1" ID doesn\'t exist.', $PostId));
        }
        $result = $Post;
        return $result;
    }


    /**
     * function get all data
     *
     * @return \AHT\Portfolio\Api\Data\PortfolioInterface
     */
    public function getList()
    {
        $collection = $this->PostCollectionFactory->create();
        return $collection->getData();
    }

    /**
     * Create post.
     *  
     * @return \AHT\Portfolio\Api\Data\PortfolioInterface
     * 
     * @throws LocalizedException
     */
    public function createPost(PortfolioInterface $post)
    {
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return json_encode(array(
            "status" => 200,
            "message" => $post->getData()
        ));
        
    }
}