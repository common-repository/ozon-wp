<?php


namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Api\Entity\Request\ManifestRemove;
use Ipol\Ozon\Ozon\Entity\ManifestRemoveResult as ResultObj;


/**
 * Class RequestManifestRemove
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestManifestRemove extends AutomatedCommonRequest
{
    /**
     * RequestManifestRemove constructor.
     * @param ResultObj $resultObj
     * @param string $postingNumber
     */
    public function __construct(ResultObj $resultObj, string $postingNumber)
    {
        parent::__construct($resultObj);

        $data = new ManifestRemove();
        $data->setPostingNumber($postingNumber);
        $this->setRequestObj($data);
    }

}