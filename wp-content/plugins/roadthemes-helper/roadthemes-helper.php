<?php
/**
 * Plugin Name: RoadThemes Helper
 * Plugin URI: http://roadthemes.com/
 * Description: The helper plugin for RoadThemes themes.
 * Version: 1.0.0
 * Author: RoadThemes
 * Author URI: http://roadthemes.com/
 * Text Domain: flaton
 * License: GPL/GNU.
 /*  Copyright 2015  RoadThemes  (email : roadthemez@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( file_exists( ABSPATH . 'wp-admin/includes/file.php' ) ) {
	require_once(ABSPATH . 'wp-admin/includes/file.php');
}

add_action( 'add_meta_boxes', 'pedona_add_meta_box');

function pedona_add_meta_box() {

        $screens = array( 'post', 'page' );

        foreach ( $screens as $screen ) {
            if($screen == 'post'){
                add_meta_box(
                    'pedona_post_intro_section',
                    esc_html__( 'Post featured content', 'pedona' ),
                    'Pedona_Class::pedona_meta_box_callback',
                    $screen
                );
                add_meta_box(
                    'pedona_custom_sidebar',
                    esc_html__( 'Custom Sidebar', 'pedona' ),
                    'Pedona_Class::pedona_custom_sidebar_callback',
                    $screen
                );
            }
            if($screen == 'page'){
                add_meta_box(
                    'pedona_custom_sidebar',
                    esc_html__( 'Custom Sidebar', 'pedona' ),
                    'Pedona_Class::pedona_custom_sidebar_callback',
                    $screen
                );
            }
        }
    }


//Add less compiler
function compileLessFile($input, $output, $params) {
   require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
   
	$less = new lessc;
	$less->setVariables($params);
	
    // input and output location
    $inputFile = get_template_directory().'/less/'.$input;
    $outputFile = get_template_directory().'/css/'.$output;

    try {
		$less->compileFile($inputFile, $outputFile);
	} catch (Exception $ex) {
		echo "lessphp fatal error: ".$ex->getMessage();
	}
}
function compileChildLessFile($input, $output, $params) {
	require_once( plugin_dir_path( __FILE__ ).'less/lessc.inc.php' );
	$less = new lessc;
	$less->setVariables($params);
	
    // input and output location
    $inputFile = get_stylesheet_directory().'/less/'.$input;
    $outputFile = get_stylesheet_directory().'/css/'.$output;

    try {
		$less->compileFile($inputFile, $outputFile);
	} catch (Exception $ex) {
		echo "lessphp fatal error: ".$ex->getMessage();
	}
}
function pedona_blog_sharing() {
    global $post;

    $pedona_opt = get_option( 'pedona_opt' );
    
    $share_url = get_permalink( $post->ID );
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
    $postimg = $large_image_url[0];
    $posttitle = get_the_title( $post->ID );
    ?>
    <div class="widget widget_socialsharing_widget">
        <h3 class="widget-title"><?php if(isset($pedona_opt['blog_share_title'])) { echo esc_html($pedona_opt['blog_share_title']); } else { esc_html_e('Share this post', 'pedona'); } ?></h3>
        <ul class="social-icons">
            <li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}
function pedona_product_sharing() {
    $pedona_opt = get_option( 'pedona_opt' );
    
    if(isset($_POST['data'])) { // for the quickview
        $postid = intval( $_POST['data'] );
    } else {
        $postid = get_the_ID();
    }
    
    $share_url = get_permalink( $postid );

    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'large' );
    $postimg = $large_image_url[0];
    $posttitle = get_the_title( $postid );
    ?>
    <div class="widget widget_socialsharing_widget">
        <h3 class="widget-title"><?php if(isset($pedona_opt['product_share_title'])) { echo esc_html($pedona_opt['product_share_title']); } else { esc_html_e('Share this product', 'pedona'); } ?></h3>
        <ul class="social-icons">
            <li><a class="facebook social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.facebook.com/sharer/sharer.php?u='.$share_url; ?>'); return false;" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter social-icon" href="#" title="Twitter" onclick="javascript: window.open('<?php echo 'https://twitter.com/home?status='.$posttitle.'&nbsp;'.$share_url; ?>'); return false;" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li><a class="pinterest social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://pinterest.com/pin/create/button/?url='.$share_url.'&amp;media='.$postimg.'&amp;description='.$posttitle; ?>'); return false;" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a></li>
            <li><a class="gplus social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://plus.google.com/share?url='.$share_url; ?>'); return false;" title="Google +" target="_blank"><i class="fa fa-google-plus"></i></a></li>
            <li><a class="linkedin social-icon" href="#" onclick="javascript: window.open('<?php echo 'https://www.linkedin.com/shareArticle?mini=true&amp;url='.$share_url.'&amp;title='.$posttitle; ?>'); return false;" title="LinkedIn" target="_blank"><i class="fa fa-linkedin"></i></a></li>
        </ul>
    </div>
    <?php
}
//Shortcodes
add_shortcode( 'roadlogo', 'pedona_logo_shortcode' );
add_shortcode( 'roadmainmenu', 'pedona_mainmenu_shortcode' );
add_shortcode( 'roadcategoriesmenu', 'pedona_roadcategoriesmenu_shortcode' );
add_shortcode( 'roadlangswitch', 'pedona_roadlangswitch_shortcode' );
add_shortcode( 'roadsocialicons', 'pedona_roadsocialicons_shortcode' );
add_shortcode( 'roadminicart', 'pedona_roadminicart_shortcode' );
add_shortcode( 'roadproductssearch', 'pedona_roadproductssearch_shortcode' );
add_shortcode( 'roadproductssearchdropdown', 'pedona_roadproductssearchdropdown_shortcode' );
add_shortcode( 'roadcopyright', 'pedona_roadcopyright_shortcode' );
add_shortcode( 'ourbrands', 'pedona_brands_shortcode' );
add_shortcode( 'pedona_counter', 'pedona_counter_shortcode' );
add_shortcode( 'popular_categories', 'pedona_popular_categories_shortcode' );
add_shortcode( 'categoriescarousel', 'pedona_categoriescarousel_shortcode' );
add_shortcode( 'latestposts', 'pedona_latestposts_shortcode' );
add_shortcode( 'pedona_map', 'pedona_contact_map' );
add_shortcode( 'magnifier_map', 'pedona_magnifier_options' );