<?php
/**
 * 404 template.
 *
 * @package Neve
 */

get_header();
?>
<div class="place-404 <?php echo esc_attr( $container_class ); ?> single-page-container">
	<div class="row container-place-wrapper">
		<div class="nv-single-page-wrap col-12 container-home">
      <div class="nv-content-none-wrap">
        <p>Схоже, що не вдалося знайти те, що ви шукаєте.</p>
      </div>
		</div>
	</div>

</div>
<?php 
get_footer();
