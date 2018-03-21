<?php
/**
 * Plugin Name: Gravity Forms Google Maps
 * 
 * Description: Field with google maps support
 * Version: 0.1 beta
 * Author: Nadir Zenith
 * Author URI: http://www.SOON.net/
 * License:  
  DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
  Version 2, December 2004

  Copyright (C) 2004 Sam Hocevar <sam@hocevar.net>

  Everyone is permitted to copy and distribute verbatim or modified
  copies of this license document, and changing it is allowed as long
  as the name is changed.

  DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
  TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION

  0. You just DO WHAT THE FUCK YOU WANT TO.
 */
// Add a custom field button to the advanced to the field editor
add_filter( 'gform_add_field_buttons', 'nz_add_google_maps_field' );

function nz_add_google_maps_field( $field_groups ) {
      foreach ( $field_groups as &$group ) {
            if ( $group[ "name" ] == "advanced_fields" ) { // to add to the Advanced Fields
                  //if( $group["name"] == "standard_fields" ){ // to add to the Standard Fields
                  //if( $group["name"] == "post_fields" ){ // to add to the Standard Fields
                  $group[ "fields" ][] = array(
                        "class" => "button",
                        "value" => __( "Google Maps", "gravityforms" ),
                        "onclick" => "StartAddField('google_maps');"
                  );
                  break;
            }
      }
      return $field_groups;
}

// Adds title to GF custom field
add_filter( 'gform_field_type_title', 'nz_google_maps_title' );

function nz_google_maps_title( $type ) {
      if ( $type == 'image_preview' )
            return __( 'Google Maps', 'gravityforms' );
}

// Now we execute some javascript technicalitites for the field to load correctly
add_action( "gform_editor_js", "nz_gform_google_maps_js" );

function nz_gform_google_maps_js() {
      ?>

      <script type='text/javascript'>

            jQuery(document).ready(function($) {
                  fieldSettings["google_maps"] = ".label_setting, .description_setting, .rules_setting, .error_message_setting, .css_class_setting";

                  //binding to the load field settings event to initialize the checkbox
                  /*                        
                   $(document).bind("gform_load_field_settings", function(event, field, form) {
                   jQuery("#field_nz_set_featured").attr("checked", field["nz_set_featured"] == true);
                   jQuery("#field_nz_image_sizes").attr("value", field["nz_image_sizes"]);
                   });
                   * */

            });

      </script>
      <?php
}


// Adds the input area to the external side
add_action( "gform_field_input", "nz_gform_google_maps_field_input", 10, 5 );

function nz_gform_google_maps_field_input( $input, $field, $value, $lead_id, $form_id ) {

      if ( $field[ "type" ] == "google_maps" ) {
            /* d($input); */
            /* d($field); */

            $value = apply_filters( 'nz_gform_google_maps_value_' . $form_id . '_' . $field[ 'id' ], $value );
            /* d($value); */

            $street = json_decode( $value );
            /* d($street); */

            if ( $street )
                  $street = $street->address;

            $id = 'input_' . $form_id . '_' . $field[ 'id' ];
            $input_field = '<input type="hidden" id="' . $id . '" name="input_' . $field[ 'id' ] . '" value="' . htmlspecialchars( $value ) . '"  />';
            $search_field = '<input type="text" name="_nz_coolplace_address_search" id="_nz_coolplace_address_search" value="' . htmlspecialchars( $street ) . '" placeholder="Type in an address" class="medium" size="30" />';

            $map_canvas = '<div id="map_canvas" class="map_canvas"></div>';
            $input = '<div class="ginput_container">' . $input_field . $search_field . $map_canvas . '</div>';
      }

      return $input;
}

// Add a custom class to the field li
add_action( "gform_field_css_class", "nz_gform_google_maps_custom_class", 10, 3 );

function nz_gform_google_maps_custom_class( $classes, $field, $form ) {
      if ( $field[ "type" ] == "google_maps" ) {
            $classes .= " nz_gform_google_maps ";
      }

      return $classes;
}

// Add a script to the display of the particular form only if image preview field is being used
add_action( 'gform_enqueue_scripts', 'nz_gform_google_maps_enqueue_scripts', 10, 2 );

function nz_gform_google_maps_enqueue_scripts( $form, $ajax ) {
      // cycle through fields to see if image_preview is being used
      foreach ( $form[ 'fields' ] as $field ) {
            if ( $field[ 'type' ] == 'google_maps' ) {
                  add_action( 'wp_footer', 'nz_gform_google_maps_script', 10, 2 );

                  // Register the script first.
                  /* wp_register_script('nz_gform_google_maps_geocomplete', plugins_url('jquery.geocomplete.min.js', __FILE__), array("jquery")); */

                  // The script can be enqueued now or later.
                  /* wp_enqueue_script('nz_gform_google_maps_api'); */
                  /* wp_enqueue_script('nz_gform_google_maps_geocomplete'); */

                  break;
            }
      }
}

function nz_gform_google_maps_script() {
      ?>
      <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&sensor=true"></script>
      <style>
            .map_canvas {
                  width: 98%;
                  margin: 5px auto;
                  height: 300px;
            }
      </style>
      <script>
                  jQuery(function($) {
                        $form = $('#gform_1');
                        
                        $form.bind("keyup keypress", function(e) {
                              var code = e.keyCode || e.which;
                              if (code == 13) {
                                    e.preventDefault();
                                    return false;
                              }
                        });
                        //get current address from hidden field
                        $input = $('#input_1_11');
                        jsonAdress = $.parseJSON($input.val());
                        //if is not empty build LatLng
                        //else default to bcn
                        if (jsonAdress) {
                              /*if (jsonAdress !== null && typeof jsonAdress === 'object') {*/
                              currentLatlng = new google.maps.LatLng(jsonAdress.lat, jsonAdress.lng);
                              /*$('#_nz_coolplace_address_search').val(jsonAdress.address);*/
                        } else {
                              currentLatlng = new google.maps.LatLng(41.382573, 2.175293);
                        }

                        // vars
                        var args = {
                              zoom: 15,
                              center: currentLatlng,
                              mapTypeId: google.maps.MapTypeId.ROADMAP
                        };

                        // create map
                        map = new google.maps.Map(document.getElementById("map_canvas"), args);
                        console.log(map);

                        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('_nz_coolplace_address_search'));
                        autocomplete.map = map;
                        autocomplete.bindTo('bounds', map);

                        var marker = new google.maps.Marker({
                              position: currentLatlng,
                              map: map
                        });

                        //process place change
                        google.maps.event.addListener(autocomplete, 'place_changed', function(e) {
                              var place = autocomplete.getPlace();

                              //if no place
                              if (!place.geometry) {
                                    $input.val('');
                                    return;
                              }

                              // If the place has a geometry, then present it on a map. ??
                              if (place.geometry.viewport) {
                                    map.fitBounds(place.geometry.viewport);
                              } else {
                                    map.setCenter(place.geometry.location);
                                    map.setZoom(17);  // Why 17? Because it looks good.
                              }

                              //build json to save full address latlong
                              var save = {
                                    address: place.formatted_address,
                                    lat: place.geometry.location.k,
                                    lng: place.geometry.location.B
                              };

                              $input.val(JSON.stringify(save));

                              marker.setPosition(place.geometry.location);
                              marker.setVisible(true);

                        });


                  });
      </script>
      <?php
}

add_action( "gform_after_submission", "nz_gform_google_maps_after_submission", 10, 2 );

function nz_gform_google_maps_after_submission( $entry, $form ) {
      foreach ( $form[ 'fields' ] as $field ) {
            if ( 'google_maps' == $field[ 'type' ] ) {
                  $action_name = 'nz_gform_google_maps_after_submission_' . $form[ 'id' ] . '_' . $field[ 'id' ];
                  do_action( $action_name
                            , array( 'field' => $field, 'entry' => $entry )
                  );
            }
      }
}
