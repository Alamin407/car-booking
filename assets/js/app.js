
jQuery(document).ready(function($){

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    // Validation
    function wptvalidate(){
        // Or First Name
        $('.wpt-or-f-name').on({
            focus: function(){
                var fname = $('.wpt-or-f-name').val();
                if( fname == '' ){
                    $('.wpt-or-f-name-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-or-f-name-error').fadeOut();
            },
            mouseleave: function(){
                var fname = $('.wpt-or-f-name').val();
                if(fname == ''){
                    $('.wpt-or-f-name-error').fadeIn();
                }
            }
        });
    
        // Or Last Name
        $('.wpt-or-l-name').on({
            focus: function(){
                var lname = $('.wpt-or-l-name').val();
                if( lname == '' ){
                    $('.wpt-or-l-name-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-or-l-name-error').fadeOut();
            },
            mouseleave: function(){
                var lname = $('.wpt-or-l-name').val();
                if(lname == ''){
                    $('.wpt-or-l-name-error').fadeIn();
                }
            }
        });
    
        // Or Phone
        $('.wpt-or-phone').on({
            focus: function(){
                var orphone = $('.wpt-or-phone').val();
                if( orphone == '' ){
                    $('.wpt-or-p-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-or-p-error').fadeOut();
            },
            mouseleave: function(){
                var orphone = $('.wpt-or-phone').val();
                if(orphone == ''){
                    $('.wpt-or-p-error').fadeIn();
                }
            }
        });
    
        // Or Email
        $('.wpt-or-email').on({
            focus: function(){
                var oremail = $('.wpt-or-email').val();
                if( oremail == '' ){
                    $('.wpt-or-e-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-or-e-error').fadeOut();
            },
            mouseleave: function(){
                var oremail = $('.wpt-or-email').val();
                if(oremail == ''){
                    $('.wpt-or-e-error').fadeIn();
                }
            }
        });

        // CL Fname
        $('.wpt-cl-f-name').on({
            focus: function(){
                var clfname = $('.wpt-cl-f-name').val();
                if( clfname == '' ){
                    $('.wpt-cl-fname-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-cl-fname-error').fadeOut();
            },
            mouseleave: function(){
                var clfname = $('.wpt-cl-f-name').val();
                if(clfname == ''){
                    $('.wpt-cl-fname-error').fadeIn();
                }
            }
        });

        // CL lname
        $('.wpt-cl-lname').on({
            focus: function(){
                var cllname = $('.wpt-cl-lname').val();
                if( cllname == '' ){
                    $('.wpt-cl-lname-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-cl-lname-error').fadeOut();
            },
            mouseleave: function(){
                var cllname = $('.wpt-cl-lname').val();
                if(cllname == ''){
                    $('.wpt-cl-lname-error').fadeIn();
                }
            }
        });

        // CL phone
        $('.wpt-cl-phone').on({
            focus: function(){
                var clphone = $('.wpt-cl-phone').val();
                if( clphone == '' ){
                    $('.wpt-cl-phone-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-cl-phone-error').fadeOut();
            },
            mouseleave: function(){
                var clphone = $('.wpt-cl-phone').val();
                if(clphone == ''){
                    $('.wpt-cl-phone-error').fadeIn();
                }
            }
        });

        // CL Email
        $('.wpt-cl-email').on({
            focus: function(){
                var clemail = $('.wpt-cl-email').val();
                if( clemail == '' ){
                    $('.wpt-cl-email-error').fadeIn();
                }
            },
            keypress: function(){
                $('.wpt-cl-email-error').fadeOut();
            },
            mouseleave: function(){
                var clemail = $('.wpt-cl-email').val();
                if(clemail == ''){
                    $('.wpt-cl-email-error').fadeIn();
                }
            }
        });

    }

    // Trigger Validation
    wptvalidate();

    // Trigger continue functionality
    $(".footer .next").click(function(){
        current_fs = $(this).parent().parent().parent();
        next_fs = $(this).parent().parent().parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        
        //show the next fieldset
        $('.wpt-or-name-error').fadeOut();
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;
                    
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });

                    next_fs.css({'opacity': opacity});
                },
                duration: 500
            });
        setProgressBar(++current);
    });
    
    $(".previous").click(function(){
    
    current_fs = $(this).parent().parent().parent();
    previous_fs = $(this).parent().parent().parent().prev();
    
    //Remove class active
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show();
    
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
        step: function(now) {
    // for making fielset appear animation
        opacity = 1 - now;
    
        current_fs.css({
            'display': 'none',
            'position': 'relative'
        });

        previous_fs.css({'opacity': opacity});
    },
        duration: 500
    });
        setProgressBar(--current);
    });
    
    function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
    }

    $( '#or-phone' ).intlTelInput();
    $( '#cl-phone' ).intlTelInput();

    $( '.select-text' ).click(function(){
        $( '.default-wrap' ).toggleClass('show');
    });

    $( '.default-wrap li' ).click(function(){
        var currentEle = $(this).text();
        $('#preferance').val(currentEle);
        $('.selected').text(currentEle);
        $(this).parent().removeClass('show');
    });

    var maxpass = 2;
    var totalpess = 0;
    var pess = '<div class="client-pessen py-5"><h3 class="mb-4">Client/Passenger</h3><div class="row mb-4"><div class="col-12 col-md-6"><div class="form-group"><label for="client_first_name">First Name*</label><input type="text" name="client_first_name[]" id="client_first_name" class="wpt-form-control" placeholder="Enter your first name" required></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="client_last_name">Last Name*</label><input type="text" name="client_last_name[]" id="client_last_name" class="wpt-form-control" placeholder="Enter your last name" required></div></div></div><div class="row mb-4"><div class="col-12 col-md-6"><div class="form-group"><label for="phone">Phone Number*</label><input type="tel" name="client_phone[]" id="cl-phone" class="wpt-form-control" placeholder="(319) 555-0115" required></div></div><div class="col-12 col-md-6"><div class="form-group"><label for="email">E-mail*</label><input type="text" name="client_email[]" id="email" class="wpt-form-control" placeholder="Enter your e-mail address"></div></div></div><a href="#" class="wpt-remove wpt-pass-remove">Remove Passenger</a></div>';

    $( '.wpt-add-pass' ).click(function(){
        if( totalpess <= maxpass ){
            $('#wpt-client').append(pess);
            totalpess++;
        }
    });

    $(document).on('click', '.wpt-pass-remove', function(){
        $(this).parent().remove();
        totalpess--;
    });

    var maxchild = 1;
    var totalchild = 1;
    var child = '<div class="client-pessen py-5"><h3 class="mb-4">Child</h3><div class="row mb-4"><div class="col-12 col-md-2"><div class="form-group"><label for="child_set">Child Set*</label><input type="text" name="child_set" id="child_set" class="wpt-form-control" placeholder="3" required></div></div><div class="col-12 col-md-10"></div></div><a href="#" class="wpt-cld-rm">Remove Passenger</a></div>';

    $( '.wpt-add-child' ).click(function(){
        if( totalchild <= maxchild ){
            $('#wpt-client').append(child);
            totalchild++;
        }
    });

    $(document).on('click', '.wpt-cld-rm', function(){
        $(this).parent().remove();
        totalchild--;
    });

    $('.wpt-trip .trip-label:first').addClass('trip-active');
    $('.trip-label').click(function(){
        var vlue = $(this).text();
        $('#trip-value').val(vlue);
        $('.wpt-trip .trip-label').removeClass('trip-active');
        $(this).addClass('trip-active');
    });
    
    $( '.wpt-pic-from #pick-up:first' ).addClass( 'pic-active' );
    $('.pic-label').click(function(){
        var pickval = $(this).text();
        $('.wpt-pic-from #pick-up').removeClass('pic-active');
        $(this).addClass('pic-active');
        $('#pickup_from').val(pickval);
    });

    $('#pick-selected').click(function(){
        $('#pick-flight-list').toggleClass('flight-show');
    });

    $( '#pick-flight-list .flight-list-item' ).click(function(){
        var currentFlight = $(this).text();

        $('#flight').val(currentFlight);
        $('#pick-selected .text').text(currentFlight);
        $(this).parent().removeClass('flight-show');
    });

    var picknotemax = 1;
    var picknotetotal = 1;
    var picknoteArea = '<div class="row mt-3"><div class="col-12"><div class="form-group"><label for="note">Note</label><textarea name="pick_note" id="note" cols="30" rows="10" class="wpt-form-control" placeholder="Write your note here.."></textarea><a href="#" class="wpt-remove wpt-pick-note-remove mt-4">Remove Note</a></div></div></div>';

    $('.wpt-pick-note').click(function(){
        if( picknotetotal <= picknotemax ){
            $('#wpt-pick-cnt-area').append(picknoteArea);
            picknotetotal++;
        }
    });

    $(document).on('click', '.wpt-pick-note-remove', function(){
        $(this).parent().remove();
        picknotetotal--;
    });

    $( '.wpt-pic-from #drop-Off:first' ).addClass( 'pic-active' );
    $('.drop-label').click(function(){
        var drpval = $(this).text();
        $('.wpt-pic-from #drop-Off').removeClass('pic-active');
        $(this).addClass('pic-active');
        $('#drop_Off_from').val(drpval);
    });

    $('#drop-selected').click(function(){
        $('#drop-flight-list').toggleClass('flight-show');
    });

    $( '#drop-flight-list .flight-list-item' ).click(function(){
        var currentFlight = $(this).text();

        $('#dro-flight').val(currentFlight);
        $('#drop-selected .text').text(currentFlight);
        $(this).parent().removeClass('flight-show');
    });

    var dropnotemax = 1;
    var dropnotetotal = 1;
    var dropnoteArea = '<div class="row mt-3"><div class="col-12"><div class="form-group"><label for="drop-note">Note</label><textarea name="drop_note" id="drop-note" cols="30" rows="10" class="wpt-form-control" placeholder="Write your note here.."></textarea><a href="#" class="wpt-remove wpt-pick-note-remove mt-4">Remove Note</a></div></div></div>';
    $('.wpt-drop-note').click(function(){
        if( dropnotetotal <= dropnotemax  ){
            $('#wpt-drop-cnt-area').append(dropnoteArea);
            dropnotetotal++;
        }
    });
    $(document).on('click', '.wpt-pick-note-remove', function(){
        $(this).parent().remove();
        dropnotetotal--;
    });

    $( '.wpt-pic-from #return-Off:first' ).addClass( 'pic-active' );
    $('.return-label').click(function(){
        var retunval = $(this).text();
        $('.wpt-pic-from #return-Off').removeClass('pic-active');
        $(this).addClass('pic-active');
        $('#return_from').val(retunval);
    });

    $('#return-selected').click(function(){
        $('#return-flight-list').toggleClass('flight-show');
    });

    $( '#return-flight-list .flight-list-item' ).click(function(){
        var currentFlight = $(this).text();

        $('#return-flight').val(currentFlight);
        $('#return-selected .text').text(currentFlight);
        $(this).parent().removeClass('flight-show');
    });

    $('.return-yes-label').click(function(){
        var isreturn = $(this).text();
        $('.return-item #return-Off-yes').removeClass('return-active');
        $(this).addClass('return-active');
        $('#return_Off_from').val(isreturn);
    });

    $('.yes').click(function(){
        $('#wpt-return-card').show();

        // Validation enabled
        $('#return_from').val('Commercial Air');
        $('#return-flight').attr('required', 'required');
        $('#return-airport').attr('required', 'required');
        $('#return-airline-name').attr('required', 'required');
        $('#return-flight-number').attr('required', 'required');
        $('#return-arrival-date').attr('required', 'required');
    });

    $('.no').click(function(){
        $('#wpt-return-card').hide();

        // Validation enabled
        $('#return_from').val('');
        $('#return-flight').removeAttr('required');
        $('#return-airport').removeAttr('required');
        $('#return-airline-name').removeAttr('required');
        $('#return-flight-number').removeAttr('required');
        $('#return-arrival-date').removeAttr('required');
    });

    $('#book-myself').click(function(){
        $('#myself').attr('checked', 'checked');
        $('#client').removeAttr('checked');
    });

    $('#book-client').click(function(){
        $('#client').attr('checked', 'checked');
        $('#myself').removeAttr('checked');
    });

    $( '.cptwooint-cart-btn-wrapper a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart' ).html('Book Now');
    var bookingurl = $('.wpt-tab-content-area .wpt-car-slide .wpt-car-footer #book-now').attr('href');
    var bookurl = $('.wpt-tab-content-area .wpt-car-slide .wpt-car-footer #bookurl').val();
    console.log(bookurl);
    $( '.cptwooint-cart-btn-wrapper .add_to_cart_button.ajax_add_to_cart' ).click(function(){
        setTimeout(function(){
            if(bookurl){
                window.location.href = bookurl;
            }else if(bookingurl){
                window.location.href = bookingurl;
            }else{
                window.location.href = bookurl;
            }
        }, 3000);
    });

    // Cars Category Tab
    $('.wpt-tab-list-item:first').addClass('wpt-tab-active');
    $('.wpt-tab-content-area:first').fadeIn();
    $('.wpt-tab-list-item').click(function(){
        var index = $(this).index();
        $('.wpt-tab-list .wpt-tab-list-item').removeClass( 'wpt-tab-active' );
        $(this).addClass('wpt-tab-active');
        $('.wpt-cartab-wrap .wpt-tab-content-area').fadeOut();
        $('.wpt-tab-content-area').eq(index).fadeIn();
    });

    // Click to change thumbnail
    $('.wpt-car-gallery .wpt-gal-item img').click(function(){
        var thumb = $(this).attr('src');
        $('.wpt-car-thumb').html('<img src="' + thumb + '">');
    });

    $('.wpt-car-gallery .wpt-gal-item img').hover(function(){
        var thumb = $(this).attr('src');
        $('.wpt-car-thumb').html('<img src="' + thumb + '">');
    });

    // Car Slider
    var carslide = $('.wpt-car-sliders');
    carslide.owlCarousel({
        loop:true,
        margin:10,
        autoplay: true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    // Suv
    var carslidesuv = $('.wpt-car-sliders-suv');
    carslidesuv.owlCarousel({
        loop:true,
        margin:10,
        autoplay: true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    // Sprinter
    var sprinter = $('.wpt-car-sliders-sprinter');
    sprinter.owlCarousel({
        loop:true,
        margin:10,
        autoplay: true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    // Motor Coach
    var motorcoach = $('.wpt-car-sliders-motor-coach');
    motorcoach.owlCarousel({
        loop:true,
        margin:10,
        autoplay: true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

    // mini Coach
    var minicoach = $('.wpt-car-sliders-mini-coach');
    minicoach.owlCarousel({
        loop:true,
        margin:10,
        autoplay: true,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });


});