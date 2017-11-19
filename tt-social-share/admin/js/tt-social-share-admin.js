(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */


	     $(function(){

	          // Let's set up some variables for the image upload and removing the image
	          var colorPickerInputs = $( '#tt-social-share-colorCode' );

	          // WordPress specific plugins - color picker and image upload
	          colorPickerInputs.wpColorPicker();

	     }); // End of DOM Ready

			 $( function() {
		     $( "#sortable" ).sortable({
					 placeholder: "ui-state-highlight",
					 update: function(event, ui) {
                var order = $("#sortable").sortable("toArray");
                $('#btnOrder').val(order.join(","));
            }});
		     $( "#sortable" ).disableSelection();
		   } );

			 $( function() {
				 if($('#tt-social-share-btnSm').prop('checked')) {
					 $('#sortable').removeClass('btnMd').removeClass('btnLg').addClass('btnSm');
				 }
				 if($('#tt-social-share-btnMd').prop('checked')) {
					 $('#sortable').removeClass('btnSm').removeClass('btnLg').addClass('btnMd');
				 }
				 if($('#tt-social-share-btnLg').prop('checked')) {
					 $('#sortable').removeClass('btnMd').removeClass('btnSm').addClass('btnLg');
				 }
			 } );


})( jQuery );
