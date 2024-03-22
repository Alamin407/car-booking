jQuery(document).ready(function($){
    $('#displaybtn').click(function(){
        $('#displaycar').select();
        document.execCommand("Copy");

        $('#copied-success').fadeIn();

        setTimeout(function(){
            $('#copied-success').fadeOut()
        }, 3000);
    });

    $('#bookingbtn').click(function(){
        $('#bookingcar').select();
        document.execCommand("Copy");

        $('#copied-success').fadeIn();

        setTimeout(function(){
            $('#copied-success').fadeOut()
        }, 3000);
    });
});