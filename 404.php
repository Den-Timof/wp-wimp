<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package wimp
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-3">
						<?php echo get_sidebar(); ?>
					</div>
					<div class="col-12 col-sm-9">
						<section class="error-404 not-found">

							<div class="entry-content">
								<?php echo carbon_get_theme_option('body_404_page'); ?>
							</div>
						
						</section><!-- .error-404 -->
					</div>
				</div>
			</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
