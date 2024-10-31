<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\DeliveryVariantsByAddressShort as RequestObj;
use Ipol\Ozon\Api\Entity\Request\Part\Common\Dimensions;
use Ipol\Ozon\Api\Entity\Request\Part\Common\Package;
use Ipol\Ozon\Api\Entity\Request\Part\Common\PackageList;
use Ipol\Ozon\Core\Delivery\Shipment;
use Ipol\Ozon\Ozon\Entity\DeliveryVariantsShortResult;

/**
 * Class RequestDeliveryVariantsForShipmentShort
 * @package Ipol\Ozon\Ozon
 * @subpakage Controller
 */
class RequestDeliveryVariantsForShipmentShort extends AutomatedCommonRequest
{
    /**
     * @var Shipment
     */
    protected $coreShipment;

    /**
     * RequestDeliveryVariantsForShipmentShort constructor.
     * @param DeliveryVariantsShortResult $resultObj
     * @param Shipment $shipment
     * @param float $radius
     * @param int $limit
     */
    public function __construct(
        DeliveryVariantsShortResult $resultObj,
        Shipment $shipment,
        float $radius,
        int $limit = 3000
    ) {
        parent::__construct($resultObj);

        $this->coreShipment = $shipment;
        $data = new RequestObj();
        $data->setRadius($radius)
            ->setLimit($limit);
        $this->setRequestObj($data);
    }

    public function getSelfHash(): string
    {
        return $this->getSelfHashByRequestObj() . $this->coreShipment->getHash();
    }

    /**
     * @return $this
     */
    public function convert(): RequestDeliveryVariantsForShipmentShort
    {
        $shipment = $this->coreShipment;
        /**@var $data RequestObj */
        $data = $this->getRequestObj();
        $data->setDeliveryTypes($shipment->getTariff())
            ->setAddress($shipment->getTo()->getName());

        $packCollection = new PackageList();
        $shipment->getCargoes()->reset();
        while ($cargo = $shipment->getCargoes()->getNext()) {
            $pack = new Package();
            $pack->setPrice($cargo->getTotalPrice()->getAmount())
                ->setCount(1)
                ->setDimensions(new Dimensions(
                    $cargo->getWeight(),
                    $cargo->getDimensions()['L'],
                    $cargo->getDimensions()['W'],
                    $cargo->getDimensions()['H']
                ));
            $packCollection->add($pack);
        }
        $data->setPackages($packCollection);

        $this->setRequestObj($data);

        return $this;
    }

}