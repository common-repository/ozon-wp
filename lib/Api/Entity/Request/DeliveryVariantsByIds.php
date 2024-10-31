<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class DeliveryVariantsByIds
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DeliveryVariantsByIds extends AbstractRequest
{
    /**
     * @var int[]
     */
    protected $ids;

    /**
     * @return int[]
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * @param int[] $ids
     * @return DeliveryVariantsByIds
     */
    public function setIds(array $ids): DeliveryVariantsByIds
    {
        $this->ids = $ids;
        return $this;
    }
}