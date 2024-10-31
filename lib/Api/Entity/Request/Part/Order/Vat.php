<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Order;


use Ipol\Ozon\Api\Entity\AbstractEntity;

/**
 * Class Vat
 * @package Ipol\Ozon\Api\Entity\Request\Part\Order
 */
class Vat extends AbstractEntity
{
    /**
     * @var int
     */
    protected $rate;
    /**
     * @var float
     */
    protected $sum;

    /**
     * Vat constructor.
     * @param int $rate
     * @param float $sum
     */
    public function __construct(int $rate, float $sum)
    {
        parent::__construct();
        $this->rate = $rate;
        $this->sum = $sum;
    }

    /**
     * @return int
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * @param int $rate
     * @return Vat
     */
    public function setRate(int $rate): Vat
    {
        $this->rate = $rate;
        return $this;
    }

    /**
     * @return float
     */
    public function getSum(): float
    {
        return $this->sum;
    }

    /**
     * @param float $sum
     * @return Vat
     */
    public function setSum(float $sum): Vat
    {
        $this->sum = $sum;
        return $this;
    }

}