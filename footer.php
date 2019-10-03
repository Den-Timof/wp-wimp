<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wimp
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-4 mb-5 mb-sm-0">
					<p class="text_copyright">
						<?php echo carbon_get_theme_option('footer_copyright'); ?>
					</p>
					<img src="<?php echo carbon_get_theme_option('footer_logo') ?>" alt="">

				</div>
				<div class="col-12 col-sm-3 col-lg-2">
					<strong class="mb-3 list-caption"><?php echo carbon_get_theme_option('footer_col_2_title'); ?></strong>
					<ul class="footer-list">
						<?php 
							$all_categories = get_categories(array(
								'taxonomy'		=>	'product_cat',
								'orderby'			=>	'name',
								'show_count'	=>	0,
								'hide_empty'	=>	1,
								'exclude'			=>	'15',
								'parent'			=>	0
							));
							foreach( $all_categories as $category ) {
								$category_link = get_category_link( $category->term_id );
								$category_name = $category->cat_name;
								echo "<li class='list-item'><a href='$category_link'>$category_name</a></li>";
							}
						?>
					</ul>
				</div>
				<div class="col-12 col-sm-3 col-lg-2 mb-5 mb-sm-0">
					<strong class="mb-3 list-caption"><?php echo carbon_get_theme_option('footer_col_3_title'); ?></strong>
					<ul class="footer-list">
						<?php
							$arr_list_pages = carbon_get_theme_option('footer_list_pages');
							// var_dump($arr_list_pages);
						
							foreach( $arr_list_pages as $obj_page ) {
								$page_id = $obj_page['id'];

								$page = get_post($page_id);
								$page_link = get_page_link($page_id);
								$page_name = $page->post_title;

								echo "<li class='list-item'><a href='$page_link'>$page_name</a></li>";
							}
						?>
					</ul>
				</div>
				<div class="col-12 col-sm-6 col-lg-2 mb-5 mb-sm-0 mt-sm-5 mt-lg-0">

					<div class="social-block">
						<ul class="list social-list">
							<?php
								$arr_social_links = carbon_get_theme_option('crb_slides');

								foreach( $arr_social_links as $social ) {
									$social_img		= $social['footer_complex_social_image'];
									$social_href	= $social['footer_complex_social_link'];

									echo "<li class='social-icon'><a href='$social_href' target='_blank'><img alt='' src='$social_img'></a></li>";
								}
							?>
						</ul>
					</div>

					<div class="email email-icon mt-3">
						<span class="dashicons dashicons-email-alt"></span>
						<span><a href="mailto:">
							<?php echo carbon_get_theme_option('general_email'); ?>
						</a></span>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-lg-2 mt-sm-5 mt-lg-0">
					<ul class="list payment-list">
						<?php
							$arr_social_links = carbon_get_theme_option('footer_complex_payment');

							foreach( $arr_social_links as $social ) {
								$payment_img		= $social['footer_complex_payment_image'];

								echo "<li class='payment-item'><img alt='' src='$payment_img'></li>";
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</footer>

	<div class="under-footer position-relative pt-2 pb-2">
		<div class="bg-layer lite-gray"></div>

		<div class="container">
			<div class="row">
				<div class="col-12">
					<p><?php echo carbon_get_theme_option('separator_footer_year'); ?></p>
				</div>
			</div>
		</div>

	</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
