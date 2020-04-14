<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div id="container">
            <div id="content" role="main">
 
                <h1 class="page-title"><?php
                    printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
                ?></h1>
								<?php $category = get_category( get_query_var( 'cat' ) );
								$cat_id = $category->cat_ID;
								echo $cat_id;
								?>
								<?php 
									$loop_places = new WP_Query( 
										array( 
										'post_type' => 'places',
										'cat' => $cat_id,   
										'posts_per_page' => -1
										) 
									);
								?>
								<?php while ( $loop_places->have_posts() ) : $loop_places->the_post(); ?>
								<?php echo the_title('<h3>', '</h3>'); ?>
								<?php endwhile; // end of the loop. ?>
              
 
            </div><!-- #content -->
        </div><!-- #container -->

<?php get_footer();
