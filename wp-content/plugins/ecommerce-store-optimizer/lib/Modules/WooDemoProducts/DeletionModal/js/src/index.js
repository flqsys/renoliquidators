import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import { Button, Modal } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

function EcommerceStoreOptimizerDemoProductsDeletionModal() {
	const [modalOpen, setModalOpen] = useState( false );
	const [ deletionState, setDeletionState ] = useState( 'initial' );

	function closeModal() {
		setModalOpen( false );
	}
	
	function deleteAllDemoProucts() {
		setDeletionState( 'in_progress' );

		fetch( ecommerce_store_optimizer_demoproductdeletionmodalvars.demo_products_modal_endpoint, {
			method: 'POST',
			mode: 'same-origin',
			credentials: 'same-origin',
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
							setDeletionState( 'success' );
							location.reload();
						} else {
							setDeletionState( 'error' );
						}
					}
				).catch(
					function( err ) {
						console.log('Fetch Error: ', err);
						setDeletionState( 'error' );
					}
				);
			}
		).catch(
			function( err ) {
				console.log('Fetch Error: ', err);
				setDeletionState( 'error' );
			}
		);	
	}
	
	function maybeRenderInitialDeletionState() {
		if ( 'initial' === deletionState ) {
			return (
				<>
					<p>{ __( 'Would you like to remove all demo products?', 'ecommerce-store-optimizer' ) }</p>
					<Button
						isSecondary
						onClick={ closeModal }
						style={{marginRight:'10px'}}
						aria-label={ __( 'Do not remove all demo products, take no action.', 'ecommerce-store-optimizer' ) }
					>
						{ __( 'No thanks', 'ecommerce-store-optimizer' ) }
					</Button>
					<Button
						isPrimary
						onClick={ deleteAllDemoProucts }
						aria-label={ __( 'Remove all demo products', 'ecommerce-store-optimizer' ) }
					>
						{ __( 'Yes, remove all demo products', 'ecommerce-store-optimizer' ) }
					</Button>
				</>
			)
		}
	}
	
	function maybeRenderInProgressDeletionState() {
		if ( 'in_progress' === deletionState ) {
			return <p>{ __( 'Deleting all demo products...', 'ecommerce-store-optimizer' ) }</p>;
		}
	}
	
	function maybeRenderSuccessfulDeletionState() {
		if ( 'success' === deletionState ) {
			return <p>{ __( 'All demo products deleted. Refreshing the page.', 'ecommerce-store-optimizer' ) }</p>;
		}
	}
	
	function maybeRenderErrorDeletionState() {
		if ( 'error' === deletionState ) {
			return <p>{ __( 'Unable to delete demo products.', 'ecommerce-store-optimizer' ) }</p>;
		}
	}
	
	function maybeRenderInlineRowAction() {
		if ( ! modalOpen ) {
			return (
				<a 
					className="submitdelete"
					aria-label={ __( 'Remove all demo products', 'ecommerce-store-optimizer' ) }
					onClick={( event ) => setModalOpen( true ) }
					style={{color: '#a00', cursor: 'pointer'}}
					>
						{ __( 'Remove all demo products', 'ecommerce-store-optimizer' ) }
				</a>
			)
		}
	}
	
	function maybeRenderModal() {
		if ( modalOpen ) {
			return(
				<Modal
					title={ __( 'Remove all demo products?', 'ecommerce-store-optimizer' ) }
					onRequestClose={ closeModal }>
					{ maybeRenderInitialDeletionState() }
					{ maybeRenderInProgressDeletionState() }
					{ maybeRenderSuccessfulDeletionState() }
					{ maybeRenderErrorDeletionState() }
				 </Modal>
			);
		}
	}
	
	return(
		<>
			{ maybeRenderInlineRowAction() }
			{ maybeRenderModal() }
		</>
	)

}

function populateRowActions(){
	
	const row_action_element_exists = document.querySelector( '.ecommerce-store-optimizer-deletedemoproductsmodal' );

	if ( row_action_element_exists ) {

		var row_action_elements = document.querySelectorAll( '.ecommerce-store-optimizer-deletedemoproductsmodal' );

		var counter = 0;

		row_action_elements.forEach(function( row_action_element ) {
			ReactDOM.render(<EcommerceStoreOptimizerDemoProductsDeletionModal/>, row_action_element );  
		});
	}
}
populateRowActions();
