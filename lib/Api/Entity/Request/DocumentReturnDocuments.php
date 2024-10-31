<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class DocumentReturnDocuments
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DocumentReturnDocuments extends AbstractRequest
{
    /**
     * @var integer|null
     */
    protected $pagination__size;
    /**
     * @var string|null
     */
    protected $pagination__token;
    /**
     * @var string|null
     */
    protected $documentNumber;
    /**
     * @var string|null DateTime
     */
    protected $dateFrom;
    /**
     * @var string|null DateTime
     */
    protected $dateTo;

    /**
     * @return int|null
     */
    public function getPaginationSize(): ?int
    {
        return $this->pagination__size;
    }

    /**
     * @param int|null $pagination__size
     * @return DocumentReturnDocuments
     */
    public function setPaginationSize(?int $pagination__size): DocumentReturnDocuments
    {
        $this->pagination__size = $pagination__size;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaginationToken(): ?string
    {
        return $this->pagination__token;
    }

    /**
     * @param string|null $pagination__token
     * @return DocumentReturnDocuments
     */
    public function setPaginationToken(?string $pagination__token): DocumentReturnDocuments
    {
        $this->pagination__token = $pagination__token;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDocumentNumber(): ?string
    {
        return $this->documentNumber;
    }

    /**
     * @param string|null $documentNumber
     * @return DocumentReturnDocuments
     */
    public function setDocumentNumber(?string $documentNumber): DocumentReturnDocuments
    {
        $this->documentNumber = $documentNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param string|null $dateFrom
     * @return DocumentReturnDocuments
     */
    public function setDateFrom(?string $dateFrom): DocumentReturnDocuments
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param string|null $dateTo
     * @return DocumentReturnDocuments
     */
    public function setDateTo(?string $dateTo): DocumentReturnDocuments
    {
        $this->dateTo = $dateTo;
        return $this;
    }

}