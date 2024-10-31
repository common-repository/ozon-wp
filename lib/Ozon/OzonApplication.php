<?php


namespace Ipol\Ozon\Ozon;


use Exception;
use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Logger\Psr\Log\LoggerInterface;
use Ipol\Ozon\Api\Sdk;
use Ipol\Ozon\Core\Delivery\Shipment;
use Ipol\Ozon\Core\Entity\CacheInterface;
use Ipol\Ozon\Core\Order\Order;
use Ipol\Ozon\Ozon\Controller\AutomatedCommonRequest;
use Ipol\Ozon\Ozon\Controller\CancelOrders;
use Ipol\Ozon\Ozon\Controller\RequestBarcode;
use Ipol\Ozon\Ozon\Controller\RequestController;
use Ipol\Ozon\Ozon\Controller\RequestDeliveryCalculate;
use Ipol\Ozon\Ozon\Controller\RequestDeliveryCalculateForShipment;
use Ipol\Ozon\Ozon\Controller\RequestDeliveryTime;
use Ipol\Ozon\Ozon\Controller\RequestDeliveryVariants;
use Ipol\Ozon\Ozon\Controller\RequestDeliveryVariantsForShipment;
use Ipol\Ozon\Ozon\Controller\RequestDeliveryVariantsForShipmentShort;
use Ipol\Ozon\Ozon\Controller\RequestDocument;
use Ipol\Ozon\Ozon\Controller\RequestDocumentCreate;
use Ipol\Ozon\Ozon\Controller\RequestDocumentList;
use Ipol\Ozon\Ozon\Controller\RequestManifestRemove;
use Ipol\Ozon\Ozon\Controller\RequestManifestUnprocessed;
use Ipol\Ozon\Ozon\Controller\RequestPickupExtendedInfo;
use Ipol\Ozon\Ozon\Controller\RequestToken;
use Ipol\Ozon\Ozon\Controller\RequestTrackingList;
use Ipol\Ozon\Ozon\Controller\SendOrder;
use Ipol\Ozon\Ozon\Controller\ShipmentRequest;
use Ipol\Ozon\Ozon\Controller\TrackingByBarcode;
use Ipol\Ozon\Ozon\Controller\TrackingByPostingNumber;
use Ipol\Ozon\Ozon\Controller\TrackingDetail;
use Ipol\Ozon\Ozon\Entity\AbstractResult;

/**
 * Class OzonApplication
 * @package Ipol\Ozon\Ozon
 */
class OzonApplication
{
    /**
     * @var string
     */
    protected $clientId;
    /**
     * @var string
     */
    protected $clientSecret;
    /**
     * @var string Auth bearer token
     */
    protected $token = "";
    /**
     * @var bool - shows if api mode is test or productive
     */
    protected $testMode = false;
    /**
     * @var bool - true if using custom URL for requests is allowed
     */
    protected $customAllowed = false;
    /**
     * @var false|EncoderInterface
     */
    protected $encoder = null;
    /**
     * @var null|LoggerInterface
     */
    protected $logger;
    /**
     * @var integer
     */
    protected $timeout;
    /**
     * @var false|CacheInterface
     */
    protected $cache = false;
    /**
     * @var array
     * saves results of calculation via hash
     */
    protected $abyss;
    /**
     * @var bool
     * set - data won't get into the abyss
     */
    protected $blockAbyss = true;
    /**
     * @var string
     * shows how was made last request: via cache, taken from abyss or by actual request to server
     */
    protected $lastRequestType = false;
    /**
     * @var string
     */
    protected $hash;
    /**
     * @var ExceptionCollection empty if no errors occurred, error-info otherwise
     */
    protected $errorCollection;
    /**
     * @var bool
     * Indicates if the method was already called (for recurrent calls for dead jwt)
     */
    protected $recursionFlag = false;

    /**
     * OzonApplication constructor.
     * @param string $clientId
     * @param string $clientSecret
     * @param bool $isTest
     * @param int $timeout
     * @param EncoderInterface|null $encoder
     * @param CacheInterface|null $cache
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        string $clientId,
        string $clientSecret,
        bool $isTest = false,
        int $timeout = 6,
        ?EncoderInterface $encoder = null,
        ?CacheInterface $cache = null,
        ?LoggerInterface $logger = null
    ) {
        $this->setClientId($clientId)
            ->setClientSecret($clientSecret)
            ->setTestMode($isTest)
            ->setTimeout($timeout)
            ->setEncoder($encoder)
            ->setCache($cache)
            ->setLogger($logger);

        $this->abyss = [];
        $this->errorCollection = new ExceptionCollection();
        try {
            $this->getToken();
        } catch (AppLevelException $e) {
            $this->addError($e);
        }
    }

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @return Entity\RequestTokenResult
     */
    protected function requestToken(string $clientId, string $clientSecret): Entity\RequestTokenResult
    {
        $this->lastRequestType = 'token direct';
        $controller = new RequestToken($clientId, $clientSecret);

        try {
            $adapter = new CurlAdapter($this->getTimeout());
            if ($this->getLogger()) {
                $adapter->setLog($this->getLogger());
            }

            $mode = $this->testMode ? 'TEST' : 'API';
            $sdk = new Sdk($adapter, false, $this->getEncoder(), $mode, $this->customAllowed);

            return $controller->setSdk($sdk)->execute();
        } catch (Exception $e) {
            $this->addError($e);
            $result = new Entity\RequestTokenResult();
            $result->setSuccess(false);
            return $result;
        }
    }

    /**
     * @param AutomatedCommonRequest|mixed $controller
     * @param bool $useCache
     * @param int $cacheTTL
     * @return AbstractResult|mixed
     */
    private function genericCall($controller, bool $useCache = false, int $cacheTTL = 3600)
    {
        $resultObj = $controller->getResultObject();
        $this->setHash($controller->getSelfHash());
        if ($this->checkAbyss()) {
            $this->lastRequestType = 'abyss';
            return $this->abyss[$this->getHash()];
        } else {
            if ($useCache && $this->getCache() && $this->getCache()->setLife($cacheTTL)->checkCache($this->getHash())) {
                $this->lastRequestType = 'cache';
                return $this->getCache()->getCache($this->getHash());
            } else {
                $this->lastRequestType = 'direct';

                try {
                    $this->configureController($controller);
                } catch (Exception $e) {
                    $this->addError($e);
                    return $resultObj;
                }
                $controller->convert()
                    ->execute();

                if ($resultObj->getError()) {
                    if (($resultObj->getError()->getCode() == 401) && !$this->recursionFlag) {
                        $this->setToken("");
                        $this->recursionFlag = true; //blocking further recursive calls
                        try {
                            $this->getToken(true); //forcing token-request
                        } catch (AppLevelException $e) {
                            $this->addError($e);
                            return $resultObj;
                        }
                        return $this->genericCall($controller, $useCache, $cacheTTL);
                    } else {
                        $this->addError($resultObj->getError());
                    }
                } else {
                    $this->toAbyss($resultObj);
                    if ($useCache) {
                        $this->toCache($resultObj, $this->getHash());
                    }
                }
            }
        }
        return $resultObj;
    }

    /**
     * @param string|null $cityName
     * @param bool $workingHours - return info about working hours?
     * @param bool $postalCode - return info about postal codes?
     * @param int|null $paginationSize - quantity of entities in one response
     * @param string|null $paginationToken - token of requested page from DeliveryVariantsResult->getNextPageToken()
     * @return Entity\DeliveryVariantsResult
     */
    public function deliveryVariants(
        ?string $cityName = null,
        bool $workingHours = true,
        bool $postalCode = false,
        ?int $paginationSize = null,
        ?string $paginationToken = null
    ): Entity\DeliveryVariantsResult {
        $controller = new RequestDeliveryVariants(new Entity\DeliveryVariantsResult(), $cityName, $workingHours,
            $postalCode, $paginationSize, $paginationToken);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller, true);
    }

    /**
     * @return Entity\RequestCitiesResult
     */
    public function getCities(): Entity\RequestCitiesResult
    {
        $controller = new AutomatedCommonRequest(new Entity\RequestCitiesResult());
        $controller->setSdkMethodName('deliveryCities');
        return $this->genericCall($controller, true, 3600 * 24);
    }

    /**
     * @param int $deliveryVariantId
     * @param float $weight
     * @param int $fromPlaceId
     * @param float $estimatedPrice
     * @return Entity\DeliveryCalculate
     */
    public function deliveryCalculate(
        int $deliveryVariantId,
        float $weight,
        int $fromPlaceId,
        float $estimatedPrice = 0
    ): Entity\DeliveryCalculate {
        $controller = new RequestDeliveryCalculate(new Entity\DeliveryCalculate(), $deliveryVariantId, $weight, $fromPlaceId, $estimatedPrice);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller, true);
    }

    /**
     * Calculates delivery price for shipment
     * Uses maximum of physical and volume weight
     *
     * @param int $deliveryVariantId
     * @param Shipment $shipment
     * @param int $fromPlaceId
     * @return Entity\DeliveryCalculate
     */
    public function deliveryCalculateForShipment(
        int $deliveryVariantId,
        Shipment $shipment,
        int $fromPlaceId
    ): Entity\DeliveryCalculate {
        $controller = new RequestDeliveryCalculateForShipment(new Entity\DeliveryCalculate(), $deliveryVariantId, $shipment, $fromPlaceId);
        $controller->setSdkMethodName('deliveryCalculate');
        return $this->genericCall($controller, true);
    }

    //TODO deliveryCalculatePost

    //TODO deliveryCalculateInformation

    /**
     * @return Entity\DeliveryFromPlacesResult
     */
    public function deliveryFromPlaces(): Entity\DeliveryFromPlacesResult
    {
        $controller = new AutomatedCommonRequest(new Entity\DeliveryFromPlacesResult());
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller, true);
    }

    /**
     * @param Shipment $shipment
     * @param float $radius - km
     * @return Entity\DeliveryVariantsForShipmentResult
     */
    public function deliveryVariantsForShipment(
        Shipment $shipment,
        float $radius
    ): Entity\DeliveryVariantsForShipmentResult {
        $controller = new RequestDeliveryVariantsForShipment(new Entity\DeliveryVariantsForShipmentResult(), $shipment,
            $radius);
        $controller->setSdkMethodName('deliveryVariantsByAddress');
        return $this->genericCall($controller, true);
    }

    /**
     * @param Shipment $shipment
     * @param float $radius - km
     * @param int $limit
     * @return Entity\DeliveryVariantsShortResult
     */
    public function deliveryVariantsForShipmentShort(
        Shipment $shipment,
        float $radius,
        int $limit = 3000
    ): Entity\DeliveryVariantsShortResult {
        $controller = new RequestDeliveryVariantsForShipmentShort(new Entity\DeliveryVariantsShortResult(), $shipment,
            $radius, $limit);
        $controller->setSdkMethodName('deliveryVariantsByAddressShort');
        return $this->genericCall($controller, true);
    }

    //TODO deliveryVariantsByViewport

    //TODO deliveryVariantsByIds

    /**
     * Return information about how long in days will take delivery
     * @param int $fromPlaceId - id of dispatch place
     * @param int $deliveryVariant - delivery variant id (from one of deliveryVariants... methods)
     * @return Entity\DeliveryTimeResult
     */
    public function deliveryTime(int $fromPlaceId, int $deliveryVariant): Entity\DeliveryTimeResult
    {
        $controller = new RequestDeliveryTime(new Entity\DeliveryTimeResult(), $fromPlaceId, $deliveryVariant);
        $controller->setSdkMethodName('deliveryTime');
        return $this->genericCall($controller, true);
    }

    //TODO deliveryPickupPlaces

    /**
     * get list of created documents
     * @param $paginationSize - int - amount records on page
     * @param $paginationToken - string
     * @param array $arFilter - [
     *      number - string - filter by document Number
     *      dateFrom - string date-time
     *      dateTo - string date-time]
     * @return Entity\DocumentListResult
     */
    public function getDocumentList(
        ?int $paginationSize = null,
        ?string $paginationToken = null,
        array $arFilter = []
    ): Entity\DocumentListResult {
        $controller = new RequestDocumentList(new Entity\DocumentListResult(), $paginationSize, $paginationToken,
            $arFilter);
        $controller->setSdkMethodName('documentList');
        return $this->genericCall($controller);
    }

    //TODO documentReturnDocuments

    /**
     * @param int $documentId - from createDocument or getDocumentList response
     * @param string $documentType -
     *      "Act" – for acceptance-transfer certificate (PDF)
     *      "T12" – for TORG-12 (PDF)
     *      "ActSales" – for sales invoice (PDF)
     *      "T12Sales" – for sales invoice (Xls)
     * @param string $documentFormat - "PDF" or "XLS"
     * @return Entity\GetDocumentResult
     */
    public function getDocument(int $documentId, string $documentType, string $documentFormat): Entity\GetDocumentResult
    {
        $controller = new RequestDocument(new Entity\GetDocumentResult(), $documentId, $documentType, $documentFormat);
        $controller->setSdkMethodName('document');
        return $this->genericCall($controller);
    }

    //TODO documentImage

    /**
     * @param int[] $arrId - array of postingId's - id from manifestUnprocessed response
     * @return Entity\DocumentCreateResult
     */
    public function createDocument(array $arrId): Entity\DocumentCreateResult
    {
        $controller = new RequestDocumentCreate(new Entity\DocumentCreateResult(), $arrId);
        $controller->setSdkMethodName('documentCreate');
        return $this->genericCall($controller);
    }

    //TODO documentBinary

    //TODO draftOrder

    //TODO draftOrderAddress

    //TODO draftOrderDeliveryVariant

    //TODO dropoff

    //TODO dropoffAct

    //TODO dropoffActs

    //TODO manifestUpload

    /**
     * @param int|null $paginationSize - amount records on page
     * @param string|null $paginationToken - token of requested page from ManifestUnprocessedResult->getNextPageToken()
     * @return Entity\ManifestUnprocessedResult
     */
    public function manifestUnprocessed(
        ?int $paginationSize = null,
        ?string $paginationToken = null
    ): Entity\ManifestUnprocessedResult
    {
        $controller = new RequestManifestUnprocessed(new Entity\ManifestUnprocessedResult(), $paginationSize,
            $paginationToken);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller, true);
    }

    /**
     * @param string $postingNumber
     * @return Entity\ManifestRemoveResult
     */
    public function manifestRemove(string $postingNumber): Entity\ManifestRemoveResult
    {
        $controller = new RequestManifestRemove(new Entity\ManifestRemoveResult(), $postingNumber);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller);
    }

    /**
     * @param Order $cOrder
     * @return Entity\SendOrderResult
     */
    public function sendOrder(Order $cOrder): Entity\SendOrderResult
    {
        $controller = new SendOrder(new Entity\SendOrderResult(), $cOrder);
        $controller->setSdkMethodName('order');
        return $this->genericCall($controller);
    }

    //TODO orderReturn

    //TODO orderById

    //TODO orderImport

    /**
     * @param array $arrOrderIds
     * @return Entity\CancelOrdersResult
     */
    public function cancelOrders(array $arrOrderIds): Entity\CancelOrdersResult
    {
        $controller = new CancelOrders(new Entity\CancelOrdersResult(), $arrOrderIds);
        $controller->setSdkMethodName('orderStatusCanceled');
        return $this->genericCall($controller);
    }

    //TODO orderCancellationReasons

    //TODO orderConvert

    /**
     * @param int $postingId - id from manifestUnprocessed response
     * @return Entity\GetBarcodeResult
     */
    public function getBarcodePdf(int $postingId): Entity\GetBarcodeResult
    {
        $controller = new RequestBarcode(new Entity\GetBarcodeResult(), $postingId);
        $controller->setSdkMethodName('postingTicket');
        return $this->genericCall($controller);
    }

    //TODO reportList

    //TODO reportBinary

    //TODO reportSentToDeliverySubscribe

    //TODO reportSentToDeliveryUnsubscribe

    public function shipmentRequest(array $orderIdArray): Entity\ShipmentRequest
    {
        $controller = new ShipmentRequest(new Entity\ShipmentRequest(), $orderIdArray);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller);
    }

    //TODO shipmentRequestAct

    //TODO shipmentRequestActs

    /**
     * @return Entity\TariffListResult
     */
    public function getTariffList(): Entity\TariffListResult
    {
        $controller = new AutomatedCommonRequest(new Entity\TariffListResult());
        $controller->setSdkMethodName('tariffList');
        return $this->genericCall($controller, true, 24 * 3600);
    }

    //TODO ticket

    /**
     * @param string $postingNumber - order number, send in order:orderNumber or in manifestUpload:posting:postingNumber
     * @return Entity\TrackingResult
     */
    public function trackingByPostingNumber(string $postingNumber): Entity\TrackingResult
    {
        $controller = new TrackingByPostingNumber(new Entity\TrackingResult(), $postingNumber);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller);
    }

    /**
     * @param string $barcode
     * @return Entity\TrackingResult
     */
    public function trackingByBarcode(string $barcode): Entity\TrackingResult
    {
        $controller = new TrackingByBarcode(new Entity\TrackingResult(), $barcode);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller);
    }

    /**
     * @param string[] $arArticles - array of postingBarcodes and postingNumbers (yes, they can be mixed)
     * @return Entity\TrackingListResult
     */
    public function trackingList(array $arArticles): Entity\TrackingListResult
    {
        $controller = new RequestTrackingList(new Entity\TrackingListResult(), $arArticles);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller);
    }

    //TODO trackingByOrderNumber

    /**
     * @param string $postingBarcode
     * @return Entity\TrackingDetailResult
     */
    public function trackingDetail(string $postingBarcode): Entity\TrackingDetailResult
    {
        $controller = new TrackingDetail(new Entity\TrackingDetailResult(), $postingBarcode);
        $controller->setSdkMethodName('trackingPosting');
        return $this->genericCall($controller);
    }

    /**
     * @param int $delVarId
     * @return Entity\PickupExtendedInfo
     */
    public function pickupExtendedInfo(int $delVarId): Entity\PickupExtendedInfo
    {
        $controller = new RequestPickupExtendedInfo(new Entity\PickupExtendedInfo(), $delVarId);
        $controller->setSdkMethodName(__FUNCTION__);
        return $this->genericCall($controller, true);
    }

    /**
     * @param RequestController $controller
     * sets sdk
     * @throws Exception
     */
    protected function configureController($controller)
    {
        $controller->setSDK($this->getSdk());
    }

    /**
     * @return Sdk
     * get the sdk-controller
     * ! timeout sets only here: later it wouldn't be changed !
     * @throws Exception
     */
    public function getSdk(): Sdk
    {
        $mode = $this->testMode ? 'TEST' : 'API';
        $adapter = new CurlAdapter($this->getTimeout());
        if ($this->getLogger()) {
            $adapter->setLog($this->getLogger());
        }

        return new Sdk($adapter, $this->getToken(), $this->getEncoder(), $mode, $this->customAllowed);
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return OzonApplication
     */
    public function setClientId(string $clientId): OzonApplication
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     * @return OzonApplication
     */
    public function setClientSecret(string $clientSecret): OzonApplication
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTestMode(): bool
    {
        return $this->testMode;
    }

    /**
     * @param bool $testMode
     * @return OzonApplication
     */
    public function setTestMode(bool $testMode): OzonApplication
    {
        $this->testMode = $testMode;
        return $this;
    }

    /**
     * @return int|false
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * @param int|false $timeout
     * @return OzonApplication
     */
    public function setTimeout($timeout): OzonApplication
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return bool|EncoderInterface
     */
    public function getEncoder()
    {
        return $this->encoder;
    }

    /**
     * @param false|EncoderInterface $encoder
     * @return OzonApplication
     */
    public function setEncoder($encoder): OzonApplication
    {
        $this->encoder = $encoder;
        return $this;
    }

    /**
     * @return CacheInterface|null
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param CacheInterface|null $cache
     * @return OzonApplication
     */
    public function setCache($cache): OzonApplication
    {
        $this->cache = $cache;
        return $this;
    }

    /**
     * @param mixed $data
     * @param string $hash
     * @return OzonApplication
     */
    public function toCache($data, string $hash): OzonApplication
    {
        if (!$hash || $data === null || !$this->getCache()) {
            return $this;
        }

        $this->getCache()->setCache($hash, $data);
        return $this;
    }

    /**
     * @return LoggerInterface|null
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface|null $logger
     * @return OzonApplication
     */
    public function setLogger($logger): OzonApplication
    {
        $this->logger = $logger;
        return $this;
    }

    /**
     * @param bool $force
     * @return string
     * @throws AppLevelException
     */
    public function getToken(bool $force = false): string
    {
        if ($this->token) {
            return $this->token;
        }

        if (!$force && $this->getCache() && $this->getCache()->setLife(60)->checkCache(md5($this->getClientId() . $this->getClientSecret() . 'token'))) {
            $this->setToken($this->getCache()->getCache(md5($this->getClientId() . $this->getClientSecret() . 'token')));
        } else {
            $newToken = $this->requestToken($this->getClientId(), $this->getClientSecret());
            if (!$newToken->isSuccess()) {
                if ($newToken->getError()) {
                    if ($newToken->getError()->getCode() == 302) {
                        $this->addError(new AppLevelException('IP not in white-list', 302));
                    } else {
                        $this->addError($newToken->getError());
                    }
                }
                throw new AppLevelException('Fail to get token!');
            } else {
                $this->setToken($newToken->getAccessToken());
                if ($this->getCache()) {
                    $this->getCache()
                        ->setCache(md5($this->getClientId() . $this->getClientSecret() . 'token'), $this->token);
                }
            }
        }
        return $this->token;
    }

    /**
     * @param string $token
     * @return OzonApplication
     */
    public function setToken(string $token): OzonApplication
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getHash(): ?string
    {
        return $this->hash;
    }

    /**
     * @param mixed $hash
     * @return OzonApplication
     */
    public function setHash($hash): OzonApplication
    {
        $this->hash = $hash;
        return $this;
    }

    /**
     * @return $this
     */
    public function allowCustom(): OzonApplication
    {
        $this->customAllowed = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function disallowCustom(): OzonApplication
    {
        $this->customAllowed = false;
        return $this;
    }

    /**
     * @param bool $blockAbyss
     * @return OzonApplication
     */
    public function setAbyssLock(bool $blockAbyss): OzonApplication
    {
        $this->blockAbyss = $blockAbyss;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAbyssLocked(): bool
    {
        return $this->blockAbyss;
    }

    /**
     * @return array
     */
    public function getAbyss(): array
    {
        return $this->abyss;
    }

    /**
     * @param array $abyss
     * @return OzonApplication
     */
    public function setAbyss(array $abyss): OzonApplication
    {
        $this->abyss = $abyss;
        return $this;
    }

    /**
     * @param mixed $val
     * @param string $hash
     * @return $this
     * returns saved request
     */
    public function toAbyss($val, string $hash = ''): OzonApplication
    {
        $hash = ($hash) ? $hash : $this->getHash();
        if (!$this->blockAbyss && $hash) {
            $this->abyss[$hash] = $val;
        }

        return $this;
    }

    /**
     * @param bool|string $hash
     * @return bool|mixed
     * checks whether same request was already done
     */
    public function checkAbyss($hash = false)
    {
        $hash = ($hash) ?: $this->getHash();
        if (!$this->isAbyssLocked() &&
            $hash &&
            array_key_exists($hash, $this->abyss)
        ) {
            return $this->abyss[$hash];
        }
        return false;
    }

    /**
     * @param mixed $error - throwable (Exceptions)
     * @return $this
     */
    protected function addError($error): OzonApplication
    {
        $this->errorCollection->add($error);
        return $this;
    }

    /**
     * @return ExceptionCollection
     */
    public function getErrorCollection(): ExceptionCollection
    {
        return $this->errorCollection;
    }

    /**
     * @return string
     */
    public function getLastRequestType()
    {
        return $this->lastRequestType;
    }

}