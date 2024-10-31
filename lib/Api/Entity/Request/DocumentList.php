<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class DocumentList
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DocumentList extends AbstractRequest
{
    /**
     * @var integer
     */
    protected $pagination__size;
    /**
     * @var string
     */
    protected $pagination__token;
    /**
     * @var integer
     */
    protected $number;
    /**
     * @var string (DateTime)
     */
    protected $dateFrom;
    /**
     * @var string (DateTime)
     */
    protected $dateTo;

    /**
     * @return int
     */
    public function getPaginationSize(): ?int
    {
        return $this->pagination__size;
    }

    /**
     * @param int $pagination__size
     * @return DocumentList
     */
    public function setPaginationSize(int $pagination__size): DocumentList
    {
        $this->pagination__size = $pagination__size;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaginationToken(): ?string
    {
        return $this->pagination__token;
    }

    /**
     * @param string $pagination__token
     * @return DocumentList
     */
    public function setPaginationToken(string $pagination__token): DocumentList
    {
        $this->pagination__token = $pagination__token;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return DocumentList
     */
    public function setNumber(int $number): DocumentList
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param string $dateFrom
     * @return DocumentList
     */
    public function setDateFrom(string $dateFrom): DocumentList
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return string
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param string $dateTo
     * @return DocumentList
     */
    public function setDateTo(string $dateTo): DocumentList
    {
        $this->dateTo = $dateTo;
        return $this;
    }

}