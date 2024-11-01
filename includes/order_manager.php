<?php
/*
* Developer: Robiul Awal
* Woo-commerce manage Order before placing and after placing 
*/

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

	class orderManager{
		

		// instance 
		public static $instance;
		
		// instance function
		public static function instance(){
			if( self::$instance == null ){
				return self::$instance = new self();
			}
			else self::$instance;	
		}
		
		/*
		* Will run all filter and actions 
		* @param none
		* @return none
		*/
		
		public function addActions(){
			add_action( 'woocommerce_checkout_process', array($this,'wc_minimum_order_amount') );
			add_action( 'woocommerce_before_cart' , array($this,'wc_minimum_order_amount') );
		}
		
		function wc_minimum_order_amount() {

			$minimum = get_option( 'wc_settings_ns_new_setting_tab_min_price' );
			$message = get_option( 'wc_settings_ns_new_setting_tab_error_message' );
			
			$message = str_replace("[minAmount]", "%s", $message);
			$message = str_replace("[currentAmount]", "%s", $message);

			if ( WC()->cart->total < $minimum ) {

				if( is_cart() ) {
					wc_print_notice( __( sprintf( $message , wc_price( $minimum ), wc_price( WC()->cart->total )), 'woocommerce'), 'error');

				} else {
					wc_add_notice( __( sprintf( $message , wc_price( $minimum ),wc_price( WC()->cart->total )), 'woocommerce'), 'error' );
				}
			}
		}		
		


	}
	
  $oma = orderManager::instance();
  $oma -> addActions();
  
  
