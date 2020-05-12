<?php
/**
 * 
 * 
 *
 * @package neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'single-post' );

get_header();

?>
	<div class="<?php echo esc_attr( $container_class ); ?> single-post-container">
		<div class="row">
			<div class="col-12">

				<?php while ( have_posts() ) : the_post(); ?>

				<article <?php post_class('places-article'); ?> id="post-<?php the_ID(); ?>">
					<header class="entry-header">
						<div class="places-logo">
							<img src="<?php echo get_field('logo'); ?>">
						</div>
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<?php if ( esc_url( get_field('address_web') ) ) {?>
							<p class="places-web"><?php echo __('Веб-сайт', 'neve'); ?>: <a href="<?php echo esc_url( get_field('address_web') ); ?>"><?php echo esc_url( get_field('address_web') ); ?></a></p>
						<?php } ?>
					</header><!-- .entry-header -->

					<?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

					<footer class="single-article-footer">
						<div class="row">
						<?php
							// var_dump(get_fields());
							$single_fields = get_fields();
							foreach($single_fields as $single_field) {
								if (is_array($single_field)) {
									foreach($single_field as $cert) {	?>
										<div class="col-md-3">
											<div class="certificate-card" style="background-color: <?php echo $cert['certificate_background']; ?>">
												<div class="certificate-body">
													<h3 class="certificate-title"><?php echo $cert['certificate_title']; ?></h3>
													<p class="certificate-description"><?php echo $cert['certificate_description']; ?></p>
												</div>
												<div class="certificate-footer">
													<p class="certificate-cost"><?php echo $cert['certificate_cost']; ?>  <?php echo __('грн.', 'neve'); ?></p>
													<a class="certificate-order" href="<?php echo $cert['certificate_order']; ?>"><?php echo __('Придбати', 'neve'); ?></a>
												</div>
											</div>
										</div>
									<?php }
								}
							} ?>
						</div>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->

				<?php endwhile; // end of the loop. ?>

			</div>
		</div><!-- .row -->
	</div>
<?php
 get_footer();
