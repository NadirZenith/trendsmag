<?php

function wpse35622_get_new_locale( $locale = false ) {
      $new_locale = get_user_meta( get_current_user_id(), 'wpse_locale', true );
      if ( $new_locale )
            return $new_locale;

      return $locale;
}

class SH_Pick_Lang {

      /**
       * A unique name for this plug-in
       */
      static $name = 'sh_pick_lang';

      /**
       * Hook the functions
       */
      public function __construct() {

            if ( isset( $_POST[ self::$name ] ) ) {
                  add_action( 'locale', array( $this, 'update_user' ) );
            }
            add_filter( 'locale', 'wpse35622_get_new_locale', 20 );
            add_action( 'wp_before_admin_bar_render', array( $this, 'admin_bar' ) );
      }

      /**
       * Update the user's option just in time! Only once mind...
       */
      function update_user( $locale ) {
            $save_locale = $_POST[ self::$name ];
            update_user_meta( get_current_user_id(), 'wpse_locale', $save_locale );
            remove_filter( current_filter(), __FUNCTION__ );
            return $locale;
      }

      /**
       * Add a really horrible looking dropdown menu that I'm sure Kaiser will make look fantastic.
       */
      function admin_bar() {
            global $wp_admin_bar;

            $wp_admin_bar->add_menu( array(
                  'id' => 'shlangpick',
                  'title' => $this->wpse_language_dropown(),
            ) );
      }

      /**
       * Generates a list of available locales.
       * Searches the wp-content/languages folder for files of the form xx_xx.mo
       * 
       * TODO Not all locales are of the form xx_xx.mo - we might miss some.
       * TODO Better way of gettin gthe wp-content/languages folder without a constant?
       */
      function wpse_language_dropown() {
            $name = self::$name;
            $locale = get_locale();
            $langs = get_available_languages();
            $langs[] = 'en_US';

            //For the labels (format_code_lang)
            require_once( ABSPATH . 'wp-admin/includes/ms.php');

            $html = "<form method='post'> ";
            $html .= "<select name='{$name}'>";
            foreach ( $langs as $lang ) {
                  $label = format_code_lang( $lang );
                  $html .= "<option " . selected( $lang, $locale, false ) . " value='{$lang}'>{$label}</option>";
            }
            $html .= "</select>"
                      . "<input type='submit' id='change lng' value='Change' onclick=''/>";
            /*$html .= get_submit_button( 'Change Language', 'secondary', 'submit', true );*/
            $html .= "</form >";

            return $html;
      }

}

// END Class
//Initiate...
/*$sh_pick_lang = new SH_Pick_Lang();*/
