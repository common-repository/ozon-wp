<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\TrackingByPostingNumber\ItemList;
use Ipol\Ozon\Api\Entity\Response\Part\TrackingByPostingNumber\TrackingHeader;

/**
 * Class TrackingByPostingNumber
 * @package Ipol\Ozon\Api\Entity\Response
 */
class TrackingByPostingNumber extends AbstractResponse
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
     * @return TrackingByPostingNumber
     */
    public function setTrackingHeader(array $trackingHeader): TrackingByPostingNumber
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
     * @return TrackingByPostingNumber
     * @throws BadResponseException
     */
    public function setItems(array $array): TrackingByPostingNumber
    {
        $collection = new ItemList();
        $this->items = $collection->fillFromArray($array);
        return $this;
    }
}