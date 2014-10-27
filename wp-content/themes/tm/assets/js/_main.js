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

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
      var Roots = {
            // All pages
            common: {
                  init: function() {
                        console.log('init');
                        // JavaScript to be fired on all pages
                        //$('.post-nav').css('display', 'none');

                        //dropdow on hover plugin
                        /*                        
                         $('.dropdown-toggle').dropdownHover();
                         
                         //make top links clicable
                         $('nav > ul > li:has(ul) > a').on('click', function() {
                         window.location.href = this.href;
                         });
                         * */

                        // ** fixed menu on scroll    
                        var nav = $('.navbar');
                        /*console.log(nav.outerHeight());*/
                        var pos = nav.offset().top;

                        $(window).scroll(function() {
                              /*console.log(pos);*/
                              /*console.log($(this).scrollTop());*/

                              if ($(this).scrollTop() > pos) {//fix navbar top
                                    nav.addClass("navbar-fixed-top");//navbar-fixed
                                    var paddingTop = nav.outerHeight(true) + 'px';
                                    $('body').addClass("navbar-fixed-fix").css({
                                          paddingTop: paddingTop
                                    });

                                    /*                                    */
                                    /*                                    
                                     console.log('height(): ', nav.height());//only element height
                                     console.log('innerHeight(): ', nav.innerHeight());//with padding
                                     console.log('outerHeight(): ', nav.outerHeight());//with border
                                     console.log('outerHeight(true): ', nav.outerHeight(true));//with margin
                                     * */
                                    /*                                    */

                                    /*                                    
                                     var paddingTop = pos + nav.height() + 'px';
                                     console.log('paddingTop: ', paddingTop);
                                     $('body').css({
                                     paddingTop: paddingTop
                                     });
                                     * */
                              } else {
                                    nav.removeClass("navbar-fixed-top");//navbar-default

                                    $('body').removeClass("navbar-fixed-fix").css({
                                          paddingTop: '0'
                                    });

                              }
                        });
                        $(window).scroll();


                        // ** Performs a smooth page scroll to an anchor on the same page.                        
                        $('a[href*=#]:not([href=#])').click(function() {
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
                        $('.menu-search a.search').on('click', function(e) {
                              /*$btn = $(this);*/
                              $search_form = $('.menu-search-form-wrapper');
                              if ($search_form.is(':hidden')) {
                                    $search_form.slideDown(300).find('input').focus();
                              } else {
                                    $search_form.slideUp(500);
                              }
                              return false;
                        });
                        $('.menu-search .search-field').focusout(function(e) {
                              $search_form = $('.menu-search-form-wrapper');
                              $search_form.slideUp(500);
                              return false;
                        });

                        // ** fancybox
                        //gallery
                        /*$('.fancybox').fancybox();*/
                        $("a[rel=nz_gallery]").fancybox();
                        $("a[rel=nz_fancybox]").fancybox();
                        /*$('dt.gallery-icon a').fancybox();*/


                        // ** infinite scroll
                        /*$infinite_scroll_target = ;*/

                        $('footer.content-info').after(
                                $('<div class="wrap container"> <div class="row"> <ul class="nz-posts-list-1" id="infsc-target"> </ul> </div> </div>')
                                );


                        $('.infinite-src').infinitescroll({
                              binder: $(window), // $('.infinite-home'), // scroll on this element rather than on the window
                              navSelector: "nav.post-nav",
                              nextSelector: "nav.post-nav a:first",
                              itemSelector: ".infinite-src li",
                              appendCallback: false,
                              errorCallback: function() {
                                    console.log('errorCallback');
                              }
                        }, function(list) {
                              $('#infsc-target').append(list);
                        });

                        //nz-posts-list-1 js
                        $(document).on('click', '.slideup-trig', function(e) {

                              e.preventDefault();
                              var $btn = $(e.currentTarget);

                              $box = $btn.next('.slideup-box');
                              $box.css("bottom", "3px");


                        });


                        $(document).on('mouseleave', 'article', function(e) {
                              var $article = $(e.currentTarget);

                              var $box = $article.find('.slideup-box');

                              $box.css('bottom', "-100%");
                        });

                  }
            },
            // Home page
            home: {
                  init: function() {
                        console.log('home');
                  }
            },
            // subir-event page, note the change from subit-evento to subir_evento.
            subir_evento: {
                  init: function() {

                        var nz_dtp_globalize = function(currentDateTime) {
                              dt1 = currentDateTime;
                        };

                        var nz_dtp_litmit = function() {
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
            fire: function(func, funcname, args) {
                  var namespace = Roots;
                  funcname = (funcname === undefined) ? 'init' : funcname;
                  if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
                        namespace[func][funcname](args);
                  }
            },
            loadEvents: function() {
                  UTIL.fire('common');

                  $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
                        UTIL.fire(classnm);
                  });
            }
      };

      $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
