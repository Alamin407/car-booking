<?php
/**
 * Booking Page
 * 
 */
// Define shortcode for booking page
add_shortcode('booking_page', 'display_booking_form');

function display_booking_form(){
    if (isset($_GET['car_id'])) {
        $car_id = intval($_GET['car_id']);
        $car_title = get_the_title($car_id);
        $car_status = get_post_meta($car_id, '_car_status', true);
        
        ob_start();
        ?>
        <div class="wpt-bookin-wrapper mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="frm-head">
                        <h3>Booking Information</h3>
                    </div>
                    <form id="msform" method="post">
                        <input type="hidden" name="car_id" value="<?php echo esc_attr($car_id); ?>">
                        <div class="info-box py-4">
                            <h4>Booking on behalf of</h4>
                            <div class="wpt-info-item d-flex">
                                <div class="info-left">
                                    <input type="radio" name="bookfor" id="myself" value="Myself" checked="checked">
                                    <label for="myself" id="book-myself">Myself</label>
                                </div>
                                <div class="info-right">
                                    <input type="radio" name="bookfor" id="client" value="client">
                                    <label for="client" id="book-client">Client/Passenger</label>
                                </div>
                            </div>
                            <span class="error">Please Select an Option</span>
                        </div>
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active" id="account">
                                <span class="num">1</span>
                                <span>Organizer Information</span>
                                <span class="icon"><i class="fa-solid fa-chevron-right"></i></span>
                            </li>
                            <li id="personal">
                                <span class="num">2</span>
                                <span>Client/Passenger</span>
                                <span class="icon"><i class="fa-solid fa-chevron-right"></i></span>
                            </li>
                            <li id="payment">
                                <span class="num">3</span>
                                <span>Pick Up</span>
                                <span class="icon"><i class="fa-solid fa-chevron-right"></i></span>
                            </li>
                            <li id="confirm">
                                <span class="num">4</span>
                                <span>Drop Off</span>
                                <span class="icon"><i class="fa-solid fa-chevron-right"></i></span>
                            </li>
                            <li id="confirm">
                                <span class="num">6</span>
                                <span>Payment</span>
                            </li>
                        </ul>
                        <fieldset>
                            <div class="form-card">
                                <div class="organize py-5">
                                    <h3 class="mb-4">Organizer Information</h3>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="fname">First Name*</label>
                                                <input type="text" name="organizer_first_name" id="fname" class="wpt-form-control wpt-or-f-name" placeholder="Enter your first name" required>
                                                <div class="wpt-or-f-name-error wpt-error">Enter your first name</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lname">Last Name*</label>
                                                <input type="text" name="organizer_last_name" id="lname" class="wpt-form-control wpt-or-l-name" placeholder="Enter your last name" required>
                                                <div class="wpt-or-l-name-error wpt-error">Enter your last name</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone Number*</label>
                                                <input type="tel" name="organizer_phone" id="or-phone" class="wpt-form-control wpt-or-phone" placeholder="(319) 555-0115" required>
                                                <div class="wpt-or-p-error wpt-error">Enter your number</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email">E-mail*</label>
                                                <input type="email" name="organizer_email" id="email" class="wpt-form-control wpt-or-email" placeholder="Enter your e-mail address" required>
                                                <div class="wpt-or-e-error wpt-error">Enter your email</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="company">Company Name</label>
                                                <input type="text" name="organizer_company" id="company" class="wpt-form-control" placeholder="Enter your company name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="left-btn">
                                    <a href="<?php echo home_url(); ?>" class="cancle wpt-btn wpt-reg-btn">Cancle</a>
                                </div>
                                <div class="right-btn">
                                    <a class="next action-button wpt-btn wpt-next-or" aria-disabled="true">Continue</a>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-card" id="wpt-client">
                                <div class="client-pessen py-5">
                                    <h3 class="mb-4">Client/Passenger</h3>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="fname">First Name*</label>
                                                <input type="text" name="client_first_name[]" id="fname" class="wpt-form-control wpt-cl-f-name" placeholder="Enter your first name" required>
                                                <div class="wpt-cl-fname-error wpt-error">Enter your first name</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="lname">Last Name*</label>
                                                <input type="text" name="client_last_name[]" id="lname" class="wpt-form-control wpt-cl-lname" placeholder="Enter your first name" required>
                                                <div class="wpt-cl-lname-error wpt-error">Enter your last name</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="phone">Phone Number*</label>
                                                <input type="tel" name="client_phone[]" id="cl-phone" class="wpt-form-control wpt-cl-phone" placeholder="(319) 555-0115" required>
                                                <div class="wpt-cl-phone-error wpt-error">Enter your first name</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="email">E-mail*</label>
                                                <input type="email" name="client_email[]" id="email" class="wpt-form-control wpt-cl-email" placeholder="Enter your e-mail address" required>
                                                <div class="wpt-cl-email-error wpt-error">Enter your first name</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="wpt-slc-pref">
                                                            <h4>Communication Preference</h4>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="wpt-select-wrap">
                                                            <div class="select-text">
                                                                <span class="selected">Preference</span>
                                                                <span class="drop-icon">
                                                                    <i class="fa-solid fa-chevron-down"></i>
                                                                </span>
                                                            </div>
                                                            <input type="hidden" name="preferance" id="preferance" value="">
                                                            <ul class="default-wrap">
                                                                <li>Option 1</li>
                                                                <li>Option 2</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpt-add-more pb-4">
                                <div class="wpt-more-wrap">
                                    <div class="wpt-passen-group mb-4">
                                        <a href="#" class="wpt-add-pass wpt-btn">
                                            <span class="icon">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                            Add Another Passenger
                                        </a>
                                    </div>
                                    <div class="wpt-child-group">
                                        <a href="#" class="wpt-add-child wpt-btn">
                                            <span class="icon">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                            Add Child Seat
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="left-btn">
                                    <a class="previous wpt-reg-btn wpt-btn">Back</a>
                                    <a href="#" class="cancle wpt-btn wpt-reg-btn">Cancle</a>
                                </div>
                                <div class="right-btn">
                                    <a class="next action-button wpt-btn">Continue</a>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-card" id="wpt-pick-off">
                                <div class="client-pessen py-5" id="wpt-pick-cnt-area">
                                    <h3 class="mb-4">Pick Up</h3>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="wpt-trip">
                                                <input type="hidden" name="trip" id="trip-value" value="Transfer">
                                                <label for="transfer" class="trip-label transfer">
                                                    <i class="fa-solid fa-location-dot"></i> Transfer
                                                </label>
                                                <label for="hourly-trip" class="trip-label hourly">
                                                    <i class="fa-regular fa-clock"></i> Hourly Trip
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="wpt-pic-from">
                                                <input type="hidden" name="pickup_from" id="pickup_from" value="Commercial Air">
                                                <label for="pickup-commercial" class="pic-label" id="pick-up">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Commercial Air
                                                </label>
                                                <label for="pickup-private-air" class="pic-label" id="pick-up">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Private Air
                                                </label>
                                                <label for="pickup-address" class="pic-label" id="pick-up">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Address
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="flight">Select Flight*</label>
                                                <input type="hidden" name="pickup_flight" id="flight" class="wpt-form-control wpt-pick-flight" placeholder="Enter your first name" value="">
                                                <div class="wpt-pick-flight-wrap">
                                                    <div class="wpt-selected" id="pick-selected">
                                                        <span class="text">Select flight</span>
                                                        <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
                                                    </div>
                                                    <ul class="flight-list" id="pick-flight-list">
                                                        <li class="flight-list-item">Arriaval flight</li>
                                                        <li class="flight-list-item">Economy flight</li>
                                                        <li class="flight-list-item">Other flight</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="arrival-airport">Arrival Airport*</label>
                                                <input type="text" name="pickup_arrival_airport" id="arrival-airport" class="wpt-form-control" placeholder="Enter arrival airport name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="airline-name">Airline Name*</label>
                                                <input type="text" name="pickup_airline_name" id="airline-name" class="wpt-form-control" placeholder="Enter airline name" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="flight-number">Flight Number*</label>
                                                <input type="text" name="pickup_flight_number" id="flight-number" class="wpt-form-control" placeholder="Enter flight number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="flight-arrival-date">Flight Arrival Date</label>
                                                <input type="datetime-local" name="pickup_flight_arrival_date" id="flight-arrival-date" class="wpt-form-control" placeholder="MM/dd/YY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpt-pick-extra mb-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="wpt-pick-wrap">
                                            <a href="#" class="wpt-btn wpt-pick-note">Add Note</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer">
                                <div class="left-btn">
                                    <a class="previous wpt-reg-btn wpt-btn">Back</a>
                                    <a href="#" class="cancle wpt-reg-btn wpt-btn">Cancle</a>
                                </div>
                                <div class="right-btn">
                                    <a class="next action-button wpt-btn">Continue</a>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="client-pessen py-5" id="wpt-drop-cnt-area">
                                    <h3 class="mb-4">Destination Drop Off</h3>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="wpt-pic-from">
                                                <input type="hidden" name="drop_Off_from" id="drop_Off_from" value="Commercial Air">
                                                <label for="drop-commercial-air" class="drop-label" id="drop-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Commercial Air
                                                </label>
                                                <label for="drop-private-air" class="drop-label" id="drop-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Private Air
                                                </label>
                                                <label for="drop-pic-address" class="drop-label" id="drop-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Address
                                                </label>
                                                <label for="drop-trip" class="drop-label" id="drop-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Hourly Trip
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="drop-flight">Select Flight*</label>
                                                <input type="hidden" name="drop_off_flight" id="dro-flight" class="wpt-form-control wpt-drop-flight">
                                                <div class="wpt-pick-flight-wrap">
                                                    <div class="wpt-selected" id="drop-selected">
                                                        <span class="text">Select flight</span>
                                                        <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
                                                    </div>
                                                    <ul class="flight-list" id="drop-flight-list">
                                                        <li class="flight-list-item">Arriaval flight</li>
                                                        <li class="flight-list-item">Economy flight</li>
                                                        <li class="flight-list-item">Other flight</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="drop-airport">Arrival Airport*</label>
                                                <input type="text" name="drop_off_arrival_airport" id="drop-airport" class="wpt-form-control" placeholder="Enter arrival airport name" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="drop-airline-name">Airline Name*</label>
                                                <input type="text" name="drop_off_airline_name" id="drop-airline-name" class="wpt-form-control" placeholder="Enter airline name" required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="drop-flight-number">Flight Number*</label>
                                                <input type="text" name="drop_off_flight_number" id="drop-flight-number" class="wpt-form-control" placeholder="Enter flight number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="drop-arrival-date">Flight Arrival Date</label>
                                                <input type="datetime-local" name="drop_off_flight_arrival_date" id="drop-arrival-date" class="wpt-form-control" placeholder="MM/dd/YY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wpt-pick-extra mb-4">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="wpt-pick-wrap">
                                            <a href="#" class="wpt-btn wpt-drop-note">Add Note</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="return-wrap">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="mb-4">Return Trip</h3>
                                        <div class="return-item">
                                            <input type="hidden" name="return_Off_from" id="return_Off_from" value="No">
                                            <label for="return-yes" class="return-yes-label yes" id="return-Off-yes">
                                                <span class="icon"><i class="fa-solid fa-check"></i></span> Yes
                                            </label>
                                            <label for="return-no" class="return-yes-label no" id="return-Off-yes">
                                                <span class="icon"><i class="fa-solid fa-check"></i></span> No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-card" id="wpt-return-card">
                                <div class="client-pessen py-5" id="wpt-drop-cnt-area">
                                    <h3 class="mb-4">Return Trip</h3>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <div class="wpt-pic-from">
                                                <input type="hidden" name="return_from" id="return_from" value="">
                                                <label for="return-commercial-air" class="return-label" id="return-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Commercial Air
                                                </label>
                                                <label for="return-private-air" class="return-label" id="return-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Private Air
                                                </label>
                                                <label for="return-address" class="return-label" id="return-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Address
                                                </label>
                                                <label for="return-trip" class="return-label" id="return-Off">
                                                    <span class="icon"><i class="fa-solid fa-check"></i></span> Hourly Trip
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="return-flight">Select Flight*</label>
                                                <input type="hidden" name="return_flight" id="return-flight" class="wpt-form-control wpt-drop-flight" placeholder="Enter your first name">
                                                <div class="wpt-pick-flight-wrap">
                                                    <div class="wpt-selected" id="return-selected">
                                                        <span class="text">Select flight</span>
                                                        <span class="icon"><i class="fa-solid fa-chevron-down"></i></span>
                                                    </div>
                                                    <ul class="flight-list" id="return-flight-list">
                                                        <li class="flight-list-item">Arriaval flight</li>
                                                        <li class="flight-list-item">Economy flight</li>
                                                        <li class="flight-list-item">Other flight</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="return-airport">Arrival Airport*</label>
                                                <input type="text" name="return_arrival_airport" id="return-airport" class="wpt-form-control" placeholder="Enter arrival airport name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="return-airline-name">Airline Name*</label>
                                                <input type="text" name="return_airline_name" id="return-airline-name" class="wpt-form-control" placeholder="Enter airline name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="return-flight-number">Flight Number*</label>
                                                <input type="text" name="return_flight_number" id="return-flight-number" class="wpt-form-control" placeholder="Enter flight number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="return-arrival-date">Flight Arrival Date</label>
                                                <input type="datetime-local" name="return_flight_arrival_date" id="return-arrival-date" class="wpt-form-control" placeholder="MM/dd/YY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="footer mt-4">
                                <div class="left-btn">
                                    <a class="previous wpt-reg-btn wpt-btn">Back</a>
                                    <a href="#" class="cancle wpt-reg-btn wpt-btn">Cancle</a>
                                </div>
                                <div class="right-btn">
                                    <input type="submit" name="submit" value="Book Car" class="wpt-btn">
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}




// Handle form submission
add_action( 'init', 'handle_car_booking_form_submission' );

function handle_car_booking_form_submission() {
    if( isset( $_POST['submit'] ) ) {
        global $wpdb;
        $car_id = intval($_POST['car_id']);
        $car_title = get_the_title($car_id);
        $bookfor = sanitize_text_field($_POST['bookfor']);
        $organizer_first_name = sanitize_text_field($_POST['organizer_first_name']);
        $organizer_last_name = sanitize_text_field($_POST['organizer_last_name']);
        $organizer_phone = sanitize_text_field($_POST['organizer_phone']);
        $organizer_email = sanitize_email($_POST['organizer_email']);
        $organizer_company = sanitize_text_field($_POST['organizer_company']);
        $child_set = sanitize_text_field($_POST['child_set']);
        $preferance = sanitize_text_field($_POST['preferance']);
        $trip = sanitize_text_field($_POST['trip']);
        $pickup_from = sanitize_text_field($_POST['pickup_from']);
        $pickup_flight = sanitize_text_field($_POST['pickup_flight']);
        $pickup_arrival_airport = sanitize_text_field($_POST['pickup_arrival_airport']);
        $pickup_airline_name = sanitize_text_field($_POST['pickup_airline_name']);
        $pickup_flight_number = sanitize_text_field($_POST['pickup_flight_number']);
        $pickup_flight_arrival_date = sanitize_text_field($_POST['pickup_flight_arrival_date']);
        $pick_note = sanitize_text_field($_POST['pick_note']);
        $drop_Off_from = sanitize_text_field($_POST['drop_Off_from']);
        $drop_off_flight = sanitize_text_field($_POST['drop_off_flight']);
        $drop_off_arrival_airport = sanitize_text_field($_POST['drop_off_arrival_airport']);
        $drop_off_airline_name = sanitize_text_field($_POST['drop_off_airline_name']);
        $drop_off_flight_number = sanitize_text_field($_POST['drop_off_flight_number']);
        $drop_off_flight_arrival_date = sanitize_text_field($_POST['drop_off_flight_arrival_date']);
        $drop_note = sanitize_text_field($_POST['drop_note']);
        $return_Off_from = sanitize_text_field($_POST['return_Off_from']);
        $return_from = sanitize_text_field($_POST['return_from']);
        $return_flight = sanitize_text_field($_POST['return_flight']);
        $return_arrival_airport = sanitize_text_field($_POST['return_arrival_airport']);
        $return_airline_name = sanitize_text_field($_POST['return_airline_name']);
        $return_flight_number = sanitize_text_field($_POST['return_flight_number']);
        $return_flight_arrival_date = sanitize_text_field($_POST['return_flight_arrival_date']);

        // Save data for each passenger
        $passenger_data = array();
        foreach($_POST['client_first_name'] as $key => $name) {
            $passenger_data[] = array(
                'car_id' => $car_id,
                'car_title' => $car_title,
                'bookfor' => $bookfor,
                'organizer_first_name' => $organizer_first_name,
                'organizer_last_name' => $organizer_last_name,
                'organizer_phone' => $organizer_phone,
                'organizer_email' => $organizer_email,
                'organizer_company' => $organizer_company,
                'client_first_name' => sanitize_text_field( $_POST['client_first_name'][$key] ),
                'client_last_name' => sanitize_text_field( $_POST['client_last_name'][$key] ),
                'client_phone' => sanitize_text_field( $_POST['client_phone'][$key] ),
                'client_email' => sanitize_text_field( $_POST['client_email'][$key] ),
                'preferance' => $preferance,
                'child_set' => $child_set,
                'trip' => $trip,
                'pickup_from' => $pickup_from,
                'pickup_flight' => $pickup_flight,
                'pickup_arrival_airport' => $pickup_arrival_airport,
                'pickup_airline_name' => $pickup_airline_name,
                'pickup_flight_number' => $pickup_flight_number,
                'pickup_flight_arrival_date' => $pickup_flight_arrival_date,
                'pick_note' => $pick_note,
                'drop_off_from' => $drop_Off_from,
                'drop_off_flight' => $drop_off_flight,
                'drop_off_arrival_airport' => $drop_off_arrival_airport,
                'drop_off_airline_name' => $drop_off_airline_name,
                'drop_off_flight_number' => $drop_off_flight_number,
                'drop_off_flight_arrival_date' => $drop_off_flight_arrival_date,
                'drop_note' => $drop_note,
                'return_off_from' => $return_Off_from,
                'return_from' => $return_from,
                'return_flight' => $return_flight,
                'return_arrival_airport' => $return_arrival_airport,
                'return_airline_name' => $return_airline_name,
                'return_flight_number' => $return_flight_number,
                'return_flight_arrival_date' => $return_flight_arrival_date,
            );
        }

        $table_name = $wpdb->prefix . 'car_bookings';
        foreach ($passenger_data as $data) {
            $wpdb->insert($table_name, $data);
        }

        // Update car status
        update_post_meta($car_id, '_car_status', 'booked');

        // Redirect after form submission
        wp_redirect( home_url('/checkout') );
        exit;
    }
}
