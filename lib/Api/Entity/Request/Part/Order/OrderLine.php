<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Order;


/**
 * Class OrderLine
 * @package Ipol\Ozon\Api\Entity\Request\Part\Order
 */
class OrderLine extends \Ipol\Ozon\Api\Entity\Common\Part\OrderLine
{
    /**
     * @var Vat
     */
    protected $vat;
    /**
     * @var Attributes
     */
    protected $attributes;

    /**
     * @return Vat
     */
    public function getVat(): ?Vat
    {
        return $this->vat;
    }

    /**
     * @param Vat|null $vat
     * @return OrderLine
     */
    public function setVat(?Vat $vat): OrderLine
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return Attributes
     */
    public function getAttributes(): ?Attributes
    {
        return $this->attributes;
    }

    /**
     * @param Attributes $attributes
     * @return OrderLine
     */
    public function setAttributes(Attributes $attributes): OrderLine
    {
        $this->attributes = $attributes;
        return $this;
    }

}