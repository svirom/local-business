<?php 
  
  // for correct displaying on category map (all places) when using ajax loading
  $category = get_category( get_query_var( 'cat' ) );
  $loop_places_map = new WP_Query( 
    array( 
    'post_type' => 'places',
    'cat' => $category->cat_ID,   
    'posts_per_page' => -1
    ) 
  );

  $locations_arr = [];

  while ( $loop_places_map->have_posts() ) : $loop_places_map->the_post();
    // print_r($post);
    $arr_el = [];
    array_push($arr_el, $post->post_title);
    array_push($arr_el, get_field('coord_lattitude'));
    array_push($arr_el, get_field('coord_longitude'));
    array_push($arr_el, get_post_permalink($post));
    
    settype($arr_el[1], 'float');
    settype($arr_el[2], 'float');

    array_push($locations_arr, $arr_el);
  endwhile;

  // var_dump($arr);
?>

<div class="row">
  <div class="col-12 map-wrapper">
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
      var map, infoWindow;
      function initMap() {
        var kyiv = {lat: 50.45466, lng: 30.5238};

        var map_styles = [
            {
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#ebe3cd"
                }
              ]
            },
            {
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "color": "#523735"
                }
              ]
            },
            {
              "elementType": "labels.text.stroke",
              "stylers": [
                {
                  "color": "#f5f1e6"
                }
              ]
            },
            {
              "featureType": "administrative",
              "elementType": "geometry.stroke",
              "stylers": [
                {
                  "color": "#c9b2a6"
                }
              ]
            },
            {
              "featureType": "administrative.land_parcel",
              "elementType": "geometry.stroke",
              "stylers": [
                {
                  "color": "#dcd2be"
                }
              ]
            },
            {
              "featureType": "administrative.land_parcel",
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "color": "#ae9e90"
                }
              ]
            },
            {
              "featureType": "landscape.natural",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#dfd2ae"
                }
              ]
            },
            {
              "featureType": "poi",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#dfd2ae"
                }
              ]
            },
            {
              "featureType": "poi",
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "color": "#93817c"
                }
              ]
            },
            {
              "featureType": "poi.park",
              "elementType": "geometry.fill",
              "stylers": [
                {
                  "color": "#a5b076"
                }
              ]
            },
            {
              "featureType": "poi.park",
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "color": "#447530"
                }
              ]
            },
            {
              "featureType": "road",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#f5f1e6"
                }
              ]
            },
            {
              "featureType": "road.arterial",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#fdfcf8"
                }
              ]
            },
            {
              "featureType": "road.highway",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#f8c967"
                }
              ]
            },
            {
              "featureType": "road.highway",
              "elementType": "geometry.stroke",
              "stylers": [
                {
                  "color": "#e9bc62"
                }
              ]
            },
            {
              "featureType": "road.highway.controlled_access",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#e98d58"
                }
              ]
            },
            {
              "featureType": "road.highway.controlled_access",
              "elementType": "geometry.stroke",
              "stylers": [
                {
                  "color": "#db8555"
                }
              ]
            },
            {
              "featureType": "road.local",
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "color": "#806b63"
                }
              ]
            },
            {
              "featureType": "transit.line",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#dfd2ae"
                }
              ]
            },
            {
              "featureType": "transit.line",
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "color": "#8f7d77"
                }
              ]
            },
            {
              "featureType": "transit.line",
              "elementType": "labels.text.stroke",
              "stylers": [
                {
                  "color": "#ebe3cd"
                }
              ]
            },
            {
              "featureType": "transit.station",
              "elementType": "geometry",
              "stylers": [
                {
                  "color": "#dfd2ae"
                }
              ]
            },
            {
              "featureType": "water",
              "elementType": "geometry.fill",
              "stylers": [
                {
                  "color": "#b9d3c2"
                }
              ]
            },
            {
              "featureType": "water",
              "elementType": "labels.text.fill",
              "stylers": [
                {
                  "color": "#92998d"
                }
              ]
            }
          ];

        map = new google.maps.Map(
          document.getElementById('map'), {
            zoom: 12, 
            center: kyiv,
            styles: map_styles
        });

        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            //infoWindow.setPosition(pos);
            //infoWindow.setContent('Location found.');
            //infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }

        setMarkers(map);
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        /*infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');*/
        //infoWindow.open(map);  
      }
    
      var locations = <?php echo json_encode( $locations_arr ); ?>;

      function setMarkers(map) {

        for (var i = 0; i < locations.length; i++) {
          var location = locations[i];

          var web = location[3] != '' ? '<a href="'+location[3]+'">'+location[0]+'</a>' : location[0];

          var contentString = '<div class="info-window">' + web + '</div>';

          var marker = new google.maps.Marker({
            position: {lat: location[1], lng: location[2]},
            map: map,
            title: location[0],
            info: contentString
          });
          
          var infowindow = new google.maps.InfoWindow({
            //content: contentString
          });
          marker.addListener('click', function() {
            // infowindow.open(map, marker);
            infowindow.setContent( this.info );	   
            infowindow.open( map, this );
          }); 
          // marker.addListener('mouseout', function() {	   
          //   infowindow.close( map, this );
          // });
        }
      }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFtMfRGX45XT3etX9K3QZvLbUBmacmTs4&callback=initMap"></script>
  </div>
</div>