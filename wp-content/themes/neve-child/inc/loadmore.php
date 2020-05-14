<?php
function true_load_posts(){
	$category = get_category( get_query_var( 'cat' ) );
	$args = unserialize(stripslashes($_POST['query']));
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';
	$args['cat'] = $category->cat_ID;
	// $args['posts_per_page'] = 1;
	$args['post_type'] = 'places';
	$q = new WP_Query($args);
	if( $q->have_posts() ):
		while($q->have_posts()): $q->the_post();
			?>
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
			<?php
		endwhile;
	endif;
	wp_reset_postdata();
	die();
}
 
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');