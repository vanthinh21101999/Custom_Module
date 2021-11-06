<?php

namespace AHT\Portfolio\Api\Data;

interface PortfolioInterface
{
	const ID = 'id';

    /**
     * Get portfolio id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set portfolio id
     *
     * @param int $id
     * @return @this
     */
    public function setId($id);

    /**
     * Get portfolio title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Set portfolio title
     *
     * @param string $title
     * @return null
     */
    public function setTitle($title);

    /**
     * Get portfolio images
     *
     * @return string|null
     */
    
    public function getCategoryid();

    /**
     * Set portfolio categoryid
     *
     * @param int $categoryid
     * @return @this
     */
    public function setCategoryid($categoryid);

    /**
     * Get portfolio description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set portfolio description
     *
     * @param string $description
     * @return null
     */
    public function setDescription($description);

    /**
     * Get portfolio price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set portfolio price
     *
     * @param string $price
     * @return null
     */
    public function setPrice($price);

    /**
     * Get portfolio content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set portfolio content
     *
     * @param string $content
     * @return null
     */
    public function setContent($content);
}