<?php


namespace Ipol\Ozon\Api\Entity\Response\Part\OrderCancel;


use Ipol\Ozon\Api\Entity\AbstractEntity;
use Ipol\Ozon\Api\Entity\Response\Part\AbstractResponsePart;

/**
 * Class Response
 * @package Ipol\Ozon\Api
 * @subpackage Response
 */
class Response extends AbstractEntity
{
    use AbstractResponsePart;

    /**
     * @var string
     */
    protected $newStatus;
    /**
     * @var string
     */
    protected $oldStatus;

    /**
     * @return string
     */
    public function getNewStatus(): string
    {
        return $this->newStatus;
    }

    /**
     * @param string $newStatus
     * @return Response
     */
    public function setNewStatus(string $newStatus): Response
    {
        $this->newStatus = $newStatus;
        return $this;
    }

    /**
     * @return string
     */
    public function getOldStatus(): string
    {
        return $this->oldStatus;
    }

    /**
     * @param string $oldStatus
     * @return Response
     */
    public function setOldStatus(string $oldStatus): Response
    {
        $this->oldStatus = $oldStatus;
        return $this;
    }

}