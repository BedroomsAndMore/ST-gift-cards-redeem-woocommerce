<?php
/**
 * WooCommerce Gift Card Settings
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WC_Settings_Accounts
 */
class RPGC_Settings extends WC_Settings_Page {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id    = 'giftcard';
		$this->label = __( 'ST-Gift Cards',  'rpgiftcards'  );

		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 20 );
		add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
		add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
		add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );

		add_action( 'woocommerce_admin_field_addon_settings', array( $this, 'addon_setting' ) );
		add_action( 'woocommerce_admin_field_excludeProduct', array( $this, 'excludeProducts' ) );
	}


	/**
	 * Get sections
	 *
	 * @return array
	 */
	public function get_sections() 
	{

	
	}

	/**
	 * Output sections
	 */
	public function output_sections() 
	{
	}

	/**
	 * Output the settings
	 */
	public function output() 
	{
		global $current_section;

		$settings = $this->get_settings( $current_section );

 		WC_Admin_Settings::output_fields( $settings );
	}

	/**
	 * Save settings
	 */
	public function save() {
		global $current_section;
		 update_option('woocommerce_enable_giftcard_cartpage', 'no' );
		 update_option('woocommerce_enable_giftcard_checkoutpage', 'yes' );
		 update_option('woocommerce_enable_giftcard_info_requirements', 'no' );
		 update_option('woocommerce_enable_addtocart', 'no' );
		 update_option('woocommerce_enable_physical', 'no' );
		 update_option('woocommerce_enable_physical', 'no' );
		 update_option('woocommerce_enable_giftcard_charge_shipping', 'yes' );
		 update_option('woocommerce_enable_giftcard_charge_tax', 'yes' );
		 update_option('woocommerce_enable_giftcard_charge_fee', 'yes' );	
		$settings = $this->get_settings( $current_section );
		WC_Admin_Settings::save_fields( $settings );
	}


	/**
	 * Get settings array
	 *
	 * @return array
	 */
	public function get_settings( $current_section = '' ) {
			$options = '';
		if( $current_section == '' ) {

			$options = apply_filters( 'woocommerce_giftcard_settings', array
			(

				array( 'title' 		=> __( 'Merchant Setting',  'rpgiftcards'  ), 'type' => 'title', 'id' => 'giftcard_products_options_title' ),

				array(
					'name'     => __( 'Merchant Id', 'rpgiftcards' ),
					'desc'     => __( 'This is merchant id .', 'rpgiftcards' ),
					'id'       => 'woocommerce_giftcard_merchant_id',
					'std'      => 'Merchant_id', // WooCommerce < 2.0
					'default'  => 'Merchant_id', // WooCommerce >= 2.0
					'type'     => 'text',
					'desc_tip' =>  true,
				),

				array(
					'name'     => __( 'Terminal Id', 'rpgiftcards' ),
					'desc'     => __( 'This is the value terminal_id', 'rpgiftcards' ),
					'id'       => 'woocommerce_giftcard_terminal_id',
					'std'      => 'Terminal Id', // WooCommerce < 2.0
					'default'  => 'Terminal Id', // WooCommerce >= 2.0
					'type'     => 'text',
					'desc_tip' =>  true,
				),

		

				array( 'type' => 'sectionend', 'id' => 'account_registration_options'),
			));
		} else if( $current_section == 'extensions') {

			$options = array( 
				array( 'type' 	=> 'sectionend', 'id' => 'giftcard_extensions' ),

				array( 'type' => 'addon_settings' ),

			); // End pages settings
		}
		return apply_filters ('get_giftcard_settings', $options, $current_section );
	}





	/**
	 * Output the frontend styles settings.
	 */
	public function addon_setting() {
		
		if( $this->activatedPlugins() ) {
			register_setting( 'wpr-options', 'wpr_options' );
			?>
			<h3><?php _e('Activate Extensions', 'rpgiftcards' ); ?></h3> 
			<table>
			<?php do_action( 'wpr_add_license_field' ); ?>
			</table>
			<br class="clear" />
		
		<?php } ?>
		
		<h3><?php _e(' Premium features available', 'rpgiftcards' ); ?></h3>
		<p>
		<?php _e( 'You can now add additional functionallity to the gift card plugin using some of my premium plugins offered through', 'rpgiftcards' ); ?> <a href="wp-ronin.com">wp-ronin.com</a>.
		</p>
		<br class="clear" />
		<div class='wc_addons_wrap' style="margin-top:10px;">
		<ul class="products" style="overflow:hidden;">
		<?php

			$i = 0;
			$addons = array();

			if( ! class_exists( 'WPRWG_GiftCards_Pro' ) ) {
				$addons[$i]["title"] = __('Woocommerce Giftcards Pro', 'rpgiftcards' );
				$addons[$i]["image"] = "";
				$addons[$i]["excerpt"] = __( 'Get all the added features of the Pro gift card addon in this one package.', 'rpgiftcards' );
				$addons[$i]["link"] = "https://wp-ronin.com/downloads/";
				$i++;
			}

			if( ! class_exists( 'WPRWG_Custom_Price' ) ) {
				$addons[$i]["title"] = __('Custom Price', 'rpgiftcards' );
				$addons[$i]["image"] = "";
				$addons[$i]["excerpt"] = __( 'Dont want to have to create multiple products to offer Gift Cards on your site.  Use this plugin to create a single product that allows your customers to put in the price.  Select 10 – 10000000 it wont matter.', 'rpgiftcards' );
				$addons[$i]["link"] = "https://wp-ronin.com/downloads/woocommerce-gift-cards-custom-price/";
				$i++;
			}

			if( ! class_exists( 'WPRWG_Custom_Number' ) ) {
				$addons[$i]["title"] = __( 'Customize Card Number', 'rpgiftcards' );
				$addons[$i]["image"] = "";
				$addons[$i]["excerpt"] = __( 'Want to be able to customize the gift card number when it is created, this plugin will do it.', 'rpgiftcards' );
				$addons[$i]["link"] = "https://wp-ronin.com/downloads/woocommerce-gift-cards-customize-gift-card/";
				$i++;
			}

			if( ! class_exists( 'WPRWG_Auto_Send' ) ) {
				$addons[$i]["title"] = __( 'Auto Send Card', 'rpgiftcards' );
				$addons[$i]["image"] = "";
				$addons[$i]["excerpt"] = __( 'Save time creating gift cards by using this plugin.  Enable it and customers will have their gift card sent out directly upon purchase or payment.', 'rpgiftcards' );
				$addons[$i]["link"] = "https://wp-ronin.com/downloads/auto-send-email-woocommerce-gift-cards/";
				$i++;
			}
		
			if( ! class_exists( 'WPRWG_CSV_Importer' ) ) {
				$addons[$i]["title"] = __( 'CSV Importer', 'rpgiftcards' );
				$addons[$i]["image"] = "";
				$addons[$i]["excerpt"] = __( 'Import large number of gift cards with this extention. Use our supplied .', 'rpgiftcards' );
				$addons[$i]["link"] = "https://wp-ronin.com/downloads/csvimporter/";
				$i++;
			}
			
			foreach ( $addons as $addon ) {
				echo '<li class="product" style="float:left; margin:0 1em 1em 0 !important; padding:0; vertical-align:top; width:300px;">';
				echo '<a href="' . $addon['link'] . '">';
				if ( ! empty( $addon['image'] ) ) {
					echo '<img src="' . $addon['image'] . '"/>';
				} else {
					echo '<h3>' . $addon['title'] . '</h3>';
				}
				echo '<p>' . $addon['excerpt'] . '</p>';
				echo '</a>';
				echo '</li>';
			}
		?>
		</ul>
		</div>
		<?php
	}

	public function activatedPlugins() {

		if( defined( 'WPR_GC_PRO_TEXT' ) || defined( 'RPWCGC_AUTO_CORE_TEXT_DOMAIN' ) || defined( 'WPR_CP_CORE_TEXT_DOMAIN' ) || defined( 'RPWCGC_CN_CORE_TEXT_DOMAIN' ) )
			return true;

		if( defined( 'WPR_GC_ACTIVE_PLUGIN' ) )
			return true;

		return false;

	}


	public function excludeProducts() {
		?>
			<tr valign="top" class="">
				<th class="titledesc" scope="row">
					<?php _e( 'Exclude products', 'rpgiftcards' ); ?>
					<img class="help_tip" data-tip='<?php _e( 'Products which gift cards can not be used on', 'rpgiftcards' ); ?>' src="<?php echo WC()->plugin_url(); ?>/assets/images/help.png" height="16" width="16" />
				</th>
					<td class="forminp forminp-checkbox">
					<fieldset>
						<input type="hidden" class="wc-product-search" data-multiple="true" style="width: 50%;" name="exclude_product_ids" data-placeholder="<?php _e( 'Search for a product&hellip;', 'rpgiftcards' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-selected="<?php
							$product_ids = array_filter( array_map( 'absint', explode( ',', get_option( 'exclude_product_ids' ) ) ) );
							$json_ids    = array();

							foreach ( $product_ids as $product_id ) {
								$product = wc_get_product( $product_id );
								$json_ids[ $product_id ] = wp_kses_post( $product->get_formatted_name() );
							}

							echo esc_attr( json_encode( $json_ids ) );
						?>" value="<?php echo implode( ',', array_keys( $json_ids ) ); ?>" />
					</fieldset>
				</td>
			</tr>
		<?php

	}

}


return new RPGC_Settings();
