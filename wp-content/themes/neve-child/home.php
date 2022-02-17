<?php
/**
 * Template Name: Home Page
 *
 * @package Neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'blog-archive' );

global $curr_lang;

if ( $curr_lang == 'ru' ) {
  $catalogue = '/ru/catalogue';
} else if ( $curr_lang == 'en' ) {
  $catalogue = '/en/catalogue';
} else {
  $catalogue = '/catalogue';
}


get_header();

?>

  <div class="<?php echo esc_attr( $container_class ); ?> archive-container">

    <?php require get_stylesheet_directory() .'/content-parts/header-home.php';?>

    <div class="row container-home-wrapper">
      <div class="col-12 container-home">

        <div class="row">
          <div class="col-12 text-center map-title" id="map-title">
            <h3><?php echo __('Шукайте на мапі', 'neve-child') ?></h3>
          </div>
        </div>
        <?php 
          $loop_places = new WP_Query( 
            array( 
            'post_type' => 'places',
            ) 
          );

          @require get_stylesheet_directory() .'/content-parts/map.php';
        ?>

        <div class="row">
          <div class="col-12 text-center">
            <h4><?php echo __('або ознайомтесь з каталогом закладів', 'neve-child') ?></h4>
          </div>
        </div>

        <div class="row">
          <?php $categories = get_categories(array('hide_empty' => false));
            $category_count = 0;
            foreach($categories as $category) {
              if ( $category->slug != 'uncategorized' ) {; ?>
                <?php $i++; 
                  if ($i > 8) { 
                    break;
                  }
                ?>
                <div class="col-sm-6 col-md-3 category-card-wrapper">
                  <div class="category-card">
                    <a href="<?php echo get_category_link($category->cat_ID); ?>"><?php echo $category->cat_name; ?></a>
                  </div>
                </div>
              <?php }  
            }
          ?>
        </div>

        <div class="row">
          <div class="col-12 text-center all-categories">
            <h5>
              <a href="<?php echo site_url() . $catalogue; ?>" class="btn btn-link"><?php echo __('Переглянути усі категорії', 'neve-child'); ?></a>
            </h5>
          </div>
        </div>

      </div>
    </div>

    <?php require get_stylesheet_directory() .'/content-parts/bottom-form.php';?>
    <?php require get_stylesheet_directory() .'/content-parts/bottom-contact.php';?>

  </div>
<?php 
get_footer();
