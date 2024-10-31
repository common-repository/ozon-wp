<?php

namespace WordPress\Ozon;

use Ipol\Ozon\Core\Entity\Money;
use Ipol\Ozon\Core\Order\Address;
use Ipol\Ozon\Core\Order\Buyer;
use Ipol\Ozon\Core\Order\BuyerCollection;
use Ipol\Ozon\Core\Order\Goods;
use Ipol\Ozon\Core\Order\Item;
use Ipol\Ozon\Core\Order\ItemCollection;
use Ipol\Ozon\Core\Order\Order;
use Ipol\Ozon\Core\Order\Payment;
use Ipol\Ozon\Core\Order\Receiver;
use Ipol\Ozon\Core\Order\ReceiverCollection;
use Ipol\Ozon\Ozon\OzonApplication;

class Ozon_WP {

    private static $instance;

    public static function getInstance() {
        if(!self::$instance)
            self::$instance = new self();

        return self::$instance;
    }

    /**
     * Активация и деактивация плагина, регистрация всех фильтров и действий для работы плагина
    */
    public function run() {
        
        register_activation_hook(OZON_PLUGIN_DIR.'/ozon-wp.php', [$this, 'registerActivationHook']);
        register_deactivation_hook(OZON_PLUGIN_DIR.'/ozon-wp.php', [$this, 'registerDeactivationHook']);

        add_filter('plugin_action_links_'.OZON_PLUGIN_BASENAME, [$this, 'filterPluginActionLinks']);
        // add_filter('pre_set_site_transient_update_plugins', [$this, 'filterPreSetSiteTransientUpdatePlugins']);
        
//        add_filter('plugins_api', [$this, 'filterPluginsApi'], 10, 3);
        add_filter('cron_schedules', [$this, 'filterCronSchedules']);
        add_filter('woocommerce_shipping_methods', [$this, 'filterShippingMethods']);
        
        add_filter('woocommerce_checkout_fields', [$this, 'filterWoocommerceCheckoutFields'], 1000);
        add_filter('woocommerce_cart_shipping_method_full_label', [$this, 'actionCartShippingMethodFullLabel'], 10, 2);
        
        add_action('init', [$this, 'actionInit']);
        add_action('wp', [$this, 'actionWP']);
        add_action('od_every_minute_event', [$this, 'actionEveryMinuteEvent']);
        add_action('od_hourly_event', [$this, 'actionHourlyEvent']);
        add_action('admin_footer', [$this, 'actionAdminFooter']);
        add_action('wp_footer', [$this, 'actionWPFooter']);
        add_action('woocommerce_shipping_init', [$this, 'actionCourierShippingInit']);
        add_action('admin_enqueue_scripts', [$this, 'actionAdminEnqueueScripts']);
        add_action('wp_enqueue_scripts', [$this, 'actionWpEnqueueScripts']);
        
        
        add_action('woocommerce_checkout_create_order', [$this, 'actionWoocommerceCheckoutCreateOrder'], 10, 2);
        add_action('woocommerce_after_checkout_validation', [$this, 'actionWoocommerceAfterCheckoutValidation'], 10, 2);

        
        add_action('add_meta_boxes', [$this, 'actionAddMetaBoxes'], 10);
        add_action('wp_ajax_od_update_shipping', [$this, 'actionWpAjaxOdUpdateShipping'], 10);
        add_action('wp_ajax_nopriv_od_update_shipping', [$this, 'actionWpAjaxOdUpdateShipping'], 10);
        add_action('wp_ajax_od_send_order', [$this, 'actionWpAjaxOdSendOrder'], 10);
        add_action('wp_ajax_nopriv_od_send_order', [$this, 'actionWpAjaxOdSendOrder'], 10);
        add_action('wp_ajax_od_create_document', [$this, 'actionWpAjaxOdCreateDocument'], 10);
        add_action('wp_ajax_nopriv_od_create_document', [$this, 'actionWpAjaxOdCreateDocument'], 10);

        add_action('wp_head', [$this, 'addJsConstants']);
        add_action('admin_head', [$this, 'addJsConstants']);
    }

    public function addJsConstants()
    {
        echo '<!----><script>'.
            'window.ozonPluginUrl = "'. OZON_PLUGIN_URI .'";'.
        '</script>';
    }

    /**
     * Хук активации. Отрабатывает при установке плагина.
     * Используется для инициализации таблицы с вариантами доставки Озон, а также инициализация Cron-задач
     * для выгрузки вариантов и для синхронизации статусов
    */
    public function registerActivationHook() {
        global $wpdb;

        $sql = "CREATE TABLE IF NOT EXISTS `{$wpdb->base_prefix}ozon_delivery_variants` (
            `id` bigint NOT NULL,
            `type_id` bigint NOT NULL DEFAULT '0',
            `type_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `address` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `region` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `settlement` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `streets` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `placement` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `enabled` tinyint(1) NOT NULL DEFAULT '0',
            `city_id` bigint NOT NULL DEFAULT '0',
            `fias_guid` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `fias_guid_control` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `address_element_id` bigint NOT NULL DEFAULT '0',
            `fitting_shoes_available` tinyint(1) NOT NULL DEFAULT '0',
            `fitting_clothes_available` tinyint(1) NOT NULL DEFAULT '0',
            `card_payment_available` tinyint(1) NOT NULL DEFAULT '0',
            `how_to_get` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `contractor_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `contractor_id` bigint NOT NULL DEFAULT '0',
            `state_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `min_weight` float NOT NULL DEFAULT '0',
            `max_weight` float NOT NULL DEFAULT '0',
            `min_price` float NOT NULL DEFAULT '0',
            `max_price` float NOT NULL DEFAULT '0',
            `restriction_width` int NOT NULL DEFAULT '0',
            `restriction_length` int NOT NULL DEFAULT '0',
            `restriction_height` int NOT NULL DEFAULT '0',
            `latitude` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `longitude` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `return_available` tinyint(1) NOT NULL DEFAULT '0',
            `partial_give_out_available` tinyint(1) NOT NULL DEFAULT '0',
            `dangerous_available` tinyint(1) NOT NULL DEFAULT '0',
            `is_cash_forbidden` tinyint(1) NOT NULL DEFAULT '0',
            `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `wifi_available` tinyint(1) NOT NULL DEFAULT '0',
            `legal_entity_not_available` tinyint(1) NOT NULL DEFAULT '0',
            `date_open` datetime DEFAULT NULL,
            `date_close` datetime DEFAULT NULL,
            `is_restriction_access` tinyint(1) NOT NULL DEFAULT '0',
            `restriction_access_message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `utc_offset_str` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `is_partial_prepayment_forbidden` tinyint(1) NOT NULL DEFAULT '0',
            `is_geozone_available` tinyint(1) NOT NULL DEFAULT '0',
            `postal_code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
            `date_sync` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) {$wpdb->get_charset_collate()};";

        require_once(ABSPATH.'wp-admin/includes/upgrade.php');

        dbDelta($sql);

        $wpdb->query("ALTER TABLE `{$wpdb->base_prefix}ozon_delivery_variants` ADD UNIQUE KEY `id` (`id`)");

        wp_clear_scheduled_hook('od_every_minute_event');
        wp_clear_scheduled_hook('od_hourly_event');
        wp_schedule_event(time(), 'od_every_minute', 'od_every_minute_event');
        wp_schedule_event(time(), 'hourly', 'od_hourly_event');
        delete_option('ozon_token');
        delete_option('ozon_update_date');
    }

    /**
     * Хук деактивации. Отрабатывает при деинсталяции плагина.
     */
    public function registerDeactivationHook() {
        global $wpdb;

        $wpdb->query("TRUNCATE TABLE `{$wpdb->base_prefix}ozon_delivery_variants`");
        $wpdb->query("DROP TABLE IF EXISTS `{$wpdb->base_prefix}ozon_delivery_variants`");

        wp_clear_scheduled_hook('od_every_minute_event');
        wp_clear_scheduled_hook('od_hourly_event');
        delete_option('ozon_token');
        delete_option('ozon_update_date');
    }

    /**
     * Добавление активной кнопки настрек в разделе плагинов
     *
     * @param array $links
     * @return array
     */
    public function filterPluginActionLinks(array $links): array {
        $new_links[] = '<a href="'.admin_url( 'admin.php?page=wc-settings&tab=shipping&section=ozon_shipping_method').'">'.
            __('Settings').
            '</a>';

        return array_merge($new_links, $links);
    }

    /**
     * Добавление типа графика, необходимое для выполнения крон-задач раз в минуту.
    */
    public function filterCronSchedules($schedules) {
        if(!isset($schedules['od_every_minute']))
            $schedules['od_every_minute'] = array(
                'interval' => 60,
                'display' => __('Every minute', OZON_PLUGIN_DOMAIN)
            );

        return $schedules;
    }

    /**
     * Регистрация собственного метода доставки
    */
    public function filterShippingMethods($methods) {
        $methods[] = 'Ozon_Shipping_Method';

        return $methods;
    }

    /**
     * Инициализация языковых файлов
    */
    public function actionInit() {
        load_plugin_textdomain(OZON_PLUGIN_DOMAIN, false, OZON_PLUGIN_DOMAIN.'/languages/');
    }

    /**
     * Инициализация Cron-задач
    */
    public function actionWP() {
        if(!wp_next_scheduled('od_every_minute_event'))
            wp_schedule_event(time(), 'od_every_minute', 'od_every_minute_event');
        if(!wp_next_scheduled('od_hourly_event'))
            wp_schedule_event(time(), 'hourly', 'od_hourly_event');
    }

    /**
     * Событие, которое отрабатывает каждую минуту.
     * Используется для фоновой выгрузки и обновления вариантов доставки ОЗОН.
    */
    public function actionEveryMinuteEvent() {
        if(get_option('ozon_update_date', null) != date('Y-m-d')) {
            require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

            $shipping_method = new \Ozon_Shipping_Method();

            if($shipping_method->has_settings() && $shipping_method->get_option('client_id') &&
               $shipping_method->get_option('client_secret')) {

                $app = new OzonApplication(
                    $shipping_method->get_option('client_id'),
                    $shipping_method->get_option('client_secret'),
                    false,
                    600);

                $app->setCache(false);
                $response = $app->deliveryVariants(null, true, false, 500, get_option('ozon_token', null));

                if ($response->isSuccess()) {
                    $values = [];

                    foreach ($response->getResponse()->getData()->getFields() as $deliveryVariant) {
                        if (empty($deliveryVariant['id']))
                            continue;

                        $values[] = implode(',', [
                            $deliveryVariant['id'],
                            !empty($deliveryVariant['objectTypeId']) ? $deliveryVariant['objectTypeId'] : '0',
                            !empty($deliveryVariant['objectTypeName']) ? "'" . $deliveryVariant['objectTypeName'] . "'" : 'NULL',
                            !empty($deliveryVariant['name']) ? "'" . addslashes($deliveryVariant['name']) . "'" : 'NULL',
                            !empty($deliveryVariant['address']) ? "'" . addslashes($deliveryVariant['address']) . "'" : 'NULL',
                            !empty($deliveryVariant['region']) ? "'" . addslashes($deliveryVariant['region']) . "'" : 'NULL',
                            !empty($deliveryVariant['settlement']) ? "'" . addslashes($deliveryVariant['settlement']) . "'" : 'NULL',
                            !empty($deliveryVariant['streets']) ? "'" . addslashes($deliveryVariant['streets']) . "'" : 'NULL',
                            !empty($deliveryVariant['placement']) ? "'" . addslashes($deliveryVariant['placement']) . "'" : 'NULL',
                            !empty($deliveryVariant['enabled']) ? $deliveryVariant['enabled'] : 'false',
                            !empty($deliveryVariant['cityId']) ? $deliveryVariant['cityId'] : '0',
                            !empty($deliveryVariant['fiasGuid']) ? "'" . addslashes($deliveryVariant['fiasGuid']) . "'" : 'NULL',
                            !empty($deliveryVariant['fiasGuidControl']) ? "'" . addslashes($deliveryVariant['fiasGuidControl']) . "'" : 'NULL',
                            !empty($deliveryVariant['addressElementId']) ? $deliveryVariant['addressElementId'] : '0',
                            !empty($deliveryVariant['fittingShoesAvailable']) ? $deliveryVariant['fittingShoesAvailable'] : 'false',
                            !empty($deliveryVariant['fittingClothesAvailable']) ? $deliveryVariant['fittingClothesAvailable'] : 'false',
                            !empty($deliveryVariant['cardPaymentAvailable']) ? $deliveryVariant['cardPaymentAvailable'] : 'false',
                            !empty($deliveryVariant['howToGet']) ? "'" . addslashes($deliveryVariant['howToGet']) . "'" : 'NULL',
                            !empty($deliveryVariant['phone']) ? "'" . addslashes($deliveryVariant['phone']) . "'" : 'NULL',
                            !empty($deliveryVariant['contractorName']) ? "'" . addslashes($deliveryVariant['contractorName']) . "'" : 'NULL',
                            !empty($deliveryVariant['contractorId']) ? $deliveryVariant['contractorId'] : '0',
                            !empty($deliveryVariant['stateName']) ? "'" . addslashes($deliveryVariant['stateName']) . "'" : 'NULL',
                            !empty($deliveryVariant['minWeight']) ? $deliveryVariant['minWeight'] : '0',
                            !empty($deliveryVariant['maxWeight']) ? $deliveryVariant['maxWeight'] : '0',
                            !empty($deliveryVariant['minPrice']) ? $deliveryVariant['minPrice'] : '0',
                            !empty($deliveryVariant['maxPrice']) ? $deliveryVariant['maxPrice'] : '0',
                            !empty($deliveryVariant['restrictionWidth']) ? $deliveryVariant['restrictionWidth'] : '0',
                            !empty($deliveryVariant['restrictionLength']) ? $deliveryVariant['restrictionLength'] : '0',
                            !empty($deliveryVariant['restrictionHeight']) ? $deliveryVariant['restrictionHeight'] : '0',
                            !empty($deliveryVariant['lat']) ? "'" . addslashes($deliveryVariant['lat']) . "'" : 'NULL',
                            !empty($deliveryVariant['long']) ? "'" . addslashes($deliveryVariant['long']) . "'" : 'NULL',
                            !empty($deliveryVariant['returnAvailable']) ? $deliveryVariant['returnAvailable'] : 'false',
                            !empty($deliveryVariant['partialGiveOutAvailable']) ? $deliveryVariant['partialGiveOutAvailable'] : 'false',
                            !empty($deliveryVariant['dangerousAvailable']) ? $deliveryVariant['dangerousAvailable'] : 'false',
                            !empty($deliveryVariant['isCashForbidden']) ? $deliveryVariant['isCashForbidden'] : 'false',
                            !empty($deliveryVariant['code']) ? "'" . addslashes($deliveryVariant['code']) . "'" : 'NULL',
                            !empty($deliveryVariant['wifiAvailable']) ? $deliveryVariant['wifiAvailable'] : 'false',
                            !empty($deliveryVariant['legalEntityNotAvailable']) ? $deliveryVariant['legalEntityNotAvailable'] : 'false',
                            !empty($deliveryVariant['dateOpen']) ? "'" . (new \DateTime($deliveryVariant['dateOpen']))->format('Y-m-d H:i:s') . "'" : 'NULL',
                            !empty($deliveryVariant['dateClose']) ? "'" . (new \DateTime($deliveryVariant['dateClose']))->format('Y-m-d H:i:s') . "'" : 'NULL',
                            !empty($deliveryVariant['isRestrictionAccess']) ? $deliveryVariant['isRestrictionAccess'] : 'false',
                            !empty($deliveryVariant['restrictionAccessMessage']) ? "'" . addslashes($deliveryVariant['restrictionAccessMessage']) . "'" : 'NULL',
                            !empty($deliveryVariant['utcOffsetStr']) ? "'" . addslashes($deliveryVariant['utcOffsetStr']) . "'" : 'NULL',
                            !empty($deliveryVariant['isPartialPrepaymentForbidden']) ? $deliveryVariant['isPartialPrepaymentForbidden'] : 'false',
                            !empty($deliveryVariant['isGeozoneAvailable']) ? $deliveryVariant['isGeozoneAvailable'] : 'false',
                            !empty($deliveryVariant['postalCode']) ? "'" . addslashes($deliveryVariant['postalCode']) . "'" : 'NULL',
                            "'" . date('Y-m-d H:i:s') . "'"
                        ]);
                    }

                    update_option('ozon_token', $response->getNextPageToken());

                    global $wpdb;

                    $wpdb->query("REPLACE INTO `{$wpdb->base_prefix}ozon_delivery_variants` VALUES (" . implode('),(', $values) . ')');
                } else {
                    delete_option('ozon_token');
                    update_option('ozon_update_date', date('Y-m-d'));
                }
            }
        }
    }

    /**
     * Событие, которое отрабатывает каждый час.
     * Используется для фоновой синхронизации статусов заказов.
     */
    public function actionHourlyEvent() {
        require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

        $shipping_method = new \Ozon_Shipping_Method();
        $app = new OzonApplication(
            $shipping_method->get_option('client_id'),
            $shipping_method->get_option('client_secret'),
            false,
            600);
        $app->setCache(false);

        $begin_date = (new \DateTime())->modify('-2 weeks');
        $final_date = new \DateTime();

        $orders = wc_get_orders([
            'limit' => -1,
            'type'=> 'shop_order',
            'date_created' => $begin_date->format('Y-m-d').'...'.$final_date->format('Y-m-d'),
            'order' => 'date_created DESC'
        ]);

        foreach($orders as $order) {
            if($order_meta = $order->get_meta('_ozon_order_data')) {
                if(!empty($order_meta['packages'])) {
                    foreach($order_meta['packages'] as $key => $package) {
                        $response = $app->trackingByPostingNumber($package['postingId']);

                        if ($response->isSuccess()) {
                            $statuses = $response->getResponse()->getItems()->getFields();
                            $latest_status = array_pop($statuses);

                            if($change_status = $shipping_method->get_option('ozon_status_'.$latest_status['eventId'])) {
                                $order->update_status($change_status);
                                $order->save();
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Модифицкаиця формы оформления заказа. Добавление CSS-классов для полей формы.
     */
    public function filterWoocommerceCheckoutFields($fields) {
        !isset($fields['billing']['billing_city']['class']) ?: $fields['billing']['billing_city']['class'][] = 'update-on-change';
        !isset($fields['shipping']['shipping_city']['class']) ?: $fields['shipping']['shipping_city']['class'][] = 'update-on-change';
        !isset($fields['billing']['billing_state']['class']) ?: $fields['billing']['billing_state']['class'][] = 'update-on-change';
        !isset($fields['shipping']['shipping_state']['class']) ?: $fields['shipping']['shipping_state']['class'][] = 'update-on-change';
        !isset($fields['billing']['billing_postcode']['class']) ?: $fields['billing']['billing_postcode']['class'][] = 'update-on-change';
        !isset($fields['shipping']['shipping_postcode']['class']) ?: $fields['shipping']['shipping_postcode']['class'][] = 'update-on-change';

        return $fields;
    }

    /**
     * Добавление дополнительного HTML, который содержит карту пунктов ОЗОН для бекенда.
     * Используется при редактировании заказа.
    */
    public function actionAdminFooter() {?>
        <div class="od-popup" id="od-pickup-map-popup" data-map="pickup-map">
            <button type="button" class="od-popup-close" title="<?php _e('Close', OZON_PLUGIN_DOMAIN)?>">&times;</button>
            <div class="od-popup-header"><?php _e('Choose pickup point', OZON_PLUGIN_DOMAIN)?></div>
            <div class="od-popup-content">
                <div class="yandex-map" id="pickup-map"></div>
            </div>
        </div>
        <div class="od-popup" id="od-postamat-map-popup" data-map="postamat-map">
            <button type="button" class="od-popup-close" title="<?php _e('Close', OZON_PLUGIN_DOMAIN)?>">&times;</button>
            <div class="od-popup-header"><?php _e('Choose postamat', OZON_PLUGIN_DOMAIN)?></div>
            <div class="od-popup-content">
                <div class="yandex-map" id="postamat-map"></div>
            </div>
        </div>
<?php
    }

    /**
     * Добавление дополнительного HTML, который содержит карту пунктов ОЗОН для фронтенда.
     * Используется на странице оформления заказа.
     */
    public function actionWPFooter() {
        if(!is_checkout()) return;?>
            <div class="od-popup" id="od-pickup-map-popup" data-map="pickup-map">
                <button type="button" class="od-popup-close" title="<?php _e('Close', OZON_PLUGIN_DOMAIN)?>">&times;</button>
                <div class="od-popup-header"><?php _e('Choose pickup point', OZON_PLUGIN_DOMAIN)?></div>
                <div class="od-popup-content">
                    <div class="yandex-map" id="pickup-map"></div>
                </div>
            </div>
            <div class="od-popup" id="od-postamat-map-popup" data-map="postamat-map">
                <button type="button" class="od-popup-close" title="<?php _e('Close', OZON_PLUGIN_DOMAIN)?>">&times;</button>
                <div class="od-popup-header"><?php _e('Choose postamat', OZON_PLUGIN_DOMAIN)?></div>
                <div class="od-popup-content">
                    <div class="yandex-map" id="postamat-map"></div>
                </div>
            </div>
            <script type="text/javascript">
                jQuery(document).on('change', '.update-on-change', function() {
                    jQuery('#pickup-data').remove();
                    jQuery('#postamat-data').remove();
                    jQuery(document.body).trigger('update_checkout');
                });
            </script>
        <?php
    }

    /**
     * Инициализация класса собственного метода доставки
    */
    public function actionCourierShippingInit() {
        require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');
    }

    /**
     * Сбор пунктов доставки для дальнейшего размещения их на карту при оформлении заказа.
     *
     * @param string $label
     * @param \WC_Shipping_Rate $method
     * @return string
     */
    public function actionCartShippingMethodFullLabel(string $label, \WC_Shipping_Rate $method): string {
        if(function_exists('is_checkout') && is_checkout()) {
            if ($method->id === 'ozon_shipping_method:pickup') {
                $script = '<script>window.pickupPoints = [];';

                foreach($method->get_meta_data() as $meta_data) {
                    $script .= 'pickupPoints.push({
                      id: '.$meta_data->id.',
                      name: \''.$meta_data->name.'\',
                      address: \''.$meta_data->address.'\',
                      latitude: \''.$meta_data->latitude.'\',
                      longitude: \''.$meta_data->longitude.'\'
                    });';
                }

                $script .= '</script>';

//                $label = $label . '<span class="od-map-btn-wrapper"><button type="button" class="button alt button-map" data-od_popup="od-pickup-map-popup">' .
//                    __('Select on map', OZON_PLUGIN_DOMAIN) .
//                    '</button></span>'.$script;
				$label .= $script;

            } elseif ($method->id === 'ozon_shipping_method:postamat') {
                $script = '<script>window.postamatPoints = [];';

                foreach($method->get_meta_data() as $meta_data) {
                    $script .= 'postamatPoints.push({
                      id: '.$meta_data->id.',
                      name: \''.$meta_data->name.'\',
                      address: \''.$meta_data->address.'\',
                      latitude: \''.$meta_data->latitude.'\',
                      longitude: \''.$meta_data->longitude.'\'
                    });';
                }

                $script .= '</script>';

//                $label = $label . '<span class="od-map-btn-wrapper"><button type="button" class="button alt button-map" data-od_popup="od-postamat-map-popup">' .
//                    __('Select on map', OZON_PLUGIN_DOMAIN) .
//                    '</button></span>'.$script;

	            $label .= $script;
            }
        }

        return $label;
    }

    /**
     * Подключение дополнительных скриптов и стилей на стороне бекенда
    */
    public function actionAdminEnqueueScripts() {
        require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

        $shipping_method = new \Ozon_Shipping_Method();

        if($shipping_method->has_settings() && $shipping_method->get_option('yandex_maps_key'))
            wp_enqueue_script('yandex-maps-admin', '//api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey='.$shipping_method->get_option('yandex_maps_key'), array(), OZON_PLUGIN_VERSION, true);

        wp_enqueue_script(OZON_PLUGIN_DOMAIN.'-scripts', OZON_PLUGIN_URI.'assets/js/admin-scripts.js?v1', array('jquery', 'yandex-maps-admin'), OZON_PLUGIN_VERSION, true);
        wp_enqueue_style(OZON_PLUGIN_DOMAIN.'-admin-styles', OZON_PLUGIN_URI.'assets/css/admin-styles.css', array(), OZON_PLUGIN_VERSION);
    }

    /**
     * Подключение дополнительных скриптов и стилей на стороне фронтенда
     */
    public function actionWpEnqueueScripts() {
        if (is_checkout()) {
            require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

            $shipping_method = new \Ozon_Shipping_Method();

            if($shipping_method->has_settings() && $shipping_method->get_option('yandex_maps_key'))
                wp_enqueue_script('yandex-maps', '//api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey='.$shipping_method->get_option('yandex_maps_key'), array(), OZON_PLUGIN_VERSION, true);

            wp_enqueue_script(OZON_PLUGIN_DOMAIN.'-scripts', OZON_PLUGIN_URI.'assets/js/scripts.js?v4', array('jquery', 'yandex-maps'), OZON_PLUGIN_VERSION, true);
            wp_enqueue_style(OZON_PLUGIN_DOMAIN.'-styles', OZON_PLUGIN_URI.'assets/css/styles.css', array(), OZON_PLUGIN_VERSION);
        }
    }

    /**
     * Дополнительнын правила валидации формы при оформлении заказа
    */
    public function actionWoocommerceAfterCheckoutValidation($fields, $errors) {
        require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

        $shipping_method = new \Ozon_Shipping_Method();
        if ($shipping_method->get_option('shipping_pvz_required') != 'yes') {
            return ;
        }

        if(in_array('ozon_shipping_method:pickup', $fields['shipping_method']) ||
           in_array('ozon_shipping_method:postamat', $fields['shipping_method'])) {
            if(empty($_POST['point']) || empty($_POST['point']['type']) || empty($_POST['point']['id']))
                $errors->add('validation', __('Please, choose point on map', OZON_PLUGIN_DOMAIN));
        }
    }

    /**
     * Сохранение дополнительных метаданных о пункте доставки после оформления заказа
    */
    public function actionWoocommerceCheckoutCreateOrder($order, $data) {
        if(!empty($_POST['point'])) {
            $json_point = json_encode($_POST['point']);
            $order->update_meta_data('_point_data', $json_point);
        }
    }

    /**
     * Добавление мета-блока доставки ОЗОН в бекенде при редактировании заказа.
    */
    public function actionAddMetaBoxes() {
        require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

        $shipping_method = new \Ozon_Shipping_Method();

        if ($shipping_method->get_option('show_always_button') != 'always') {
            $order = wc_get_order();
            $shipping_methods = [];

            if ($order) {
                foreach($order->get_shipping_methods() as $shipping_method) {
                    $shipping_methods[] = $shipping_method->get_method_id();
                }
            }

            if (!in_array('ozon_shipping_method', $shipping_methods)) {
                return ;
            }
        }

        add_meta_box(OZON_PLUGIN_DOMAIN.'-panel', __('Ozon Delivery', OZON_PLUGIN_DOMAIN), [$this, 'callbackMetaBoxes'], 'shop_order', 'side', 'high');
    }

    /**
     * Содержание мета-блока доставки ОЗОН в бекенде.
     * Здесь формируется информация о заказа с возможностью:
     * - изменить вариант доставки
     * - отправить заказ в ОЗОН
     * - распечатать этикетку
     * - создать документы
     * - распечатать документы
     */
    public function callbackMetaBoxes() {
        require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

        $shipping_method = new \Ozon_Shipping_Method();
        
        $app = new OzonApplication(
            $shipping_method->get_option('client_id'),
            $shipping_method->get_option('client_secret'),
            false,
            600);
        $app->setCache(false);
        
        $order = wc_get_order();

        $data = [
            'id'         => $order->get_id(),
            'first_name' => $order->get_shipping_first_name() ? : $order->get_billing_first_name(),
            'last_name'  => $order->get_shipping_last_name() ? : $order->get_billing_last_name(),
            'phone'      => $order->get_billing_phone(),
            'email'      => $order->get_billing_email(),
            'company'    => $order->get_shipping_company() ? : $order->get_billing_company(),
            'shipping'   => [
                'from_places' => []
            ],
            'package' => [
                'weight' => 0,
                'length' => 0,
                'width'  => 0,
                'height' => 0
            ],
            'ozon'          => [],
            'paid_amount'   => 0,
            'full_paid'     => in_array($order->get_payment_method(), (array) $shipping_method->get_option('online_payments')),
            'allow_uncovering' => $allow_uncovering = $shipping_method->get_option('default_allow_uncovering') == 'yes',
            'chst'          => $shipping_method->get_option('default_chst') == 'yes' || $allow_uncovering,
            'basket'        => []
        ];

        if($order_meta = $order->get_meta('_ozon_order_data')) {
            $data['ozon'] = $order_meta;
            $data['ozon']['history'] = [];

            if(!empty($data['ozon']['packages'])) {
                foreach($data['ozon']['packages'] as $key => $package) {
                    $upload = wp_get_upload_dir();

                    if(!empty($package['postingId'])) {
                        $response = $app->trackingByBarcode($package['postingId']);

                        if ($response->isSuccess())
                            $data['ozon']['packages'][$key]['history'] = $response->getResponse()->getItems()->getFields();

                        if ($sticker = $order->get_meta('_sticker_' . $package['postingId'])) {
                            $data['ozon']['packages'][$key]['sticker'] = $sticker;
                        } else {
                            $response = $app->getBarcodePdf($package['postingId']);

                            if ($response->isSuccess()) {
                                $barcode = base64_decode($response->getBarcode());
                                $name = 'sticker-' . $package['postingId'] . '.pdf';

                                if (!file_exists($upload['basedir']))
                                    mkdir($upload['basedir']);

                                if (!file_exists($upload['basedir'] . '/ozon'))
                                    mkdir($upload['basedir'] . '/ozon');

                                if (file_put_contents($upload['basedir'] . '/ozon' . $name, $barcode)) {
                                    $order->update_meta_data('_sticker_' . $package['postingId'], $upload['baseurl'] . '/ozon' . $name);
                                    $order->save();
                                    $data['ozon']['packages'][$key]['sticker'] = $upload['baseurl'] . '/ozon' . $name;
                                }
                            }
                        }
                    }

                    if(!empty($package['document']) && !empty($package['document']['id'])) {
                        if ($document = $order->get_meta('_document_'.$package['document']['id'])) {
                            $data['ozon']['packages'][$key]['document']['url'] = $document;
                        } else {
                            $response = $app->getDocument($package['document']['id'], 'Act', 'pdf');

                            if ($response->isSuccess()) {
                                $bytes = base64_decode($response->getResponse()->getDocumentBytes());
                                $name = 'document-'.$package['document']['id'].'.pdf';

                                if (!file_exists($upload['basedir']))
                                    mkdir($upload['basedir']);

                                if (!file_exists($upload['basedir'] . '/ozon'))
                                    mkdir($upload['basedir'] . '/ozon');

                                if (file_put_contents($upload['basedir'] . '/ozon' . $name, $bytes)) {
                                    $order->update_meta_data('_document_' . $package['document']['id'], $upload['baseurl'] . '/ozon' . $name);
                                    $order->save();
                                    $data['ozon']['packages'][$key]['document']['url'] = $upload['baseurl'] . '/ozon' . $name;
                                }
                            }
                        }
                    }
                }
            }
        }

        $max_length = $max_width = $max_height = 0;
        $quantity = 0;

        foreach($order->get_items() as $item) {
            /**
             * @var \WC_Order_Item_Product $item
             */
            $dimensions = $this->_getItemDimensions($item, $shipping_method);
            $data['package']['weight'] += $dimensions['weight'];
            $quantity += $item->get_quantity();

            if($max_length < $dimensions['length'])
                $max_length = $dimensions['length'];
            if($max_width < $dimensions['width'])
                $max_width = $dimensions['width'];
            if($max_height < $dimensions['height'])
                $max_height = $dimensions['height'];

            $data['basket'][$item->get_product_id()] = [
                'id'        => $item->get_product_id(),
                'title'     => $item->get_product()->get_name(),
                'artnumber' => $item->get_product()->get_sku(),
                'cost'      => $shipping_method->settings['disable_insurance'] == 'yes' ? 0 : $item->get_product()->get_price(),
                'price'     => $item->get_product()->get_price(),
                'quantity'  => $item->get_quantity(),
            ];
        }

        $min_side = min($max_length, $max_width, $max_height);

        if($min_side == $max_length) {
            $data['package']['length'] = $max_length * $quantity;
            $data['package']['width'] = $max_width;
            $data['package']['height'] = $max_height;
        } elseif($min_side == $max_width) {
            $data['package']['length'] = $max_length;
            $data['package']['width'] = $max_width * $quantity;
            $data['package']['height'] = $max_height;
        } elseif($min_side == $max_height) {
            $data['package']['length'] = $max_length;
            $data['package']['width'] = $max_width;
            $data['package']['height'] = $max_height * $quantity;
        }

        if($point_data = $this->_getDeliveryPoint($order)) {
            $data['shipping']['point'] = $point_data;
            $data['shipping']['point']['json'] = json_encode($point_data);
        }

        foreach($order->get_items('shipping') as $shipping_item) {
            /**
             * @var \WC_Order_Item_Shipping $shipping_item
             */

            if($shipping_item->get_method_id() == \Ozon_Shipping_Method::SHIPPING_METHOD_ID) {
                $data['shipping']['title'] = $shipping_item->get_method_title();

                if(!empty($data['shipping']['point']) && !empty($data['shipping']['point']['type'])) {
                    global $wpdb;

                    if($point = $wpdb->get_row(
                        "SELECT * FROM `{$wpdb->base_prefix}ozon_delivery_variants` WHERE id = ".(int)$data['shipping']['point']['id']
                    ))
                        $data['shipping']['point']['data'] = $point;
                } else
                    $data['shipping']['address'] = $this->_getCourierAddressLine($order);
            }
        }

        $package = [
            'destination' => [
                'country' => $order->get_shipping_country() ? : $order->get_billing_country(),
                'city' => $order->get_shipping_city() ? : $order->get_billing_city()
            ],
            'contents' => []
        ];

        foreach($order->get_items() as $item) {
            /**
             * @var \WC_Order_Item_Product $item
            */

            $package['contents'][] = [
                'data' => $item->get_product(),
                'quantity' => $item->get_quantity()
            ];
        }

        $data['shipping']['rates'] = $shipping_method->get_rates_for_package($package);

        $fromPlacesResponse = $app->deliveryFromPlaces();

        if($fromPlacesResponse->isSuccess())
            $data['shipping']['from_places'] = $fromPlacesResponse->getResponse()->getPlaces()->getFields();

        require_once OZON_PLUGIN_DIR.'/admin/meta-box.php';
    }

    /**
     * Обработчик AJAX-запроса на изменение метода доставки
     */
    public function actionWpAjaxOdUpdateShipping() {
        require_once(OZON_PLUGIN_DIR.'classes/shipping.class.php');

        if(isset($_POST['order_id']) && isset($_POST['method']) && isset($_POST['title']) && isset($_POST['cost'])) {
            if($order = wc_get_order(wc_sanitize_order_id($_POST['order_id']))) {
                $order->delete_meta_data('_point_data');

                if($_POST['method'] != \Ozon_Shipping_Method::SHIPPING_METHOD_ID.':courier') {
                    if(empty($_POST['point'])) {
                        wp_send_json([
                            'type' => 'error',
                            'message' => 'Необходимо выбрать точку на карте.'
                        ]);
                        wp_die();
                    } else {
                        $json_point = json_encode($_POST['point']);
                        $order->update_meta_data('_point_data', $json_point);
                    }
                }

                foreach ($order->get_items('shipping') as $shipping_item) {
                    /**
                     * @var \WC_Order_Item_Shipping $shipping_item
                     */
                    $order->remove_item($shipping_item->get_id());
                }

                $rate = new \WC_Shipping_Rate();
                $rate->set_id(sanitize_text_field($_POST['method']));
                $rate->set_cost((int)sanitize_text_field($_POST['cost']));
                $rate->set_label(sanitize_text_field($_POST['title']));

                $new_shipping_item = new \WC_Order_Item_Shipping;
                $new_shipping_item->set_shipping_rate($rate);
                $new_shipping_item->set_method_id(\Ozon_Shipping_Method::SHIPPING_METHOD_ID);

                if(!empty($_POST['variant']) && ($_POST['method'] == \Ozon_Shipping_Method::SHIPPING_METHOD_ID.':courier'))
                    $new_shipping_item->add_meta_data('delivery_variant_id', sanitize_text_field($_POST['variant']));

                $order->add_item($new_shipping_item);
                $order->calculate_totals();

                wp_send_json([
                    'type' => 'success',
                    'message' => __('Данные успешно сохранены.', OZON_PLUGIN_DOMAIN)
                ]);
                wp_die();
            }
        }

        wp_send_json([
            'type' => 'error',
            'message' => __('Возникла ошибка. Попробуйте, пожалуйста, позже.', OZON_PLUGIN_DOMAIN)
        ]);
        wp_die();
    }

    /**
     * Обработчик AJAX-запроса на отправку заказа
     */
    public function actionWpAjaxOdSendOrder() {
        if(!empty($_POST['ozon_order']) && !empty($_POST['ozon_order']['order_id'])) {
            $form = $_POST['ozon_order'];

            if($wc_order = wc_get_order(wc_sanitize_order_id($_POST['ozon_order']['order_id']))) {
                require_once(OZON_PLUGIN_DIR . 'classes/shipping.class.php');

                $shipping_method = new \Ozon_Shipping_Method();

                if ($shipping_method->has_settings() && $shipping_method->get_option('client_id') &&
                    $shipping_method->get_option('client_secret')) {

                    if($this->_validateSendForm($form)) {
                        $app = new OzonApplication(
                            $shipping_method->get_option('client_id'),
                            $shipping_method->get_option('client_secret'),
                            false,
                            600);

                        $point_data = $this->_getDeliveryPoint($wc_order);
                        $itemCollection = $this->_getOrderItemCollection($wc_order, $shipping_method, $form);
                        $buyerCollection = $this->_getOrderBuyerCollection($form);
                        $receiverCollection = $this->_getOrderReceiverCollection($form);
                        $goods = $this->_getOrderGoods($form);
                        $payment = $this->_getOrderPayment($wc_order, $form, $shipping_method);
                        $addressTo = $this->_getOrderAddressTo($wc_order, $point_data, $form);
                        $addressFrom = $this->_getOrderAddressFrom($wc_order, $form);
                        $order = new Order();

                        $order->setBuyers($buyerCollection)
                            ->setPayment($payment)
                            ->setAddressTo($addressTo)
                            ->setAddressFrom($addressFrom)
                            ->setGoods($goods)
                            ->setItems($itemCollection)
                            ->setNumber($shipping_method->get_option('order_prefix').$wc_order->get_order_number())
                            ->setReceivers($receiverCollection)
                            ->setField('DeliveryVariantId', $this->_getDeliveryVariantId($wc_order, $point_data))
                            ->setField('Comment', '')
                            ->setField('allowUncovering', $form['allow_uncovering'] || $form['chst']) 
                            ->setField('allowPartialDelivery', $form['allow_uncovering'] || $form['chst'])
							->setField('Source', 'wordpress')
                        ;

                        // fix
						$oldSerializePrecision = ini_get('serialize_precision');
						ini_set('serialize_precision', -1);

                        $response = $app->sendOrder($order);

                        ini_set('serialize_precision', $oldSerializePrecision);

                        if($response->isSuccess()) {
                            $wc_order->update_meta_data('_ozon_order_data', [
                                'id' => $response->getResponse()->getId(),
                                'number' => $response->getResponse()->getOrderNumber(),
                                'logistic_number' => $response->getResponse()->getLogisticOrderNumber(),
                                'packages' => $response->getResponse()->getPackages()->getFields()
                            ]);
                            $wc_order->save();

                            wp_send_json([
                                'type' => 'success',
                                'message' => sprintf('Заказ успешно создан с номером №%s.', $response->getResponse()->getOrderNumber())
                            ]);
                            wp_die();
                        } else {
                            $errors = [];

                            foreach ($response->getResponse()->getArguments() as $argument)
                                foreach($argument as $error)
                                    $errors[] = $error;

                            wp_send_json([
                                'type' => 'error',
                                'message' => !empty($errors) ? implode("\r\n", $errors):
                                    __('Возникла ошибка при отправке заказа. Попробуйте повторить запрос.', OZON_PLUGIN_DOMAIN)
                            ]);
                            wp_die();
                        }
                    }
                } else {
                    wp_send_json([
                        'type' => 'error',
                        'message' => __('Приложение не настроено. Пожалуйста, проверьте настройки.', OZON_PLUGIN_DOMAIN)
                    ]);
                    wp_die();
                }
            }
        }

        wp_send_json([
            'type' => 'error',
            'message' => __('Возникла ошибка. Попробуйте, пожалуйста, позже.', OZON_PLUGIN_DOMAIN)
        ]);
        wp_die();
    }

    /**
     * Обработчик AJAX-запроса на создание документа
     */
    public function actionWpAjaxOdCreateDocument() {
        if(!empty($_POST['order_id']) && !empty($_POST['posting'])) {
            if($wc_order = wc_get_order(wc_sanitize_order_id($_POST['order_id']))) {
                require_once(OZON_PLUGIN_DIR . 'classes/shipping.class.php');

                $shipping_method = new \Ozon_Shipping_Method();

                if ($shipping_method->has_settings() && $shipping_method->get_option('client_id') &&
                    $shipping_method->get_option('client_secret')) {
                    $app = new OzonApplication(
                        $shipping_method->get_option('client_id'),
                        $shipping_method->get_option('client_secret'),
                        false,
                        600);

                    if(($order_meta = $wc_order->get_meta('_ozon_order_data')) && !empty($order_meta['packages'])) {
                        foreach($order_meta['packages'] as $key => $package) {
                            if($package['postingId'] == $_POST['posting']) {
                                $response = $app->createDocument([$package['postingId']]);

                                if($response->isSuccess()) {
                                    $fields = $response->getResponse()->getFields();
                                    $order_meta['packages'][$key]['document'] = [
                                        'id' => $fields['documentId'],
                                        'name' => $fields['documentName']
                                    ];
                                    $wc_order->update_meta_data('_ozon_order_data', $order_meta);
                                    $wc_order->save();

                                    wp_send_json([
                                        'type' => 'success',
                                        'message' => sprintf('Документ успешно создан с номером %s.', $fields['documentName'])
                                    ]);
                                    wp_die();
                                } else {
                                    $fields = $response->getResponse()->getFields();

                                    wp_send_json([
                                        'type' => 'error',
                                        'message' => $fields['message'] ??
                                            __('Возникла ошибка при создании документа. Попробуйте повторить запрос.', OZON_PLUGIN_DOMAIN)
                                    ]);
                                    wp_die();
                                }
                            }
                        }
                    }
                }
            }
        }

        wp_send_json([
            'type' => 'error',
            'message' => __('Возникла ошибка. Попробуйте, пожалуйста, позже.', OZON_PLUGIN_DOMAIN)
        ]);
        wp_die();
    }

    /**
     * Получение габаритов отправления
     *
     * @param \WC_Order_Item_Product $item
     * @param \Ozon_Shipping_Method $shipping_method
     * @return array
     */
    private function _getItemDimensions(\WC_Order_Item_Product $item, \Ozon_Shipping_Method $shipping_method): array {
        empty($item->get_product()->get_weight()) ?
            $itemWeight = (float) wc_get_weight($shipping_method->get_option('default_item_weight'), 'g', 'kg') :
            $itemWeight = wc_get_weight($item->get_product()->get_weight(), 'g');

        empty($item->get_product()->get_length()) ?
            $itemLength = (float) wc_get_dimension($shipping_method->get_option('default_item_length'), 'mm', 'cm') :
            $itemLength = wc_get_dimension($item->get_product()->get_length(), 'mm');

        empty($item->get_product()->get_width()) ?
            $itemWidth  = (float) wc_get_dimension($shipping_method->get_option('default_item_width'), 'mm', 'cm') :
            $itemWidth  = wc_get_dimension($item->get_product()->get_width(), 'mm');

        empty($item->get_product()->get_height()) ?
            $itemHeight = (float) wc_get_dimension($shipping_method->get_option('default_item_height'), 'mm', 'cm') :
            $itemHeight = wc_get_dimension($item->get_product()->get_height(), 'mm');


        return [
            'weight' => $itemWeight,
            'length' => $itemLength,
            'width'  => $itemWidth,
            'height' => $itemHeight
        ];
    }

    /**
     * Валидация формы отправки заказа
     *
     * @param array $form
     * @return bool
     */
    private function _validateSendForm(array $form): bool {
        $errors = [];

        if(empty($form['first_name']))
            $errors[] = __('Необходимо указать имя покупателя.', OZON_PLUGIN_DOMAIN);
        if(empty($form['last_name']))
            $errors[] = __('Необходимо указать фамилию покупателя.', OZON_PLUGIN_DOMAIN);
        if(empty($form['phone']))
            $errors[] = __('Необходимо указать телефон покупателя.', OZON_PLUGIN_DOMAIN);
        elseif (!preg_match('/(\+7[89][0-9]{9})|(\+7\([89][0-9]{2}\)[0-9]{7})|(\+7\([89][0-9]{2}\)[0-9]{3}-[0-9]{2}-[0-9]{2})/', $form['phone'])) {
            $errors[] = __('Не верный формат телефона. Формат передаваемых данных:' 
                . PHP_EOL . '+7XXXXXXXXXXX'
                . PHP_EOL . '+7(XXX)XXXXXXXX'
                . PHP_EOL . '+7(XXX)XXX-XX-XX'
            );
        }
        if(empty($form['email']))
            $errors[] = __('Необходимо указать E-mail покупателя.', OZON_PLUGIN_DOMAIN);
        if(empty($form['type']) || !in_array($form['type'], [
                \Ozon_Shipping_Method::BUYER_TYPE_NATURAL,
                \Ozon_Shipping_Method::BUYER_TYPE_LEGAL
            ]))
            $errors[] = __('Необходимо указать тип покупателя', OZON_PLUGIN_DOMAIN);
        elseif(($form['type'] == \Ozon_Shipping_Method::BUYER_TYPE_LEGAL) && empty($form['legal_name']))
            $errors[] = __('Необходимо указать наименование юр. лица.', OZON_PLUGIN_DOMAIN);
        if(empty($form['package_weight']))
            $errors[] = __('Вес не может быть нулевым.', OZON_PLUGIN_DOMAIN);
        elseif(!is_numeric($form['package_weight']))
            $errors[] = __('Вес должен быть числом.', OZON_PLUGIN_DOMAIN);
        if(empty($form['package_length']) || empty($form['package_width']) || empty($form['package_height']))
            $errors[] = __('Необходимо задать габариты посылки.', OZON_PLUGIN_DOMAIN);
        elseif(!is_numeric($form['package_length']) || !is_numeric($form['package_width']) || !is_numeric($form['package_height']))
            $errors[] = __('Габариты необходимо указать числовым значением.', OZON_PLUGIN_DOMAIN);

        if(!empty($form['paid_amount']) && !is_numeric($form['paid_amount']))
            $errors[] = __('Сумму оплаты необходимо указать числовым значением.', OZON_PLUGIN_DOMAIN);

        if(!empty($errors)) {
            wp_send_json([
                'type' => 'error',
                'message' => implode("\r\n", $errors)
            ]);
            wp_die();
        }

        return true;
    }

    /**
     * Получение списка товаров при отправке заказа
     *
     * @param \WC_Order $wc_order
     * @param \Ozon_Shipping_Method $shipping_method
     * @return ItemCollection
     */
    private function _getOrderItemCollection(\WC_Order $wc_order, \Ozon_Shipping_Method $shipping_method, $form = []): ItemCollection {
        $itemCollection = new ItemCollection();

        $basket = $form['basket'];

        foreach ($wc_order->get_items() as $wc_item) {
            /**
             * @var \WC_Order_Item_Product $wc_item
             */
            $dimensions = $this->_getItemDimensions($wc_item, $shipping_method);
            
            $data = array_merge([
                'id'        => $itemId = $wc_item->get_product_id(),
                'title'     => $wc_item->get_product()->get_name(),
                'artnumber' => $wc_item->get_product()->get_sku(),
                'cost'      => $wc_item->get_product()->get_price(),
                'price'     => $wc_item->get_product()->get_price(),
                'quantity'  => $wc_item->get_quantity(),
            ], $basket[$itemId] ?? []);

            $item = new Item();
            $item->setId($data['id'])
                ->setArticul($data['artnumber'])
                ->setName($data['title'])
                ->setCost(new Money($data['cost']))
                ->setPrice(new Money($data['price']))
                ->setQuantity($data['quantity'])

                ->setWeight($dimensions['weight'])
                ->setLength($dimensions['length'])
                ->setWidth($dimensions['width'])
                ->setHeight($dimensions['height'])
                // ->setPrice(new Money($wc_item->get_subtotal()))
                ->setField('IsDangerous', false)
            ;

            $itemCollection->add($item);
        }

        return $itemCollection;
    }

    /**
     * Получение списка покупателей при отправке заказа
     *
     * @param array $form
     * @return BuyerCollection
     */
    private function _getOrderBuyerCollection(array $form): BuyerCollection {
        $buyerCollection = new BuyerCollection();
        $buyer = new Buyer();
        $buyer->setFirstName($form['first_name'])
            ->setSecondName($form['last_name'])
            ->setPhone($form['phone'])
            ->setEmail($form['email'])
            ->setField('PersonType', $form['type']);

        if($form['type'] == \Ozon_Shipping_Method::BUYER_TYPE_LEGAL)
            $buyer->setField('Company', $form['legal_name']);
        ;
        $buyerCollection->add($buyer);

        return $buyerCollection;
    }

    /**
     * Получение списка получателей при отправке заказа
     *
     * @param array $form
     * @return ReceiverCollection
     */
    private function _getOrderReceiverCollection(array $form): ReceiverCollection {
        $receiverCollection = new ReceiverCollection();
        $receiver = new Receiver();
        $receiver->setFirstName($form['first_name'])
            ->setSecondName($form['last_name'])
            ->setPhone($form['phone'])
            ->setEmail($form['email'])
            ->setField('PersonType', sanitize_text_field($form['type']));

        if($form['type'] == \Ozon_Shipping_Method::BUYER_TYPE_LEGAL)
            $receiver->setField('Company', $form['legal_name']);

        $receiverCollection->add($receiver);

        return $receiverCollection;
    }

    /**
     * Получение информации по посылке при отправке заказа
     *
     * @param array $form
     * @return Goods
     */
    private function _getOrderGoods(array $form): Goods {
        $goods = new Goods();
        $goods
            ->setWeight(wc_get_weight($form['package_weight']   , 'g',  'kg'))
            ->setLength(wc_get_dimension($form['package_length'], 'mm', 'cm'))
            ->setWidth (wc_get_dimension($form['package_width'] , 'mm', 'cm'))
            ->setHeight(wc_get_dimension($form['package_height'], 'mm', 'cm'))
        ;

        return $goods;
    }

    /**
     * Получение информации об оплате при отправке заказа
     *
     * @param \WC_Order $wc_order
     * @param array $form
     * @param \Ozon_Shipping_Method $shipping_method
     * @return Payment
     */
    private function _getOrderPayment(\WC_Order $wc_order, array $form, \Ozon_Shipping_Method $shipping_method): Payment {
        $payment = new Payment();

        $goodsPrice = round($wc_order->get_subtotal(), 2);
        $shippingPrice = round($wc_order->get_shipping_total(), 2);
        $totalPrice = round($wc_order->get_total(), 2);

        if($form['full_paid']) {
            $payment->setGoods(new Money($goodsPrice))
                ->setDelivery(new Money($shippingPrice))
                ->setNdsDelivery(0)
                ->setPayed(new Money($totalPrice))
                ->setIsBeznal(true);
        } else
            $payment->setGoods(new Money($goodsPrice))
                    ->setDelivery(new Money($shippingPrice))
                    ->setNdsDelivery($shipping_method->get_option('shipping_nds'))
                    ->setPayed(new Money(0))
                    ->setIsBeznal(false);

        return $payment;
    }

    /**
     * Получение информации об адресе получателя при отправке заказа
     *
     * @param \WC_Order $wc_order
     * @param array | boolean $point_data
     * @param array $form
     * @return Address
     */
    private function _getOrderAddressTo(\WC_Order $wc_order, $point_data, array $form): Address {
        global $wpdb;

        $addressTo = new Address();
        $address_line = false;

        if(!empty($point_data) && !empty($point_data['id']) && ($point = $wpdb->get_row(
            "SELECT * FROM `{$wpdb->base_prefix}ozon_delivery_variants` WHERE id = ".(int)$point_data['id']
        )))
            $address_line = $point->address;

        if(empty($address_line))
            $address_line = $this->_getCourierAddressLine($wc_order);

        $addressTo->setLine($address_line);

        return $addressTo;
    }

    /**
     * Получение информации об адресе отправителя при отправке заказа
     *
     * @param \WC_Order $wc_order
     * @param array $form
     * @return Address
     */
    private function _getOrderAddressFrom(\WC_Order $wc_order, array $form): Address {
        $addressFrom = new Address();

        if(!empty($form['from_place']))
            $addressFrom->setCode($form['from_place']);

        return $addressFrom;
    }

    /**
     * Получение информации о пункте доставки
     *
     * @param \WC_Order $order
     *
     * @return array | boolean $point_data
     */
    private function _getDeliveryPoint(\WC_Order $order) {
        foreach($order->get_meta_data() as $meta_data_row) {
            /**
             * @var \WC_Meta_Data $meta_data
             */
            $meta_data = $meta_data_row->get_data();

            if($meta_data['key'] == '_point_data')
                return @json_decode($meta_data['value'], true);
        }

        return false;
    }

    /**
     * Генерация адресной строки
     *
     * @param \WC_Order $order
     * @return string
     */
    private function _getCourierAddressLine(\WC_Order $order): string {
        $address_parts = [];
        $countries = WC()->countries->get_countries();

        if(!empty($order->get_shipping_country()) && !empty($countries[$order->get_shipping_country()]))
            $address_parts[] = $countries[$order->get_shipping_country()];
        elseif(!empty($order->get_billing_country()) && !empty($countries[$order->get_billing_country()]))
            $address_parts[] = $countries[$order->get_shipping_country()];

        if(!empty($order->get_shipping_state()))
            $address_parts[] = $order->get_shipping_state();
        elseif(!empty($order->get_billing_state()))
            $address_parts[] = $order->get_billing_state();

        if(!empty($order->get_shipping_city()))
            $address_parts[] = $order->get_shipping_city();
        elseif(!empty($order->get_billing_city()))
            $address_parts[] = $order->get_billing_city();

        if(!empty($order->get_shipping_address_1()))
            $address_parts[] = $order->get_shipping_address_1();
        elseif(!empty($order->get_billing_address_1()))
            $address_parts[] = $order->get_billing_address_1();

        if(!empty($order->get_shipping_address_2()))
            $address_parts[] = $order->get_shipping_address_2();
        elseif(!empty($order->get_billing_address_2()))
            $address_parts[] = $order->get_billing_address_2();

        return implode(', ', $address_parts);
    }

    /**
     * Получение ID варианта доставки
     *
     * @param \WC_Order $wc_order
     * @param array | boolean $point_data
     * @return string
     */
    private function _getDeliveryVariantId(\WC_Order $wc_order, $point_data): string {
        if(!empty($point_data) && !empty($point_data['id']))
            return $point_data['id'];

        $delivery_variant_id = false;

        foreach($wc_order->get_items('shipping') as $shipping_item) {
            /**
             * @var \WC_Order_Item_Shipping $shipping_item
             */

            if($shipping_item->get_method_id() == \Ozon_Shipping_Method::SHIPPING_METHOD_ID) {
                foreach($shipping_item->get_meta_data() as $meta_data_row) {
                    /**
                     * @var \WC_Meta_Data $meta_data_row
                    */
                    $meta_data = $meta_data_row->get_data();

                    if($meta_data['key'] == 'delivery_variant_id')
                        $delivery_variant_id = $meta_data['value'];
                }
            }
        }

        return $delivery_variant_id;
    }
}