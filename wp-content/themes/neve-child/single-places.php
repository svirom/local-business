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
					<header class="row places-article-header">
						<div class="col-md-6 places-logo">
							<img src="<?php echo get_field('logo'); ?>">
						</div>
						<div class="col-md-6 places-title">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							<p class="places-header-text"><strong><?php echo __('Місто', 'neve-child'); ?>: </strong><?php echo get_field('address_city'); ?></p>
							<p class="places-header-text"><strong><?php echo __('Адреса', 'neve-child'); ?>: </strong><?php echo get_field('address_street'); ?></p>
						</div>
					</header>

					<div class="row entry-content">
						<div class="col-12">
							<?php the_content(); ?>
						</div>
					</div>

					<div class="row certificate-add">
						<div class="col-12 container-home">
							<h3><?php echo __('Придбати сертифікат', 'neve-child'); ?></h3>
						</div>
						<div class="col-12">
							<form action="" class="certificate-form" method="post">
								<div class="form-group">
									<select class="form-control certificate-amount" name="certificate-amount">
										<option value="200"><?php echo __('Сертифікат на', 'neve-child'); ?> 200 <?php echo __('грн', 'neve-child'); ?></option>
										<option value="500"><?php echo __('Сертифікат на', 'neve-child'); ?> 500 <?php echo __('грн', 'neve-child'); ?></option>
										<option value="1000"><?php echo __('Сертифікат на', 'neve-child'); ?> 1000 <?php echo __('грн', 'neve-child'); ?></option>
									</select>
								</div>
								<button type="submit" class="btn btn-primary"><?php echo __('Придбати', 'neve-child'); ?></button>
							</form>
							<p class="certificate-oferta"><?php echo __('Додаючи заклад ви погоджуєтесь з умовами', 'neve-child'); ?> <a href="#"><?php echo __('оферти', 'neve-child'); ?></a></p>
						</div>
					</div>

					<footer class="single-article-footer container">
						<div class="row">
							<div class="col-12">
								<h3><?php echo __('Інші пропозиції', 'neve-child'); ?></h3>
							</div>
						</div>
						<div class="row certificate-cards">
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
													<p class="certificate-cost"><?php echo $cert['certificate_cost']; ?>  <?php echo __('грн.', 'neve-child'); ?></p>
													<?php if (strlen($cert['certificate_order']) > 0) { ?>
														<a class="certificate-order" href="<?php echo $cert['certificate_order']; ?>"><?php echo __('Придбати', 'neve-child'); ?></a>
													<?php } ?>
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
		</div>

		<div class="row container-home-wrapper single-article-map">
			<div class="col-12 container-home">
				<div class="row">
					<div class="col-12 single-map-header">
						<p class="places-map-text"><strong><?php echo __('Місто', 'neve-child'); ?>: </strong><?php echo get_field('address_city'); ?></p>
						<p class="places-map-text"><strong><?php echo __('Адреса', 'neve-child'); ?>: </strong><?php echo get_field('address_street'); ?></p>
						<p class="places-map-text"><strong><?php echo __('Телефон', 'neve-child'); ?>: </strong><?php echo get_field('address_tel'); ?></p>
						<?php if ( esc_url( get_field('address_web') ) ) {?>
							<p class="places-map-text"><strong><?php echo __('Сайт', 'neve-child'); ?>: </strong><a href="<?php echo esc_url( get_field('address_web') ); ?>"><?php echo esc_url( get_field('address_web') ); ?></a></p>
						<p class="places-map-text last-map-text"><strong><?php echo __('Час роботи', 'neve-child'); ?>: </strong><?php echo get_field('address_time'); ?></p>
						<?php } ?>
					</div>
				</div>

				<?php require get_stylesheet_directory() .'/content-parts/map-single.php'; ?>

			</div>
		</div>

		<?php require get_stylesheet_directory() .'/content-parts/bottom-form.php';?>
		<?php require get_stylesheet_directory() .'/content-parts/bottom-contact.php';?>
		
	</div>
<?php
 get_footer();
