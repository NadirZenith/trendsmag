<?php
/**
 * Template Name: TicketScript Template
 *
 * Displays the index TicketScript template.
 *
 */
?>
<div class="row">
    <div class="col-xs-12 col-md-10">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/page', 'header'); ?>
            <?php get_template_part('templates/content', 'page'); ?>
        <?php endwhile; ?>


        <?php
        if (class_exists('NzWpCmTicketscript')) {
            if (wp_is_mobile()) {
                NzWpCmTicketscript::get_mobile_iframe('NDL5738Z');
            } else {
                NzWpCmTicketscript::get_web_iframe('NDL5738Z');
            }
        } else {
            if (current_user_can('manage_options')) {
                echo '- activate ticketscript plugin -';
            }
        }
        ?>

    </div>
</div>