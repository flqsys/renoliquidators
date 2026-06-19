import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import { FormToggle } from '@wordpress/components';

function EcommerceStoreOptimizerDemoProductsToggle() {
	const [checked, setChecked] = useState( ecommerce_store_optimizer_togglevars.demo_products_exist );
	const [componentHasMounted, setComponentHasMounted] = useState( false );

	useEffect( () => {
		setComponentHasMounted( true );
	}, [componentHasMounted] );

	useEffect( () => {
		// Prevent running the API fetch if the component is simply mounting.
		if ( ! componentHasMounted ) {
			return;
		}
		toggleDemoProductsOnServer();
	}, [checked] );

	function toggleDemoProductsOnServer() {
		var postData = new FormData();
		postData.append('demo_products_on', checked);

		fetch( ecommerce_store_optimizer_togglevars.demo_products_toggle_endpoint, {
			method: "POST",
			mode: "same-origin",
			credentials: "same-origin",
			body: postData
		} ).then(
			function( response ) {
				if ( response.status !== 200 ) {
					console.log('Looks like there was a problem. Status Code: ' + response.status);

					return;
				}

				// Examine the text in the response
				response.json().then(
					function( data ) {
						if ( data.success ) {
							location.reload();
						} else {
							alert( 'Unable to delete' );
						}
					}
				).catch(
					function( err ) {
						console.log('Fetch Error: ', err);
					}
				);
			}
		).catch(
			function( err ) {
				console.log('Fetch Error: ', err);
			}
		);
	
	}

	return(
		<FormToggle 
			checked={ checked }
			onChange={ () => {
				setChecked( checked ? false : true );
			} }
		/>
	);
}

window.renderEcommerceStoreOptimizerDemoProductsToggle = function renderEcommerceStoreOptimizerDemoProductsToggle() {
	ReactDOM.render(<EcommerceStoreOptimizerDemoProductsToggle/>, document.getElementById('ecommerce-store-optimizer-toggle'));  
}
renderEcommerceStoreOptimizerDemoProductsToggle();

window.renderEcommerceStoreOptimizerDemoProductsToggleBlank = function renderEcommerceStoreOptimizerDemoProductsToggleBlank() {
	ReactDOM.render(<EcommerceStoreOptimizerDemoProductsToggle/>, document.getElementById('ecommerce-store-optimizer-toggleblank'));  
}
renderEcommerceStoreOptimizerDemoProductsToggleBlank();