<?php
function car_booking_delete_tables() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'car_bookings';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}