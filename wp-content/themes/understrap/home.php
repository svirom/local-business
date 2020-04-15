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
            <?php //var_dump(get_categories(array('hide_empty' => false))); ?>
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

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer();
