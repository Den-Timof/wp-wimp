<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package wimp
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function wimp_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'wimp_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function wimp_woocommerce_scripts() {
	wp_enqueue_style( 'wimp-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'wimp-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'wimp_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function wimp_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'wimp_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function wimp_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'wimp_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function wimp_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'wimp_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function wimp_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'wimp_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function wimp_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wimp_woocommerce_related_products_args' );

if ( ! function_exists( 'wimp_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function wimp_woocommerce_product_columns_wrapper() {
		$columns = wimp_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'wimp_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'wimp_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function wimp_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'wimp_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'wimp_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function wimp_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

			<div class="container">
				<div class="row">
					<?php if( !is_product() ) { ?>
						<div class="d-none d-md-block col-12 col-md-4 col-lg-3">
							<?php do_action('woocommerce_sidebar'); ?>
						</div>
						<div class="col-12 col-md-8 col-lg-9">
					<?php } else { ?>
						<div class="col-12">
					<?php } ?>
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'wimp_woocommerce_wrapper_before' );

if ( ! function_exists( 'wimp_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function wimp_woocommerce_wrapper_after() {
			?>
					<?php if( !is_product() ) { ?>
								</div>
							</div>
						</div>
					<?php } else { ?>
						</div>
					<?php } ?>
			
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'wimp_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'wimp_woocommerce_header_cart' ) ) {
			wimp_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'wimp_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function wimp_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		wimp_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'wimp_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'wimp_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function wimp_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'wimp' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'wimp' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="d-none amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span>
			<span class="dashicons dashicons-cart">
				<span class="count">
					<?php echo esc_html( $item_count_text ); ?>
				</span>
			</span>
			<span class="cart-text">Корзина <br> товаров</span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'wimp_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function wimp_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = 'woocommerce_header_cart';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php wimp_woocommerce_cart_link(); ?>
			</li>
			<li class="woocommerce_header_cart__list">
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


/**
 * @snippet       Remove Sidebar @ Single Product Page
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=19572
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.2.6
 */
 
add_action( 'wp', 'bbloomer_remove_sidebar_product_pages' );
 
function bbloomer_remove_sidebar_product_pages() {
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}

/* Separete Login form and registration form */
// add_action('woocommerce_before_single_product_summary','custom_woocommerce_before_single_product_summary');
// function custom_woocommerce_before_single_product_summary() {
// 	echo 'Echo';

// 	echo do_shortcode('[product_attribute]');
// }

// add_action('woocommerce_after_single_product_summary','custom_woocommerce_after_single_product_summary');
// function custom_woocommerce_after_single_product_summary() {
	
// 	global $product;

// 	$razmer_attribute_product = $product->get_attribute( 'pa_razmer' );
// 	echo '<b>Размер:</b> ' . $razmer_attribute_product;

// }

/**
 * Меняем текст в кнопке "В корзину"
 */
add_filter('woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text');
 
function woo_custom_cart_button_text() {
	return 'Добавить в корзину';
}

/**
 * Минимальная цена в вариативном товаре
 */
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2); 

function custom_variation_price( $price, $product ) { 
	$price = '';
	$price .= wc_price($product->get_price()); 
	return 'от ' . $price;
}


add_filter('woocommerce_after_shop_loop', 'custom_woocommerce_after_shop_loop');
function custom_woocommerce_after_shop_loop() {

	if( is_product_category() ) {

		$is_category_parent = 1;

		$taxonomy     = 'product_cat';
		$orderby      = 'name';  
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 0;      // 1 for yes, 0 for no  
		$title        = '';
		$empty        = 1;
	
		$args = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			'pad_counts'   => $pad_counts,
			'hierarchical' => $hierarchical,
			'title_li'     => $title,
			'hide_empty'   => $empty,
		);

		$all_categories = get_categories( $args );

		foreach ($all_categories as $cat) {

			if( ($cat->category_parent == 0) && ( get_queried_object_id() == $cat->term_id ) ) {
				$is_category_parent = 0; break;
			}
		}

		if(!$is_category_parent) {

			$categories = get_categories(
				array( 
					'taxonomy' => 'product_cat',
					'parent'   => get_queried_object_id()
				)
			);

			?>
				<div class="discounts-section">
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
							<?php echo do_shortcode('[sale_products orderby="rand" limit="3" columns="3" category="'. get_queried_object()->slug .'"]'); ?>
						</div>
					</div>
				</div>
			<?php
		}
	}
	


}

// add_filter('woocommerce_before_cart', 'custom_woocommerce_before_cart');
// function custom_woocommerce_before_cart() {
// 	echo '<div class="row">';
// }
// add_filter('woocommerce_after_cart', 'custom_woocommerce_after_cart');
// function custom_woocommerce_after_cart() {
// 	echo '</div>';
// }

// add_filter('woocommerce_before_cart_table', 'custom_woocommerce_before_cart_table');
// function custom_woocommerce_before_cart_table() {
// 	echo '<div class="col-10">';
// }
// add_filter('woocommerce_after_cart_table', 'custom_woocommerce_after_cart_table');
// function custom_woocommerce_after_cart_table() {
// 	echo '</div>';
// }

// add_filter('woocommerce_before_cart_totals', 'custom_woocommerce_before_cart_totals');
// function custom_woocommerce_before_cart_totals() {
// 	echo '<div class="col-2">';
// }
// add_filter('woocommerce_after_cart_table', 'custom_woocommerce_after_cart_totals');
// function custom_woocommerce_after_cart_totals() {
// 	echo '</div>';
// }

