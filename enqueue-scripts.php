<?php 

/*
 * Generic template for enqueue script
 */
wp_enqueue_script( 
  'handle-js', 
  CONSTANT_PLUGIN_URL . 'assets/js/file.js', 
  array( 'jquery' ), 
  '1.0.0', 
  true
);

/*
 * Real example from plugin WC Onsite Courses
 * wp_enqueue_script() call only, in practice this is placed in a method that is hooked to the action "wp_enqueue_scripts"
 */
wp_enqueue_script(
  'fullcalendar-core-js',
  WC_ONSITE_COURSES_PLUGIN_URL . 'vendor/fullcalendar/packages/core/main.min.js',
  array( 'jquery' ),
  '1.0.0',
  true
);

wp_enqueue_script(
  'fullcalendar-daygrid-js',
  WC_ONSITE_COURSES_PLUGIN_URL . 'vendor/fullcalendar/packages/daygrid/main.min.js',
  array( 'jquery' ),
  '1.0.0',
  true
);

/*
 * Hook call in PHP class
 */
do_action('wp_enqueue_scripts', array( $this, 'scripts' ));
public function scripts() {
  
  wp_enqueue_script( 
    'handle-js', 
    CONSTANT_PLUGIN_URL . 'assets/js/file.js', 
    array( 'jquery' ), 
    '1.0.0', 
    true
  );
  
}
