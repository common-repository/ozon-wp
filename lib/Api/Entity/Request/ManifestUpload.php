<?php


namespace Ipol\Ozon\Api\Entity\Request;


use Ipol\Ozon\Api\Entity\Request\Part\ManifestUpload\ManifestList;

/**
 * Class ManifestUpload
 * @package Ipol\Ozon\Api\Entity\Request
 */
class ManifestUpload extends AbstractRequest
{
    /**
     * @var ManifestList
     */
    protected $manifests;

    /**
     * @return ManifestList
     */
    public function getManifests(): ManifestList
    {
        return $this->manifests;
    }

    /**
     * @param ManifestList $manifests
     * @return ManifestUpload
     */
    public function setManifests(ManifestList $manifests): ManifestUpload
    {
        $this->manifests = $manifests;
        return $this;
    }
}