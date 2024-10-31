<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Payment
 * @package Ipol\Ozon\Api\Entity\Request\Part\Order
 */
class Payment extends \Ipol\Ozon\Api\Entity\Common\Part\Payment
{
    use AbstractResponsePart;

    /**
     * @var Vat
     */
    protected $deliveryVat;

    /**
     * @return Vat
     */
    public function getDeliveryVat(): Vat
    {
        return $this->deliveryVat;
    }

    /**
     * @param Vat $deliveryVat
     * @return Payment
     */
    public function setDeliveryVat(Vat $deliveryVat): Payment
    {
        $this->deliveryVat = $deliveryVat;
        return $this;
    }

}