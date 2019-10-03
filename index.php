<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wimp
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="container">
				<div class="row">
					<div class="col-12 d-none d-md-block col-sm-3">
						<?php echo get_sidebar(); ?>
					</div>
					<div class="con-12 col-md-9 pt-3">
						<div class="banner-section">
							<?php echo do_shortcode('[metaslider id="76"]'); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="discounts-section">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="caption-block mt-3 mb-3">
								<span class="dashicons dashicons-clipboard"></span>
								<span class="caption-text">Скидки</span>
								<a class="ml-2" href="<?php echo get_page_link(127) ?>">смотреть всё</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<?php echo do_shortcode('[sale_products limit="4" orderby="rand"]'); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="favorite-section mt-5">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="caption-block mt-3 mb-3">
								<span class="dashicons dashicons-album"></span>
								<span class="caption-text">Популярное</span>
								<a class="ml-2" href="<?php echo get_page_link(129) ?>">смотреть всё</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<?php echo do_shortcode('[best_selling_products limit="4" ]'); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="letter-section position-relative mt-5 mb-5 pt-5 pb-5">
				<div class="bg-layer dark-gray"></div>
				<div class="container">
					<div class="row">
						<div class="offset-md-2 offset-lg-3"></div>
						<div class="col-12 col-md-8 col-lg-6">
							<?php echo do_shortcode('[mailpoet_form id="2"]'); ?>
						</div>
						<div class="offset-md-2 offset-lg-3"></div>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
