<?php

add_filter( 'acf/settings/path', 'my_acf_settings_path' );

function nz_acf_settings_path( $path ) {

      // update path
      $path = get_stylesheet_directory() . '/lib/nz/vendor/advanced-custom-fields/';
      // return
      return $path;
}

add_filter( 'acf/settings/dir', 'my_acf_settings_dir' );

function my_acf_settings_dir( $dir ) {

      // update path
      $dir = get_stylesheet_directory_uri() . '/lib/nz/vendor/advanced-custom-fields/';
      // return
      return $dir;
}

/* add_filter( 'acf/settings/show_admin', '__return_false' ); */


//custom fields

if ( function_exists( "register_field_group" ) ) {
      register_field_group( array(
            'id' => 'acf_evento',
            'title' => 'Evento',
            'fields' => array(
                  array(
                        'key' => 'field_54124819e9275',//fecha inicio
                        'label' => 'Fecha inicio',
                        'name' => 'event_begin_date',
                        'type' => 'date_time_picker',
                        'required' => 1,
                        'show_date' => 'true',
                        'date_format' => 'dd/mm/yy',
                        'time_format' => 'H:mm',
                        'show_week_number' => 'false',
                        'picker' => 'slider',
                        'save_as_timestamp' => 'true',
                        'get_as_timestamp' => 'true',
                  ),
                  array(
                        'key' => 'field_54124862e9276',//fecha final
                        'label' => 'Fecha final',
                        'name' => 'event_end_date',
                        'type' => 'date_time_picker',
                        'show_date' => 'true',
                        'date_format' => 'dd/mm/yy',
                        'time_format' => 'H:mm',
                        'show_week_number' => 'false',
                        'picker' => 'slider',
                        'save_as_timestamp' => 'true',
                        'get_as_timestamp' => 'true',
                  ),
                  array(
                        'key' => 'field_541248a8d988a',//precio
                        'label' => 'Precio',
                        'name' => 'event_price',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => 0,
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                  ),
                  array(
                        'key' => 'field_541248d6d988b',//condiciones del precio
                        'label' => 'Condiciones del precio',
                        'name' => 'event_price_conditions',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                  ),
                  array(
                        'key' => 'field_541248f9d988c',
                        'label' => 'Nombre del lugar',//nombre del lugar
                        'name' => 'event_place_name',
                        'type' => 'text',
                        'required' => 1,
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                  ),
                  array(
                        'key' => 'field_54124920d988d',
                        'label' => 'Dirección',       //direccion goole maps
                        'name' => 'event_place_direction',
                        'type' => 'google_map',
                        'instructions' => '41.400505,2.173176',
                        'required' => 1,
                        'center_lat' => '41.400505',
                        'center_lng' => '2.173176',
                        'zoom' => '',
                        'height' => '',
                  ),
                  array(
                        'key' => 'field_541249acd988e',
                        'label' => 'Email de confirmación', //email confirmacion
                        'name' => 'event_confirmation_email',
                        'type' => 'email',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                  ),
                  array(
                        'key' => 'field_541249f6d988f',
                        'label' => 'Evento destacado',      //true false destacar evento
                        'name' => 'event_featured',
                        'type' => 'true_false',
                        'message' => '',
                        'default_value' => 0,
                  ),
                  array(
                        'key' => 'field_54317b1d3a21f',
                        'label' => 'Place',           //relational top-place post type
                        'name' => 'place',
                        'type' => 'post_object',
                        'post_type' => array(
                              0 => 'top-place',
                        ),
                        'taxonomy' => array(
                              0 => 'all',
                        ),
                        'allow_null' => 1,
                        'multiple' => 0,
                  ),
                  array(
                        'key' => 'field_5431841a46105',
                        'label' => 'Ciudad',
                        'name' => 'event_city',
                        'type' => 'text',
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'formatting' => 'html',
                        'maxlength' => '',
                  ),
            ),
            'location' => array(
                  array(
                        array(
                              'param' => 'post_type',
                              'operator' => '==',
                              'value' => 'event',
                              'order_no' => 0,
                              'group_no' => 0,
                        ),
                  ),
            ),
            'options' => array(
                  'position' => 'normal',
                  'layout' => 'no_box',
                  'hide_on_screen' => array(
                  ),
            ),
            'menu_order' => 0,
      ) );
      register_field_group( array(
            'id' => 'acf_place',
            'title' => 'Place',
            'fields' => array(
                  array(
                        'key' => 'field_54314ae1ded28',
                        'label' => 'Place address',
                        'name' => 'place_address',
                        'type' => 'google_map',
                        'required' => 1,
                        'center_lat' => '',
                        'center_lng' => '',
                        'zoom' => '',
                        'height' => '',
                  ),
            ),
            'location' => array(
                  array(
                        array(
                              'param' => 'post_type',
                              'operator' => '==',
                              'value' => 'top-place',
                              'order_no' => 0,
                              'group_no' => 0,
                        ),
                  ),
            ),
            'options' => array(
                  'position' => 'normal',
                  'layout' => 'no_box',
                  'hide_on_screen' => array(
                  ),
            ),
            'menu_order' => 0,
      ) );
}

//credits text field
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_credits',
		'title' => 'Credits',
		'fields' => array (
			array (
				'key' => 'field_544a5e2824515',
				'label' => 'Credits',
				'name' => 'post_credits',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
