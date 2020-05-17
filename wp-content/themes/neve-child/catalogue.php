<?php
/**
 * Template Name: Catalogue Page
 *
 * @package Neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'blog-archive' );

get_header();

?>

  <div class="<?php echo esc_attr( $container_class ); ?> archive-container">

  <?php 
    // $category = get_category( get_query_var( 'cat' ) );

    $loop_places = new WP_Query( 
      array( 
      'post_type' => 'places',   
      'posts_per_page' => 1
      ) 
    );
  ?>

		<div class="row category-title">
      <div class="col-12 container-home text-center">
        <h1 class="page-title"><?php echo __( 'Каталог закладів', 'neve-child' ); ?></h1>
      </div>
		</div>

    <div class="row container-home-wrapper">
      <div class="col-12 container-home">

        <div class="row">
          <?php $categories = get_categories(array('hide_empty' => false));
            foreach($categories as $category) {
              if ( $category->slug != 'uncategorized' ) {; ?>
                <div class="col-sm-6 col-md-3 category-card-wrapper">
                  <div class="category-card">
                    <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                  </div>
                </div>
              <?php }  
            }
          ?>
        </div>

        <?php  @require get_stylesheet_directory() .'/content-parts/map.php'; ?>

        <div class="row business-wrapper">

          <?php if ( $loop_places->have_posts() ) : ?>
            <?php while ( $loop_places->have_posts() ) : $loop_places->the_post(); ?>
              <div class="col-md-4 business-card-wrapper">
                <a href="<?php echo the_permalink(); ?>" class="business-card" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>')">
                  <div class="business-content">
                    <?php echo the_title('<h3 class="business-title">', '</h3>'); ?>
                    <div class="business-address">
                      <div class="business-category">
                        <?php echo (get_the_category($post->ID))[0]->name; ?>
                      </div>
                      <div class="business-city">
                        <?php echo get_field('address_city'); ?>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile; ?>

            <!-- ajax load posts -->
            <?php if (  $loop_places->max_num_pages > 1 ) { ?>
              <script>
                var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                var true_posts = '<?php echo serialize($loop_places->query_vars); ?>';
                var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                var max_pages = '<?php echo $loop_places->max_num_pages; ?>';
              </script>
              <div id="true_loadmore" class="col-12 w-100 text-center business-loadmore">
                <a href="#" class="btn btn-link"><?php echo __('Показати ще', 'neve-child') ?></a>
              </div>
            <?php } ?>

          <?php else : ?>
            <div class="col-12 text-center business-empty">
              <h3><?php echo __('Ваш заклад може бути першим', 'neve-child'); ?></h3>
            </div>
          <?php endif; ?>

        </div>

      </div>
    </div>

    <?php require get_stylesheet_directory() .'/content-parts/bottom-form.php';?>
    <?php require get_stylesheet_directory() .'/content-parts/bottom-contact.php';?>

  </div>
<?php 
get_footer();
