<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class DeliveryCities
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DeliveryCities extends AbstractResponse
{
    /**
     * @var string[]
     */
    protected $data;

    /**
     * @return string[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param string[] $data
     * @return DeliveryCities
     */
    public function setData(array $data): DeliveryCities
    {
        $this->data = $data;
        return $this;
    }

}