<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package wimp
 */

$sidebar_list_category = '%d1%81%d0%bf%d0%b8%d1%81%d0%be%d0%ba-%d0%ba%d0%b0%d1%82%d0%b5%d0%b3%d0%be%d1%80%d0%b8%d0%b9-%d1%82%d0%be%d0%b2%d0%b0%d1%80%d0%be%d0%b2';

$sidebar_filter_products = 'spisok-filtrov-tovarov';

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( $sidebar_list_category ); ?>

	<?php 

		if( is_product_category() ) {

			$is_category_parent = 1;

			$taxonomy     = 'product_cat';
			$orderby      = 'name';  
			$show_count   = 0;      // 1 for yes, 0 for no
			$pad_counts   = 0;      // 1 for yes, 0 for no
			$hierarchical = 1;      // 1 for yes, 0 for no  
			$title        = '';
			$empty        = 0;
		
			$args = array(
				'taxonomy'     => $taxonomy,
				'orderby'      => $orderby,
				'show_count'   => $show_count,
				'pad_counts'   => $pad_counts,
				'hierarchical' => $hierarchical,
				'title_li'     => $title,
				'hide_empty'   => $empty
			);

			$all_categories = get_categories( $args );

			foreach ($all_categories as $cat) {

				if( ($cat->category_parent == 0) && ( get_queried_object_id() == $cat->term_id ) ) {
					$is_category_parent = 0; break;
				}
			}

			if($is_category_parent) {
				dynamic_sidebar( $sidebar_filter_products );
			}

		}
	?>

</aside><!-- #secondary -->
