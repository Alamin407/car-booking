jQuery(document).ready(function(){
    // validation
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

}
});

