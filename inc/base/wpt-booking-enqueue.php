<?php
function booking_enqueue(){
    // Register Styles
    wp_enqueue_style( 'wpt-font-awesome', WPT_BOOKING_URL . 'assets/css/all.min.css', [], rand(), 'all' );
    wp_enqueue_style( 'wpt-inputtelcss', WPT_BOOKING_URL . 'assets/css/intlTelInput.min.css', [], rand(), 'all' );
    wp_enqueue_style( 'wpt-booking-owl-css', WPT_BOOKING_URL . 'assets/css/owl.carousel.min.css', [], rand(), 'all' );
    wp_enqueue_style( 'wpt-booking-owl-theme', WPT_BOOKING_URL . 'assets/css/owl.theme.default.min.css', [], rand(), 'all' );
    wp_enqueue_style( 'wpt-bootstrap', WPT_BOOKING_URL . 'assets/css/bootstrap.min.css', [], rand(), 'all' );
    wp_enqueue_style( 'wpt-style-main', WPT_BOOKING_URL . 'assets/css/style.css', [], rand(), 'all' );

    // Register JS
    wp_enqueue_script( 'wpt-inputjs-mainbook-js', WPT_BOOKING_URL . 'assets/js/intlTelInput-jquery.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wpt-bboking-owl-js', WPT_BOOKING_URL . 'assets/js/owl.carousel.min.js', [ 'wpt-inputjs-mainbook-js' ], false, true );
    wp_enqueue_script( 'wpt-booking-bootstrap-js', WPT_BOOKING_URL . 'assets/js/bootstrap.min.js', [ 'wpt-bboking-owl-js' ], false, true );
    wp_enqueue_script( 'wpt-app-js', WPT_BOOKING_URL . 'assets/js/app.js', [ 'wpt-booking-bootstrap-js' ], false, true );
 }
 add_action( 'wp_enqueue_scripts', 'booking_enqueue' );

 function booking_enqueue_admin(){
    // Styles
    wp_enqueue_style( 'wpt-font-awesome', WPT_BOOKING_URL . 'assets/css/all.min.css', [], rand(), 'all' );
    wp_enqueue_style( 'wpt-admin-bootstrap', WPT_BOOKING_URL . 'assets/css/bootstrap.min.css', [], rand(), 'all' );
    wp_enqueue_style( 'wpt-admin-style-main', WPT_BOOKING_URL . 'assets/css/admin-style.css', [], rand(), 'all' );

    // Scripts
    wp_enqueue_script( 'wpt-booking-admin-bootstrap-js', WPT_BOOKING_URL . 'assets/js/bootstrap.min.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'wpt-admin-app-js', WPT_BOOKING_URL . 'assets/js/wpt-admin-app.js', [ 'wpt-booking-admin-bootstrap-js' ], false, true );
 }
 add_action( 'admin_enqueue_scripts', 'booking_enqueue_admin' );