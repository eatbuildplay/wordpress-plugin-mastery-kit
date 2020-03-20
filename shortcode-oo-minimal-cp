<?php 

namespace CommercialProperty;

class ListingTableShortcode {

  public $tag = 'listing-table';

  public function __construct() {
    add_action('init', array( $this, 'init'));
  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    $atts = shortcode_atts( array(), $atts, $this->tag );

    $template = new Template();
    $template->templatePath = 'templates/';
    $template->templateName = 'listing-table-widget';
    $template->data = array(
      'response' => $response,
      'meetings' => $meetings
    );
    return $template->get();

  }

}
