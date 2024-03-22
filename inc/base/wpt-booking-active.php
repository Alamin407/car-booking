<?php
// Create database table for car bookings
function create_car_bookings_table() {
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix . 'car_bookings';

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        car_id mediumint(9) NOT NULL,
        car_title varchar(255) NOT NULL,
        bookfor varchar(255) NOT NULL,
        organizer_first_name varchar(255) NOT NULL,
        organizer_last_name varchar(255) NOT NULL,
        organizer_phone varchar(20) NOT NULL,
        organizer_email varchar(255) NOT NULL,
        organizer_company varchar(255),
        client_first_name varchar(255) NOT NULL,
        client_last_name varchar(255) NOT NULL,
        client_phone varchar(20) NOT NULL,
        client_email varchar(255) NOT NULL,
        child_set varchar(255) NOT NULL,
        preferance text,
        trip varchar(255),
        pickup_from varchar(255),
        pickup_flight varchar(255),
        pickup_arrival_airport varchar(255),
        pickup_airline_name varchar(255),
        pickup_flight_number varchar(255),
        pickup_flight_arrival_date datetime,
        pick_note text,
        drop_off_from varchar(255),
        drop_off_flight varchar(255),
        drop_off_arrival_airport varchar(255),
        drop_off_airline_name varchar(255),
        drop_off_flight_number varchar(255),
        drop_off_flight_arrival_date datetime,
        drop_note text,
        return_off_from varchar(255),
        return_from varchar(255),
        return_flight varchar(255),
        return_arrival_airport varchar(255),
        return_airline_name varchar(255),
        return_flight_number varchar(255),
        return_flight_arrival_date datetime,
        booking_status varchar(255) NOT NULL DEFAULT 'processing',
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}