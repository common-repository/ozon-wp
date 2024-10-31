<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderCancel;


use Ipol\Ozon\Api\Entity\AbstractCollection;

/**
 * Class ResponseElementList
 * @package Ipol\Ozon\Api
 * @subpackage Response
 * @method ResponseElement getFirst
 * @method ResponseElement getNext
 */
class ResponseElementList extends AbstractCollection
{
    protected $ResponseElements;

    public function __construct()
    {
        parent::__construct('ResponseElements');
    }

}