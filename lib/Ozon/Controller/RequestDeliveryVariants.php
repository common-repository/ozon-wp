<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\DeliveryVariants as RequestObj;
use Ipol\Ozon\Ozon\Entity\DeliveryVariantsResult;

/**
 * Class RequestDeliveryVariants
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestDeliveryVariants extends AutomatedCommonRequest
{
    /**
     * RequestDeliveryVariants constructor.
     * @param DeliveryVariantsResult $resultObj
     * @param string|null $cityName
     * @param bool $workingHours
     * @param bool $postalCode
     * @param int|null $paginationSize
     * @param string|null $paginationToken
     */
    public function __construct(DeliveryVariantsResult $resultObj, ?string $cityName, bool $workingHours, bool $postalCode, ?int $paginationSize, ?string $paginationToken)
    {
        parent::__construct($resultObj);

        $data = new RequestObj();
        $data->setCityName($cityName)
            ->setPayloadIncludesIncludeWorkingHours($workingHours)
            ->setPayloadIncludesIncludePostalCode($postalCode)
            ->setPaginationSize($paginationSize)
            ->setPaginationToken($paginationToken);

        $this->setRequestObj($data);
    }

}