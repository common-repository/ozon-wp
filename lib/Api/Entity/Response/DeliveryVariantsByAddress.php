<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\Common\DataList;

/**
 * Class DeliveryVariantsByAddress
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DeliveryVariantsByAddress extends AbstractResponse
{
    /**
     * @var DataList
     */
    protected $data;

    /**
     * @return DataList
     */
    public function getData(): DataList
    {
        return $this->data;
    }

    /**
     * @param array $array
     * @return DeliveryVariantsByAddress
     * @throws BadResponseException
     */
    public function setData(array $array): DeliveryVariantsByAddress
    {
        $collection = new DataList();
        $this->data = $collection->fillFromArray($array);
        return $this;
    }

}