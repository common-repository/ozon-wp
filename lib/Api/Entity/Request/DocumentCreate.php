<?php


namespace Ipol\Ozon\Api\Entity\Request;


/**
 * Class DocumentCreate
 * @package Ipol\Ozon\Api\Entity\Request
 */
class DocumentCreate extends AbstractRequest
{
    /**
     * @var string[]
     */
    protected $postingIds;

    /**
     * @return string[]
     */
    public function getPostingIds(): array
    {
        return $this->postingIds;
    }

    /**
     * @param string[] $postingIds
     * @return DocumentCreate
     */
    public function setPostingIds(array $postingIds): DocumentCreate
    {
        $this->postingIds = $postingIds;
        return $this;
    }

}