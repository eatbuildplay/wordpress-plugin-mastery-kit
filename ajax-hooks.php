<?php 

class SomeClass {

  public function __constructor() {
  
    add_action( 'wp_ajax_airtable_connect_api_test', array( $this, 'apiTest'));
    
  }
  
  public function apiTest() {
    
    $response = array(
      'message' => 'This response message will become vailable in the return in your JS ajax call'
    );
    print json_encode( $response );
    
    // end ajax hook callbacks safely
    wp_die();
  
  }  
  
}


