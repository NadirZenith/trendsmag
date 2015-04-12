
<script>
    (function ($) {
        $(document).ready(function () {
            var s = $("#main-menu-footer");
            var pos = s.position();
            $(window).scroll(function () {
                var windowHeight = $(window).height();
                var windowpos = $(window).scrollTop();

                if ((windowpos + windowHeight + 35) >= pos.top) {
                    s.addClass("stick");
                } else {
                    s.removeClass("stick");
                }
            });
        });
    })(jQuery);
</script>
<footer class="content-info" role="contentinfo" >
    
    <?php
    if (has_nav_menu('footer_navigation')) :
        wp_nav_menu(
            array(
                'theme_location' => 'footer_navigation',
                'menu_class' => 'nav navbar-nav',
                'menu_id' => 'main-menu-footer'
            )
        );
    endif;
    /* dynamic_sidebar( 'sidebar-footer' ); */
    ?>
</footer>


<?php wp_footer(); ?>

<script>

    (function ($) {
        $(document).ready(function () {
            $('#main-menu-footer').nzMenuReplace({
            });
        });
    })(jQuery);
    
</script>