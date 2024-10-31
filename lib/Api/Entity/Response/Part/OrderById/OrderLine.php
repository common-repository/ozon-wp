<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;
use stdClass;

/**
 * Class OrderLine
 * @package Ipol\Ozon\Api\Entity\Request\Part\Order
 */
class OrderLine extends \Ipol\Ozon\Api\Entity\Common\Part\OrderLine
{
    use AbstractResponsePart;

    /**
     * @var Vat|null
     */
    protected $vat;
    /**
     * @var Attributes|null
     */
    protected $attributes;

    /**
     * @return Vat|null
     */
    public function getVat(): ?Vat
    {
        return $this->vat;
    }

    /**
     * @param stdClass $vat
     * @return OrderLine
     */
    public function setVat($vat): OrderLine
    {
        $this->vat = new Vat($vat);
        return $this;
    }

    /**
     * @return Attributes|null
     */
    public function getAttributes(): ?Attributes
    {
        return $this->attributes;
    }

    /**
     * @param stdClass $attributes
     * @return OrderLine
     */
    public function setAttributes($attributes): OrderLine
    {
        $this->attributes = new Attributes($attributes);
        return $this;
    }

}