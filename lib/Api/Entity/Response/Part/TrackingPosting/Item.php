<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\TrackingPosting;


use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Item
 * @package Ipol\Ozon\Api\Entity\Response\Part\TrackingPosting
 */
class Item extends \Ipol\Ozon\Api\Entity\AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $itemCode;
    /**
     * @var string
     */
    protected $barcode;
    /**
     * @var string
     */
    protected $itemName;
    /**
     * @var float
     */
    protected $price;
    /**
     * @var bool
     */
    protected $isReturn;

    /**
     * @return string
     */
    public function getItemCode(): string
    {
        return $this->itemCode;
    }

    /**
     * @param string $itemCode
     * @return Item
     */
    public function setItemCode(string $itemCode): Item
    {
        $this->itemCode = $itemCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     * @return Item
     */
    public function setBarcode(string $barcode): Item
    {
        $this->barcode = $barcode;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * @param string $itemName
     * @return Item
     */
    public function setItemName(string $itemName): Item
    {
        $this->itemName = $itemName;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Item
     */
    public function setPrice(float $price): Item
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsReturn(): bool
    {
        return $this->isReturn;
    }

    /**
     * @param bool $isReturn
     * @return Item
     */
    public function setIsReturn(bool $isReturn): Item
    {
        $this->isReturn = $isReturn;
        return $this;
    }

}