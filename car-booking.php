<?php
/*
Plugin Name: Car Booking
Description: A custom WordPress plugin for car booking.
Version: 1.0
Author: MD AL AMIN ISLAM
Author URI: https://portfolio.guidance.tips/
Plugin URI: https://portfolio.guidance.tips/
Text Domain: car-booking
Copyright (C) 2024 W-Pro Themes.
License: This plugin is distributed under the GNU General Public License, allowing you to redistribute and modify it freely. It comes without any warranty, implied or expressed. For details, refer to the GNU GPL. See http://www.gnu.org/licenses/.
*/

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );

define( 'WPT_BOOKING_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
define( 'WPT_BOOKING_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

// Register Activation hook
require_once(WPT_BOOKING_PATH . 'inc/base/wpt-booking-active.php' );
register_activation_hook(__FILE__, 'create_car_bookings_table');

// Deactivation hook
require_once(WPT_BOOKING_PATH . 'inc/base/wpt-booking-deactive.php');
register_deactivation_hook(__FILE__, 'car_booking_delete_tables');

require_once( WPT_BOOKING_PATH . 'inc/init.php' );

