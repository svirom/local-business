/**
 * Location Module (LITE) for Contact Form 7
 *
 * @ver 1.1.0
 */

(function( $ ) {
	'use strict';

	/**
	 * Reload funcion for form style
	 */
	var ui_reload = function (){
		var width = $('.wpcf7').outerWidth();
		var buttonwidth = $('#cf7-geocode-buttons').outerWidth();
		buttonwidth = buttonwidth + $('#geocode-reset').outerWidth();
		var height = $('#cf7-geocode-address').outerHeight();
		$('#cf7-geocode-address').css( "height", height+'px' );
		var height = $('#cf7-geocode-address').outerHeight();
		$('.cf7-loc-button').css( "line-height", height+'px' );
		width = width - buttonwidth -5;
		$('#cf7-geocode-address').css( "width", width );
	};
	var map;

	/**
	 * On Load Functions
	 */
	$(window).load(function(){
			ui_reload();
		}
	);

	/**
	 * On Ready Functions
	 */
	$(document).ready(function(e){

		if ($('#cf7-location-map').length) {
			// Get Option Value
			var def_latitude = CF7LM.deflat;
			var def_longitude = CF7LM.deflng;
			var def_zoom = parseInt(CF7LM.defzoom);
			var def_err_msg = CF7LM.def_err_msg;
			var def_maps_view = CF7LM.mapsView;
			var cf7_mrkr_enable = CF7LM.show_marker_start_location;

			/**
			 * Map Init
			 */
			map = new GMaps({
				div: '#cf7-location-map',
				scrollwheel: false,
				mapTypeControl: false,
				streetViewControl: false,
				lat: def_latitude,
				lng: def_longitude,
				zoom: def_zoom,
				mapType: def_maps_view
			});

			if(cf7_mrkr_enable){
				map.addMarker({
					lat: def_latitude,
					lng: def_longitude,
				});	
			}
			

			/**
			 * Get Location by GPS
			 */
			$('#cf7-get-gps').click(function() {
				if (navigator.geolocation) {

					navigator.geolocation.getCurrentPosition(
						// Success callback
						function (position) {

							/*
							 position is an object containing various information about
							 the acquired device location:

							 position = {
							 coords: {
							 latitude - Geographical latitude in decimal degrees.
							 longitude - Geographical longitude in decimal degrees.
							 altitude - Height in meters relative to sea level.
							 accuracy - Possible error margin for the coordinates in meters.
							 altitudeAccuracy - Possible error margin for the altitude in meters.
							 heading - The direction of the device in degrees relative to north.
							 speed - The velocity of the device in meters per second.
							 }
							 timestamp - The time at which the location was retrieved.
							 }
							 */
							var gpslat = position.coords.latitude;
							var gpslng = position.coords.longitude;

							//Reverse Geocoding after marker drop
							GMaps.geocode({
								lat: gpslat,
								lng: gpslng,
								callback: function (results, status) {
									if (status == 'OK') {
										// Update coords
										$('#cf7-location-lat').val(gpslat);
										$('#cf7-location-lng').val(gpslng);

										var url = 'http://maps.google.com/maps?z=12&q=loc:';
										url += gpslat;
										url += '+';
										url += gpslng;
										$('#cf7-location-url').val(url);

										$('#cf7-geocode-address').val(results["0"].formatted_address);
										map.setCenter(gpslat, gpslng);
										map.removeMarkers();

										map.addMarker({
											lat: gpslat,
											lng: gpslng,

											// Drag and Drop Reverse geocode
											draggable: true,
											dragend: function(e) {

												// Update coords
												$('#cf7-location-lat').val(e.latLng.lat());
												$('#cf7-location-lng').val(e.latLng.lng());
												$('#cf7-location-url').val('http://maps.google.com/maps?z=12&q=loc:'+e.latLng.lat()+'+'+e.latLng.lng());

												//Reverse Geocoding after marker drop
												GMaps.geocode({
													lat: e.latLng.lat(),
													lng: e.latLng.lng(),
													callback: function(results, status) {
														if (status == 'OK') {
															$('#cf7-geocode-address').val(results["0"].formatted_address);
														}
													}
												});
											}
										});
										// Zoom on the marker
										map.setZoom(13);
									}
								}
							});
						}
					);
				}
			});
			/**
			 * Geocode the input on "SET" button press
			 */
			$( '#geocode-link' ).click(function() {
				// Inserisco un ritardo per evitare che venga eseguita una chiamata ad ogni keypress
				var geocodeinput = GMaps.geocode({
					address: $('#cf7-geocode-address').val(),
					callback: function (results, status) {
						if (status == 'OK') {
							var latlng = results[0].geometry.location;
							// Centro la mappa dopo il geocode
							map.setCenter(latlng.lat(), latlng.lng());
							// Scrivo le coordinate nei campi nascosti
							$('#cf7-location-lat').val(latlng.lat());
							$('#cf7-location-lng').val(latlng.lng());

							// I Build the url
							//example: http://maps.google.com/maps?z=12&q=loc:38.9419+-78.3020
							var url = 'http://maps.google.com/maps?z=12&q=loc:';
							url += latlng.lat();
							url += '+';
							url += latlng.lng();
							$('#cf7-location-url').val(url);
							// Rimuovo eventuali marker presenti
							map.removeMarkers();
							// Add marker with the new position
							map.addMarker({
								lat: latlng.lat(),
								lng: latlng.lng(),

								// Drag and Drop Reverse geocode
								draggable: true,
								dragend: function(e) {

									// Update coords
									$('#cf7-location-lat').val(e.latLng.lat());
									$('#cf7-location-lng').val(e.latLng.lng());

									// I Build the url
									//example: http://maps.google.com/maps?z=12&q=loc:38.9419+-78.3020
									//url = 'http://maps.google.com/maps?z=12&q=loc:';
									//url += e.latLng.lat();
									//url += '+';
									//url += e.latLng.lng();
									$('#cf7-location-url').val('http://maps.google.com/maps?z=12&q=loc:'+e.latLng.lat()+'+'+e.latLng.lng());

									//Reverse Geocoding after marker drop
									GMaps.geocode({
										lat: e.latLng.lat(),
										lng: e.latLng.lng(),
										callback: function(results, status) {
											if (status == 'OK') {
												$('#cf7-geocode-address').val(results["0"].formatted_address);
											}
										}
									});
								}
							});
							// Zoom on the marker
							map.setZoom(13);
						}else{
							alert(def_err_msg);
						}
					}
				});
			});
			$( '#cf7-geocode-reset' ).click(function() {
				map = new GMaps({
					div: '#cf7-location-map',
					scrollwheel: false,
					mapTypeControl: false,
					streetViewControl: false,
					lat: def_latitude,
					lng: def_longitude,
					zoom: def_zoom,
					mapType: def_maps_view
				});

				$('#cf7-location-lat').val('');
				$('#cf7-location-lng').val('');
				$('#cf7-location-url').val('');
				$('#cf7-geocode-address').val('');
			});
		}
	});

	/**
	 * Refresh the map & gui when windows is resized
	 */
	$( window ).resize(function() {
		if ($('#cf7-location-map').length) {
			map.refresh();
			ui_reload();
		}
	});

})( jQuery );
