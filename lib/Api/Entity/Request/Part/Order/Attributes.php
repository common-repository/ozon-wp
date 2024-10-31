<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\Order;


/**
 * Class Attributes
 * @package Ipol\Ozon\Api\Entity\Request\Part\Order
 */
class Attributes extends \Ipol\Ozon\Api\Entity\Common\Part\Attributes
{
    /**
     * Attributes constructor.
     * @param bool $isDangerous
     */
    public function __construct(?bool $isDangerous = null)
    {
        parent::__construct();
        $this->isDangerous = $isDangerous;
    }
}