<?php

/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
      return '...';
        return ' &hellip; <a href="' . get_permalink() . '">' . __('Continue', 'roots') . '</a>';
}

add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
        if (is_feed()) {
                return $title;
        }

        $title .= get_bloginfo('name');

        return $title;
}

add_filter('wp_title', 'roots_wp_title', 10);


/**
 *      NZ INCLUDE FILES
 */
include 'nz/main-includes.php';