<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\Entity\Response\Part\DocumentReturnDocuments\ItemList;
use Ipol\Ozon\Api\BadResponseException;

/**
 * Class DocumentReturnDocuments
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DocumentReturnDocuments extends AbstractResponse
{
    /**
     * @var ItemList
     */
    protected $items;
    /**
     * @var string|null
     */
    protected $nextPageToken;

    /**
     * @return ItemList
     */
    public function getItems(): ItemList
    {
        return $this->items;
    }

    /**
     * @param array $array
     * @return DocumentReturnDocuments
     * @throws BadResponseException
     */
    public function setItems(array $array): DocumentReturnDocuments
    {
        $collection = new ItemList();
        $this->items = $collection->fillFromArray($array);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }

    /**
     * @param string|null $nextPageToken
     * @return DocumentReturnDocuments
     */
    public function setNextPageToken(?string $nextPageToken): DocumentReturnDocuments
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

}