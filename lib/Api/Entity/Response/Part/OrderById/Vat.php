<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderById;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Vat
 * @package Ipol\Ozon\Api\Entity\Response\Part\OrderById
 */
class Vat extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $rate;
    /**
     * @var float
     */
    protected $sum;

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