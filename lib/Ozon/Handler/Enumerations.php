<?php


namespace Ipol\Ozon\Ozon\Handler;


class Enumerations
{
    const STATUS_REGISTERED = 5;
    const STATUS_TAKEN_BY_DELIVERY_SERVICE = 10;
    const STATUS_ESTIMATED_DELIVERY_DATE = 1005;
    const STATUS_SHIPPING_CANCELED = 1010;
    const STATUS_SHIPPED_TO_YOUR_CITY = 20;
    const STATUS_ARRIVED_AT_YOUR_CITY = 40;
    const STATUS_READY_TO_PICKUP = 45;
    const STATUS_DELIVERED = 50;
    const STATUS_PARTIALLY_DELIVERED = 60;
    const STATUS_PARTIALLY_RETURN_AFTER_DELIVERY = 65;
    const STATUS_CLIENT_REFUSED = 70;
    const STATUS_SHIPPING_NOT_CLAIMED = 80;
    const STATUS_GIVEN_TO_CURRIER = 90;
    const STATUS_RETURN_SHIPPED_TO_WAREHOUSE = 100;
    const STATUS_RETURN_ARRIVED_AT_WAREHOUSE = 110;
    const STATUS_RETURN_READY_FOR_TRANSFER_TO_SENDER = 115;
    const STATUS_RETURN_DELIVERED_TO_SENDER = 120;

    /**
     * @return array
     * Returns array of final statuses (which must not be tracked)
     */
    public static function getFinalStatuses(): array
    {
        return array(
            self::STATUS_DELIVERED,
            93,
            self::STATUS_RETURN_DELIVERED_TO_SENDER,
            self::STATUS_SHIPPING_CANCELED,
        );
    }

    /**
     * @return array
     * Returns array of statuses which mark the process of returning the order to the shop
     */
    public static function getReturnStatuses(): array
    {
        return array(
            self::STATUS_PARTIALLY_RETURN_AFTER_DELIVERY,
            self::STATUS_RETURN_SHIPPED_TO_WAREHOUSE,
            self::STATUS_RETURN_ARRIVED_AT_WAREHOUSE,
            self::STATUS_RETURN_READY_FOR_TRANSFER_TO_SENDER,
        );
    }

    /**
     * @return array
     * Returns array of statuses which precede the return status
     */
    public static function getPreReturnStatuses(): array
    {
        return array(
            self::STATUS_PARTIALLY_DELIVERED,
            self::STATUS_CLIENT_REFUSED,
            self::STATUS_SHIPPING_NOT_CLAIMED,
        );
    }

}