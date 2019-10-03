<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wimp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<div class="d-none d-md-block top-header position-relative">
		<div class="bg-layer"></div>

		<div class="container">
			<div class="row top-header top-header-row">
				<div class="col-12 top-header--column">
					<div class="column-item dropdown d-inline-block">
						<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Информация
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="#">Action</a>
							<a class="dropdown-item" href="#">Another action</a>
							<a class="dropdown-item" href="#">Something else here</a>
						</div>
					</div>
					<div class="d-none d-sm-flex column-item">
						<a class="order-tracking" href="<?php echo get_page_link(59); ?>"><?php echo get_post(59)->post_title; ?></a>
					</div>
					<div class="column-item email email-icon">
						<span class="dashicons dashicons-email-alt"></span>
						<span><a href="mailto:">
							<?php echo carbon_get_theme_option('general_email'); ?>
						</a></span>
					</div>
					<div class="column-item">
						<?php
							// $args = array([
							// 	'theme_location'  => '',
							// 	'menu'            => 'Menu 1', 
							// 	'container'       => 'div', 
							// 	'container_class' => '', 
							// 	'container_id'    => '',
							// 	'menu_class'      => 'menu', 
							// 	'menu_id'         => '',
							// 	'echo'            => true,
							// 	'fallback_cb'     => 'wp_page_menu',
							// 	'before'          => '',
							// 	'after'           => '',
							// 	'link_before'     => '',
							// 	'link_after'      => '',
							// 	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							// 	'depth'           => 0,
							// 	'walker'          => '',
							// ]);
							// wp_nav_menu( $args );
						?>
					</div>
					<div class="column-item">
						<?php dynamic_sidebar( 'pereklyuchatel-yazykov' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<header id="masthead" class="d-none d-md-block site-header header-section">
		<div class="bg-layer"></div>
		<div class="container">
			<div class="row pt-3 pb-3 header-row">
				<div class="d-none d-sm-block col-12 col-sm-3 col-lg-2">
					<?php the_custom_logo(); ?>
					<input type="hidden" name="logotype_url" value="<?php echo wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0]; ?>">
					<input type="hidden" name="site_url" value="<?php echo site_url(); ?>">
				</div>
				<div class="col-12 col-sm-6 col-lg-4">
					<?php the_widget( 'WC_Widget_Product_Search' ); ?>
				</div>
				<div class="d-none d-sm-block col-12 col-sm-1 col-lg-2 column-item">
					<div class="login-block">
						<?php my_account_loginout_link(); ?>
					</div>
				</div>
				<div class="d-none d-sm-block col-12 col-sm-1 col-lg-2 column-item">
					<?php echo do_shortcode('[ti_wishlist_products_counter]'); ?>
				</div>
				<div class="d-none d-sm-block col-12 col-sm-1 col-lg-2 column-item">
					<?php
						if ( function_exists( 'wimp_woocommerce_header_cart' ) ) {
							wimp_woocommerce_header_cart();
						}
					?>
				</div>
		</div>
	</header>

	<div id="content" class="site-content">
