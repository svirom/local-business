<?php 
  // $loop_places = new WP_Query( 
  //   array( 
  //   'post_type' => 'places',
  //   ) 
  // );

  $locations_arr = [];
  while ( $loop_places->have_posts() ) : $loop_places->the_post();
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

        map = new google.maps.Map(
          document.getElementById('map'), {
            zoom: 12, 
            center: kyiv
        });

        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Location found.');
            infoWindow.open(map);
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