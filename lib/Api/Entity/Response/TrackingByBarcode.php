<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\ApiLevelException;
use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\TrackingByBarcode\ItemList;
use Ipol\Ozon\Api\Entity\Response\Part\TrackingByBarcode\TrackingHeader;
use Ipol\Ozon\Api\Tools;

/**
 * Class TrackingByBarcode
 * @package Ipol\Ozon\Api\Entity\Response
 */
class TrackingByBarcode extends AbstractResponse
{
    /**
     * @var TrackingHeader
     */
    protected $trackingHeader;
    /**
     * @var ItemList
     */
    protected $items;

    /**
     * @return TrackingHeader
     */
    public function getTrackingHeader(): TrackingHeader
    {
        return $this->trackingHeader;
    }

    /**
     * @param array $trackingHeader
     * @return TrackingByBarcode
     */
    public function setTrackingHeader(array $trackingHeader): TrackingByBarcode
    {
        $this->trackingHeader = new TrackingHeader($trackingHeader);
        return $this;
    }

    /**
     * @return ItemList
     */
    public function getItems(): ItemList
    {
        return $this->items;
    }

    /**
     * @param array $array
     * @return TrackingByBarcode
     * @throws BadResponseException
     */
    public function setItems(array $array): TrackingByBarcode
    {
        $collection = new ItemList();
        $this->items = $collection->fillFromArray($array);
        return $this;
    }

}