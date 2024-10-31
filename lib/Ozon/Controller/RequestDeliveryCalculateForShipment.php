<?php
namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Core\Delivery\Shipment;
use Ipol\Ozon\Core\Delivery\Tools;
use Ipol\Ozon\Api\Entity\Request\DeliveryCalculate as RequestObj;
use Ipol\Ozon\Ozon\Entity\DeliveryCalculate as ResultObj;

/**
 * Class RequestDeliveryCalculateForShipment
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestDeliveryCalculateForShipment extends AutomatedCommonRequest
{
    /**
     * @var Shipment
     */
    protected $coreShipment;

    /**
     * RequestDeliveryCalculateForShipment constructor.
     * @param ResultObj $resultObj
     * @param int $deliveryVariantId
     * @param Shipment $shipment
     * @param int $fromPlaceId
     */
    public function __construct(ResultObj $resultObj, int $deliveryVariantId, Shipment $shipment, int $fromPlaceId)
    {
        parent::__construct($resultObj);

        $this->coreShipment = $shipment;
        $data = new RequestObj();
        $data->setFromPlaceId($fromPlaceId)
            ->setDeliveryVariantId($deliveryVariantId);
        $this->setRequestObj($data);
    }

    /**
     * @return string
     */
    public function getSelfHash(): string
    {
        return $this->getSelfHashByRequestObj().serialize([
            $this->coreShipment->getCargoes()->getTotalDimensions(),
            $this->coreShipment->getCargoes()->getTotalWeight(),
            $this->coreShipment->getCargoes()->getTotalPrice()->getAmount(),
            $this->coreShipment->getCargoes()->getTotalCost()->getAmount(),
        ]);
    }

    /**
     * @return $this
     */
    public function convert(): RequestDeliveryCalculateForShipment
    {
        $shipment = $this->coreShipment;
        /**@var $data RequestObj */
        $data = $this->getRequestObj();

        $dimensions = $shipment->getCargoes()->getTotalDimensions();
        $weight = max($shipment->getCargoes()->getTotalWeight(), Tools::calculateVolumeWeight($dimensions['L'], $dimensions['W'], $dimensions['H']));

        $data
            ->setWeight($weight)
            ->setEstimatedPrice($shipment->getCargoes()->getTotalCost()->getAmount());

        $this->setRequestObj($data);

        return $this;
    }
}