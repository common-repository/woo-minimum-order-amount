<?php
/**
 * Plugin Name: Woo-commerce minimum order Amount
 * Description: By this simple Plugin You can set Woo-commerce minimum Order price 
 * Version: 0.2.1
 * Author: Robiul Awal
 * Author URI: http://github.com/robiulawal40
 *
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if( !class_exists('NsMinAmount') ):

final class NsMinAmount{
	/*
	* class property 
	* 
	*
	*/
	
	private static $instance;
	
	/*
	* instance functions 
	*
	*
	*/
	public static function instance(){
		if( is_null( self::$instance ) ){
			self::$instance = new NsMinAmount;	
		}
		return self::$instance;
	}
	
	/*
	 * Cloning is forbidden.
	 * 
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'nvce' ), '1.0' );
	}

	/*
	 * Unserializing instances of this class is forbidden.
	 * 
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'nvce' ), '1.0' );
	}	
	
	/*
	* Plugin constructor
	*
	*
	*/
	 function __construct(){		 
		 $this->set_constants();
		 $this->includes();
		 $this->init_hooks();
	 }
	
	/*
	* Setting the plugin  constant 
	*
	*/
	public function set_constants(){ 
	
     if (!defined('NS_VERSION')) {
         define('NS_VERSION', '1.0');
     }

     if (!defined('NS_PLUGIN_DIR')) {
         define('NS_PLUGIN_DIR', plugin_dir_path(__FILE__));
     }
     if (!defined('NS_PLUGIN_INCLUDES')) {
         define('NS_PLUGIN_INCLUDES', plugin_dir_path(__FILE__) . 'includes/');
     }

     if (!defined('NS_PLUGIN_URL')) {
         define('NS_PLUGIN_URL', plugin_dir_url(__FILE__));
     }

     if (!defined('NS_PLUGIN_ROOT')) {
         define('NS_PLUGIN_ROOT', __FILE__);
     }
	 if( !defined('NS_JS_SUFFIX') ){
		 define('NS_JS_SUFFIX',''); //.min
	 }
	 
	}
	
	/*
	* Plugin include files 
	*
	*/
	public function includes(){
		
		if ( is_admin() ) {
			//require_once NS_PLUGIN_DIR . "includes/admin.php";
			//require_once NS_PLUGIN_DIR . "includes/post_type_meta_box.php";
			
			}
		require_once NS_PLUGIN_DIR . "includes/helper_functions.php";	
		require_once NS_PLUGIN_DIR . "includes/order_manager.php";	
	}
	
	/*
	* Plugin include hooks  files 
	*
	*/
	public function init_hooks(){
		
	}
	

	
	
}

endif;

function NVCE(){
	return NsMinAmount::instance();
}
NVCE();