<?php


namespace Ipol\Ozon\Api\Entity\Common\Part;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class OrderLine
 * @package Ipol\Ozon\Api
 */
class OrderLine extends AbstractEntity
{
    /**
     * @var string
     */
    protected $lineNumber;
    /**
     * @var string
     */
    protected $articleNumber;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int|null
     */
    protected $weight;
    /**
     * @var float
     */
    protected $sellingPrice;
    /**
     * @var float
     */
    protected $estimatedPrice;
    /**
     * @var int
     */
    protected $quantity;
    /**
     * @var string[]
     */
    protected $resideInPackages;
    /**
     * @var string
     */
    protected $supplierTin;

    /**
     * @return string
     */
    public function getLineNumber(): string
    {
        return $this->lineNumber;
    }

    /**
     * @param string $lineNumber
     * @return OrderLine
     */
    public function setLineNumber(string $lineNumber): OrderLine
    {
        $this->lineNumber = $lineNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getArticleNumber(): string
    {
        return $this->articleNumber;
    }

    /**
     * @param string $articleNumber
     * @return OrderLine
     */
    public function setArticleNumber(string $articleNumber): OrderLine
    {
        $this->articleNumber = $articleNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return OrderLine
     */
    public function setName(string $name): OrderLine
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     * @return OrderLine
     */
    public function setWeight(?int $weight): OrderLine
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @return float
     */
    public function getSellingPrice(): float
    {
        return $this->sellingPrice;
    }

    /**
     * @param float $sellingPrice
     * @return OrderLine
     */
    public function setSellingPrice(float $sellingPrice): OrderLine
    {
        $this->sellingPrice = $sellingPrice;
        return $this;
    }

    /**
     * @return float
     */
    public function getEstimatedPrice(): float
    {
        return $this->estimatedPrice;
    }

    /**
     * @param float $estimatedPrice
     * @return OrderLine
     */
    public function setEstimatedPrice(float $estimatedPrice): OrderLine
    {
        $this->estimatedPrice = $estimatedPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return OrderLine
     */
    public function setQuantity(int $quantity): OrderLine
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getResideInPackages(): array
    {
        return $this->resideInPackages;
    }

    /**
     * @param string[] $resideInPackages
     * @return OrderLine
     */
    public function setResideInPackages(array $resideInPackages): OrderLine
    {
        $this->resideInPackages = $resideInPackages;
        return $this;
    }

    /**
     * @return string
     */
    public function getSupplierTin(): ?string
    {
        return $this->supplierTin;
    }

    /**
     * @param string|null $supplierTin
     * @return OrderLine
     */
    public function setSupplierTin(?string $supplierTin): OrderLine
    {
        $this->supplierTin = $supplierTin;
        return $this;
    }

}