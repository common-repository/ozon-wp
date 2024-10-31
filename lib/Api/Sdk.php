<?php


namespace Ipol\Ozon\Api;


use Error;
use Ipol\Ozon\Api\Adapter\CurlAdapter;
use Ipol\Ozon\Api\Entity\EncoderInterface;
use Ipol\Ozon\Api\Methods\DeliveryCalculate;
use Ipol\Ozon\Api\Methods\DeliveryCities;
use Ipol\Ozon\Api\Methods\DeliveryFromPlaces;
use Ipol\Ozon\Api\Methods\DeliveryVariants;
use Ipol\Ozon\Api\Methods\DeliveryVariantsByAddress;
use Ipol\Ozon\Api\Methods\DeliveryVariantsByAddressShort;
use Ipol\Ozon\Api\Methods\DeliveryVariantsByIds;
use Ipol\Ozon\Api\Methods\DeliveryVariantsByViewport;
use Ipol\Ozon\Api\Methods\Document;
use Ipol\Ozon\Api\Methods\DocumentBinary;
use Ipol\Ozon\Api\Methods\DocumentCreate;
use Ipol\Ozon\Api\Methods\DocumentList;
use Ipol\Ozon\Api\Methods\DocumentReturnDocuments;
use Ipol\Ozon\Api\Methods\Dropoff;
use Ipol\Ozon\Api\Methods\DropoffAct;
use Ipol\Ozon\Api\Methods\GeneralMethod;
use Ipol\Ozon\Api\Methods\ManifestRemove;
use Ipol\Ozon\Api\Methods\ManifestUnprocessed;
use Ipol\Ozon\Api\Methods\ManifestUpload;
use Ipol\Ozon\Api\Methods\Order;
use Ipol\Ozon\Api\Methods\OrderById;
use Ipol\Ozon\Api\Methods\OrderImport;
use Ipol\Ozon\Api\Methods\PickupExtendedInfo;
use Ipol\Ozon\Api\Methods\PostingTicket;
use Ipol\Ozon\Api\Methods\ReportBinary;
use Ipol\Ozon\Api\Methods\ReportList;
use Ipol\Ozon\Api\Methods\TariffList;
use Ipol\Ozon\Api\Methods\Ticket;
use Ipol\Ozon\Api\Methods\TokenGenerate;
use Ipol\Ozon\Api\Methods\TrackingByBarcode;
use Ipol\Ozon\Api\Methods\TrackingByPostingNumber;
use Ipol\Ozon\Api\Methods\TrackingList;
use Ipol\Ozon\Api\Methods\TrackingPosting;

/**
 * Class Sdk
 * @package Ipol\Ozon\Api
 */
class Sdk
{
    /**
     * @var CurlAdapter
     */
    private $adapter;
    /**
     * @var EncoderInterface|null
     */
    private $encoder;
    /**
     * @var array
     */
    protected $map;

    /**
     * Sdk constructor.
     * @param CurlAdapter $adapter
     * @param string $token
     * @param false|EncoderInterface $encoder
     * @param string $mode
     * @param bool $custom
     */
    public function __construct(CurlAdapter $adapter, string $token = '', $encoder = null, string $mode = 'API', bool $custom = false)
    {
        $this->adapter = $adapter;
        $this->encoder = $encoder;
        $this->map = self::getMap($mode, $custom);

        if($token)
            $this->adapter->appendHeaders(['Authorization: Bearer '.$token]);
    }

    /**
     * @param string $mode
     * @param bool $custom
     * @return array
     */
    protected function getMap(string $mode, bool $custom): array
    {
        $api = 'https://xapi.ozon.ru/principal-integration-api/v1';
        $test = 'https://api-stg.ozonru.me/principal-integration-api/v1';

        $arMap = [
            'tokenGenerate' => [
                'API' => 'https://xapi.ozon.ru/principal-auth-api/connect/token',
                'TEST' => 'https://api-stg.ozonru.me/principal-auth-api/connect/token',
                'REQUEST_TYPE' => 'FORM'
            ],
//----------Delivery-----------------------------------------------------------------------------
            'deliveryVariants' => [/*Получение списка способов доставки*/
                'API' => $api.'/delivery/variants',
                'TEST' => $test.'/delivery/variants',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryCities' => [/*Получение списка городов, в которые есть возможность доставлять*/
                'API' => $api.'/delivery/cities',
                'TEST' => $test.'/delivery/cities',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryCalculate' => [/*Метод расчёта стоимости доставки*/
                'API' => $api.'/delivery/calculate',
                'TEST' => $test.'/delivery/calculate',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryCalculatePost' => [/*Метод расчёта стоимости доставки*/
                'API' => $api.'/delivery/calculate',
                'TEST' => $test.'/delivery/calculate',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryCalculateInformation' => [/**/
                'API' => $api.'/delivery/calculate/information',
                'TEST' => $test.'/delivery/calculate/information',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryFromPlaces' => [/*Получение информации о месте передачи отправления на склад О – Курьер списком (Список ПВЗ принимающих заказы)*/
                'API' => $api.'/delivery/from_places',
                'TEST' => $test.'/delivery/from_places',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryVariantsByAddress' => [/*Получение списка способов доставки по адресу*/
                'API' => $api.'/delivery/variants/byaddress',
                'TEST' => $test.'/delivery/variants/byaddress',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryVariantsByAddressShort' => [ /*Получение идентификаторов способов доставки по адресу*/
                'API' => $api.'/delivery/variants/byaddress/short',
                'TEST' => $test.'/delivery/variants/byaddress/short',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryVariantsByViewport' => [/*Получение списка способов доставки по viewport*/
                'API' => $api.'/delivery/variants/byviewport',
                'TEST' => $test.'/delivery/variants/byviewport',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryVariantsByIds' => [/*Получение списка способов доставки по идентификаторам*/
                'API' => $api.'/delivery/variants/byids',
                'TEST' => $test.'/delivery/variants/byids',
                'REQUEST_TYPE' => 'POST',
            ],
            'deliveryTime' => [/*Получение списка способов доставки по идентификаторам*/
                'API' => $api.'/delivery/time',
                'TEST' => $test.'/delivery/time',
                'REQUEST_TYPE' => 'GET',
            ],
            'deliveryPickupPlaces' => [/*Получение списка складов пикапа*/
                'API' => $api.'/delivery/pickup_places',
                'TEST' => $test.'/delivery/pickup_places',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Document-----------------------------------------------------------------------------
            'documentList' => [//deprecated
                'API' => $api.'/document/list',
                'TEST' => $test.'/document/list',
                'REQUEST_TYPE' => 'GET',
            ],
            'documentReturnDocuments' => [/*Метод получения списка расходных документов*/
                'API' => $api.'/document/return_documents',
                'TEST' => $test.'/document/return_documents',
                'REQUEST_TYPE' => 'GET',
            ],
            'document' => [//deprecated
                'API' => $api.'/document',
                'TEST' => $test.'/document',
                'REQUEST_TYPE' => 'GET',
            ],
            'documentImage' => [/*Метод получения документа в виде изображений PNG. Ответ содержит массив страниц.*/
                'API' => $api.'/document/image',
                'TEST' => $test.'/document/image',
                'REQUEST_TYPE' => 'GET',
            ],
            'documentCreate' => [//deprecated
                'API' => $api.'/document/create',
                'TEST' => $test.'/document/create',
                'REQUEST_TYPE' => 'POST',
            ],
            'documentBinary' => [/*Метод получения документа с идентификатором (в бинарном виде)*/
                'API' => $api.'/document/binary',
                'TEST' => $test.'/document/binary',
                'REQUEST_TYPE' => 'GET',
            ],
//----------DraftOrder---------------------------------------------------------------------------
            'draftOrder' => [/*Загрузка черновика заказа. Черновик обновляется, если с таким номером уже существует*/
                'API' => $api.'/draftOrder',
                'TEST' => $test.'/draftOrder',
                'REQUEST_TYPE' => 'PUT',
            ],
            'draftOrderAddress' => [/*Обновление адреса в черновике заказа*/
                'API' => $api.'/draftOrder', //{logisticOrderNumber}/address <-added in method class
                'TEST' => $test.'/draftOrder',
                'REQUEST_TYPE' => 'PUT',
            ],
            'draftOrderDeliveryVariant' => [/*Обновление способа доставки в черновике заказа*/
                'API' => $api.'/draftOrder', //{logisticOrderNumber}/deliveryVariant <-added in method class
                'TEST' => $test.'/draftOrder',
                'REQUEST_TYPE' => 'PUT',
            ],
//----------Dropoff------------------------------------------------------------------------------
            'dropoff' => [/*Метод создания завки на отгрузку*/
                'API' => $api.'/dropoff',
                'TEST' => $test.'/dropoff',
                'REQUEST_TYPE' => 'POST',
            ],
            'dropoffAct' => [/*Метод для для получения акта по ID заявки на отгрузку*/
                'API' => $api.'/dropoff', // /{id}/act <-added in method class
                'TEST' => $test.'/dropoff',
                'REQUEST_TYPE' => 'GET',
            ],
            'dropoffActs' => [/*Получение актов по идентификаторам заявок на отгрузку*/
                'API' => $api.'/dropoff/acts',
                'TEST' => $test.'/dropoff/acts',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Manifest-----------------------------------------------------------------------------
            'manifestUpload' => [/*Метод загрузки отправлений(выгрузка/обновление заказов согласно ТЗ)*/
                'API' => $api.'/manifest/upload',
                'TEST' => $test.'/manifest/upload',
                'REQUEST_TYPE' => 'POST',
            ],
            'manifestUnprocessed' => [/*Получение списка необработанных (не переданных в доставку) отправлений*/
                'API' => $api.'/manifest/unprocessed',
                'TEST' => $test.'/manifest/unprocessed',
                'REQUEST_TYPE' => 'GET',
            ],
            'manifestRemove' => [/*Помечает на удаление манифест*/
                'API' => $api.'/manifest/remove',
                'TEST' => $test.'/manifest/remove',
                'REQUEST_TYPE' => 'POST',
            ],
//----------Order--------------------------------------------------------------------------------
            'order' => [/*Метод загрузки заказов*/
                'API' => $api.'/order',
                'TEST' => $test.'/order',
                'REQUEST_TYPE' => 'POST',
            ],
            'orderReturn' => [/*Выполняет создание заказа из возвращаемых товаров*/
                'API' => $api.'/order/return',
                'TEST' => $test.'/order/return',
                'REQUEST_TYPE' => 'POST',
            ],
            'orderById' => [/*Получение заказа по его Id*/
                'API' => $api.'/order',
                'TEST' => $test.'/order',
                'REQUEST_TYPE' => 'GET',
            ],
            'orderImport' => [
                'API' => $api.'/order/import',
                'TEST' => $test.'/order/import',
                'REQUEST_TYPE' => 'POST',
            ],
            'orderStatusCanceled' => [/*Отмена заказов*/
                'API' => $api.'/order/status/canceled',
                'TEST' => $test.'/order/status/canceled',
                'REQUEST_TYPE' => 'PUT',
            ],
            'orderCancellationReasons' => [/*Справочник причин отмены заказа*/
                'API' => $api.'/order/cancellationReasons',
                'TEST' => $test.'/order/cancellationReasons',
                'REQUEST_TYPE' => 'GET',
            ],
            'orderConvert' => [/**/
                'API' => $api.'/order', // /{draftLogisticOrderNumber}/convert <-added in method class
                'TEST' => $test.'/order',
                'REQUEST_TYPE' => 'POST',
            ],
//----------Posting------------------------------------------------------------------------------
            'postingTicket' => [/*Получение этикетки по номеру отправления*/
                'API' => $api.'/posting/ticket',
                'TEST' => $test.'/posting/ticket',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Report-------------------------------------------------------------------------------
            'reportList' => [/*Метод получения списка отчётов*/
                'API' => $api.'/report/list',
                'TEST' => $test.'/report/list',
                'REQUEST_TYPE' => 'GET',
            ],
            'reportBinary' => [/*Получение отчёта (в бинарном виде)*/
                'API' => $api.'/report/binary',
                'TEST' => $test.'/report/binary',
                'REQUEST_TYPE' => 'GET',
            ],
            'reportSentToDeliverySubscribe' => [/*Подписаться на рассылку об оприходованных отправлениях*/
                'API' => $api.'/report/sent_to_delivery/subscribe',
                'TEST' => $test.'/report/sent_to_delivery/subscribe',
                'REQUEST_TYPE' => 'GET',
            ],
            'reportSentToDeliveryUnsubscribe' => [/*/v1/report/sent_to_delivery/unsubscribe*/
                'API' => $api.'/report/sent_to_delivery/unsubscribe',
                'TEST' => $test.'/report/sent_to_delivery/unsubscribe',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Shipment-----------------------------------------------------------------------------
            'shipmentRequest' => [/*Метод создания заявки на отгрузку*/
                'API' => $api.'/shipmentRequest',
                'TEST' => $test.'/shipmentRequest',
                'REQUEST_TYPE' => 'POST',
            ],
            'shipmentRequestAct' => [/*Метод для для получения акта по ID заявки на отгрузку*/
                'API' => $api.'/shipmentRequest', // /{id}/act <-added in method class
                'TEST' => $test.'/shipmentRequest',
                'REQUEST_TYPE' => 'GET',
            ],
            'shipmentRequestActs' => [/*Получение актов по идентификаторам заявок на отгрузку*/
                'API' => $api.'/shipmentRequest/acts',
                'TEST' => $test.'/shipmentRequest/acts',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Tariff-------------------------------------------------------------------------------
            'tariffList' => [/*Метод получения списка тарифов*/
                'API' => $api.'/tariff/list',
                'TEST' => $test.'/tariff/list',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Ticket-------------------------------------------------------------------------------
            'ticket' => [/*Получение архива с этикетками по массиву OrderId*/
                'API' => $api.'/ticket',
                'TEST' => $test.'/ticket',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Tracking-----------------------------------------------------------------------------
            'trackingByPostingNumber' => [/*Получение трекинга по номеру отправления*/
                'API' => $api.'/tracking/bypostingnumber',
                'TEST' => $test.'/tracking/bypostingnumber',
                'REQUEST_TYPE' => 'GET',
            ],
            'trackingByBarcode' => [/*Получение трекинга по штрихкоду отправления*/
                'API' => $api.'/tracking/bybarcode',
                'TEST' => $test.'/tracking/bybarcode',
                'REQUEST_TYPE' => 'GET',
            ],
            'trackingList' => [/*Получение трекинга по списку номеров отправлений или штрихкодов*/
                'API' => $api.'/tracking/list',
                'TEST' => $test.'/tracking/list',
                'REQUEST_TYPE' => 'POST',
            ],
            'trackingByOrderNumber' => [/*Получение трекинга по номеру заказа*/
                'API' => $api.'/tracking/byordernumber',
                'TEST' => $test.'/tracking/byordernumber',
                'REQUEST_TYPE' => 'GET',
            ],
            'trackingPosting' => [/*deprecated*/
                'API' => $api.'/tracking/posting',
                'TEST' => $test.'/tracking/posting',
                'REQUEST_TYPE' => 'GET',
            ],
//----------Other--------------------------------------------------------------------------------
            'pickupExtendedInfo' => [/*Получение расширенной информации о точках самовывоза*/
                'API' => 'https://api.ozon.ru/delivery-params-api/v1/delivery/methods/pickup/extended-info',
                'TEST' => 'https://api-stg.ozonru.me/delivery-params-api/v1/delivery/methods/pickup/extended-info',
                'REQUEST_TYPE' => 'GET',
            ],
        ];

        if(defined('IPOL_OZON_CUSTOM_MAP') && is_array(IPOL_OZON_CUSTOM_MAP))
            foreach(IPOL_OZON_CUSTOM_MAP as $method => $url)
            {
                $arMap[$method]['CUSTOM'] = $url;
            }

        if($mode != 'TEST' && $mode != 'API')
            throw new Error('Unknown Api-map configuring mode');

        $arReturn = array();
        foreach($arMap as $method => $arData)
        {
            if($custom && isset($arData['CUSTOM']))
                $url = $arData['CUSTOM'];
            else
                $url = $arData[$mode];

            $arReturn[$method] = array(
                'URL' => $url,
                'REQUEST_TYPE' => $arData['REQUEST_TYPE']
            );
        }
        return $arReturn;
    }

    /**
     * @param string $method name of method in api-map
     */
    protected function configureRequest(string $method): void
    {
        if(array_key_exists($method, $this->map))
        {
            $url = $this->map[$method]['URL'];
            $type = $this->map[$method]['REQUEST_TYPE'];
        }
        else
        {
            throw new Error('Requested method "'.$method.'" not found in module map!');
        }

        $this->adapter->setMethod($method);
        $this->adapter->setUrl($url);
        $this->adapter->setRequestType($type);
    }

    /**
     * @param Entity\Request\TokenGenerate $data
     * @return TokenGenerate
     * @throws BadResponseException
     */
    public function tokenGenerate(Entity\Request\TokenGenerate $data): TokenGenerate
    {
        $this->configureRequest(__FUNCTION__);
        return new TokenGenerate($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DeliveryVariants $data
     * @return DeliveryVariants
     * @throws BadResponseException
     */
    public function deliveryVariants(Entity\Request\DeliveryVariants $data): DeliveryVariants
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryVariants($data, $this->adapter, $this->encoder);
    }

    /**
     * @return DeliveryCities
     * @throws BadResponseException
     */
    public function deliveryCities(): DeliveryCities
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryCities( $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DeliveryCalculate $data
     * @return DeliveryCalculate
     * @throws BadResponseException
     */
    public function deliveryCalculate(Entity\Request\DeliveryCalculate $data): DeliveryCalculate
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryCalculate($data, $this->adapter, $this->encoder);
    }

    public function deliveryCalculatePost(Entity\Request\DeliveryCalculatePost $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DeliveryCalculatePost::class, $this->encoder);
    }

    public function deliveryCalculateInformation(Entity\Request\DeliveryCalculateInformation $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DeliveryCalculateInformation::class, $this->encoder);
    }

    /**
     * @return DeliveryFromPlaces
     * @throws BadResponseException
     */
    public function deliveryFromPlaces(): DeliveryFromPlaces
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryFromPlaces($this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DeliveryVariantsByAddress $data
     * @return DeliveryVariantsByAddress
     * @throws BadResponseException
     */
    public function deliveryVariantsByAddress(Entity\Request\DeliveryVariantsByAddress $data): DeliveryVariantsByAddress
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryVariantsByAddress($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DeliveryVariantsByAddressShort $data
     * @return DeliveryVariantsByAddressShort
     * @throws BadResponseException
     */
    public function deliveryVariantsByAddressShort(Entity\Request\DeliveryVariantsByAddressShort $data): DeliveryVariantsByAddressShort
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryVariantsByAddressShort($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DeliveryVariantsByViewport $data
     * @return DeliveryVariantsByViewport
     * @throws BadResponseException
     */
    public function deliveryVariantsByViewport(Entity\Request\DeliveryVariantsByViewport $data): DeliveryVariantsByViewport
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryVariantsByViewport($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DeliveryVariantsByIds $data
     * @return DeliveryVariantsByIds
     * @throws BadResponseException
     */
    public function deliveryVariantsByIds(Entity\Request\DeliveryVariantsByIds $data): DeliveryVariantsByIds
    {
        $this->configureRequest(__FUNCTION__);
        return new DeliveryVariantsByIds($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DeliveryTime $data
     * @return GeneralMethod
     * @throws BadResponseException
     */
    public function deliveryTime(Entity\Request\DeliveryTime $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DeliveryTime::class, $this->encoder);
    }

    public function deliveryPickupPlaces(Entity\Request\DeliveryPickupPlaces $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DeliveryPickupPlaces::class, $this->encoder);
    }

    /**
     * @param Entity\Request\DocumentList $data
     * @return DocumentList
     * @throws BadResponseException
     * @deprecated
     */
    public function documentList(Entity\Request\DocumentList $data): DocumentList
    {
        $this->configureRequest(__FUNCTION__);
        return new DocumentList($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DocumentReturnDocuments $data
     * @return Methods\DocumentReturnDocuments
     * @throws BadResponseException
     */
    public function documentReturnDocuments(Entity\Request\DocumentReturnDocuments $data): DocumentReturnDocuments
    {
        $this->configureRequest(__FUNCTION__);
        return new DocumentReturnDocuments($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\Document $data
     * @return Document
     * @throws BadResponseException
     * @deprecated
     */
    public function document(Entity\Request\Document $data): Document
    {
        $this->configureRequest(__FUNCTION__);
        return new Document($data, $this->adapter, $this->encoder);
    }

    public function documentImage(Entity\Request\DocumentImage $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DocumentImage::class, $this->encoder);
    }

    /**
     * @param Entity\Request\DocumentCreate $data
     * @return DocumentCreate
     * @throws BadResponseException
     * @deprecated
     */
    public function documentCreate(Entity\Request\DocumentCreate $data): DocumentCreate
    {
        $this->configureRequest(__FUNCTION__);
        return new DocumentCreate($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\DocumentBinary $data
     * @return DocumentBinary
     * @throws BadResponseException
     */
    public function documentBinary(Entity\Request\DocumentBinary $data): DocumentBinary
    {
        $this->configureRequest(__FUNCTION__);
        return new DocumentBinary($data, $this->adapter, $this->encoder);
    }

    public function draftOrder(Entity\Request\DraftOrder $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DraftOrder::class, $this->encoder);
    }

    public function draftOrderAddress(Entity\Request\DraftOrderAddress $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DraftOrderAddress::class, $this->encoder);
    }

    public function draftOrderDeliveryVariant(Entity\Request\DraftOrderDeliveryVariant $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DraftOrderDeliveryVariant::class, $this->encoder);
    }

    /**
     * @param Entity\Request\Dropoff $data
     * @return Dropoff
     * @throws BadResponseException
     */
    public function dropoff(Entity\Request\Dropoff $data): Dropoff
    {
        $this->configureRequest(__FUNCTION__);
        return new Dropoff($data, $this->adapter, $this->encoder);
    }

    /**
     * @param int $id
     * @return DropoffAct
     * @throws BadResponseException
     */
    public function dropoffAct(int $id): DropoffAct
    {
        $this->configureRequest(__FUNCTION__);
        return new DropoffAct($id, $this->adapter, $this->encoder);
    }

    public function dropoffActs(Entity\Request\DropoffActs $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\DropoffActs::class, $this->encoder);
    }

    /**
     * @param Entity\Request\ManifestUpload $data
     * @return ManifestUpload
     * @throws BadResponseException
     */
    public function manifestUpload(Entity\Request\ManifestUpload $data): ManifestUpload
    {
        $this->configureRequest(__FUNCTION__);
        return new ManifestUpload($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\ManifestUnprocessed $data
     * @return ManifestUnprocessed
     * @throws BadResponseException
     */
    public function manifestUnprocessed(Entity\Request\ManifestUnprocessed $data): ManifestUnprocessed
    {
        $this->configureRequest(__FUNCTION__);
        return new ManifestUnprocessed($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\ManifestRemove $data
     * @return ManifestRemove
     * @throws BadResponseException
     */
    public function manifestRemove(Entity\Request\ManifestRemove $data): ManifestRemove
    {
        $this->configureRequest(__FUNCTION__);
        return new ManifestRemove($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\Order $data
     * @return Order
     * @throws BadResponseException
     */
    public function order(Entity\Request\Order $data): Order
    {
        $this->configureRequest(__FUNCTION__);
        return new Order($data, $this->adapter, $this->encoder);
    }

    public function orderReturn(Entity\Request\OrderReturn $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\OrderReturn::class, $this->encoder);
    }

    /**
     * @param int $id
     * @return OrderById
     * @throws BadResponseException
     */
    public function orderById(int $id): OrderById
    {
        $this->configureRequest(__FUNCTION__);
        return new OrderById($id, $this->adapter, $this->encoder);
    }

    /**
     * @return OrderImport
     * @throws BadResponseException
     */
    public function orderImport(): OrderImport
    {
        $this->configureRequest(__FUNCTION__);
        return new OrderImport($this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\OrderCancel $data
     * @return GeneralMethod
     * @throws BadResponseException
     */
    public function orderStatusCanceled(Entity\Request\OrderCancel $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\OrderCancel::class, $this->encoder);
    }

    public function orderCancellationReasons(Entity\Request\OrderCancellationReasons $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\OrderCancellationReasons::class, $this->encoder);
    }

    public function orderConvert(Entity\Request\OrderConvert $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\OrderConvert::class, $this->encoder);
    }

    /**
     * @param Entity\Request\PostingTicket $data
     * @return PostingTicket
     * @throws BadResponseException
     */
    public function postingTicket(Entity\Request\PostingTicket $data): PostingTicket
    {
        $this->configureRequest(__FUNCTION__);
        return new PostingTicket($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\ReportList $data
     * @return ReportList
     * @throws BadResponseException
     */
    public function reportList(Entity\Request\ReportList $data): ReportList
    {
        $this->configureRequest(__FUNCTION__);
        return new ReportList($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\ReportBinary $data
     * @return ReportBinary
     * @throws BadResponseException
     */
    public function reportBinary(Entity\Request\ReportBinary $data): ReportBinary
    {
        $this->configureRequest(__FUNCTION__);
        return new ReportBinary($data, $this->adapter, $this->encoder);
    }

    public function reportSentToDeliverySubscribe(Entity\Request\ReportSentToDeliverySubscribe $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\ReportSentToDeliverySubscribe::class, $this->encoder);
    }

    public function reportSentToDeliveryUnsubscribe(Entity\Request\ReportSentToDeliveryUnsubscribe $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\ReportSentToDeliveryUnsubscribe::class, $this->encoder);
    }

    public function shipmentRequest(Entity\Request\ShipmentRequest $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\ShipmentRequest::class, $this->encoder);
    }

    public function shipmentRequestAct(Entity\Request\ShipmentRequestAct $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\ShipmentRequestAct::class, $this->encoder);
    }

    public function shipmentRequestActs(Entity\Request\ShipmentRequestActs $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\ShipmentRequestActs::class, $this->encoder);
    }

    /**
     * @return TariffList
     * @throws BadResponseException
     */
    public function tariffList(): TariffList
    {
        $this->configureRequest(__FUNCTION__);
        return new TariffList( $this->adapter, $this->encoder);
    }

    /**
     * @param array $data
     * @return Ticket
     * @throws BadResponseException
     */
    public function ticket(array $data): Ticket
    {
        $this->configureRequest(__FUNCTION__);
        return new Ticket($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\TrackingByPostingNumber $data
     * @return TrackingByPostingNumber
     * @throws BadResponseException
     */
    public function trackingByPostingNumber(Entity\Request\TrackingByPostingNumber $data): TrackingByPostingNumber
    {
        $this->configureRequest(__FUNCTION__);
        return new TrackingByPostingNumber($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\TrackingByBarcode $data
     * @return TrackingByBarcode
     * @throws BadResponseException
     */
    public function trackingByBarcode(Entity\Request\TrackingByBarcode $data): TrackingByBarcode
    {
        $this->configureRequest(__FUNCTION__);
        return new TrackingByBarcode($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\TrackingList $data
     * @return TrackingList
     * @throws BadResponseException
     */
    public function trackingList(Entity\Request\TrackingList $data): TrackingList
    {
        $this->configureRequest(__FUNCTION__);
        return new TrackingList($data, $this->adapter, $this->encoder);
    }

    public function trackingByOrderNumber(Entity\Request\TrackingByOrderNumber $data): GeneralMethod
    {
        $this->configureRequest(__FUNCTION__);
        return new GeneralMethod($data, $this->adapter, Entity\Response\TrackingByOrderNumber::class, $this->encoder);
    }

    /**
     * @param Entity\Request\TrackingPosting $data
     * @return TrackingPosting
     * @throws BadResponseException
     * @deprecated
     */
    public function trackingPosting(Entity\Request\TrackingPosting $data): TrackingPosting
    {
        $this->configureRequest(__FUNCTION__);
        return new TrackingPosting($data, $this->adapter, $this->encoder);
    }

    /**
     * @param Entity\Request\PickupExtendedInfo $data
     * @return PickupExtendedInfo
     * @throws BadResponseException
     */
    public function pickupExtendedInfo(Entity\Request\PickupExtendedInfo $data): PickupExtendedInfo
    {
        $this->configureRequest(__FUNCTION__);
        return new PickupExtendedInfo($data, $this->adapter, $this->encoder);
    }

}