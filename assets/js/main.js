jQuery(document).ready(function($) {
	
	// Nominate the containing selector
	var parentSelector = $('.quantity');
	// If it's on the page
	if( parentSelector.length ) {
	
		// Get the original HTML
		var numberInputs = parentSelector.html();
		// Change number to text
		var textInputs = numberInputs.replace('type="number"', 'type="text"');
		// Plus button
		var btnMore = '<button class="more">+</button>';
		// Minus button
		var btnLess = '<button class="less">-</button>';
		// Append it all
		parentSelector.append(textInputs + btnMore + btnLess);
		// Hide the original
		parentSelector.find('input[type="number"]').hide();
	
		// increase or decrease the count
		$('.more, .less').on('click', function(e) {
	
			e.preventDefault();
	
			var newCounter = $(this).prevAll('input.qty[type="text"]');
			var oldCounter = $(this).prevAll('input.qty[type="number"]');
			var counterVal = newCounter.val();
	
			if( $(e.target).hasClass('more') ) {
	
				counterVal++ ;
	
			} else {
	
				counterVal-- ;
			}
	
			// Apply to both inputs
			newCounter.val(counterVal);
			oldCounter.val(counterVal);
		});
	}

	/**
	 * Cookcodesmenu
	 */
	$(function() {

		let logotype_src = $('input[name="logotype_url"]').val();
		let site_url = $('input[name="site_url"]').val();

		let ccm_nav;
		let ccm_menu;
		let ccm_brand;
		
		function ccm_init() {
			
			ccm_nav = $('.cookcodesmenu_nav');
			ccm_menu = $('.cookcodesmenu_menu');
			ccm_brand = ccm_menu.find('.cookcodesmenu_brand');

			/**
			 * Order tracking
			 */
			if( ccm_nav.find('.order-tracking').length == 0 ) {
				let order_tracking = $('.order-tracking').clone();
				ccm_nav = ccm_menu.find('.cookcodesmenu_nav');
				ccm_nav.prepend('<li class="cat-item">' + order_tracking.get(0).outerHTML + '</li>');
			}

			/**
			 * widget_product_search
			 */
			if( ccm_nav.find('.widget_product_search').length == 0 ) {
				let widget_product_search = $('#masthead .widget_product_search').clone();
				ccm_nav = ccm_menu.find('.cookcodesmenu_nav');
				ccm_nav.prepend('<li class="cat-item">' + widget_product_search.get(0).outerHTML + '</li>');
			}

			/**
			 * Product filter by attribute
			 */
			let widget = $('.content-area .widget');
			if( widget.length > 0 ) {

				/**
				 * by attribute (dropdown/list)
				 */
				let widget_layered_nav_block = $('.widget_layered_nav');
				let ccm_widget_layered_nav = ccm_menu.find('.widget_layered_nav');

				if( ccm_widget_layered_nav.length == 0 )
					ccm_nav.find('.ccm-wrap-filters .children').append( widget_layered_nav_block );
				
				/**
				 * Raiting filter
				 */
				let widget_rating_filter_block = $('.widget_rating_filter');
				let ccm_widget_rating_filter = ccm_menu.find('.widget_rating_filter');

				if( ccm_widget_rating_filter.length == 0 )
					ccm_nav.find('.ccm-wrap-filters .children').append( widget_rating_filter_block );

				/**
				 * Price filter
				 */
				let widget_price_filter_block = $('.widget_price_filter');
				let ccm_widget_price_filter = ccm_menu.find('.widget_price_filter');

				if( ccm_widget_price_filter.length == 0 )
					ccm_nav.find('.ccm-wrap-filters .children').append( widget_price_filter_block );
				
				
				ccm_nav.find('.ccm-wrap-filters .children li').each(function(i,e) {
					$(e).addClass('cat-item cat-parent cookcodesmenu_collapsed cookcodesmenu_parent');
				});

			}
			
		}

		function mobile_menu() {
			$('ul.product-categories').cookcodesmenu({
				display: 767.98, 
				label: '',
				brand: '<a href="' + site_url + '"><img src="' + logotype_src + '" alt=""></a>',
				duplicate: true,
				duration: 0,
				closedSymbol: '<span class="dashicons dashicons-arrow-down-alt2"></span>',
				openedSymbol: '<span class="dashicons dashicons-arrow-up-alt2"></span>',
				prependTo: 'body',
				appendTo: '',
				parentTag: 'a',
				closeOnClick: true,
				allowParentLinks: true,
				nestedParentLinks: true,
				showChildren: false,
				removeIds: true,
				removeClasses: false,
				removeStyles: false,

				init: function () {

					ccm_menu = $('.cookcodesmenu_menu');
					ccm_nav = ccm_menu.find('.cookcodesmenu_nav');
					ccm_brand = ccm_menu.find('.cookcodesmenu_brand');


					/**
					 * Login
					 */
					let login_block = $('.login-block');
					let ccm_login_block = ccm_menu.find('.login-block');

					if( ccm_login_block.length == 0 ) {
						login_block_clone = login_block.clone();
						ccm_brand.after( login_block_clone );
					}

					/**
					 * Wishlist
					 */
					let wishlist_block = $('.wishlist_products_counter');
					let ccm_wishlist_block = ccm_menu.find('.wishlist_products_counter');

					if( ccm_wishlist_block.length == 0 ) {
						wishlist_block_clone = wishlist_block.clone();
						ccm_brand.after( wishlist_block_clone );
					}
					
					/**
					 * Mini cart
					 */
					let mini_cart_block = $('.site-header-cart');
					let ccm_mini_cart_block = ccm_menu.find('.site-header-cart');

					if( ccm_mini_cart_block.length == 0 ) {
						mini_cart_block_clone = mini_cart_block.clone();
						ccm_brand.after( mini_cart_block_clone );
					}


					/**
					 * Product categories (wrapping)
					 */
					let ccm_items = $(".cookcodesmenu_nav > li[class^=cat-item]");
					
					ccm_nav.append('\
						<li class="ccm-wrap-categories cat-item cat-parent cookcodesmenu_collapsed cookcodesmenu_parent">\
							<a href="#" role="menuitem" aria-haspopup="true" tabindex="0" class="cookcodesmenu_item cookcodesmenu_row" style="outline: currentcolor none medium;">\
								<span tabindex="0">Категории</span>\
								<span class="cookcodesmenu_arrow"><span class="dashicons dashicons-arrow-down-alt2"></span></span>\
							</a>\
							<ul class="children cookcodesmenu_hidden" role="menu" style="display: none;" aria-hidden="true"></ul>\
						</li>\
					');

					ccm_items.each(function(i,e) {
						ccm_nav.find('.ccm-wrap-categories .children').append( $(e) );
					});

					if( $('.widget_layered_nav, .widget_rating_filter, .widget_price_filter').length > 0 ) {
						ccm_nav.append('\
							<li class="ccm-wrap-filters cat-item cat-parent cookcodesmenu_collapsed cookcodesmenu_parent">\
								<a href="#" role="menuitem" aria-haspopup="true" tabindex="0" class="cookcodesmenu_item cookcodesmenu_row" style="outline: currentcolor none medium;">\
									<span tabindex="0">Фильтры товаров</span>\
									<span class="cookcodesmenu_arrow"><span class="dashicons dashicons-arrow-down-alt2"></span></span>\
								</a>\
								<ul class="children cookcodesmenu_hidden" role="menu" style="display: none;" aria-hidden="true"></ul>\
							</li>\
						');
					}

					ccm_init();
				},

			});
		}
		

		$('body.woocommerce-page.single-product #masthead').cookcodesmenu({
			display: 767.98, 
			label: '',
			brand: '<a href="' + site_url + '"><img src="' + logotype_src + '" alt=""></a>',
			duplicate: true,
			duration: 0,
			closedSymbol: '<span class="dashicons dashicons-arrow-down-alt2"></span>',
			openedSymbol: '<span class="dashicons dashicons-arrow-up-alt2"></span>',
			prependTo: 'body',
			appendTo: '',
			parentTag: 'a',
			closeOnClick: true,
			allowParentLinks: true,
			nestedParentLinks: true,
			showChildren: false,
			removeIds: true,
			removeClasses: false,
			removeStyles: false,

			init: function () {

				ccm_menu = $('.cookcodesmenu_menu');
				ccm_nav = ccm_menu.find('.cookcodesmenu_nav');
				ccm_brand = ccm_menu.find('.cookcodesmenu_brand');

				ccm_menu.find('.bg-layer').remove();
				ccm_menu.find('.container').remove();


				/**
				 * Login
				 */
				let login_block = $('#masthead .login-block');
				let ccm_login_block = ccm_nav.siblings('.login-block');

				if( ccm_login_block.length == 0 ) {
					login_block_clone = login_block.clone();
					ccm_brand.after( login_block_clone );
				}

				/**
				 * Wishlist
				 */
				let wishlist_block = $('#masthead .wishlist_products_counter');
				let ccm_wishlist_block = ccm_nav.siblings('.wishlist_products_counter');

				if( ccm_wishlist_block.length == 0 ) {
					wishlist_block_clone = wishlist_block.clone();
					ccm_brand.after( wishlist_block_clone );
				}
				
				/**
				 * Mini cart
				 */
				let mini_cart_block = $('#masthead .site-header-cart');
				let ccm_mini_cart_block = ccm_nav.siblings('.site-header-cart');

				if( ccm_mini_cart_block.length == 0 ) {
					mini_cart_block_clone = mini_cart_block.clone();
					ccm_brand.after( mini_cart_block_clone );
				}

				 
				/**
				 * Order tracking
				 */
				if( ccm_nav.find('.order-tracking').length == 0 ) {
					let order_tracking = $('.order-tracking').clone();
					ccm_nav = ccm_menu.find('.cookcodesmenu_nav');
					ccm_nav.prepend('<li class="cat-item">' + order_tracking.get(0).outerHTML + '</li>');
				}

				/**
				 * widget_product_search
				 */
				if( ccm_nav.find('.widget_product_search').length == 0 ) {
					let widget_product_search = $('#masthead .widget_product_search').clone();
					ccm_nav = ccm_menu.find('.cookcodesmenu_nav');
					ccm_nav.prepend('<li class="cat-item">' + widget_product_search.get(0).outerHTML + '</li>');
				}


			},

		});;


		$(document).ready(function() { 
			if( $(window).width() <= 767.98 ) {
				mobile_menu();
			} else {

			}
		});

		$(window).resize(function() { 
			
				if( $(window).width() >= 768 ) {

					ccm_menu = $('.cookcodesmenu_menu');
					ccm_widget = ccm_menu.find('.cookcodesmenu_nav .widget:not(.widget_product_search)');
					if( ccm_widget.length > 0 )
						$('aside#secondary.widget-area').append( ccm_widget );

				} else {

					if( $('.cookcodesmenu_menu').length > 0 ) {
						ccm_init();
					} else {
						$('.cookcodesmenu_menu').css('display', 'block');
						mobile_menu();
					}

				}
		});

	});


	/**
	 * Email mailto:
	 */
	$(function() {
		$('a[href^="mailto:"]').each(function(i,e) {
			$(e).attr('href', 'mailto:'+$(e).text() );
		});
	});

	/**
	 * Click Filter product
	 */
	$('.widget_layered_nav .widgettitle, .widget_rating_filter .widgettitle, .widget_price_filter .widgettitle').on('click', function(i,e) {

		let obj = $(this).parent('li');

		if( obj.hasClass('show') ) {
			obj.removeClass('show');
		} else {
			obj.addClass('show');
		}
	});


	/**
	 * Click widget product categories (show/hide)
	 */
	function w_product_categories_show() {

		if( ( $(window).width() >= 768 ) && ( $(window).width() < 992 ) ) {

			$('.widget_product_categories > .product-categories > .cat-item').on('click', function(i,e) {
		
				let obj = $(this);
				
				if( obj.hasClass('show') ) {
					obj.removeClass('show');
				} else {
					obj.addClass('show');
				}
			});
		} else {
			$('.widget_product_categories > .product-categories > .cat-item').each(function(i,e) {
				$(e).removeClass('show');
			});
			$('.widget_product_categories > .product-categories > .cat-item').off('click');
		}
	}

	$(document).ready(function() { w_product_categories_show() });
	$(window).resize(function()  { 
		w_product_categories_show(); 
	});



});