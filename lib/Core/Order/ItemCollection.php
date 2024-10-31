<?php


namespace Ipol\Ozon\Core\Order;


use Ipol\Ozon\Core\Entity\Collection;

/**
 * Class ItemCollection
 * @package Ipol\Ozon\Core
 * @subpackage Order
 * @method false|Item getFirst
 * @method false|Item getNext
 * @method false|Item getLast
 */
class ItemCollection extends Collection
{
    /**
     * @var array
     */
    protected $items;

    /**
     * ItemCollection constructor.
     */
    public function __construct()
    {
        parent::__construct('items');
    }

}