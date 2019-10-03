<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package wimp
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wimp_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'wimp_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wimp_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wimp_pingback_header' );




/**
 * Меняем разметку поиска
 */
add_filter( 'get_search_form', 'my_search_form' );
function my_search_form( $form ) {

	$form = '
	<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<label class="screen-reader-text" for="s">Запрос для поиска:</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="Найти" />
	</form>';

	return $form;
}


/**
 * Подключаем dashicons
 */
function my_dashicons() {
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'my_dashicons' );

/**
 * Автоматическое обновление плагинов Wordpress
 */
add_filter( 'auto_update_plugin', '__return_true' );


/**
 * Логин WC в шапке
 */
function my_account_loginout_link() {

	if (is_user_logged_in() ) {
		global $wp;
		$current_user = get_user_by( 'id', get_current_user_id() );

		echo '<a class="mr-sm-2 admin-online" href="' 
			. get_permalink( wc_get_page_id( 'myaccount' ) ) . 
		'">
			<span class="dashicons dashicons-admin-users"></span>
		<span class="d-none d-lg-block">' . $current_user->display_name . '</span></a>';

		echo '<a class="admin-exit d-none" href="' 
			. wp_logout_url( get_permalink( wc_get_page_id( 'shop' ) ) ) .
		'">выйти</a>';
	}

	else if (!is_user_logged_in() ) {
		echo '<a class="admin-offline" href="'
		 . get_permalink( wc_get_page_id( 'myaccount' ) ) . 
		'">
			<span class="dashicons dashicons-admin-users"></span>
			<span class="d-none d-lg-block">Войти /<br> <b>регистрация</b></span>
		</a>';
	}
	
}


/**
 * Filter WooCommerce  Search Field
 */
add_filter( 'get_product_search_form' , 'me_custom_product_searchform' );
function me_custom_product_searchform( $form ) {
	
	$form = '
		<form role="search" method="get" class="woocommerce-product-search" action="' . esc_url(home_url('/')) . '">
			<label class="screen-reader-text" for="woocommerce-product-search-field-0">Искать:</label>
			<input type="search" id="woocommerce-product-search-field-0" class="search-field" placeholder="Поиск по товарам…" value="' . get_search_query() . '" name="s">
			<button type="submit" value="Поиск"><span class="dashicons dashicons-search"></span></button>
			<input type="hidden" name="post_type" value="product">
		</form>
	';
	
	return $form;
}


/**
 * 
 */
add_filter( 'woocommerce_checkout_fields' , 'misha_labels_placeholders', 9999 );
 
function misha_labels_placeholders( $f ) {

	// first name can be changed with woocommerce_default_address_fields as well
	$f['billing']['billing_first_name']['label'] = '';
	$f['billing']['billing_first_name']['placeholder'] = 'Имя';
	
	$f['billing']['billing_last_name']['label'] = '';
	$f['billing']['billing_last_name']['placeholder'] = 'Фамилия';
	
	$f['billing']['billing_company']['class'] = array('form-row', 'form-row-first');
	$f['billing']['billing_company']['label'] = '';
	$f['billing']['billing_company']['placeholder'] = 'Название компании (необязательно)';
	
	$f['billing']['billing_country']['class'] = array('form-row', 'form-row-last');
	$f['billing']['billing_country']['label'] = '';
	$f['billing']['billing_country']['placeholder'] = 'Страна';

	$f['billing']['billing_address_1']['label'] = '';
	$f['billing']['billing_address_1']['placeholder'] = 'Адрес';
	$f['billing']['billing_address_1']['class'] = array('form-row', 'form-row-first');
	
	$f['billing']['billing_address_2']['label'] = '';
	$f['billing']['billing_address_2']['placeholder'] = 'Дополнительные сведения об адресе (необязательно) ';
	$f['billing']['billing_address_2']['class'] = array('form-row', 'form-row-last');
	
	$f['billing']['billing_city']['label'] = '';
	$f['billing']['billing_city']['placeholder'] = 'Населённый пункт';
	$f['billing']['billing_city']['class'] = array('form-row', 'form-row-first');
	
	$f['billing']['billing_state']['label'] = '';
	$f['billing']['billing_state']['placeholder'] = 'Область / район';
	$f['billing']['billing_state']['class'] = array('form-row', 'form-row-last');
	
	$f['billing']['billing_postcode']['label'] = '';
	$f['billing']['billing_postcode']['placeholder'] = 'Почтовый индекс';
	$f['billing']['billing_postcode']['class'] = array('form-row', 'form-row-first');
	
	$f['billing']['billing_phone']['label'] = '';
	$f['billing']['billing_phone']['placeholder'] = 'Телефон';
	$f['billing']['billing_phone']['class'] = array('form-row', 'form-row-last');
	
	$f['billing']['billing_email']['label'] = '';
	$f['billing']['billing_email']['placeholder'] = 'Email';
	$f['billing']['billing_email']['class'] = array('form-row', 'form-row-first');

	$f['shipping']['shipping_first_name']['label'] = '';
	$f['shipping']['shipping_first_name']['placeholder'] = 'Имя';

	$f['shipping']['shipping_last_name']['label'] = '';
	$f['shipping']['shipping_last_name']['placeholder'] = 'Фамилия';
		
	$f['shipping']['shipping_company']['class'] = array('form-row', 'form-row-first');
	$f['shipping']['shipping_company']['label'] = '';
	$f['shipping']['shipping_company']['placeholder'] = 'Название компании (необязательно)';
	
	$f['shipping']['shipping_country']['class'] = array('form-row', 'form-row-last');
	$f['shipping']['shipping_country']['label'] = '';
	$f['shipping']['shipping_country']['placeholder'] = 'Страна';

	$f['shipping']['shipping_address_1']['label'] = '';
	$f['shipping']['shipping_address_1']['placeholder'] = 'Адрес';
	$f['shipping']['shipping_address_1']['class'] = array('form-row', 'form-row-first');
	
	$f['shipping']['shipping_address_2']['label'] = '';
	$f['shipping']['shipping_address_2']['placeholder'] = 'Дополнительные сведения об адресе (необязательно) ';
	$f['shipping']['shipping_address_2']['class'] = array('form-row', 'form-row-last');
	
	$f['shipping']['shipping_city']['label'] = '';
	$f['shipping']['shipping_city']['placeholder'] = 'Населённый пункт';
	$f['shipping']['shipping_city']['class'] = array('form-row', 'form-row-first');
	
	$f['shipping']['shipping_state']['label'] = '';
	$f['shipping']['shipping_state']['placeholder'] = 'Область / район';
	$f['shipping']['shipping_state']['class'] = array('form-row', 'form-row-last');
	
	$f['shipping']['shipping_postcode']['label'] = '';
	$f['shipping']['shipping_postcode']['placeholder'] = 'Почтовый индекс';
	$f['shipping']['shipping_postcode']['class'] = array('form-row', 'form-row-first');
	
	$f['shipping']['shipping_phone']['label'] = '';
	$f['shipping']['shipping_phone']['placeholder'] = 'Телефон';
	$f['shipping']['shipping_phone']['class'] = array('form-row', 'form-row-last');
	
	$f['shipping']['shipping_email']['label'] = '';
	$f['shipping']['shipping_email']['placeholder'] = 'Email';
	$f['shipping']['shipping_email']['class'] = array('form-row', 'form-row-first');




	$f['order']['order_comments']['placeholder'] = 'Вы можете ввести примечание к заказу';

	return $f;

}


/**
 * Change the Thank You page title
 */
add_filter( 'woocommerce_thankyou_order_received_text', 'misha_thank_you_body', 20, 2 );
function misha_thank_you_body( $thank_you_title, $order ) {

	$thank_you_title = '';
	$thank_you_title .= '<div class="thankyou-page-body">';
	$thank_you_title .= '
		<p class="number_order">Номер заказа - ' . $order->get_order_number() . '</p>' .
		carbon_get_theme_option('body_thankyou_page_2');
	$thank_you_title .= '</div>';

	return $thank_you_title;
}

add_filter( 'woocommerce_endpoint_order-received_title', 'misha_thank_you_title');
function misha_thank_you_title( $old_title ) {

	$old_title = '';
	$old_title .= '<div class="thankyou-page-header">';
	$old_title .= carbon_get_theme_option('body_thankyou_page_1');
	$old_title .= '</div>';

	return $old_title;
}


// Activate WordPress Maintenance Mode
// function wp_maintenance_mode() {
// 	if(!current_user_can('edit_themes') || !is_user_logged_in()) {

// 		// wp_die('<h1 style="color:red">Website under Maintenance</h1><br />We are performing scheduled maintenance. We will be back on-line shortly!');

// 		echo '<h1 style="color:red">Website under Maintenance</h1><br />We are performing scheduled maintenance. We will be back on-line shortly!';
// 	}
// }
// add_action('get_header', 'wp_maintenance_mode');


