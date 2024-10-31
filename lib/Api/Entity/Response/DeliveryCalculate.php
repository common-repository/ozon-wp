<?php

namespace Ipol\Ozon\Api\Entity\Response;

/**
 * Class DeliveryCalculate
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DeliveryCalculate extends AbstractResponse
{
    /**
     * @var float
     */
    protected $amount;

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return DeliveryCalculate
     */
    public function setAmount(float $amount): DeliveryCalculate
    {
        $this->amount = $amount;
        return $this;
    }

}