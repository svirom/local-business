<?php
/**
 * Template Name: Add Place
 *
 * @package Neve
 * @since   1.0.0
 */
$container_class = apply_filters( 'neve_container_class_filter', 'container', 'single-page' );

get_header();

?>
<div class="add-place <?php echo esc_attr( $container_class ); ?> single-page-container">
	<div class="row container-place-wrapper">
		<div class="nv-single-page-wrap col-12 container-home">
			<?php
			do_action( 'neve_before_page_header' );
			do_action( 'neve_page_header', 'single-page' );
			do_action( 'neve_before_content', 'single-page' );
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				}
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			do_action( 'neve_after_content', 'single-page' );
			?>
		</div>
	</div>

    <?php require get_stylesheet_directory() .'/content-parts/bottom-contact.php';?>

</div>
<?php 
get_footer();
