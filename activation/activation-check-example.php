<?php

/**
 *
 * Plugin Name: Polly Text-to-Speech Pro
 * Plugin URI: https://eatbuildplay.com/plugins/polly-text-to-speech-pro/
 * Description: Provides enhancements and premium features for Polly Text-to-Speech.
 * Version: 1.0.0
 * Author: Casey Milne, Eat/Build/Play
 * Author URI: https://eatbuildplay.com/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 */

namespace PollyPro;

class Plugin {

  public static function activation() {

    $polly = 'polly-text-to-speech/polly-text-to-speech.php';
    $version_to_check = '1.0.0';
    $error = false;

    if(!file_exists(WP_PLUGIN_DIR.'/'.$polly)) {
      $error = true;
    }

    if( !$error ) {
      $data = get_plugin_data( WP_PLUGIN_DIR.'/'.$polly );
      $error = !version_compare ( $data['Version'], $version_to_check, '>=') ? true : false;
    }

    if( !$error && !is_plugin_active( $polly ) ) {
      $error = true;
    }

    if ( $error ) {
      echo '<h3>'.__('Polly TTS Pro requires the base (free) version of Polly TTS.', 'polly-pro').'</h3>';
      @trigger_error(__('Please install and activate Polly Text-to-Speech first before activating the pro extension for Polly TTS.', 'polly-pro'), E_USER_ERROR);
    }

  }

}

register_activation_hook(__FILE__, ['\PollyPro\Plugin','activation']);
