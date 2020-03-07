<?php

/*
 * Full Calendar is a javascript calendar project that provides a "full size calendar" and is often useful to integrate into WordPress plugins that require a calendar display.
 */

/*
 * Example of the enqueue scripts and styles for Full Calendar
 * Full Calendar divides it's functionality into different packages, to use other Full Calendar packages we enqueue the package JS and CSS first. 
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

wp_enqueue_script(
  'wc-onsite-courses-js',
  WC_ONSITE_COURSES_PLUGIN_URL . 'assets/wc-onsite-courses.js',
  array( 'jquery', 'fullcalendar-core-js', 'fullcalendar-daygrid-js' ),
  '1.0.0',
  true
);

wp_enqueue_style(
  'fullcalendar-core-css',
  WC_ONSITE_COURSES_PLUGIN_URL . '/vendor/fullcalendar/packages/core/main.min.css',
  array(),
  '1.0.0',
  'all'
);

wp_enqueue_style(
  'fullcalendar-daygrid-css',
  WC_ONSITE_COURSES_PLUGIN_URL . 'vendor/fullcalendar/packages/daygrid/main.min.css',
  array(),
  '1.0.0',
  'all'
);
