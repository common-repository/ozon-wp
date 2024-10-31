<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderCancel;


use Ipol\Ozon\Api\Entity\AbstractCollection;

/**
 * Class ErrorList
 * @package Ipol\Ozon\Api
 * @subpackage Response
 * @method Error getFirst
 * @method Error getNext
 */
class ErrorList extends AbstractCollection
{
    protected $Errors;

    public function __construct()
    {
        parent::__construct('Errors');
    }

}