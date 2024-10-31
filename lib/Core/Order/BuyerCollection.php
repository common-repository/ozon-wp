<?php


namespace Ipol\Ozon\Core\Order;


use Ipol\Ozon\Core\Entity\Collection;

/**
 * Class BuyerCollection
 * @package Ipol\Ozon\Core
 * @subpackage Order
 * @method false|Buyer getFirst
 * @method false|Buyer getNext
 * @method false|Buyer getLast
 */
class BuyerCollection extends Collection
{
    /**
     * @var array
     */
    protected $receivers;

    /**
     * BuyerCollection constructor.
     */
    public function __construct()
    {
        parent::__construct('buyers');
    }

}