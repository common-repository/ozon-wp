<?php
/*
Plugin Name: ozon-wp
Plugin URI:
Description: Ozon — ведущий игрок на рынке и одна из самых дорогих российских интернет-компаний по версии Forbes. Мы предоставляем клиентам самый широкий выбор товаров и доставляем их до двери во всех 11 часовых поясах России.
Version: 1.0.22
Author URI: https://ipol.ru
Text Domain: ozon-wp
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

use WordPress\Ozon\Ozon_WP;

if(!defined('ABSPATH') || !in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))))
    exit; // Exit if accessed directly

const OZON_PLUGIN_VERSION = '1.0.23';
const OZON_CHECK_VERSION_URL = 'http://ozon-wp.ipol.tech/update/version.php';
const OZON_PLUGIN_REQUIRES = '5.0';
const OZON_PLUGIN_TESTED = '5.8';
const OZON_NAMESPACE = 'WordPress\Ozon';
const OZON_LIB_NAMESPACE = 'Ipol\Ozon';
const OZON_PLUGIN_DOMAIN = 'ozon-wp';
const OZON_PLUGIN_DIR = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . OZON_PLUGIN_DOMAIN . DIRECTORY_SEPARATOR;

define('OZON_PLUGIN_BASENAME', plugin_basename(__FILE__));
define('OZON_PLUGIN_URI', plugin_dir_url(__FILE__));

require_once(OZON_PLUGIN_DIR.'autoload.php');

$app = Ozon_WP::getInstance();
$app->run();