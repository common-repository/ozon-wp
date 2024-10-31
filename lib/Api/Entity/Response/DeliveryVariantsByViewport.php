<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\Common\DataList;

/**
 * Class DeliveryVariantsByViewport
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DeliveryVariantsByViewport extends AbstractResponse
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
     * @return DeliveryVariantsByViewport
     * @throws BadResponseException
     */
    public function setData(array $array): DeliveryVariantsByViewport
    {
        $collection = new DataList();
        $this->data = $collection->fillFromArray($array);
        return $this;
    }
}