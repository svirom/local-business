<?php
/**
* Template Name: Home Page
*
* @package understrap
*
*
*/

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper main-page" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
      <div class="col-12">

        <main class="site-main" id="main">
          <div class="row">
            <div class="col-12">
              <h1><?php echo _e('Заклади', 'understrap') ?></h1>
            </div>
          </div>
          <div class="row justify-content-center">
            <?php $categories = get_categories(array('hide_empty' => false));
              foreach($categories as $category) {
                if ( $category->slug != 'uncategorized' ) {; ?>
                  <div class="col-md-4 py-2">
                    <div class="category-card">
                      <h3>
                        <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                      </h3>
                    </div>
                  </div>
                <?php }  
              }
            ?>
          </div>
        </main><!-- #main -->

      </div>
    </div><!-- .row -->
    
    <?php 
      $loop_places = new WP_Query( 
        array( 
        'post_type' => 'places',
        ) 
      );

      @require 'map.php';

      // $arr = [];
      // while ( $loop_places->have_posts() ) : $loop_places->the_post();
      //   // print_r($post);
      //   // print_r(get_post_permalink($post));
      //   $arr_el = [];
      //   array_push($arr_el, $post->post_title);
      //   array_push($arr_el, get_field('coord_lattitude'));
      //   array_push($arr_el, get_field('coord_longitude'));
      //   array_push($arr_el, get_post_permalink($post));
        
      //   settype($arr_el[1], 'float');
      //   settype($arr_el[2], 'float');
      //   array_push($arr, $arr_el);
      // endwhile;

      // var_dump($arr);
    ?>

<!--<div class="row">
      <div class="col-12 mt-4">
        
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

            // var marker = new google.maps.Marker({
            //   position: kyiv, 
            //   map: map,
            //   title: 'Hello'
            // });

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
        
          // var locations = [
          //   ['My home', 50.466949, 30.631009, 1, 'https://my-home.com'],
          //   ['Igor\'s home', 50.523878, 30.618252, 2, 'https://igors-home.com'],
          //   ['My work', 50.469799, 30.466366, 3, 'https://my-work.com'],
          //   ['Igor\'s work', 50.467263, 30.497674, 4, 'https://igors-work.com']
          // ];
          // var locations = <?php echo json_encode( $coordinates_array ); ?>;
          var locations = <?php echo json_encode( $arr ); ?>;

          function setMarkers(map) {

            for (var i = 0; i < locations.length; i++) {
              var location = locations[i];

              var web = location[3] != '' ? '<a href="'+location[3]+'">'+location[0]+'</a>' : location[0];

              var contentString = '<div class="info-window">'+
              //'<a href="'+location[3]+'">'+location[0]+'</a>'+
              web+
              '</div>';

              var marker = new google.maps.Marker({
                position: {lat: location[1], lng: location[2]},
                map: map,
                title: location[0],
                //zIndex: location[3],
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
    </div> -->

    <?php 
      echo do_shortcode( '[contact-form-7 id="48" title="Contact form 1"]' );
      // echo do_shortcode( "[RM_Form id='3']" );
    ?>

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer();
