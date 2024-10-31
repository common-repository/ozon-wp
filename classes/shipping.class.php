<?php

use Ipol\Ozon\Core\Delivery\Cargo;
use Ipol\Ozon\Core\Delivery\CargoCollection;
use Ipol\Ozon\Core\Delivery\CargoItem;
use Ipol\Ozon\Core\Delivery\Location;
use Ipol\Ozon\Core\Delivery\Shipment;
use Ipol\Ozon\Core\Entity\Money;

class Ozon_Shipping_Method extends \WC_Shipping_Method {

    const SHIPPING_METHOD_ID = 'ozon_shipping_method';

    const COURIER_TYPE_ID = 52895497000;
    const PICKUP_TYPE_ID = 52895552000;
    const POSTAMAT_TYPE_ID = 4635044131000;

    const BUYER_TYPE_NATURAL = 'NaturalPerson';
    const BUYER_TYPE_LEGAL = 'LegalPerson';

    /**
     * Constructor for shipping class
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->id           = self::SHIPPING_METHOD_ID;
        $this->method_title = __('Ozon Delivery', OZON_PLUGIN_DOMAIN);
        $this->title        = __('Ozon Delivery', OZON_PLUGIN_DOMAIN);
        $this->enabled      = $this->get_option('enabled', false);

        add_action('woocommerce_update_options_shipping_'.$this->id, array($this, 'process_admin_options'));

        $this->init();
    }

    /**
     * Init settings
     *
     * @access public
     * @return void
     */
    public function init() {
        $this->init_form_fields();
        $this->init_settings();

        add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
    }

    /**
     * Инициализация настроек метода доставки
    */
    public function init_form_fields() {
        $this->form_fields = array(
            'common_title' => [
                'title' => 'Общие',
                'type' => 'title',
            ],
            'enabled' => [
                'title'   => __('Enable/Disable', OZON_PLUGIN_DOMAIN),
                'type'    => 'checkbox',
                'default' => 'yes'
            ],
            'show_always_button' => [
                'title'       => 'Отображать блок заявки в заказах',
                'type'        => 'select',
                'default'     => 'no',
                'description' => 'Указывает модулю, когда добавлять на страницу заказа кнопку оформления заявки на доставку модуля: она отображается либо всегда, либо только если выбрана служба доставки модуля. Это актуально, если установлено несколько модулей интеграции.',
                'desc_tip'    => true,
                'options'     => [
                    '' => 'Доставка OZON',
                    'always' => 'Всегда',
                ]
            ],
            'default_allow_uncovering' => [
                'title' => 'Разрешение вскрытия отправления по-умолчанию',
                'type' => 'checkbox',
                'default' => 'no',
                'description' => 'Разрешить вскрытие отправления покупателем по умолчанию. Влияет на автоустановку соответствующего флага при отправке заказа.',
                'desc_tip' => true,
            ],
            'default_chst' => [
                'title' => 'Разрешение частичной выдачи по-умолчанию',
                'type' => 'checkbox',
                'default' => 'no',
                'description' => 'Разрешить частичную выдачу заказа. Влияет на автоустановку соответствующего флага при отправке заказа.',
                'desc_tip' => true,
            ],
            'disable_insurance' => [
                'title' => 'Не использовать страховку',
                'type' => 'checkbox',
                'default' => 'no',
                'description' => 'При отмеченной опции оценочная стоимость товаров не будет передаваться в API',
                'desc_tip'=> true,
            ],
            'api_title' => [
                'title' => 'Ключи авторизации',
                'type' => 'title',
            ],
            'client_id' => [
                'title'       => __('Client ID', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true
            ],
            'client_secret' => [
                'title'       => __('Client Secret', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true
            ],
            'yandex_maps_key' => [
                'title'       => __('Yandex Maps Key', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true
            ],
            'dimensions_title' => [
                'title' => 'Габариты',
                'type' => 'title',
            ],
            'default_item_weight' => [
                'title'       => __('Default item weight (kg)', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('Default item weight if it not specified', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true,
                'default'     => 1
            ],
            'default_item_length' => [
                'title'       => __('Default item length (cm)', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('Default item length if it not specified', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true,
                'default'     => 10
            ],
            'default_item_width' => [
                'title'       => __('Default item width (cm)', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('Default item width if it not specified', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true,
                'default'     => 10
            ],
            'default_item_height' => [
                'title'       => __('Default item height (cm)', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('Default item height if it not specified', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true,
                'default'     => 10
            ],
            'shipping_title' => [
                'title' => 'Настройки доставки',
                'type' => 'title',
            ],
            'shipping_insurance' => [
                'title'       => 'Включать страховку в стоимость доставки',
                'type'        => 'checkbox',
                'description' => '',
                'desc_tip'    => false,
                'default'     => 'no',
            ],
            'shipping_markup' => [
                'title'       => 'Наценка на стоимость доставки (% от стоимости товаров в заказе)',
                'type'        => 'text',
                'description' => '',
                'desc_tip'    => false,
                'default'     => 0,
            ],
            'shipping_courier_fixed_price' => [
                'title'       => 'Фиксированная стоимость доставки (курьер)',
                'type'        => 'text',
                'description' => '',
                'desc_tip'    => false,
                'default'     => '',
            ],
            'shipping_pickup_fixed_price' => [
                'title'       => 'Фиксированная стоимость доставки (ПВЗ)',
                'type'        => 'text',
                'description' => '',
                'desc_tip'    => false,
                'default'     => '',
            ],
            'shipping_postmat_fixed_price' => [
                'title'       => 'Фиксированная стоимость доставки (постамат)',
                'type'        => 'text',
                'description' => '',
                'desc_tip'    => false,
                'default'     => '',
            ],
            'shipping_pvz_required' => [
                'title'       => 'Не давать оформить заказ без выбранного пункта выдачи',
                'type'        => 'checkbox',
                'description' => '',
                'desc_tip'    => false,
                'default'     => 'yes',
            ],
            'shipping_nds' => [
                'title'       => __('Shipping NDS', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('Shipping NDS', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true,
                'default'     => 20
            ],
            'order_prefix' => [
                'title'       => __('Order Prefix', OZON_PLUGIN_DOMAIN),
                'type'        => 'text',
                'description' => __('Order Orefix', OZON_PLUGIN_DOMAIN),
                'desc_tip'    => true,
                'default'     => 'WP_'
            ],
        );

   //   $paymentGatewayes = WC()->payment_gateways();
 WC()->payment_gateways ? $paymentGatewayes = WC()->payment_gateways->payment_gateways() : $paymentGatewayes = [];
		if ($paymentGatewayes && !is_array($paymentGatewayes)){
            $paymentGatewayes = array($paymentGatewayes);
        }
        if (is_array($paymentGatewayes) && count($paymentGatewayes)>0) {
            $wc_gateways = array_filter(WC()->payment_gateways->get_available_payment_gateways(), function($gateway) {
                return $gateway->enabled == 'yes';
            });
        }

        if ($wc_gateways) {
            $gateways = [];
            foreach($wc_gateways as $gateway) {
                $gateways[ $gateway->id ] = $gateway->title;
            }
        
            $this->form_fields['payment_title'] = [
                'title' => 'Настройки соответствия платежных систем',
                'type' => 'title',
            ];

            $this->form_fields['online_payments'] = [
                'title' => 'Оплата на сайте',
                'type' => 'multiselect',
                'options' => $gateways,
            ];

            $this->form_fields['npp_payments'] = [
                'title' => 'Оплата наличными',
                'type' => 'multiselect',
                'options' => $gateways,
            ];
        }

        if($wc_statuses =  wc_get_order_statuses()) {
            $this->form_fields['status_title'] = [
                'title' => 'Статусы',
                'type' => 'title',
            ];
            
            $options = array_merge(['' => __('N/A', OZON_PLUGIN_DOMAIN)], $wc_statuses);

            foreach ($this->_get_ozon_statuses() as $code => $status)
                $this->form_fields['ozon_status_' . $code] = [
                    'title' => sprintf(__('Synchronization for status "%s"', OZON_PLUGIN_DOMAIN), $status),
                    'type' => 'select',
                    'description' => sprintf(__('Synchronization for status "%s"', OZON_PLUGIN_DOMAIN), $status),
                    'desc_tip' => true,
                    'default' => '',
                    'options' => $options
               ];
        }
    }

    /**
     * Валидация формы настроек метода доставки
     *
     * @throws Exception
     */
    public function validate_text_field($key, $value) {
        switch($key) {
            case 'client_id':
                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter Client ID.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'client_secret':
                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter Client Secret.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'yandex_maps_key':
                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter Yandex Maps key.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'default_item_weight':
                $value = strtr((float)$value, [',' => '.']);

                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter default weight.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'default_item_length':
                $value = strtr((float)$value, [',' => '.']);

                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter default length.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'default_item_width':
                $value = strtr((float)$value, [',' => '.']);

                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter default width.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'default_item_height':
                $value = strtr((float)$value, [',' => '.']);

                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter default height.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'shipping_nds':
                if(empty($value) && $value !== '0') {
                    WC_Admin_Settings::add_error(__('Please, enter shipping NDS.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
            case 'order_prefix':
                if(empty($value)) {
                    WC_Admin_Settings::add_error(__('Please, enter order prefix.', OZON_PLUGIN_DOMAIN));
                    $this->update_option('enabled', 'no');
                }
                break;
        }

        return $value;
    }

    /**
     * Метод расчета стоимости доставки
     *
     * @access public
     * @param mixed $package
     * @return void
     * @throws Exception
     */
    public function calculate_shipping($package = array()) {

        // \WordPress\Ozon\Ozon_WP::actionEveryMinuteEvent();
        // \WordPress\Ozon\Ozon_WP::actionHourlyEvent();

        if(!empty($this->settings['client_id']) && !empty($this->settings['client_secret'])) {
            $location_parts = [];

            if (!empty($package['destination']['country'])) {
                // $countries = WC()->countries->get_countries();

                if (!empty($countries[$package['destination']['country']]))
                    $location_parts[] = $countries[$package['destination']['country']];
            }

            if (!empty($package['destination']['city']))
                $location_parts[] = $package['destination']['city'];

            $shipment = new Shipment();
            $location = new Location('cms');

            $location->setName(implode(', ', $location_parts));
            $shipment->setTo($location);
            $shipment->setTariff(['Courier', 'PickPoint', 'Postamat']);

            $cargoList = new CargoCollection();
            $cargoBox = new Cargo();

            foreach ($package['contents'] as $item) {
                /**
                 * @var WC_Product_Simple $product
                 */
                $product = $item['data'];

                for ($i = 1; $i <= $item['quantity']; $i++) {
                    empty($product->get_weight()) ?
                        $cargoItemWeight = (float) wc_get_weight($this->get_option('default_item_weight'), 'g', 'kg') :
                        $cargoItemWeight = wc_get_weight($product->get_weight(), 'g');

                    empty($product->get_length())?
                        $cargoItemLength = (float) wc_get_dimension($this->get_option('default_item_length'), 'mm', 'cm') :
                        $cargoItemLength = wc_get_dimension($product->get_length(), 'mm');

                    empty($product->get_width())?
                        $cargoItemWidth  = (float) wc_get_dimension($this->get_option('default_item_width'), 'mm', 'cm') :
                        $cargoItemWidth  = wc_get_dimension($product->get_width(), 'mm');

                    empty($product->get_height())?
                        $cargoItemHeight = (float) wc_get_dimension($this->get_option('default_item_height'), 'mm', 'cm') :
                        $cargoItemHeight = wc_get_dimension($product->get_height(), 'mm');

                    $cargoItem = new CargoItem();
                    $cargoItem
                        ->setPrice(new Money($product->get_price()))
                        ->setCost(new Money($this->settings['disable_insurance'] == 'yes' ? 0 : $product->get_price()))
                        ->setWeight($cargoItemWeight)
                        ->setLength($cargoItemLength)
                        ->setWidth($cargoItemWidth)
                        ->setHeight($cargoItemHeight);

                    $cargoBox->add($cargoItem);
                }
            }

            $cargoList->add($cargoBox);
            $shipment->setCargoes($cargoList);

            $app = new Ipol\Ozon\Ozon\OzonApplication(
                $this->settings['client_id'],
                $this->settings['client_secret'],
                false,
                600);

            $app->setCache(false);
            $response = $app->deliveryVariantsForShipmentShort($shipment, 25);

            if ($response->isSuccess() && !empty($response->getResponse()->getDeliveryVariantIds())) {
                $details = $shipment->getDetails();
                $fromPlacesResponse = $app->deliveryFromPlaces();

                if($fromPlacesResponse->isSuccess()) {
                    $fromPlaces = $fromPlacesResponse->getResponse()->getFields();
                    $apiVariants = $response->getResponse()->getFields();

                    if (!empty($fromPlaces) && !empty($fromPlaces['places']) && !empty($fromPlaces['places'][0])) {
                        if (is_array($details) && array_key_exists('variantGuidCourier', $details) && $details['variantGuidCourier'])
                            $chosenVariantGuidCourier = $details['variantGuidCourier'];
                        else {
                            $variantsFilter = $this->_prepare_variant_filter(self::COURIER_TYPE_ID, $shipment, $apiVariants['deliveryVariantIds']);
                            $variantsCourier = $this->_get_possible_variants($variantsFilter);
                            $chosenVariantGuidCourier = $this->_predict_delivery_variant(self::COURIER_TYPE_ID, $variantsCourier);
                            $details = array_merge($details ? : [], [
                                'variantGuidCourier' => $chosenVariantGuidCourier,
                                'variantsAvailable' => array_keys($apiVariants),
                                'variantsCourier' => $variantsCourier
                            ]);

                            $shipment->setDetails($details);
                        }

                        if (is_array($details) && array_key_exists('variantGuidPickup', $details) && $details['variantGuidPickup'])
                            $chosenVariantGuidPickup = $details['variantGuidPickup'];
                        else {
                            $variantsFilter = $this->_prepare_variant_filter(self::PICKUP_TYPE_ID, $shipment, $apiVariants['deliveryVariantIds']);
                            $variantsPickup = $this->_get_possible_variants($variantsFilter);
                            $chosenVariantGuidPickup = $this->_predict_delivery_variant(self::PICKUP_TYPE_ID, $variantsPickup);
                            $details = array_merge($details ? : [], [
                                'variantGuidPickup' => $chosenVariantGuidPickup,
                                'variantsAvailable' => array_keys($apiVariants),
                                'variantsPickup' => $variantsPickup
                            ]);

                            $shipment->setDetails($details);
                        }

                        if (is_array($details) && array_key_exists('variantGuidPostamat', $details) && $details['variantGuidPostamat'])
                            $chosenVariantGuidPostamat = $details['variantGuidPostamat'];
                        else {
                            $variantsFilter = $this->_prepare_variant_filter(self::POSTAMAT_TYPE_ID, $shipment, $apiVariants['deliveryVariantIds']);
                            $variantsPostamat = $this->_get_possible_variants($variantsFilter);
                            $chosenVariantGuidPostamat = $this->_predict_delivery_variant(self::POSTAMAT_TYPE_ID, $variantsPostamat);
                            $details = array_merge($details ? : [], [
                                'variantGuidPostamat' => $chosenVariantGuidPostamat,
                                'variantsAvailable' => array_keys($apiVariants),
                                'variantsPostamat' => $variantsPostamat
                            ]);

                            $shipment->setDetails($details);
                        }

                        $markup = $this->get_option('shipping_markup', 0);
                        $markup = round($markup * ($package['cart_subtotal'] ?? 0) / 100, 2);

                        if($chosenVariantGuidCourier) {
                            $amount = (string) $this->get_option('shipping_courier_fixed_price', '');
                            $deliveryCourierDays = $app->deliveryTime( $fromPlaces["places"][0]["id"] , $chosenVariantGuidCourier  );
                            !($deliveryCourierDays->isSuccess()) ?: $daysCourier = $deliveryCourierDays->getResponse()->getFields()['days'];

                            if (empty($amount) && $amount !== '0') {
                                $deliveryCalculateResponse = $app->deliveryCalculateForShipment($chosenVariantGuidCourier, $shipment, $fromPlaces['places'][0]['id']);
                                $amount = $deliveryCalculateResponse->isSuccess() ? $deliveryCalculateResponse->getResponse()->getAmount() : false;
                            }

                            if ($amount !== false) {
                                $this->add_rate(array(
                                    'id' => $this->id . ':courier',
                                    'label' => __('Ozon Courier', OZON_PLUGIN_DOMAIN).' ('. $daysCourier .' дн.)',
                                    'cost' => $amount + $markup,
                                    'meta_data' => [
                                        'delivery_variant_id' => $chosenVariantGuidCourier
                                    ]
                                ));
                            }
                        }

                        if($chosenVariantGuidPickup) {
                            $amount = (string) $this->get_option('shipping_pickup_fixed_price', '');
			                 $deliveryPickupDays = $app->deliveryTime( $fromPlaces["places"][0]["id"] , $chosenVariantGuidPickup  );
                            !($deliveryPickupDays->isSuccess()) ?: $daysPickup = $deliveryPickupDays->getResponse()->getFields()['days'];

                            if (empty($amount) && $amount !== '0') {
                                $deliveryPickupResponse = $app->deliveryCalculateForShipment($chosenVariantGuidPickup, $shipment, $fromPlaces['places'][0]['id']);
                                $amount = $deliveryPickupResponse->isSuccess() ? $deliveryPickupResponse->getResponse()->getAmount() : false;
                            }

                            if ($amount !== false) {
                                $this->add_rate(array(
                                    'id' => $this->id . ':pickup',
                                    'label' => __('Ozon Pickup', OZON_PLUGIN_DOMAIN).' ('. $daysPickup .' дн.)',
                                    'cost' =>  $amount + $markup,
                                    'meta_data' => $details['variantsPickup'] ?? []
                                ));
                            }
                        }

                        if($chosenVariantGuidPostamat) {
                            $amount = (string) $this->get_option('shipping_postmat_fixed_price', '');
			    $deliveryPostamatDays = $app->deliveryTime( $fromPlaces["places"][0]["id"] , $chosenVariantGuidPostamat  );
                            !($deliveryPostamatDays->isSuccess()) ?: $daysPostamat = $deliveryPostamatDays->getResponse()->getFields()['days'];

                            if (empty($amount) && $amount !== '0') {
                                $deliveryPostamatResponse = $app->deliveryCalculateForShipment($chosenVariantGuidPostamat, $shipment, $fromPlaces['places'][0]['id']);
                                $amount = $deliveryPostamatResponse->isSuccess() ? $deliveryPostamatResponse->getResponse()->getAmount() : false;
                            }

                            if ($amount !== false) {
                                $this->add_rate(array(
                                    'id' => $this->id . ':postamat',
                                    'label' => __('Ozon Postamat', OZON_PLUGIN_DOMAIN).' ('. $daysPostamat .' дн.)',
                                    'cost' => $amount + $markup,
                                    'meta_data' => $details['variantsPostamat'] ?? []
                                ));
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Доступный список статусов ОЗОН
     *
     * @return array
    */
    protected function _get_ozon_statuses(): array {
        return [
            5    => 'Отправление зарегистрировано',
            10   => 'Передано в службу доставки',
            1005 => 'Ожидаемая дата доставки',
            1010 => 'Отправление аннулировано',
            20   => 'Отправлено в Ваш город',
            40   => 'Прибыло в Ваш город',
            45   => 'Готово к выдаче',
            50   => 'Отправление выдано',
            60   => 'Отправление выдано частично',
            65   => 'Частичный возврат после выдачи',
            70   => 'Отказ клиента',
            80   => 'Отправление не востребовано',
            90   => 'Передано курьеру',
            100  => 'Возврат отправлен на склад',
            110  => 'Возврат прибыл на склад',
            115  => 'Возврат готов к передаче отправителю',
            120  => 'Возврат передан отправителю'
        ];
    }

    /**
     * Подготовка вариантов доставки на основе параметров отправления
     *
     * @param int $object_type_id
     * @param Shipment $shipment
     * @param array $variantsIds
     * @return array filter
     */
    protected function _prepare_variant_filter(int $object_type_id, Shipment $shipment, array $variantsIds = array()): array {
        $filter = [
            'type_id = '.$object_type_id,
            'date_sync >= \''.(new \DateTime())->modify('-1 day')->format('Y-m-d').'\''
        ];

        if(!empty($variantsIds))
            $filter[] = 'id IN('.implode(',', $variantsIds).')';

        // Deal with Cargos
        $totalWeight = $shipment->getCargoes()->getTotalWeight();
        $cargoDimensions = $shipment->getCargoes()->getTotalDimensions();
        $totalPrice = $shipment->getCargoes()->getTotalPrice()->getAmount();

        if($totalWeight)
            $filter[] = '(min_weight <= '.$totalWeight.' AND (max_weight = 0 OR max_weight >= '.$totalWeight.'))';

        if(!empty($cargoDimensions['W']))
            $filter[] = '(restriction_width = 0 OR restriction_width >= '.($cargoDimensions['W']).')';
        if(!empty($cargoDimensions['L']))
            $filter[] = '(restriction_length = 0 OR restriction_length >= '.($cargoDimensions['L']).')';
        if(!empty($cargoDimensions['H']))
            $filter[] = '(restriction_height = 0 OR restriction_height >= '.($cargoDimensions['H']).')';

        if($totalPrice)
            $filter[] = '(min_price <= '.$totalPrice.' AND (max_price = 0 OR max_price >= '.$totalPrice.'))';

        return $filter;
    }

    /**
     * Получение возможных вариантов доставки
     *
     * @param array $filter
     * @return array
     */
    protected function _get_possible_variants(array $filter): array {
        global $wpdb;

        return $wpdb->get_results(
            "SELECT * FROM `{$wpdb->base_prefix}ozon_delivery_variants` WHERE ".implode(' AND ', $filter)
        );
    }

    /**
     * Предсказываение наиболее оптимального варианта доставки
     *
     * @param int $object_type_id
     * @param array $variants
     * @return string delivery variant guid
     */
    protected function _predict_delivery_variant(int $object_type_id, array $variants) {
        $result = false;

        if(!empty($variants)) {
            switch ($object_type_id) {
                case self::COURIER_TYPE_ID:
                    $result = $variants[0]->id;
                    break;
                case self::PICKUP_TYPE_ID:
                case self::POSTAMAT_TYPE_ID:
                    if (count($variants) <= 3) {
                        // Choose first available too
                        $result = $variants[0]->id;
                    } else {
                        // Choose one mostly close to city center based on coords
                        $x = $y = $count = 0;

                        foreach ($variants as $item) {
                            if ($item->latitude && $item->longitude) {
                                $x += $item->latitude;
                                $y += $item->longitude;
                                $count++;
                            }
                        }

                        $x = $x / $count;
                        $y = $y / $count;

                        $tmp = [];

                        foreach ($variants as $item) {
                            if ($item->latitude && $item->longitude) {
                                $tmp[$item->id] = (abs($x - $item->latitude) + abs($y - $item->longitude));
                            }
                        }

                        asort($tmp, SORT_NUMERIC);

                        reset($tmp);
                        $result = key($tmp);
                    }
                    break;
            }
        }

        return $result;
    }
}