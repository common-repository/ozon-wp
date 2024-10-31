<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class ManifestUnprocessed
 * @package Ipol\Ozon\Api\Entity\Request
 */
class ManifestUnprocessed extends AbstractRequest
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
     * @return int
     */
    public function getPaginationSize(): ?int
    {
        return $this->pagination__size;
    }

    /**
     * @param int $pagination__size
     * @return ManifestUnprocessed
     */
    public function setPaginationSize(int $pagination__size): ManifestUnprocessed
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
     * @return ManifestUnprocessed
     */
    public function setPaginationToken(string $pagination__token): ManifestUnprocessed
    {
        $this->pagination__token = $pagination__token;
        return $this;
    }

}