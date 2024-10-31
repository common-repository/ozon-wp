<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class OrderCancel
 * @package Ipol\Ozon\Api
 * @subpackage Request
 */
class OrderCancel extends AbstractRequest
{
    /**
     * @var int[]
     */
    protected $ids;

    /**
     * OrderCancel constructor.
     * @param int[] $ids
     */
    public function __construct(array $ids)
    {
        parent::__construct();
        $this->ids = $ids;
    }

    /**
     * @return int[]
     */
    public function getIds(): array
    {
        return $this->ids;
    }
}