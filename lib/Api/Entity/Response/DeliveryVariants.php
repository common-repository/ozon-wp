<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\Common\DataList;

/**
 * Class DeliveryVariants
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DeliveryVariants extends AbstractResponse
{
    /**
     * @var DataList
     */
    protected $data;
    /**
     * @var string|null - null for last page
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
     * @param \stdClass[] $array
     * @return DeliveryVariants
     * @throws BadResponseException
     */
    public function setData(array $array): DeliveryVariants
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
     * @return DeliveryVariants
     */
    public function setNextPageToken(?string $nextPageToken): DeliveryVariants
    {
        $this->nextPageToken = $nextPageToken;
        return $this;
    }

}