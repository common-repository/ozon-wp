<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\Common;

use Ipol\Ozon\Api\Entity\AbstractEntity;


/**
 * Class Period
 * @package Ipol\Ozon\Api\Entity\Response\Part\DeliveryVariants
 */
class Period extends AbstractEntity
{
    /**
     * @var array ["hours": 0,
     *              "minutes": 0]
     */
    protected $min;
    /**
     * @var array ["hours": 0,
     *              "minutes": 0]
     */
    protected $max;

    /**
     * @return array
     */
    public function getMin(): array
    {
        return $this->min;
    }

    /**
     * @param array $min
     * @return Period
     */
    public function setMin(array $min): Period
    {
        $this->min = $min;
        return $this;
    }

    /**
     * @return array
     */
    public function getMax(): array
    {
        return $this->max;
    }

    /**
     * @param array $max
     * @return Period
     */
    public function setMax(array $max): Period
    {
        $this->max = $max;
        return $this;
    }

}