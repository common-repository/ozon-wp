<?php


namespace Ipol\Ozon\Ozon\Controller;

use Ipol\Ozon\Api\Entity\Request\ManifestUnprocessed as RequestObj;
use Ipol\Ozon\Ozon\Entity\ManifestUnprocessedResult as ResultObj;


/**
 * Class RequestManifestUnprocessed
 * @package Ipol\Ozon\Ozon\Controller
 */
class RequestManifestUnprocessed extends AutomatedCommonRequest
{
    /**
     * RequestManifestUnprocessed constructor.
     * @param ResultObj $resultObj
     * @param int|null $size
     * @param string|null $token
     */
    public function __construct(ResultObj $resultObj, ?int $size, ?string $token)
    {
        parent::__construct($resultObj);

        $data = new RequestObj();
        if($size)
            $data->setPaginationSize($size);
        if($token)
            $data->setPaginationToken($token);

        $this->setRequestObj($data);
    }

}