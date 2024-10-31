<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\Common\PackageList;
use Ipol\Ozon\Api\Entity\Response\Part\OrderById\DeliveryInformation;
use Ipol\Ozon\Api\Entity\Response\Part\OrderById\FirstMileTransfer;
use Ipol\Ozon\Api\Entity\Response\Part\OrderById\OrderLineList;
use Ipol\Ozon\Api\Entity\Response\Part\OrderById\Payment;
use Ipol\Ozon\Api\Entity\Response\Part\OrderById\Person;
use stdClass;

/**
 * Class OrderById
 * @package Ipol\Ozon\Api\Entity\Response
 */
class OrderById extends AbstractResponse
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $principalId;
    /**
     * @var string
     */
    protected $orderNumber;
    /**
     * @var string
     */
    protected $logisticOrderNumber;
    /**
     * @var string DateTime
     */
    protected $createdAt;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var string
     */
    protected $comment;
    /**
     * @var DeliveryInformation
     */
    protected $deliveryInformation;
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
     * @var OrderLineList
     */
    protected $orderLines;
    /**
     * @var \Ipol\Ozon\Api\Entity\Response\Part\Common\PackageList
     */
    protected $packages;
    /**
     * @var bool
     */
    protected $allowPartialDelivery;
    /**
     * @var bool
     */
    protected $allowUncovering;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return OrderById
     */
    public function setId(int $id): OrderById
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getPrincipalId(): int
    {
        return $this->principalId;
    }

    /**
     * @param int $principalId
     * @return OrderById
     */
    public function setPrincipalId(int $principalId): OrderById
    {
        $this->principalId = $principalId;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     * @return OrderById
     */
    public function setOrderNumber(string $orderNumber): OrderById
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getLogisticOrderNumber(): string
    {
        return $this->logisticOrderNumber;
    }

    /**
     * @param string $logisticOrderNumber
     * @return OrderById
     */
    public function setLogisticOrderNumber(string $logisticOrderNumber): OrderById
    {
        $this->logisticOrderNumber = $logisticOrderNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return OrderById
     */
    public function setCreatedAt(string $createdAt): OrderById
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return OrderById
     */
    public function setStatus(string $status): OrderById
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return OrderById
     */
    public function setComment(string $comment): OrderById
    {
        $this->comment = $comment;
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
     * @param stdClass $deliveryInformation
     * @return OrderById
     */
    public function setDeliveryInformation(stdClass $deliveryInformation): OrderById
    {
        $this->deliveryInformation = new DeliveryInformation($deliveryInformation);
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
     * @param stdClass $buyer
     * @return OrderById
     */
    public function setBuyer(stdClass $buyer): OrderById
    {
        $this->buyer = new Person($buyer);
        return $this;
    }

    /**
     * @return Person
     */
    public function getRecipient(): Person
    {
        return $this->recipient;
    }

    /**
     * @param stdClass $recipient
     * @return OrderById
     */
    public function setRecipient(stdClass $recipient): OrderById
    {
        $this->recipient = new Person($recipient);
        return $this;
    }

    /**
     * @return FirstMileTransfer
     */
    public function getFirstMileTransfer(): FirstMileTransfer
    {
        return $this->firstMileTransfer;
    }

    /**
     * @param stdClass $firstMileTransfer
     * @return OrderById
     */
    public function setFirstMileTransfer(stdClass $firstMileTransfer): OrderById
    {
        $this->firstMileTransfer = new FirstMileTransfer($firstMileTransfer);
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
     * @param stdClass $payment
     * @return OrderById
     */
    public function setPayment(stdClass $payment): OrderById
    {
        $this->payment = new Payment($payment);
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
     * @param array $array
     * @return OrderById
     * @throws BadResponseException
     */
    public function setOrderLines(array $array): OrderById
    {
        $collection = new OrderLineList();
        $this->orderLines = $collection->fillFromArray($array);
        return $this;
    }

    /**
     * @return \Ipol\Ozon\Api\Entity\Response\Part\Common\PackageList
     */
    public function getPackages(): PackageList
    {
        return $this->packages;
    }

    /**
     * @param array $packages
     * @return OrderById
     * @throws BadResponseException
     */
    public function setPackages(array $packages): OrderById
    {
        $collection = new PackageList();
        $this->packages = $collection->fillFromArray($packages);
        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowPartialDelivery(): bool
    {
        return $this->allowPartialDelivery;
    }

    /**
     * @param bool $allowPartialDelivery
     * @return OrderById
     */
    public function setAllowPartialDelivery(bool $allowPartialDelivery): OrderById
    {
        $this->allowPartialDelivery = $allowPartialDelivery;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAllowUncovering(): bool
    {
        return $this->allowUncovering;
    }

    /**
     * @param bool $allowUncovering
     * @return OrderById
     */
    public function setAllowUncovering(bool $allowUncovering): OrderById
    {
        $this->allowUncovering = $allowUncovering;
        return $this;
    }

}