<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class TrackingList
 * @package Ipol\Ozon\Api\Entity\Request
 */
class TrackingList extends AbstractRequest
{
    /**
     * @var string[] array of numbers or barcodes
     */
    protected $articles;

    /**
     * @return string[]
     */
    public function getArticles(): array
    {
        return $this->articles;
    }

    /**
     * @param string[] $articles
     * @return TrackingList
     */
    public function setArticles(array $articles): TrackingList
    {
        $this->articles = $articles;
        return $this;
    }

}