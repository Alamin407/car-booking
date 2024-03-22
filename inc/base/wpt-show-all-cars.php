<?php
// Show all cars
add_shortcode('display_cars', 'display_all_cars_with_booking_button');

function display_all_cars_with_booking_button() {
    ?>

    <div class="wpt-cartab-wrap">
        <div class="wpt-car-tab">
            <ul class="wpt-tab-list">
                <li class="wpt-tab-list-item">Luxury Sedan</li>
                <li class="wpt-tab-list-item">SUV</li>
                <li class="wpt-tab-list-item">Sprinter</li>
                <li class="wpt-tab-list-item">Motor Coach</li>
                <li class="wpt-tab-list-item">Mini Coach</li>
            </ul>
        </div>
        <div class="wpt-tab-content-area">
            <div class="owl-carousel owl-theme wpt-car-sliders">
                <?php
                $args = array(
                    'post_type' => 'car',
                    'category_name' => 'Luxury Sedan',
                    'posts_per_page' => -1, // Retrieve all cars
                );
            
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $car_title = get_the_title();
                        $car_status = get_post_meta(get_the_ID(), '_car_status', true);
                        $car_id = get_the_ID();
                        $images = acf_photo_gallery('car_photo_gallery', $car_id);
                        ?>
                            <div class="items">
                                <div class="wpt-car-slide">
                                    <div class="row">
                                        <div class="col-12 col-lg-5">
                                            <div class="wpt-car-thumb">
                                                <?php echo get_the_post_thumbnail(); ?>
                                            </div>
                                            <div class="wpt-car-gallery">
                                                <?php
                                                    if(count($images)){
                                                        foreach( $images as $image ){
                                                            ?>
                                                            <div class="wpt-gal-item" style="background: url('<?php echo $image['full_image_url']; ?>')">
                                                                <img src="<?php echo $image['full_image_url']; ?>" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <div class="wpt-car-content">
                                                <div class="wpt-car-title mt-4 mt-lg-0">
                                                    <h2><?php echo $car_title; ?></h2>
                                                </div>
                                                <div class="wpt-car-excerpt">
                                                    <p><?php the_field( 'description' ); ?></p>
                                                </div>
                                                <div class="wpt-car-info">
                                                    <ul class="wpt-car-info-list">
                                                        <li class="wpt-car-info-item">
                                                            <span>Passenger Capacity: </span>
                                                            <span><?php the_field('passenger_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Luggage Capacity: </span>
                                                            <span><?php the_field('luggage_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Motor Coach: </span>
                                                            <span><?php the_field('motor_coach'); ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-colors">
                                                    <h3>Available color:</h3>
                                                    <ul class="wpt-car-color-list">
                                                        <?php if(have_rows( 'colors' )) : ?>
                                                            <?php while(have_rows( 'colors' )) : the_row() ?>
                                                                <li class="wpt-car-color-item">
                                                                    <span class="color-name">
                                                                        <?php the_sub_field( 'color_name' ); ?>
                                                                    </span>
                                                                    <span class="color-code" style="background: #<?php the_sub_field( 'color_code' ); ?>;">
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-rims">
                                                    <h3><?php the_field('rims_quantity'); ?></h3>
                                                    <ul class="wpt-rims-list">
                                                        <?php if(have_rows( 'rims' )) : ?>
                                                            <?php while(have_rows( 'rims' )) : the_row() ?>
                                                                <li class="wpt-rim-item">
                                                                    <span class="item">
                                                                        <i class="fa-solid fa-check"></i> 
                                                                    </span>
                                                                    <span>
                                                                        <?php echo the_sub_field( 'rim_item' ); ?>
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-perform">
                                                    <h3>Performance:</h3>
                                                    <ul class="wpt-car-perfom-list">
                                                        <?php if( have_rows('performance') ) : ?>
                                                            <?php while(have_rows('performance')) : the_row() ?>
                                                                <li class="wpt-perform-item">
                                                                    <h3><?php the_sub_field( 'performance_name' ); ?></h3>
                                                                    <h4>
                                                                        <span class="num"><?php the_sub_field( 'performance_value' ); ?></span>
                                                                        <span class="des"><?php the_sub_field( 'performance_destination' ); ?></span>
                                                                    </h4>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-footer">
                                                    <div class="wpt-car-price d-none">
                                                        <?php do_shortcode( "[cptwooint_price/]" ); ?>
                                                    </div>
                                                    <?php 
                                                        if($car_status == 'booked'){
                                                            ?>
                                                                <a class="wpt-btn btn btn-dark" disabled>Booked</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <?php echo do_shortcode("[cptwooint_cart_button/]"); ?>
                                                                <a href="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" class="book-now-button d-none" id="book-now">Book Now</a>
                                                                <input type="hidden" value="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" id="bookurl">
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>           
                        <?php
                    }
                    wp_reset_postdata(); // Restore global post data
                } else {
                    $output = '<p>No cars found.</p>';
                }
                ?>
            </div>
        </div>
        <div class="wpt-tab-content-area">
            <div class="owl-carousel owl-theme wpt-car-sliders-suv">
                <?php
                $args = array(
                    'post_type' => 'car',
                    'category_name' => 'SUV',
                    'posts_per_page' => -1, // Retrieve all cars
                );
            
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $car_title = get_the_title();
                        $car_status = get_post_meta(get_the_ID(), '_car_status', true);
                        $car_id = get_the_ID();
                        $images = acf_photo_gallery('car_photo_gallery', $car_id);
                        ?>
                            <div class="items">
                                <div class="wpt-car-slide">
                                    <div class="row">
                                        <div class="col-12 col-lg-5">
                                            <div class="wpt-car-thumb">
                                                <?php echo get_the_post_thumbnail(); ?>
                                            </div>
                                            <div class="wpt-car-gallery">
                                                <?php
                                                    if(count($images)){
                                                        foreach( $images as $image ){
                                                            ?>
                                                            <div class="wpt-gal-item" style="background: url('<?php echo $image['full_image_url']; ?>')">
                                                                <img src="<?php echo $image['full_image_url']; ?>" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <div class="wpt-car-content">
                                                <div class="wpt-car-title mt-4 mt-lg-0">
                                                    <h2><?php echo $car_title; ?></h2>
                                                </div>
                                                <div class="wpt-car-excerpt">
                                                    <p><?php the_field( 'description' ); ?></p>
                                                </div>
                                                <div class="wpt-car-info">
                                                    <ul class="wpt-car-info-list">
                                                        <li class="wpt-car-info-item">
                                                            <span>Passenger Capacity: </span>
                                                            <span><?php the_field('passenger_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Luggage Capacity: </span>
                                                            <span><?php the_field('luggage_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Motor Coach: </span>
                                                            <span><?php the_field('motor_coach'); ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-colors">
                                                    <h3>Available color:</h3>
                                                    <ul class="wpt-car-color-list">
                                                        <?php if(have_rows( 'colors' )) : ?>
                                                            <?php while(have_rows( 'colors' )) : the_row() ?>
                                                                <li class="wpt-car-color-item">
                                                                    <span class="color-name">
                                                                        <?php the_sub_field( 'color_name' ); ?>
                                                                    </span>
                                                                    <span class="color-code" style="background: #<?php the_sub_field( 'color_code' ); ?>;">
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-rims">
                                                    <h3><?php the_field('rims_quantity'); ?></h3>
                                                    <ul class="wpt-rims-list">
                                                        <?php if(have_rows( 'rims' )) : ?>
                                                            <?php while(have_rows( 'rims' )) : the_row() ?>
                                                                <li class="wpt-rim-item">
                                                                    <span class="item">
                                                                        <i class="fa-solid fa-check"></i> 
                                                                    </span>
                                                                    <span>
                                                                        <?php echo the_sub_field( 'rim_item' ); ?>
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-perform">
                                                    <h3>Performance:</h3>
                                                    <ul class="wpt-car-perfom-list">
                                                        <?php if( have_rows('performance') ) : ?>
                                                            <?php while(have_rows('performance')) : the_row() ?>
                                                                <li class="wpt-perform-item">
                                                                    <h3><?php the_sub_field( 'performance_name' ); ?></h3>
                                                                    <h4>
                                                                        <span class="num"><?php the_sub_field( 'performance_value' ); ?></span>
                                                                        <span class="des"><?php the_sub_field( 'performance_destination' ); ?></span>
                                                                    </h4>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-footer">
                                                    <div class="wpt-car-price d-none">
                                                        <?php do_shortcode( "[cptwooint_price/]" ); ?>
                                                    </div>
                                                    <?php 
                                                        if($car_status == 'booked'){
                                                            ?>
                                                                <a class="wpt-btn btn btn-dark" disabled>Booked</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <?php echo do_shortcode("[cptwooint_cart_button/]"); ?>
                                                                <a href="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" class="book-now-button d-none" id="book-now">Book Now</a>
                                                                <input type="hidden" value="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" id="bookurl">
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>           
                        <?php
                    }
                    wp_reset_postdata(); // Restore global post data
                } else {
                    $output = '<p>No cars found.</p>';
                }
                ?>
            </div>
        </div>
        <div class="wpt-tab-content-area">
            <div class="owl-carousel owl-theme wpt-car-sliders-sprinter">
                <?php
                $args = array(
                    'post_type' => 'car',
                    'category_name' => 'Sprinter',
                    'posts_per_page' => -1, // Retrieve all cars
                );
            
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $car_title = get_the_title();
                        $car_status = get_post_meta(get_the_ID(), '_car_status', true);
                        $car_id = get_the_ID();
                        $images = acf_photo_gallery('car_photo_gallery', $car_id);
                        ?>
                            <div class="items">
                                <div class="wpt-car-slide">
                                    <div class="row">
                                        <div class="col-12 col-lg-5">
                                            <div class="wpt-car-thumb">
                                                <?php echo get_the_post_thumbnail(); ?>
                                            </div>
                                            <div class="wpt-car-gallery">
                                                <?php
                                                    if(count($images)){
                                                        foreach( $images as $image ){
                                                            ?>
                                                            <div class="wpt-gal-item" style="background: url('<?php echo $image['full_image_url']; ?>')">
                                                                <img src="<?php echo $image['full_image_url']; ?>" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <div class="wpt-car-content">
                                                <div class="wpt-car-title mt-4 mt-lg-0">
                                                    <h2><?php echo $car_title; ?></h2>
                                                </div>
                                                <div class="wpt-car-excerpt">
                                                    <p><?php the_field( 'description' ); ?></p>
                                                </div>
                                                <div class="wpt-car-info">
                                                    <ul class="wpt-car-info-list">
                                                        <li class="wpt-car-info-item">
                                                            <span>Passenger Capacity: </span>
                                                            <span><?php the_field('passenger_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Luggage Capacity: </span>
                                                            <span><?php the_field('luggage_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Motor Coach: </span>
                                                            <span><?php the_field('motor_coach'); ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-colors">
                                                    <h3>Available color:</h3>
                                                    <ul class="wpt-car-color-list">
                                                        <?php if(have_rows( 'colors' )) : ?>
                                                            <?php while(have_rows( 'colors' )) : the_row() ?>
                                                                <li class="wpt-car-color-item">
                                                                    <span class="color-name">
                                                                        <?php the_sub_field( 'color_name' ); ?>
                                                                    </span>
                                                                    <span class="color-code" style="background: #<?php the_sub_field( 'color_code' ); ?>;">
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-rims">
                                                    <h3><?php the_field('rims_quantity'); ?></h3>
                                                    <ul class="wpt-rims-list">
                                                        <?php if(have_rows( 'rims' )) : ?>
                                                            <?php while(have_rows( 'rims' )) : the_row() ?>
                                                                <li class="wpt-rim-item">
                                                                    <span class="item">
                                                                        <i class="fa-solid fa-check"></i> 
                                                                    </span>
                                                                    <span>
                                                                        <?php echo the_sub_field( 'rim_item' ); ?>
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-perform">
                                                    <h3>Performance:</h3>
                                                    <ul class="wpt-car-perfom-list">
                                                        <?php if( have_rows('performance') ) : ?>
                                                            <?php while(have_rows('performance')) : the_row() ?>
                                                                <li class="wpt-perform-item">
                                                                    <h3><?php the_sub_field( 'performance_name' ); ?></h3>
                                                                    <h4>
                                                                        <span class="num"><?php the_sub_field( 'performance_value' ); ?></span>
                                                                        <span class="des"><?php the_sub_field( 'performance_destination' ); ?></span>
                                                                    </h4>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-footer">
                                                    <div class="wpt-car-price d-none">
                                                        <?php do_shortcode( "[cptwooint_price/]" ); ?>
                                                    </div>
                                                    <?php 
                                                        if($car_status == 'booked'){
                                                            ?>
                                                                <a class="wpt-btn btn btn-dark" disabled>Booked</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <?php echo do_shortcode("[cptwooint_cart_button/]"); ?>
                                                                <a href="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" class="book-now-button d-none" id="book-now">Book Now</a>
                                                                <input type="hidden" value="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" id="bookurl">
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>           
                        <?php
                    }
                    wp_reset_postdata(); // Restore global post data
                } else {
                    $output = '<p>No cars found.</p>';
                }
                ?>
            </div>
        </div>
        <div class="wpt-tab-content-area">
            <div class="owl-carousel owl-theme wpt-car-sliders-motor-coach">
                <?php
                $args = array(
                    'post_type' => 'car',
                    'category_name' => 'Motor Coach',
                    'posts_per_page' => -1, // Retrieve all cars
                );
            
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $car_title = get_the_title();
                        $car_status = get_post_meta(get_the_ID(), '_car_status', true);
                        $car_id = get_the_ID();
                        $images = acf_photo_gallery('car_photo_gallery', $car_id);
                        ?>
                            <div class="items">
                                <div class="wpt-car-slide">
                                    <div class="row">
                                        <div class="col-12 col-lg-5">
                                            <div class="wpt-car-thumb">
                                                <?php echo get_the_post_thumbnail(); ?>
                                            </div>
                                            <div class="wpt-car-gallery">
                                                <?php
                                                    if(count($images)){
                                                        foreach( $images as $image ){
                                                            ?>
                                                            <div class="wpt-gal-item" style="background: url('<?php echo $image['full_image_url']; ?>')">
                                                                <img src="<?php echo $image['full_image_url']; ?>" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <div class="wpt-car-content">
                                                <div class="wpt-car-title mt-4 mt-lg-0">
                                                    <h2><?php echo $car_title; ?></h2>
                                                </div>
                                                <div class="wpt-car-excerpt">
                                                    <p><?php the_field( 'description' ); ?></p>
                                                </div>
                                                <div class="wpt-car-info">
                                                    <ul class="wpt-car-info-list">
                                                        <li class="wpt-car-info-item">
                                                            <span>Passenger Capacity: </span>
                                                            <span><?php the_field('passenger_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Luggage Capacity: </span>
                                                            <span><?php the_field('luggage_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Motor Coach: </span>
                                                            <span><?php the_field('motor_coach'); ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-colors">
                                                    <h3>Available color:</h3>
                                                    <ul class="wpt-car-color-list">
                                                        <?php if(have_rows( 'colors' )) : ?>
                                                            <?php while(have_rows( 'colors' )) : the_row() ?>
                                                                <li class="wpt-car-color-item">
                                                                    <span class="color-name">
                                                                        <?php the_sub_field( 'color_name' ); ?>
                                                                    </span>
                                                                    <span class="color-code" style="background: #<?php the_sub_field( 'color_code' ); ?>;">
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-rims">
                                                    <h3><?php the_field('rims_quantity'); ?></h3>
                                                    <ul class="wpt-rims-list">
                                                        <?php if(have_rows( 'rims' )) : ?>
                                                            <?php while(have_rows( 'rims' )) : the_row() ?>
                                                                <li class="wpt-rim-item">
                                                                    <span class="item">
                                                                        <i class="fa-solid fa-check"></i> 
                                                                    </span>
                                                                    <span>
                                                                        <?php echo the_sub_field( 'rim_item' ); ?>
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-perform">
                                                    <h3>Performance:</h3>
                                                    <ul class="wpt-car-perfom-list">
                                                        <?php if( have_rows('performance') ) : ?>
                                                            <?php while(have_rows('performance')) : the_row() ?>
                                                                <li class="wpt-perform-item">
                                                                    <h3><?php the_sub_field( 'performance_name' ); ?></h3>
                                                                    <h4>
                                                                        <span class="num"><?php the_sub_field( 'performance_value' ); ?></span>
                                                                        <span class="des"><?php the_sub_field( 'performance_destination' ); ?></span>
                                                                    </h4>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-footer">
                                                    <div class="wpt-car-price d-none">
                                                        <?php do_shortcode( "[cptwooint_price/]" ); ?>
                                                    </div>
                                                    <?php 
                                                        if($car_status == 'booked'){
                                                            ?>
                                                                <a class="wpt-btn btn btn-dark" disabled>Booked</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <?php echo do_shortcode("[cptwooint_cart_button/]"); ?>
                                                                <a href="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" class="book-now-button d-none" id="book-now">Book Now</a>
                                                                <input type="hidden" value="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" id="bookurl">
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>           
                        <?php
                    }
                    wp_reset_postdata(); // Restore global post data
                } else {
                    $output = '<p>No cars found.</p>';
                }
                ?>
            </div>
        </div>
        <div class="wpt-tab-content-area">
            <div class="owl-carousel owl-theme wpt-car-sliders-mini-coach">
                <?php
                $args = array(
                    'post_type' => 'car',
                    'category_name' => 'Mini Coach',
                    'posts_per_page' => -1, // Retrieve all cars
                );
            
                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $car_title = get_the_title();
                        $car_status = get_post_meta(get_the_ID(), '_car_status', true);
                        $car_id = get_the_ID();
                        $images = acf_photo_gallery('car_photo_gallery', $car_id);
                        ?>
                            <div class="items">
                                <div class="wpt-car-slide">
                                    <div class="row">
                                        <div class="col-12 col-lg-5">
                                            <div class="wpt-car-thumb">
                                                <?php echo get_the_post_thumbnail(); ?>
                                            </div>
                                            <div class="wpt-car-gallery">
                                                <?php
                                                    if(count($images)){
                                                        foreach( $images as $image ){
                                                            ?>
                                                            <div class="wpt-gal-item" style="background: url('<?php echo $image['full_image_url']; ?>')">
                                                                <img src="<?php echo $image['full_image_url']; ?>" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-7">
                                            <div class="wpt-car-content">
                                                <div class="wpt-car-title mt-4 mt-lg-0">
                                                    <h2><?php echo $car_title; ?></h2>
                                                </div>
                                                <div class="wpt-car-excerpt">
                                                    <p><?php the_field( 'description' ); ?></p>
                                                </div>
                                                <div class="wpt-car-info">
                                                    <ul class="wpt-car-info-list">
                                                        <li class="wpt-car-info-item">
                                                            <span>Passenger Capacity: </span>
                                                            <span><?php the_field('passenger_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Luggage Capacity: </span>
                                                            <span><?php the_field('luggage_capacity'); ?></span>
                                                        </li>
                                                        <li class="wpt-car-info-item">
                                                            <span>Motor Coach: </span>
                                                            <span><?php the_field('motor_coach'); ?></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-colors">
                                                    <h3>Available color:</h3>
                                                    <ul class="wpt-car-color-list">
                                                        <?php if(have_rows( 'colors' )) : ?>
                                                            <?php while(have_rows( 'colors' )) : the_row() ?>
                                                                <li class="wpt-car-color-item">
                                                                    <span class="color-name">
                                                                        <?php the_sub_field( 'color_name' ); ?>
                                                                    </span>
                                                                    <span class="color-code" style="background: #<?php the_sub_field( 'color_code' ); ?>;">
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-rims">
                                                    <h3><?php the_field('rims_quantity'); ?></h3>
                                                    <ul class="wpt-rims-list">
                                                        <?php if(have_rows( 'rims' )) : ?>
                                                            <?php while(have_rows( 'rims' )) : the_row() ?>
                                                                <li class="wpt-rim-item">
                                                                    <span class="item">
                                                                        <i class="fa-solid fa-check"></i> 
                                                                    </span>
                                                                    <span>
                                                                        <?php echo the_sub_field( 'rim_item' ); ?>
                                                                    </span>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-perform">
                                                    <h3>Performance:</h3>
                                                    <ul class="wpt-car-perfom-list">
                                                        <?php if( have_rows('performance') ) : ?>
                                                            <?php while(have_rows('performance')) : the_row() ?>
                                                                <li class="wpt-perform-item">
                                                                    <h3><?php the_sub_field( 'performance_name' ); ?></h3>
                                                                    <h4>
                                                                        <span class="num"><?php the_sub_field( 'performance_value' ); ?></span>
                                                                        <span class="des"><?php the_sub_field( 'performance_destination' ); ?></span>
                                                                    </h4>
                                                                </li>
                                                            <?php endwhile; ?>
                                                        <?php endif; ?>
                                                    </ul>
                                                </div>
                                                <div class="wpt-car-footer">
                                                    <div class="wpt-car-price d-none">
                                                        <?php do_shortcode( "[cptwooint_price/]" ); ?>
                                                    </div>
                                                    <?php 
                                                        if($car_status == 'booked'){
                                                            ?>
                                                                <a class="wpt-btn btn btn-dark" disabled>Booked</a>
                                                            <?php
                                                        }else{
                                                            ?>
                                                                <?php echo do_shortcode("[cptwooint_cart_button/]"); ?>
                                                                <a href="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" class="book-now-button d-none" id="book-now">Book Now</a>
                                                                <input type="hidden" value="<?php echo esc_url(add_query_arg('car_id', $car_id, site_url('/booking'))) ?>" id="bookurl">
                                                            <?php
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>           
                        <?php
                    }
                    wp_reset_postdata(); // Restore global post data
                } else {
                    $output = '<p>No cars found.</p>';
                }
                ?>
            </div>
        </div>
        
    </div>
    <?php
}