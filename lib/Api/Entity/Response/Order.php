<?php


namespace Ipol\Ozon\Api\Entity\Response;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Response\Part\Common\PackageList;

/**
 * Class Order
 * @package Ipol\Ozon\Api\Entity\Response
 */
class Order extends AbstractResponse
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $orderNumber;
    /**
     * @var string
     */
    protected $logisticOrderNumber;
    /**
     * @var PackageList
     */
    protected $packages;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
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
     * @return Order
     */
    public function setOrderNumber(string $orderNumber): Order
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
     * @return Order
     */
    public function setLogisticOrderNumber(string $logisticOrderNumber): Order
    {
        $this->logisticOrderNumber = $logisticOrderNumber;
        return $this;
    }

    /**
     * @return PackageList
     */
    public function getPackages(): ?PackageList
    {
        return $this->packages;
    }

    /**
     * @param array $array
     * @return Order
     * @throws BadResponseException
     */
    public function setPackages(array $array): Order
    {
        $collection = new PackageList();
        $this->packages = $collection->fillFromArray($array);
        return $this;
    }

}