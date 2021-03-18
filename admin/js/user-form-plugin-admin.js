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

	 $.noConflict();
	 jQuery(document).ready(function(){
	 	$("#user_form_submit").on('submit', function(evt){
	 		evt.preventDefault();
	 		var form = $(this);
	 		var url = form.attr('action');
	 		var rowCount = $('#usersList tr').length;
	 		$.ajax({
	 			type:'POST',
	 			url:url,
	 			data:form.serialize(),
	 			dataType:'JSON',
	 			success:function(result){
	 				if(result.success==true){
	 					document.getElementById("user_form_submit").reset();
	 					if(rowCount>10){
	 						$('#usersList > tbody > tr:last').remove();
	 					}
	 					$('#usersList > tbody > tr:first').before("<tr><td>" + result.user_name + "</td><td>" + result.user_email + "</td><td>" + result.user_role + "</td></tr>");

	 					$('#addUser').modal('hide');
	 				}
	 			},
	 			error:function(err){
	 				console.log(err.responseText);
	 			}
	 		});
	 	});
	 });

	})( jQuery );
