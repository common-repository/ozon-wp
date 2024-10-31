<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\DocumentList\DataList;

/**
 * Class DocumentList
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DocumentList extends AbstractResponse
{
    /**
     * @var DataList
     */
    protected $data;
    /**
     * @var string|null
     */
    protected $nextPageToken;

    /**
     * @return DataList
     */
    public function getData(): DataList
    {
        return $this->data;
    }

    /**
     * @param array $array
     * @return DocumentList
     * @throws BadResponseException
     */
    public function setData(array $array): DocumentList
    {
            $collection = new DataList();
            $this->data = $collection->fillFromArray($array);
            return $this;
    }

    /**
     * @return string
     */
    public function getNextPageToken(): ?string
    {
        return $this->nextPageToken;
    }

    /**
     * @param string|null $nextPageToken
     * @return DocumentList
     */
    public function setNextPageToken(?string $nextPageToken): DocumentList
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

}