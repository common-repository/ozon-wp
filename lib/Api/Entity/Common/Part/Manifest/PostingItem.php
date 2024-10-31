<?php


namespace Ipol\Ozon\Api\Entity\Common\Part\Manifest;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class PostingItem
 * @package Ipol\Ozon\Api\Entity\Request\Part\ManifestUpload
 */
class PostingItem extends AbstractEntity
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var bool
     */
    protected $isDangerous;
    /**
     * @var int
     */
    protected $quantity;
    /**
     * @var int - gram
     */
    protected $weight;
    /**
     * @var float (for one item, even if quantity!=1)
     */
    protected $price;
    /**
     * @var float
     */
    protected $estimatedCost;
    /**
     * @var int
     */
    protected $nds;
    /**
     * @var float
     */
    protected $ndsSum;
    /**
     * @var  string
     */
    protected $supplierInn;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return PostingItem
     */
    public function setId(string $id): PostingItem
    {
        $this->id = $id;
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
     * @return PostingItem
     */
    public function setName(string $name): PostingItem
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDangerous(): ?bool
    {
        return $this->isDangerous;
    }

    /**
     * @param bool $isDangerous
     * @return PostingItem
     */
    public function setIsDangerous(bool $isDangerous): PostingItem
    {
        $this->isDangerous = $isDangerous;
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
     * @return PostingItem
     */
    public function setQuantity(int $quantity): PostingItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     * @return PostingItem
     */
    public function setWeight(int $weight): PostingItem
    {
        $this->weight = $weight;
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
     * @return PostingItem
     */
    public function setPrice(float $price): PostingItem
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getEstimatedCost(): float
    {
        return $this->estimatedCost;
    }

    /**
     * @param float $estimatedCost
     * @return PostingItem
     */
    public function setEstimatedCost(float $estimatedCost): PostingItem
    {
        $this->estimatedCost = $estimatedCost;
        return $this;
    }

    /**
     * @return int
     */
    public function getNds(): ?int
    {
        return $this->nds;
    }

    /**
     * @param int $nds
     * @return PostingItem
     */
    public function setNds(int $nds): PostingItem
    {
        $this->nds = $nds;
        return $this;
    }

    /**
     * @return float
     */
    public function getNdsSum(): ?float
    {
        return $this->ndsSum;
    }

    /**
     * @param float $ndsSum
     * @return PostingItem
     */
    public function setNdsSum(float $ndsSum): PostingItem
    {
        $this->ndsSum = $ndsSum;
        return $this;
    }

    /**
     * @return string
     */
    public function getSupplierInn(): ?string
    {
        return $this->supplierInn;
    }

    /**
     * @param string $supplierInn
     * @return PostingItem
     */
    public function setSupplierInn(string $supplierInn): PostingItem
    {
        $this->supplierInn = $supplierInn;
        return $this;
    }

}