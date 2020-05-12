<?php
/**
 * The template for displaying category pages
 *
 * @package Neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'blog-archive' );

get_header();

?>

  <div class="<?php echo esc_attr( $container_class ); ?> archive-container">

		<div class="row">
      <div class="col-12">

        <?php 
          $category = get_category( get_query_var( 'cat' ) );

          $loop_places = new WP_Query( 
            array( 
            'post_type' => 'places',
            'cat' => $category->cat_ID,   
            'posts_per_page' => -1
            ) 
          );
        ?>
        <div class="row category-title">
          <div class="col-12">
            <h1 class="page-title"><?php echo single_cat_title( '', false ); ?></h1>
          </div>
        </div>
        <div class="row">

        <?php if ( $loop_places->have_posts() ) : ?>
          <?php while ( $loop_places->have_posts() ) : $loop_places->the_post(); ?>
            <div class="col-md-4 business-card-wrapper">
              <a href="<?php echo the_permalink(); ?>" class="business-card" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>')">
                <div class="business-content">
                  <?php echo the_title('<h3 class="business-title">', '</h3>'); ?>
                  <div class="business-address">
                    <div class="business-city">
                      <?php echo get_field('address_city'); ?>
                    </div>
                    <div class="business-street">
                      <?php echo get_field('address_street'); ?>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php endwhile; ?>
        <?php else : ?>
          <div class="col-12">
            <h3><?php echo __('Ваш заклад може бути першим', 'neve'); ?></h3>
          </div>
        <?php endif; ?>

        </div>

        <?php  @require get_stylesheet_directory() .'/content-parts/map.php'; ?>

      </div>
		</div><!-- .row -->

  </div>
<?php 
get_footer();
