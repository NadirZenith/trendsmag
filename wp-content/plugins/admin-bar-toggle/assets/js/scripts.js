jQuery(document).ready(function($) {

    /* 	=============================
     // !Variables 
     ============================= */

    var $desktopTopMargin = '32px',
            $mobTopMargin = '46px',
            $window = $(window),
            /*$firstLoad = true,*/
            $adminBar = $('#wpadminbar'),
            $html = $('html');

    /* 	=============================
     // !On Load 
     ============================= */

    // ! Setup Admin bar on first load
    /*console.log($.cookie('nz_bar'));*/
    checkWidth();
    $adminBar.after('<a id="showadminbar" href="/">&darr;</a>');

    // ! Hide Admin Bar
    $('#wp-admin-bar-hideshow a').click(function() {
        $html.stop().animate({marginTop: '0'}, 250, "linear");
        $adminBar.stop().animate({marginTop: '-' + $desktopTopMargin}, 250, "linear", function() {
            $('#showadminbar').stop().animate({marginTop: '0'}, 250, "linear");
        });

        /*barHidden();*/
        /*console.log('hide');*/
        $.cookie('nz_bar', 0, {path: '/'});

        return false;
    });

    // ! Show Admin Bar
    $('#showadminbar').click(function() {
        $(this).stop().animate({marginTop: '-' + $desktopTopMargin}, 250, "linear", function() {
            $html.stop().animate({marginTop: $desktopTopMargin}, 250, "linear");
            $adminBar.stop().animate({marginTop: '0'}, 250, "linear");
        });

        console.log('show');
        /*barShowing();*/
        $.cookie('nz_bar', 1, {path: '/'});

        return false;
    });

    /* 	=============================
     // !On Resize 
     ============================= */

    $(window).resize(checkWidth);

    /* 	=============================
     // !Global Functions 
     ============================= */

    function checkWidth() {
        var windowsize = $window.width();
        // ! If window is less that 782
        if (windowsize <= 782) {
            $html.css({marginTop: $mobTopMargin});
            $adminBar.css({marginTop: '0'});
            barShowing();
        } else {
            /*alert($.cookie('nz_bar'));*/
            // ! If window is greater than 782 and it's loading for the first time
            /*if ($firstLoad) {*/
            if ($.cookie('nz_bar') == 0) {
                /*console.log('hide');*/
                hideBar();
                /*$firstLoad = false;*/
            } else {
                /*console.log('show');*/
                barShowing();
            }

            /*
             */
            if ($html.hasClass('jck_ab_showing')) {
                $html.css({marginTop: $desktopTopMargin});
            } else {
                hideBar();
            }
        }
    }

    function barShowing() {
        $html.removeClass('jck_ab_hidden');
        $html.addClass('jck_ab_showing');

        /*$.cookie('nz_bar', 1);*/
    }

    function barHidden() {
        $html.removeClass('jck_ab_showing');
        $html.addClass('jck_ab_hidden');

        /*$.cookie('nz_bar', 0);*/
    }

    function hideBar() {
        $html.css({marginTop: '0'});
        $adminBar.css({marginTop: '-' + $desktopTopMargin});
        barHidden();
    }
});