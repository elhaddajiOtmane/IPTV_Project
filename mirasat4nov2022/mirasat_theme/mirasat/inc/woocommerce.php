<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }
/**
 * Woocommerce Hooks
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action( 'woocommerce_before_shop_loop_item',	'woocommerce_template_loop_product_link_open', 10);
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action( 'woocommerce_after_subcategory',	'woocommerce_template_loop_category_link_close', 10);


add_filter( 'woocommerce_show_page_title', '__return_false' );

add_action('woocommerce_before_main_content', 'mirasat_wc_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'mirasat_wc_wrapper_end', 10);

if ( !function_exists( 'mirasat_wc_wrapper_start' ) ) {

	function mirasat_wc_wrapper_start() {

		$mirasat_sidebar = mirasat_get_wc_sidebar_pos();

		if ( is_active_sidebar( 'sidebar-wc' ) AND !empty( $mirasat_sidebar ) ) {

	  		echo '<div class="inner-page margin-default">
	  				<div class="row">';
	  		
	  		if ( $mirasat_sidebar == 'left' ) {

		  		echo '<div class="col-xl-9 col-xl-push-3 col-lg-8 col-lg-push-4 col-md-12 text-page products-column-with-sidebar matchHeight" >';
	  		}
	  			else {

	  			echo '<div class="col-xl-9 col-lg-8 col-md-12 col-xs-12 text-page products-column-with-sidebar matchHeight" >';
  			}
		}
			else {

	  		echo '<div class="inner-page margin-default">
	  				<div class="row centered"><div class="col-xl-9 col-lg-12 text-page">';
		}	  
	}
}

if ( !function_exists( 'mirasat_wc_wrapper_end' ) ) {

	function mirasat_wc_wrapper_end() {

		echo '</div>';
	}
}

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_before_subcategory_title',	'mirasat_woocommerce_item_wrapper_start', 9 );
add_action( 'woocommerce_before_shop_loop_item_title', 'mirasat_woocommerce_item_wrapper_start', 9 );

add_action( 'woocommerce_before_subcategory_title',	'mirasat_woocommerce_title_wrapper_start', 20 );
add_action( 'woocommerce_before_shop_loop_item_title', 'mirasat_woocommerce_title_wrapper_start', 20 );

add_action( 'woocommerce_after_shop_loop_item_title',	'mirasat_woocommerce_title_wrapper_end', 7);

add_action( 'woocommerce_after_subcategory', 'mirasat_woocommerce_item_wrapper_end', 20 );
add_action( 'woocommerce_after_shop_loop_item',	'mirasat_woocommerce_item_wrapper_end', 20 );


remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary', 'mirasat_woocommerce_title',5);

if ( ! function_exists( 'mirasat_woocommerce_title' ) ) {

	function mirasat_woocommerce_title() {
  		
		return false;
  	}
}


if ( !function_exists( 'mirasat_woocommerce_item_wrapper_start' ) ) {

	function mirasat_woocommerce_item_wrapper_start($cat='') {

		global $product;

			echo '<div class="item">';
	
		?>
			<div class="image">
		<?php
	}
}

if ( !function_exists( 'mirasat_woocommerce_item_wrapper_end' ) ) {

	function mirasat_woocommerce_item_wrapper_end($cat='') {

		global $product;

		if ( !empty($cat) ) {
		
			echo '</a></div>';
		}
			else {

			echo '</div>';
		}
	}
}

if ( !function_exists( 'mirasat_woocommerce_title_wrapper_start' ) ) {

	function mirasat_woocommerce_title_wrapper_start($cat='') {

		global $product;

		echo '</div>';

		if ( function_exists('FW') AND empty($cat) )  {

			$rate = fw_get_db_settings_option( 'wc_show_list_rate' );
			if ( $rate == 'enabled' )  {

				echo wc_get_rating_html( $product->get_average_rating() );	
			}
		}

		if ( !empty($cat) ) {

			echo '<a href="'.get_term_link( $cat, 'product_cat' ).'">';
		}
			else {

			echo '<a href="'.get_permalink( $product->get_id() ).'">';
		}
	}
}


if ( !function_exists( 'mirasat_woocommerce_title_wrapper_end' ) ) {

	function mirasat_woocommerce_title_wrapper_end() {

		global $product;

		echo '</a>';	

		if ((is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || !empty($product) )  && !is_product()) {

		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());

		    if ( function_exists('FW') ){

				$cut = (int) fw_get_db_settings_option( 'excerpt_wc_auto' );
		    }

			if (empty($cut)) $cut = 50;

			$display_excerpt = true;
			if ( function_exists('FW') ) {

				$attr = fw_get_db_settings_option( 'wc_show_list_attr' );
				if ( $attr == 'enabled' )  {

					mirasat_woocommerce_display_attr();
				}

				$display_excerpt = fw_get_db_settings_option( 'wc_show_list_excerpt' );
				if ( $display_excerpt == 'disabled') {

					$display_excerpt = false;
				}
			}

			if ( !empty($display_excerpt) ) {

				echo '<div class="post_content entry-content">'. wp_kses_post( mirasat_cut_text( $excerpt, $cut ) ) .'</div>';
			}
		}
	}
}

add_filter( 'post_class', 'mirasat_woocommerce_loop_shop_columns_class' );
add_filter( 'product_cat_class', 'mirasat_woocommerce_loop_shop_columns_class', 10, 3 );

if ( !function_exists( 'mirasat_woocommerce_loop_shop_columns_class' ) ) {
	function mirasat_woocommerce_loop_shop_columns_class($classes, $class='', $cat='') {
		global $woocommerce_loop;

		return $classes;
	}
}


if ( !function_exists( 'mirasat_woocommerce_display_attr' ) ) {

	function mirasat_woocommerce_display_attr() {

		global $product;

		$attributes = $product->get_attributes();

		if ( !empty($attributes) ) {

			echo '<div class="ltx-wc-attr-list">';

			foreach ( $attributes as $attribute ) {

				if ( !empty($attribute['value']) ) {

			        $product_attributes = array();
			        $product_attributes = explode('|', $attribute['value']);

					$items = array();
			        foreach ( $product_attributes as $pa ) {
			            $items[] = trim($pa);
			        }

			        echo '<div class="item">'.$attribute['name'] . ": <span>" . implode(', ', $items).'</span></div>';
			    }   
			    	else {

			    	echo '<div class="item">';
						echo wc_attribute_label($attribute->get_name(), $product). ": <span>".$product->get_attribute ( $attribute->get_name() )."</span>";
			    	echo '</div>';
			   	}	   	
			}

			echo '</div>';
		}
	}
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	
	$mirasatWoocommerceNewLabel = new mirasatWoocommerceNewLabel();
}

/*
	New Label
*/
if ( !class_exists( 'mirasat_woocommerce_new_label' ) ) {

	class mirasatWoocommerceNewLabel {

		public function __construct() {

			add_action( 'woocommerce_settings_image_options_after', array( $this, 'mirasat_woocommerce_admin_settings' ), 20 );
			add_action( 'woocommerce_update_options_catalog', array( $this, 'mirasat_woocommerce_save_admin_settings' ) );
			add_action( 'woocommerce_update_options_products', array( $this, 'mirasat_woocommerce_save_admin_settings' ) );

			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'mirasat_woocommerce_product_loop_new_label' ), 30 );
		}

		function mirasat_woocommerce_product_loop_new_label() {

			$product_date = strtotime( get_the_time( 'Y-m-d' ) );
			
			if ( function_exists('FW') ) {

				$new_days = fw_get_db_settings_option( 'wc_new_days' );
			}
			
			$item = wc_get_product( get_the_ID() );

			if ( empty($new_days)) {

				$new_days = 0;
			}

			if ( !$item->is_on_sale() AND ( time() - ( 60 * 60 * 24 * $new_days ) ) < $product_date ) {

				echo '<span class="wc-label-new">' . esc_html__( 'New', 'mirasat' ) . '</span>';
			}
		}

		function mirasat_woocommerce_admin_settings() {

			woocommerce_admin_fields( $this->settings );
		}

		function mirasat_woocommerce_save_admin_settings() {

			woocommerce_update_options( $this->settings );
		}

	}
}

add_filter('woocommerce_sale_flash', 'mirasat_custom_sale_text', 10, 3);
function mirasat_custom_sale_text($text, $post, $_product) {

    return '<span class="onsale">' . esc_html__( 'Sale', 'mirasat' ) . '</span>';
}

function mirasat_related_products_limit() {

	global $product;
	
	$args['posts_per_page'] = 3;
	return $args;
}

add_filter('loop_shop_columns', 'mirasat_wc_loop_columns');
if (!function_exists('mirasat_wc_loop_columns')) {

	function mirasat_wc_loop_columns() {

	    if ( function_exists('FW') ){

			$cols = fw_get_db_settings_option( 'wc_columns' );
			return $cols;
	    }		
	    	else {

			return 3;
    	}
	}
}

add_filter( 'loop_shop_per_page', 'mirasat_wc_loop_shop_per_page', 20 );
if (!function_exists('mirasat_wc_loop_shop_per_page')) {

	function mirasat_wc_loop_shop_per_page( $cols ) {

	    if ( function_exists('FW') ){

			$rows = fw_get_db_settings_option( 'wc_per_page' );
			return $rows;
	    }		
	    	else {

			return 6;
    	}
	}
}

add_filter( 'woocommerce_output_related_products_args', 'mirasat_related_products_args', 20 );
function mirasat_related_products_args( $args ) {

	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

add_filter('woocommerce_cross_sells_total', 'mirasat_CrossSellTotal');
function mirasat_CrossSellTotal($total) {

	$total = 2;
	return $total;
}

