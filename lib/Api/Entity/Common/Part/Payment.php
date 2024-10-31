<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class Payment
 * @package Ipol\Ozon\Api
 * @subpackage Entity
 */
class Payment extends AbstractEntity
{
    /**
     * @var string ("FullPrepayment" / "Postpay")
     */
    protected $type;
    /**
     * @var float
     */
    protected $prepaymentAmount;
    /**
     * @var float
     */
    protected $recipientPaymentAmount;
    /**
     * @var float
     */
    protected $deliveryPrice;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Payment
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrepaymentAmount(): float
    {
        return $this->prepaymentAmount;
    }

    /**
     * @param float $prepaymentAmount
     * @return Payment
     */
    public function setPrepaymentAmount(float $prepaymentAmount)
    {
        $this->prepaymentAmount = $prepaymentAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getRecipientPaymentAmount(): float
    {
        return $this->recipientPaymentAmount;
    }

    /**
     * @param float $recipientPaymentAmount
     * @return Payment
     */
    public function setRecipientPaymentAmount(float $recipientPaymentAmount)
    {
        $this->recipientPaymentAmount = $recipientPaymentAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getDeliveryPrice(): float
    {
        return $this->deliveryPrice;
    }

    /**
     * @param float $deliveryPrice
     * @return Payment
     */
    public function setDeliveryPrice(float $deliveryPrice)
    {
        $this->deliveryPrice = $deliveryPrice;
        return $this;
    }

}