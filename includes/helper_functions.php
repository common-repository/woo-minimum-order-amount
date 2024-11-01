<?php
/*
* Developer: Robiul Awal
* The followting function Available 
*/

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

	class helperFunction{
		
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
			add_filter( 'woocommerce_settings_tabs_array', array($this,'ns_new_setting_tab'),999 );
			add_filter( 'woocommerce_settings_tabs_ns_new_setting_tab', array($this, 'tab_content'));
			add_action( 'woocommerce_update_options_ns_new_setting_tab', array($this, 'update_settings') );
		}

		function ns_new_setting_tab( $ns_settings_tabs ) {
			 $ns_settings_tabs['ns_new_setting_tab'] = __( 'Minimum Price', 'ns_new_setting_tab' );
				return $ns_settings_tabs;
			
		}
		
		
		/**
		 * Get the setting fields
		 *
		 * @since  1.0.0
		 * @access private
		 *
		 * @return array $setting_fields
		 */
		 
		private function get_fields() {
			$setting_fields = array(
				'section_title' => array(
					'name' => __( 'Setting for Minimum Price', 'woocommerce' ),
					'type' => 'title',
					'desc' => '',
					'id'   => 'wc_settings_ns_new_setting_tab_title'
				),
				'minimum_price' => array(
					'name'    => __( 'Minimum Price', 'woocommerce' ),
					'type'    => 'text',
					'desc'    => __( 'Enter Minimum Price Here.', 'woocommerce' ),
					'id'      => 'wc_settings_ns_new_setting_tab_min_price',
					'default' => '20',
				),
				'error_notification' => array(
					'name'    => __( 'Enter Error Notification Text', 'woocommerce' ),
					'type'    => 'textarea',
					//'desc'    => __( '[minAmount] , [currentAmount] will be replaced by minimum amount you entered into the above input field and current user cart price respectively.', 'woocommerce' ),
					'id'      => 'wc_settings_ns_new_setting_tab_error_message',
					'default' => 'You must have an order with a minimum of [minAmount] to place your order, your current order total is [currentAmount].',
				),
			 'section_end' => array(
             'type' => 'sectionend',
             'id' => 'wc_settings_ns_new_setting_tab_section_end'
               )
			);
			return apply_filters( 'wc_settings_tab_ns_new_setting_tab', $setting_fields );
		}
		

		/**
		 * Output the tab content
		 *
		 * @since  1.0.0
		 * @access public
		 *
		 */
			public function tab_content() {
				woocommerce_admin_fields( $this->get_fields() );
			}
		
		   public function update_settings() {
				woocommerce_update_options( $this->get_fields() );
			}
	}
	
  $helperFunction = helperFunction::instance();
  $helperFunction -> addActions();