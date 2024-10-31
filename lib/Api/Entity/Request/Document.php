<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class Document
 * @package Ipol\Ozon\Api\Entity\Request
 */
class Document extends AbstractRequest
{
    /**
     * (documentId from /v1/document/create or id from /v1/document/list)
     * @var integer
     */
    protected $id;
    /**
     * @var string (Act / T12 / ActSales / T12Sales)
     */
    protected $type;
    /**
     * @var string (PDF / XLS)
     */
    protected $format;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Document
     */
    public function setId(int $id): Document
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Document
     */
    public function setType(string $type): Document
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * @param string $format
     * @return Document
     */
    public function setFormat(string $format): Document
    {
        $this->format = $format;
        return $this;
    }

}