<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class Document
 * @package Ipol\Ozon\Api\Entity\Response
 */
class Document extends AbstractResponse
{
    /**
     * @var string
     */
    protected $documentBytes;
    /**
     * @var string
     */
    protected $documentFormat;
    /**
     * @var string
     */
    protected $documentType;

    /**
     * @return string
     */
    public function getDocumentBytes(): string
    {
        return $this->documentBytes;
    }

    /**
     * @param string $documentBytes
     * @return Document
     */
    public function setDocumentBytes(string $documentBytes): Document
    {
        $this->documentBytes = $documentBytes;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentFormat(): string
    {
        return $this->documentFormat;
    }

    /**
     * @param string $documentFormat
     * @return Document
     */
    public function setDocumentFormat(string $documentFormat): Document
    {
        $this->documentFormat = $documentFormat;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentType(): string
    {
        return $this->documentType;
    }

    /**
     * @param string $documentType
     * @return Document
     */
    public function setDocumentType(string $documentType): Document
    {
        $this->documentType = $documentType;
        return $this;
    }

}