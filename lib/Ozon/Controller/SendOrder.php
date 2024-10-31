<?php


namespace Ipol\Ozon\Ozon\Controller;


use Ipol\Ozon\Api\Entity\Request\Order as RequestObj;
use Ipol\Ozon\Api\Entity\Request\Part\Common\Dimensions;
use Ipol\Ozon\Api\Entity\Request\Part\Order\Attributes;
use Ipol\Ozon\Api\Entity\Request\Part\Order\DeliveryInformation;
use Ipol\Ozon\Api\Entity\Request\Part\Order\FirstMileTransfer;
use Ipol\Ozon\Api\Entity\Request\Part\Order\OrderLine;
use Ipol\Ozon\Api\Entity\Request\Part\Order\OrderLineList;
use Ipol\Ozon\Api\Entity\Request\Part\Order\Package;
use Ipol\Ozon\Api\Entity\Request\Part\Order\PackageList;
use Ipol\Ozon\Api\Entity\Request\Part\Order\Payment;
use Ipol\Ozon\Api\Entity\Request\Part\Order\Person;
use Ipol\Ozon\Api\Entity\Request\Part\Order\Vat;
use Ipol\Ozon\Core\Entity\Money;
use Ipol\Ozon\Core\Order\Order;
use Ipol\Ozon\Ozon\Entity\SendOrderResult as ResultObj;

/**
 * Class SendOrder
 * @package Ipol\Ozon\Ozon\Controller
 */
class SendOrder extends AutomatedCommonRequest
{
    /**
     * @var Order
     */
    protected $coreOrder;

    /**
     * SendOrder constructor.
     * @param ResultObj $resultObj
     * @param Order $cOrder
     */
    public function __construct(ResultObj $resultObj, Order $cOrder)
    {
        parent::__construct($resultObj);

        $this->coreOrder = $cOrder;
    }

    public function getSelfHash(): string
    {
        $orderString = serialize($this->coreOrder); //TODO change it to something better-better ACTUALLY IT SHOULD NOT BE CACHED
        return md5($orderString);
    }

    /**
     * @return $this
     */
    public function convert(): SendOrder
    {
        $data = new RequestObj();
        $coreOrder = $this->coreOrder;

        $buyer = new Person();
        $buyer->setName($coreOrder->getBuyers()->getFirst()->getFullName())
            ->setPhone($coreOrder->getBuyers()->getFirst()->getPhone())
            ->setEmail($coreOrder->getBuyers()->getFirst()->getEmail())
            ->setType(($coreOrder->getBuyers()->getFirst()->getField('PersonType'))) // "LegalPerson" | "NaturalPerson"
            ->setLegalName($coreOrder->getBuyers()->getFirst()->getField('Company'));

        $payment = new Payment();
        $payment->setType((!$coreOrder->getPayment()->getPrice()->getAmount()) ? "FullPrepayment" : "Postpay")
            ->setPrepaymentAmount($coreOrder->getPayment()->getPayed()->getAmount())
            ->setRecipientPaymentAmount($coreOrder->getPayment()->getPrice()->getAmount())
            ->setDeliveryPrice($coreOrder->getPayment()->getDelivery()->getAmount())
            ->setDeliveryVat(self::makeVatObjByCostAndRate($coreOrder->getPayment()->getDelivery(), $coreOrder->getPayment()->getNdsDelivery()));

        $deliveryInfo = new DeliveryInformation();
        $deliveryInfo->setAddress($coreOrder->getAddressTo()->getAddress())
            ->setDeliveryVariantId($coreOrder->getField('DeliveryVariantId'));

        if ($coreOrder->getAddressFrom()->getCode()) {
            $firstMileTransfer = new FirstMileTransfer();
            $firstMileTransfer->setType("DropOff")
                ->setFromPlaceId($coreOrder->getAddressFrom()->getCode());
            $data->setFirstMileTransfer($firstMileTransfer);
        }

        if ($coreOrder->getReceivers()->getFirst()) {
            $recipient = new Person();
            $recipient->setName($coreOrder->getReceivers()->getFirst()->getFullName())
                ->setPhone($coreOrder->getReceivers()->getFirst()->getPhone())
                ->setEmail($coreOrder->getReceivers()->getFirst()->getEmail())
                ->setType(($coreOrder->getReceivers()->getFirst()->getField('PersonType'))) // "LegalPerson" | "NaturalPerson"
                ->setLegalName($coreOrder->getReceivers()->getFirst()->getField('Company'));
            $data->setRecipient($recipient);
        }

        $packCollection = new PackageList();
        $pack = new Package();
        $goods = $coreOrder->getGoods();
        $pack->setPackageNumber('Package#1')
            /*->setBarCode()*/
            ->setDimensions(new Dimensions(
                $goods->getWeight(),
                $goods->getLength(),
                $goods->getWidth(),
                $goods->getHeight())
            );
        $packCollection->add($pack);

        $orderLineCollection = new OrderLineList();
        $items = $coreOrder->getItems()->reset();
        while ($item = $items->getNext()) {
            $orderLine = new OrderLine();
            $orderLine->setLineNumber($item->getId())
                ->setArticleNumber($item->getArticul())
                ->setName($item->getName())
                ->setWeight($item->getWeight())
                ->setSellingPrice($item->getPrice()->getAmount())
                ->setEstimatedPrice($item->getCost()->getAmount())
                ->setQuantity($item->getQuantity())
                ->setVat(self::makeVatObjByCostAndRate($item->getPrice(), $item->getVatRate()))
                ->setAttributes(new Attributes($item->getField('IsDangerous')))
                ->setResideInPackages(['Package#1'])
                ->setSupplierTin($item->getField('SupplierTin') ?: null);

            $orderLineCollection->add($orderLine);
        }
        $data->setOrderNumber($coreOrder->getNumber())
            ->setComment($coreOrder->getField('Comment'))
            ->setDeliveryInformation($deliveryInfo)
            ->setPayment($payment)
            ->setBuyer($buyer)
            ->setPackages($packCollection)
            ->setOrderLines($orderLineCollection)
	        ->setSource($coreOrder->getField('Source'))
        ;

        $this->setRequestObj($data);

        return $this;
    }

    protected static function makeVatObjByCostAndRate(?Money $money, ?int $vatRate): ?Vat
    {
        if (is_null($money) || is_null($vatRate)) {
            return null;
        }
        $vatMoney = new Money($money->getAmount() * $vatRate / 100, $money->getCurrency()); //by this we accept inner rounding decimal part of money, which is allowed for VAT
        $vatSum = $vatMoney->getAmount();
        return new Vat($vatRate, $vatSum);
    }

}