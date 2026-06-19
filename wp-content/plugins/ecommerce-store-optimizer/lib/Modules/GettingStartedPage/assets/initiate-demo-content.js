// Send a fetch call to spin up the demo products.

var esoDemoContentImportIsComplete = false;

fetch( eso_initiate_demo_content.spin_up_demo_content_endpoint_url, {
	method: "POST",
	mode: "same-origin",
	credentials: "same-origin",
} ).then(function() {
	// When fetch is complete, hide the importing notifier.
	document.getElementById("eso-importing").style.display = "none";
	// Show the success message.
	document.getElementById("eso-import-success").style.display = "block";
	// Show the View site button.
	document.getElementById("eso-view-website-button").style.display = "block";
	
	esoDemoContentImportIsComplete = true;
} );

window.addEventListener("beforeunload", function (e) {
	if ( ! esoDemoContentImportIsComplete ) {
		(e || window.event).returnValue = true; 
		return true;
	}
 });