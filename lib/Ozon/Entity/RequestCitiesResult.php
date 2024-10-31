<?php


namespace Ipol\Ozon\Ozon\Entity;

use Ipol\Ozon\Api\Entity\Response\DeliveryCities as ResponseObj;
use Ipol\Ozon\Api\Entity\Response\ErrorResponse;


/**
 * Class RequestCitiesResult
 * @package Ipol\Ozon\Application
 * @subpackage Result
 * @method ResponseObj|ErrorResponse getResponse
 */
class RequestCitiesResult extends AbstractResult
{
    /**
     * @var array
     */
    protected $cities;

    /**
     * @return array
     */
    public function getCities(): array
    {
        return $this->cities;
    }

    /**
     * @param array $cities
     * @return RequestCitiesResult
     */
    public function setCities(array $cities): void
    {
        $this->cities = $cities;
    }

    public function parseFields(): void
    {
        if($this->getResponse()) {
            $this->setCities($this->getResponse()->getData());
        }
        parent::parseFields();
    }
}