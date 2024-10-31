<?php


namespace Ipol\Ozon\Ozon\Entity;


use Ipol\Ozon\Api\Entity\Response\ErrorResponse;
use Ipol\Ozon\Api\Entity\Response\TrackingByBarcode;
use Ipol\Ozon\Api\Entity\Response\TrackingByPostingNumber;

/**
 * Class TrackingResult
 * @package Ipol\Ozon\Application
 * @subpackage Result
 * @method TrackingByBarcode|TrackingByPostingNumber|ErrorResponse getResponse
 */
class TrackingResult extends AbstractResult
{

}