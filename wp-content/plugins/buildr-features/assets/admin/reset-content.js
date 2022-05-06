jQuery(document).ready(function ($) {
    
    $( '#reset-content' ).click( function() {
        
        var r = confirm( 'Are you sure? This cannot be un-done' )
        
        if( !r ) {
            return
        }
        
        $.ajax({
            url:    buildr.ajaxUrl,
            method: 'POST',
            data : {
                action  : 'reset_content',
                nonce   : buildr.nonce
            },
            success: function( response ) {
                alert( 'Complete' )
            }
        })
        
    })
    
    
});
