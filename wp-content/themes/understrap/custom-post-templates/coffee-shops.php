<?php
/**
* Template Name: Coffee Shops Page
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

<div class="wrapper coffee-shops-page" id="index-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
      <div class="col-12">

        <main class="site-main" id="main">
          
          <?php 
            $loop_coffee = new WP_Query( 
              array( 
              'post_type' => 'places',   
              'posts_per_page' => -1
              ) 
            );
          ?>
          <div><?php wp_list_categories( ); ?></div>
          <div class="row my-5">
            <div class="col-12 text-center">
              <?php the_title( '<h2>', '</h2>' ); ?>
            </div>
          </div>
          <div class="row justify-content-center">
          <?php if ( $loop_coffee->have_posts() ) : ?>

            <?php while ( $loop_coffee->have_posts() ) : $loop_coffee->the_post(); ?>
              <div class="col-md-4 mb-4">
                <a href="<?php echo the_permalink(); ?>" class="business-card" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>')">
                  <div class="business-content">
                    <?php echo the_title('<h3 class="business-title">', '</h3>'); ?>
                    <div class="business-address">
                      <div class="business-city">
                        <?php print_r(get_field('address_city')); ?>
                      </div>
                      <div class="business-street">
                        <?php print_r(get_field('address_street')); ?>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile; ?>

            <?php else : ?>
              <div class="col-12">
                <h3><?php echo __('Ваша кав\'ярня може бути першою', 'understrap'); ?></h3>
              </div>
            <?php endif; ?>
          </div>
        </main><!-- #main -->

      </div>
		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer();
