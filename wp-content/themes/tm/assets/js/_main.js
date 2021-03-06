/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function ($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
    var Roots = {
        // All pages
        common: {
            init: function () {

                // ** fixed menus on scroll   
                var
                        nav = $('#top-navbar'),
                        pos = nav.offset().top,
                        $body = $('body');

                $(window).scroll(function () {
                    if ($(this).scrollTop() >= pos) {//fix navbar top
                        $body.addClass("fixed-bars");
                        nav.addClass("navbar-fixed-top");//navbar-fixed
                    } else {
                        $body.removeClass("fixed-bars");
                        nav.removeClass("navbar-fixed-top");//navbar-default
                    }
                });
                $(window).scroll();
                
                //footer menu mobile
                $('#menu-footer').nzMenuReplace({});

                // ** Performs a smooth page scroll to an anchor on the same page.                        
                $('a[href*=#]:not([href=#])').click(function () {
                    if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        if (target.length) {
                            $('html,body').animate({
                                scrollTop: target.offset().top - 70//offset top bar
                            }, 1000);
                            return false;
                        }
                    }
                });

                // ** search menu
                $('.menu-search a.search').on('click', function (e) {
                    /*$btn = $(this);*/
                    $search_form = $('.menu-search-form-wrapper');
                    if ($search_form.is(':hidden')) {
                        $search_form.slideDown(300).find('input').focus();
                    } else {
                        $search_form.slideUp(500);
                    }
                    return false;
                });
                $('.menu-search .search-field').focusout(function (e) {
                    $search_form = $('.menu-search-form-wrapper');
                    $search_form.slideUp(500);
                    return false;
                });

                // ** fancybox
                $("a[rel=nz_gallery]").fancybox();
                $("a[rel=nz_fancybox]").fancybox();

                // ** infinite scroll
                $('footer.content-info').after(
                        $('<div id="infsctarget" class="wrap container"> <div class="row"> <ul class="nz-posts-list-1" id="infsc-target"> </ul> </div> </div>')
                        );

                $('.infinite-src').infinitescroll({
                    binder: $(window), // $('.infinite-home'), // scroll on this element rather than on the window
                    navSelector: "nav.post-nav",
                    nextSelector: "nav.post-nav a:first",
                    itemSelector: ".infinite-src li",
                    appendCallback: false,
                    errorCallback: function () {
                        console.log('infinite scroll error');
                    }
                }, function (list) {
                    $('#infsc-target').append(list);
                });

            }
        },
        // Home page
        home: {
            init: function () {
            }
        },
        // subir-event page, note the change from subit-evento to subir_evento.
        subir_evento: {
            init: function () {

                var nz_dtp_globalize = function (currentDateTime) {
                    dt1 = currentDateTime;
                };

                var nz_dtp_litmit = function () {
                    if (typeof dt1 !== "undefined") {
                        this.setOptions({
                            minDate: dt1
                        });
                    }
                };
                mytimes = [];

                for (var H = 23; H !== -1; H--) {
                    for (var i = 45; i !== -15; i = (i < 0) ? 45 : i - 15) {
                        fix = (i === 0) ? '0' : '';
                        mytimes.push(H.toString() + ':' + i.toString() + fix);
                    }
                }

                mytimes.unshift('23:59');

                dtoptions = {
                    lang: 'es',
                    format: 'd/m/Y H:i',
                    minDate: 0,
                    defaultSelect: false,
                    allowTimes: mytimes,
                    onChangeDateTime: nz_dtp_globalize
                };

                $('#input_1_3').datetimepicker(dtoptions);

                $.extend(dtoptions, {onShow: nz_dtp_litmit, onChangeDateTime: null});

                $('#input_1_4').datetimepicker(dtoptions);

            }
        }
    };

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
    var UTIL = {
        fire: function (func, funcname, args) {
            var namespace = Roots;
            funcname = (funcname === undefined) ? 'init' : funcname;
            if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
                namespace[func][funcname](args);
            }
        },
        loadEvents: function () {
            UTIL.fire('common');

            $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
                UTIL.fire(classnm);
            });
        }
    };

    $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
