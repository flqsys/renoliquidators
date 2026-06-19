(function( $ ) {
	'use strict';

	// woocommerce_variation_has_changed
	$(document).on('show_variation', '.variations_form', function(e, variation) {

		if(!variation) {
			return;
		}

		if(variation.variation_id == "") {
			return;
		}

		jQuery.ajax({
			url: woocommerce_ultimate_tabs_options.ajax_url,
			type: 'post',
			dataType: 'JSON',
			data: {
				action: 'woocommerce_ultimate_tabs_get_variation_tabs',
				variation_id: variation.variation_id,
			},
			success : function( response ) {

				if(!response.status) {
					return;
				}

				if(response.tabs == "") {
					return;
				}

				$.each(response.tabs, function(i, index) {

					if(index.content == "") {
						return;
					}
					
					var tabContent = $('#tab-custom-tab-' + i + ', #content_tab_custom-tab-' + i);
					if(tabContent.length < 1)  {
						return;
					}

					tabContent.html(index.content);

				});

				
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
			}						
		});

	});
})( jQuery );
