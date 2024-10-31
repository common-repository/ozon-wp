<?php


namespace Ipol\Ozon\Api\Entity\Request;


use Ipol\Ozon\Api\Entity\Request\Part\Order\Person;
use Ipol\Ozon\Api\Entity\Request\Part\Order\DeliveryInformation;
use Ipol\Ozon\Api\Entity\Request\Part\Order\FirstMileTransfer;
use Ipol\Ozon\Api\Entity\Request\Part\Order\OrderLineList;
use Ipol\Ozon\Api\Entity\Request\Part\Order\PackageList;
use Ipol\Ozon\Api\Entity\Request\Part\Order\Payment;

/**
 * Class Order
 * @package Ipol\Ozon\Api\Entity\Request
 */
class Order extends AbstractRequest
{
    /**
     * @var string
     */
    protected $orderNumber;
    /**
     * @var Person
     */
    protected $buyer;
    /**
     * @var Person
     */
    protected $recipient;
    /**
     * @var FirstMileTransfer
     */
    protected $firstMileTransfer;
    /**
     * @var Payment
     */
    protected $payment;
    /**
     * @var DeliveryInformation
     */
    protected $deliveryInformation;
    /**
     * @var PackageList
     */
    protected $packages;
    /**
     * @var OrderLineList
     */
    protected $orderLines;
    /**
     * @var string
     */
    protected $comment;

	/**
	 * @var string
	 */
    protected $source;

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     * @return Order
     */
    public function setOrderNumber(string $orderNumber): Order
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    /**
     * @return Person
     */
    public function getBuyer(): Person
    {
        return $this->buyer;
    }

    /**
     * @param Person $buyer
     * @return Order
     */
    public function setBuyer(Person $buyer): Order
    {
        $this->buyer = $buyer;
        return $this;
    }

    /**
     * @return Person
     */
    public function getRecipient(): ?Person
    {
        return $this->recipient;
    }

    /**
     * @param Person $recipient
     * @return Order
     */
    public function setRecipient(Person $recipient): Order
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return FirstMileTransfer
     */
    public function getFirstMileTransfer(): ?FirstMileTransfer
    {
        return $this->firstMileTransfer;
    }

    /**
     * @param FirstMileTransfer $firstMileTransfer
     * @return Order
     */
    public function setFirstMileTransfer(FirstMileTransfer $firstMileTransfer): Order
    {
        $this->firstMileTransfer = $firstMileTransfer;
        return $this;
    }

    /**
     * @return Payment
     */
    public function getPayment(): Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     * @return Order
     */
    public function setPayment(Payment $payment): Order
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return DeliveryInformation
     */
    public function getDeliveryInformation(): DeliveryInformation
    {
        return $this->deliveryInformation;
    }

    /**
     * @param DeliveryInformation $deliveryInformation
     * @return Order
     */
    public function setDeliveryInformation(DeliveryInformation $deliveryInformation): Order
    {
        $this->deliveryInformation = $deliveryInformation;
        return $this;
    }

    /**
     * @return PackageList
     */
    public function getPackages(): PackageList
    {
        return $this->packages;
    }

    /**
     * @param PackageList $packages
     * @return Order
     */
    public function setPackages(PackageList $packages): Order
    {
        $this->packages = $packages;
        return $this;
    }

    /**
     * @return OrderLineList
     */
    public function getOrderLines(): OrderLineList
    {
        return $this->orderLines;
    }

    /**
     * @param OrderLineList $orderLines
     * @return Order
     */
    public function setOrderLines(OrderLineList $orderLines): Order
    {
        $this->orderLines = $orderLines;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Order
     */
    public function setComment(string $comment): Order
    {
        $this->comment = $comment;
        return $this;
    }

	/**
	 * @param $source
	 * @return $this
	 */
    public function setSource($source)
    {
    	$this->source = $source;

    	return $this;
    }

	/**
	 * @return string|null
	 */
    public function getSource(): ?string
    {
    	return $this->source;
    }
}