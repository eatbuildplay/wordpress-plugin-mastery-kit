(function($) {

  data = {
    action: 'airtable_connect_delete',
    index: connectionIndex
  }
  $.post( ajaxurl, data, function( response ) {
    
     response = JSON.PARSE(response);
     console.log( response )
    
  });

})( jQuery );
