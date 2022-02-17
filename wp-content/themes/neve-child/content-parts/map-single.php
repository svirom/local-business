<?php

  $lat = get_field('coord_lattitude');
  $long = get_field('coord_longitude');
  $post_title = $post->post_title;
  $post_url = get_post_permalink($post);

  settype($lat, 'float');
  settype($long, 'float');

?>

<div class="row">
  <div class="col-12 map-wrapper">
    <!--The div element for the map -->
    <div id="map"></div>
    <script>
      var map, infoWindow;
      var lat = <?php echo json_encode( $lat ); ?>;
      var long = <?php echo json_encode( $long ); ?>;
      var post_title = <?php echo json_encode( $post_title ); ?>;
      var post_url = <?php echo json_encode( $post_url ); ?>;

      function initMap() {
        var place_position = {lat: lat, lng: long};

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
            center: place_position,
            styles: map_styles
        });

        infoWindow = new google.maps.InfoWindow;

        var web = post_url !== '' ? '<a href="'+post_url+'">'+post_title+'</a>' : post_title;

        var contentString = '<div class="info-window">' + web + '</div>';

        var marker = new google.maps.Marker({
          position: {lat: lat, lng: long},
          map: map,
          title: post_title,
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

      }

    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFtMfRGX45XT3etX9K3QZvLbUBmacmTs4&callback=initMap"></script>
  </div>
</div>