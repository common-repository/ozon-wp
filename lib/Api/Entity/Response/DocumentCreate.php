<?php


namespace Ipol\Ozon\Api\Entity\Response;


/**
 * Class DocumentCreate
 * @package Ipol\Ozon\Api\Entity\Response
 */
class DocumentCreate extends AbstractResponse
{
    /**
     * @var int
     */
    protected $documentId;
    /**
     * @var string
     */
    protected $documentName;

    /**
     * @return int
     */
    public function getDocumentId(): int
    {
        return $this->documentId;
    }

    /**
     * @param int $documentId
     * @return DocumentCreate
     */
    public function setDocumentId(int $documentId): DocumentCreate
    {
        $this->documentId = $documentId;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentName(): string
    {
        return $this->documentName;
    }

    /**
     * @param string $documentName
     * @return DocumentCreate
     */
    public function setDocumentName(string $documentName): DocumentCreate
    {
        $this->documentName = $documentName;
        return $this;
    }

}