<?php

/**
 *      Hide default posts from menus
 */
add_action('admin_menu', 'nz_hide_default_post');

function nz_hide_default_post() {
        global $menu;
        global $submenu;
        /* d($menu); */
        /* d($submenu); */
        unset($menu[5]);
        unset($submenu['edit.php'][5]);
        unset($submenu['edit.php'][10]);
        unset($submenu['edit.php'][16]);
}

/* add_action('admin_bar_menu', 'modify_admin_bar'); */
/* add_action('add_admin_bar_menus', 'modify_admin_bar'); */

function modify_admin_bar() {
        global $wp_admin_bar;
        // do something with $wp_admin_bar;
        d($wp_admin_bar);
}

/**
 *  change default post name to news
 */
/* add_action('admin_menu', 'nz_change_post_label'); */

function nz_change_post_label() {
        global $menu;
        global $submenu;
        $menu[5][0] = 'News';
        $submenu['edit.php'][5][0] = 'News';
        $submenu['edit.php'][10][0] = 'Add News item'; //admin sidebar
        $submenu['edit.php'][16][0] = 'News Tags';
}

/* add_action('init', 'nz_change_post_object'); */

function nz_change_post_object() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Noticias'; //admin list news title
        $labels->singular_name = 'News item22';
        $labels->add_new = 'Add News item'; //admin edit post new shortcut
        $labels->add_new_item = 'Add News item'; //admin edit new post title
        $labels->edit_item = 'Edit News item'; //admin edit post title
        $labels->new_item = 'News6';
        $labels->view_item = 'View News item';   //View button from admin 
        $labels->search_items = 'Search News'; //admin list news search input
        $labels->not_found = 'No News found9';
        $labels->not_found_in_trash = 'No News found in Trash';
        $labels->all_items = 'All News10';
        $labels->menu_name = 'News11';
        $labels->name_admin_bar = 'News item'; //admin top bar
}

/**
 *  hide default post type
 */
function nz_hide_default_post_type() {
        remove_menu_page('edit.php');
}

/*add_action('admin_menu', 'nz_hide_default_post_type');*/
