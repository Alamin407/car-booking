<?php
// Add custom menu item in the admin menu
add_action('admin_menu', 'register_booking_admin_page');

function register_booking_admin_page() {
    add_menu_page(
        'Car Bookings',
        'Car Bookings',
        'manage_options',
        'car-bookings',
        'display_booking_admin_page',
        'dashicons-list-view',
        9
    );
}

// Display custom admin page content
function display_booking_admin_page() {
    // Constants
    $per_page = 5; // Number of bookings per page

    if (isset($_POST['update_status'])) {
        $booking_id = intval($_POST['booking_id']);
        $status = sanitize_text_field($_POST['status']);
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'car_bookings';
        $wpdb->update(
            $table_name,
            array('booking_status' => $status),
            array('id' => $booking_id)
        );

        // If status is Success or Completed, update car post meta status to available
        $booking = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $booking_id", ARRAY_A);
        if ($status === 'Completed') {
            if ($booking) {
                update_post_meta($booking['car_id'], '_car_status', 'available');
            }
        }elseif($status === 'On Hold'){
            update_post_meta($booking['car_id'], '_car_status', 'booked');
        }elseif($status === 'On Going'){
            update_post_meta($booking['car_id'], '_car_status', 'booked');
        }elseif($status === 'Processing'){
            update_post_meta($booking['car_id'], '_car_status', 'booked');
        }

    }elseif (isset($_POST['delete_booking'])) {
        $booking_id = intval($_POST['booking_id']);

        global $wpdb;
        $table_name = $wpdb->prefix . 'car_bookings';
        $wpdb->delete(
            $table_name,
            array('id' => $booking_id)
        );
    }

    // Pagination
    $current_page = max(1, isset($_GET['paged']) ? intval($_GET['paged']) : 1);
    $offset = ($current_page - 1) * $per_page;

    global $wpdb;
    $table_name = $wpdb->prefix . 'car_bookings';
    $total_bookings = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
    ?>
    <div class="wrap">
        <h1>Car Bookings</h1>
        <table class="wp-list-table widefat striped table table-bordered wpt-admin-table">
            <thead>
                <tr>
                    <th>Car Name</th>
                    <th>Book For</th>
                    <th>Organizer Info</th>
                    <th>Client Info</th>
                    <th>Pickup Info</th>
                    <th>Drop Off Info</th>
                    <th>Retrun Info</th>
                    <th>Status</th>
                    <th>Update Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $bookings = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id DESC LIMIT $per_page OFFSET $offset", ARRAY_A);

                if ($bookings) {
                    foreach ($bookings as $booking) {
                        ?>
                            <tr>
                                <td><?php echo $booking['car_title']; ?></td>
                                <td><?php echo $booking['bookfor']; ?></td>
                                <td>
                                    <p>Name: <span><?php echo ( ! empty($booking['organizer_first_name']) ? $booking['organizer_first_name'] : '' ); ?> </span><?php echo ( ! empty($booking['organizer_last_name']) ? $booking['organizer_last_name'] : '' ); ?><span></p>
                                    <p>Phone: <?php echo ( ! empty($booking['organizer_phone']) ? $booking['organizer_phone'] : '' ); ?></p>
                                    <p>Email: <?php echo ( ! empty($booking['organizer_email']) ? $booking['organizer_email'] : '' ); ?></p>
                                    <p>Company: <?php echo ( ! empty($booking['organizer_company']) ? $booking['organizer_company'] : '' ); ?></p>
                                </td>
                                <td>
                                    <p>Name: <span><?php echo ( ! empty($booking['client_first_name']) ? $booking['client_first_name'] : '' ); ?> </span><?php echo ( ! empty($booking['client_last_name']) ? $booking['client_last_name'] : '' ); ?><span></p>
                                    <p>Phone: <?php echo ( ! empty($booking['client_phone']) ? $booking['client_phone'] : '' ); ?></p>
                                    <p>Email: <?php echo ( ! empty($booking['client_email']) ? $booking['client_email'] : '' ); ?></p>
                                    <p>Preferance: <?php echo ( ! empty($booking['preferance']) ? $booking['preferance'] : '' ); ?></p>
                                    <?php if( ! empty( $booking[ 'child_set' ] ) ) : ?>
                                        <p>Child Set: <?php echo $booking[ 'child_set' ]; ?></p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <p>Trip: <?php echo $booking['trip']; ?></p>
                                    <p>Pickup From: <?php echo $booking['pickup_from']; ?></p>
                                    <p>Flight: <?php echo $booking['pickup_flight']; ?></p>
                                    <p>Arrival Airport: <?php echo $booking['pickup_arrival_airport']; ?></p>
                                    <p>Airline Name: <?php echo $booking['pickup_airline_name']; ?></p>
                                    <p>Flight Number: <?php echo $booking['pickup_flight_number']; ?></p>
                                    <p>Arrival Date: <?php echo $booking['pickup_flight_arrival_date']; ?></p>
                                    <?php if(! empty( $booking['pick_note'] ) ) : ?>
                                        <p>Note: <?php echo $booking['pick_note']; ?></p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <p>Drop Off From: <?php echo $booking['drop_off_from']; ?></p>
                                    <p>Flight: <?php echo $booking['drop_off_flight']; ?></p>
                                    <p>Arrival Airport: <?php echo $booking['drop_off_arrival_airport']; ?></p>
                                    <p>Airline Name: <?php echo $booking['drop_off_airline_name']; ?></p>
                                    <p>Flight Number: <?php echo $booking['drop_off_flight_number']; ?></p>
                                    <p>Arrival Date: <?php echo $booking['drop_off_flight_arrival_date']; ?></p>
                                    <?php if(!empty( $booking['drop_note'] )) : ?>
                                        <p>Note: <?php echo $booking['drop_note']; ?></p>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <p>Return Trip: <?php echo $booking['return_off_from']; ?></p>
                                    <p>Return From: <?php echo ( ! empty($booking['return_from']) ? $booking['return_from'] : '' ); ?></p>
                                    <p>Flight: <?php echo ( ! empty($booking['return_flight']) ? $booking['return_flight'] : '' ); ?></p>
                                    <p>Arrival Airport: <?php echo ( ! empty($booking['return_arrival_airport']) ? $booking['return_arrival_airport'] : '' ); ?></p>
                                    <p>Airline Name: <?php echo ( ! empty($booking['return_airline_name']) ? $booking['return_airline_name'] : '' ); ?></p>
                                    <p>Flight Number: <?php echo ( ! empty($booking['return_flight_number']) ? $booking['return_flight_number'] : '' ); ?></p>
                                    <p>Arrival Date: <?php echo ( ! empty($booking['return_flight_arrival_date']) ? $booking['return_flight_arrival_date'] : '' ); ?></p>
                                </td>
                                <td><?php echo $booking['booking_status']; ?></td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <div class="form-group">
                                            <select name="status" class="form-control p-1">
                                                <option value="Processing" <?php echo selected($booking['booking_status'], 'Processing', false); ?>>Processing</option>
                                                <option value="On Hold" <?php echo selected($booking['booking_status'], 'On Hold', false); ?>>On Hold</option>
                                                <option value="On Going" <?php echo selected($booking['booking_status'], 'On Going', false); ?>>On Going</option>
                                                <option value="Completed" <?php echo selected($booking['booking_status'], 'Completed', false); ?>>Completed</option>
                                            </select>
                                        </div>
                                        <div class="form-group mt-2">
                                            <input type="submit" name="update_status" class="btn btn-primary" value="Update">
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <form method="post">
                                        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                        <input type="submit" name="delete_booking" 
                                        class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure you want to delete this booking?');">
                                    </form>
                                </td>
                            </tr>
                        <?php
                    }
                } else {
                    echo '<tr><td colspan="5">No bookings found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="wpt-admin-pagination">
            <?php
                // Pagination
                $total_pages = ceil($total_bookings / $per_page);
                $page_links = paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'prev_text' => __('&laquo; Previous'),
                    'next_text' => __('Next &raquo;'),
                    'total' => $total_pages,
                    'current' => $current_page,
                ));

                if ($page_links) {
                    ?>
                        <div class="tablenav">
                            <div class="tablenav-pages"><?php echo $page_links; ?></div>
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
    <?php
}

// Submenu for show shortcodes
function register_booking_sebmenu()
{
	add_submenu_page(
		'car-bookings',
		'Booking Shortcodes',
		'Booking Shortcodes',
		'manage_options',
		'booking-shortcodes',
		'wpt_booking_shortcodes'
	);
}
add_action('admin_menu', 'register_booking_sebmenu');

function wpt_booking_shortcodes(){
    require_once( WPT_BOOKING_PATH . 'templates/wpt-booking-shortcodes.php' );
}

