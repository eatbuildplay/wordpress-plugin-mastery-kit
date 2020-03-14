(function($) {

  data = {
    action: 'airtable_connect_delete',
    index: connectionIndex
  }
  $.post( ajaxurl, data, function( response ) {
    if ( response.status == 'success' ) {

    } else {

    }
  });

})( jQuery );
