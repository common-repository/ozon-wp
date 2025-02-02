<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\ManifestUnprocessed;


use Ipol\Ozon\Api\BadResponseException;
use Ipol\Ozon\Api\Entity\Common\Manifest;
use Ipol\Ozon\Api\Entity\Common\Part\Manifest\Person;
use Ipol\Ozon\Api\Entity\Common\Part\Manifest\PostingItemList;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Posting
 * @package Ipol\Ozon\Api\Entity\Response\Part\ManifestUnprocessed
 */
class Posting extends Manifest
{
    use AbstractResponsePart;

    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Posting
     */
    public function setId(int $id): Posting
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $fields
     * @return Posting
     */
    public function setRecipient($fields)
    {
        $recipient = new Person();
        return parent::setRecipient($recipient->setFields($fields));
    }

    /**
     * @param mixed $fields
     * @return Posting
     */
    public function setAddressee($fields)
    {
        $addressee  = new Person();
        return parent::setAddressee($addressee->setFields($fields)); // TODO: Change the autogenerated stub
    }

    /**
     * @param mixed $array
     * @return Posting
     * @throws BadResponseException
     */
    public function setPostingItems($array)
    {
            $collection = new PostingItemList();
            return parent::setPostingItems($collection->fillFromArray($array));

    }

}