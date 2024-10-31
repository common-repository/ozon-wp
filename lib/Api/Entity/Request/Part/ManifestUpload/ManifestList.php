<?php


namespace Ipol\Ozon\Api\Entity\Request\Part\ManifestUpload;


use Ipol\Ozon\Api\Entity\Common\Manifest;

class ManifestList extends \Ipol\Ozon\Api\Entity\AbstractCollection
{
    protected $Manifests;

    public function __construct()
    {
        parent::__construct('Manifests');
    }

    /**
     * @return Manifest
     */
    public function getFirst(){
        return parent::getFirst();
    }

    /**
     * @return Manifest
     */
    public function getNext(){
        return parent::getNext();
    }
}