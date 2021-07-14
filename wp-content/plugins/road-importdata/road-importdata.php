<?php
/**
 * @package Road_Importdata
 * @version 1.1
 */
/*
Plugin Name: Import Sample Data 
Plugin URI: http://wordpress.org/plugins/road-importdata/
Description: This plugin use to import demo data 
Author: Roadthemes
Version: 1.1
Author URI: http://roadthemes.com/
*/
// Constants

$theme = wp_get_theme();
if( !empty( $theme['Template'] ) ){
	$theme = wp_get_theme($theme['Template']);
}

define('THEME_NAME', $theme['Name'] );
define('THEME_SLUG', $theme['Template'] );
define( 'DS', DIRECTORY_SEPARATOR );
define('IMPORT_PATH', dirname(__FILE__));
define('THEME_DIRECTORY', get_template_directory() );
define('ROAD_SITE_URI', site_url() );
define('API_SERVER', 'roadthemes.com' );
define('THEME_URI', get_template_directory_uri() );

class RoadImportdata {
	
	function __construct() {
		
		 add_action('admin_menu', array($this,'addMyAdminMenu'));
		
	}
	
	public function addMyAdminMenu() {
         
         add_menu_page(
            'Import Roadthemes',
            'Import Roadthemes',
            'manage_options',
            'road-importdata',
            array(
                $this,
                'importdata'
            ),
            plugin_dir_url( __FILE__ ).'icon.png',
            '75'
        );
    }
	
	public function importdata () {
			
			include IMPORT_PATH.DS.'sample.php';
		
	}
}

$import_data = new RoadImportdata();

