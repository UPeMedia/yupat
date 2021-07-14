<?php
function pedona_logo_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'logo_image' => '',
		'logo_link'    => 'yes',
		'logo_width'   => '150',
		), $atts, 'roadlogo' );
	$html = '';
	ob_start(); ?>
	<?php
	if( isset($atts['logo_image']) && $atts['logo_image']!='') {
		$html .= '<div class="logo">';
			if($atts['logo_link']=='yes'){
				$html .= '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';
			}
			if ($atts['logo_width'] == '' || ! is_numeric($atts['logo_width'])) {
				$logo_width = '100%';
			} else {
				$logo_width = floatval($atts['logo_width']);
			}
			$html .= '<img width="'.esc_attr($logo_width).'" src="'.wp_get_attachment_url( $atts['logo_image']).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" />';
			if($atts['logo_link']=='yes'){
				$html .= '</a>';
			}
		$html .= '</div>';
	} else {
		$html .= '<h1 class="logo">';
			if($atts['logo_link']=='yes'){
				$html .= '<a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" rel="home">';
			}
			$html .= bloginfo( 'name' );
			if($atts['logo_link']=='yes'){
				$html .= '</a>';
			}
		$html .= '</h1>';
	} ?>
	<?php
	$html .= ob_get_contents();
	ob_end_clean();
	return $html;
}

function pedona_mainmenu_shortcode( $atts ) {
	$pedona_opt = get_option( 'pedona_opt' );

	$atts = shortcode_atts( array(
							'sticky_logoimage' => '',
							), $atts, 'roadmainmenu' );
	$html = '';
	
	ob_start(); ?>
	<div class="main-menu-wrapper">
		<div class="visible-small mobile-menu"> 
			<div class="mbmenu-toggler"><?php echo esc_html($pedona_opt['mobile_menu_label']);?><span class="mbmenu-icon"><i class="fa fa-bars"></i></span></div>
			<div class="clearfix"></div>
			<?php wp_nav_menu( array( 'theme_location' => 'mobilemenu', 'container_class' => 'mobile-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
		</div>
		<div class="<?php if(isset($pedona_opt['sticky_header']) && $pedona_opt['sticky_header']) {echo 'header-sticky';} ?> <?php if ( is_admin_bar_showing() ) {echo 'with-admin-bar';} ?>">
			<div class="nav-container">
				<?php if( isset($atts['sticky_logoimage']) && $atts['sticky_logoimage']!=''){ ?>
					<div class="logo-sticky"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo  wp_get_attachment_url( $atts['sticky_logoimage']);?>" alt=" <?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> " /></a></div>
				<?php } ?>
				<div class="horizontal-menu visible-large">
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'primary-menu-container', 'menu_class' => 'nav-menu' ) ); ?>
				</div> 
			</div> 
		</div>
	</div>	
	<?php
	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function pedona_roadcategoriesmenu_shortcode ( $atts ) {

	$pedona_opt = get_option( 'pedona_opt' );

	$html = '';

	ob_start();

	$cat_menu_class = '';

	if(isset($pedona_opt['categories_menu_home']) && $pedona_opt['categories_menu_home']) {
		$cat_menu_class .=' show_home';
	}
	if(isset($pedona_opt['categories_menu_sub']) && $pedona_opt['categories_menu_sub']) {
		$cat_menu_class .=' show_inner';
	}
	?>
	<div class="categories-menu-wrapper">
		<div class="categories-menu-inner">
			<div class="categories-menu visible-large <?php echo esc_attr($cat_menu_class); ?>">
				<div class="catemenu-toggler"><span><?php if(isset($pedona_opt)) { echo esc_html($pedona_opt['categories_menu_label']); } else { _e('Category', 'pedona'); } ?></span></div>
				<div class="catemenu-inner">
					<?php wp_nav_menu( array( 'theme_location' => 'categories', 'container_class' => 'categories-menu-container', 'menu_class' => 'categories-menu' ) ); ?>
					<div class="morelesscate">
						<span class="morecate"><i class="fa fa-plus"></i><?php if ( isset($pedona_opt['categories_more_label']) && $pedona_opt['categories_more_label']!='' ) { echo esc_html($pedona_opt['categories_more_label']); } else { _e('More Categories', 'pedona'); } ?></span>
						<span class="lesscate"><i class="fa fa-minus"></i><?php if ( isset($pedona_opt['categories_less_label']) && $pedona_opt['categories_less_label']!='' ) { echo esc_html($pedona_opt['categories_less_label']); } else { _e('Close Menu', 'pedona'); } ?></span>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<?php

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function pedona_roadlangswitch_shortcode( $atts ) {
	$pedona_opt = get_option( 'pedona_opt' );

	$html = '';

	ob_start();

	if (class_exists('SitePress')) { ?>
		<div class="switcher">
			<div class="language"><span class="switcher-title"><?php echo esc_html_e('Language', 'pedona');?> </span> <?php do_action('icl_language_selector'); ?></div>
			<div class="currency"><span class="switcher-title"><?php echo esc_html_e('Currency', 'pedona');?> </span> <?php do_action('currency_switcher'); ?></div>
		</div> 
	<?php }

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function pedona_roadsocialicons_shortcode( $atts ) {
	$pedona_opt = get_option( 'pedona_opt' );

	$html = '';

	ob_start();

	if(isset($pedona_opt['social_icons'])) {
		echo '<ul class="social-icons">';
		foreach($pedona_opt['social_icons'] as $key=>$value ) {
			if($value!=''){
				if($key=='vimeo'){
					echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
				} else {
					echo '<li><a class="'.esc_attr($key).' social-icon" href="'.esc_url($value).'" title="'.ucwords(esc_attr($key)).'" target="_blank"><i class="fa fa-'.esc_attr($key).'"></i></a></li>';
				}
			}
		}
		echo '</ul>';
	}

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function pedona_roadminicart_shortcode( $atts ) {

	$html = '';

	ob_start();

	if ( class_exists( 'WC_Widget_Cart' ) ) {
		the_widget('Custom_WC_Widget_Cart');
	}

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function pedona_roadproductssearch_shortcode( $atts ) {

	$html = '';

	ob_start();

	if( class_exists('WC_Widget_Product_Categories') && class_exists('WC_Widget_Product_Search') ) { ?>
  		<div class="header-search">
	  		<div class="search-without-dropdown">
		  		<div class="categories-container">
		  			<div class="cate-toggler-wrapper"><div class="cate-toggler"><?php esc_html_e('All Categories', 'pedona');?></div></div>
		  			<?php the_widget('WC_Widget_Product_Categories', array('hierarchical' => true, 'title' => 'All Categories', 'orderby' => 'order')); ?>
		  		</div> 
		   		<?php the_widget('WC_Widget_Product_Search', array('title' => 'Search')); ?>
	  		</div>
  		</div>
	<?php }

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function pedona_roadproductssearchdropdown_shortcode( $atts ) {

	$html = '';

	ob_start();

	if( class_exists('WC_Widget_Product_Categories') && class_exists('WC_Widget_Product_Search') ) { ?>
		<div class="header-search">
			<div class="search-dropdown">
				<?php the_widget('WC_Widget_Product_Search', array('title' => 'Search')); ?>
			</div>
		</div>
	<?php }

	$html .= ob_get_contents();

	ob_end_clean();
	
	return $html;
}

function pedona_brands_shortcode( $atts ) {
	global $pedona_opt;
	$brand_index = 0;
	
	if(isset($pedona_opt['brand_logos'])) {
		$brandfound = count($pedona_opt['brand_logos']);
	}
	$atts = shortcode_atts( array(
							'rowsnumber' => '1',
							'colsnumber' => '6',
							), $atts, 'ourbrands' );
	$html = '';
	
	if(isset($pedona_opt['brand_logos']) && $pedona_opt['brand_logos']) {
		$html .= '<div class="brands-carousel" data-col="'.$atts['colsnumber'].'">';
			foreach($pedona_opt['brand_logos'] as $brand) {
				if(is_ssl()){
					$brand['image'] = str_replace('http:', 'https:', $brand['image']);
				}
				$brand_index ++;
				if ( (0 == ( $brand_index - 1 ) % $atts['rowsnumber'] ) || $brand_index == 1) {
					$html .= '<div class="group">';
				}
				$html .= '<div>';
				$html .= '<a href="'.esc_url($brand['url']).'" title="'.esc_html($brand['title']).'">';
					$html .= '<img src="'.esc_url($brand['image']).'" alt="'.esc_attr($brand['title']).'" />';
				$html .= '</a>';
				$html .= '</div>';
				if ( ( ( 0 == $brand_index % $atts['rowsnumber'] || $brandfound == $brand_index ))  ) {
					$html .= '</div>';
				}
			}
		$html .= '</div>';
	}
	
	return $html;
}

function pedona_counter_shortcode( $atts ) {
	
	$atts = shortcode_atts( array(
							'image' => '',
							'number' => '100',
							'text' => 'Demo text',
							), $atts, 'pedona_counter' );
	$html = '';
	$html.='<div class="pedona-counter">';
		$html.='<div class="counter-image">';
			$html.='<img src="'.wp_get_attachment_url($atts['image']).'" alt="'.esc_attr( $atts['text'] ).'" />';
		$html.='</div>';
		$html.='<div class="counter-info">';
			$html.='<div class="counter-number">';
				$html.='<span>'.$atts['number'].'</span>';
			$html.='</div>';
			$html.='<div class="counter-text">';
				$html.='<span>'.$atts['text'].'</span>';
			$html.='</div>';
		$html.='</div>';
	$html.='</div>';
	
	return $html;
}

function pedona_popular_categories_shortcode( $atts ) {

	$atts = shortcode_atts( array(
		'category' => '',
		'image' => ''
	), $atts, 'popular_categories' );
	
	$html = '';
	
	$html .= '<div class="category-wrapper">';
		$pcategory = get_term_by( 'slug', $atts['category'], 'product_cat', 'ARRAY_A' );
		if($pcategory){
			$html .= '<div class="category-list">';
				$html .= '<h3><a href="'. get_term_link($pcategory['slug'], 'product_cat') .'">'. $pcategory['name'] .'</a></h3>';
				
				$html .= '<ul>';
					$args2 = array(
						'taxonomy'     => 'product_cat',
						'child_of'     => 0,
						'parent'       => $pcategory['term_id'],
						'orderby'      => 'name',
						'show_count'   => 0,
						'pad_counts'   => 0,
						'hierarchical' => 0,
						'title_li'     => '',
						'hide_empty'   => 0
					);
					$sub_cats = get_categories( $args2 );

					if($sub_cats) {
						foreach($sub_cats as $sub_category) {
							$html .= '<li><a href="'.get_term_link($sub_category->slug, 'product_cat').'">'.$sub_category->name.'</a></li>';
						}
					}
				$html .= '</ul>';
			$html .= '</div>';

			if ($atts['image']!='') {
			$html .= '<div class="cat-img">';
				$html .= '<a href="'.get_term_link($pcategory['slug'], 'product_cat').'"><img class="category-image" src="'.esc_attr($atts['image']).'" alt="'.esc_attr($pcategory['name']).'" /></a>';
			$html .= '</div>';
			}
		}
	$html .= '</div>';
	
	return $html;
}

function pedona_latestposts_shortcode( $atts ) {
	global $pedona_opt;
	$post_index = 0;
	$atts = shortcode_atts( array(
		'posts_per_page' => 5,
		'order' => 'DESC',
		'orderby' => 'post_date',
		'image' => 'wide', //square
		'length' => 20,
		'rowsnumber' => '1',
		'colsnumber' => '4',
		'image1' => 'square',
	), $atts, 'latestposts' );
	
	if($atts['image']=='wide'){
		$imagesize = 'pedona-post-thumbwide';
	} else {
		$imagesize = 'pedona-post-thumb';
	}
	$html = '';

	$postargs = array(
		'posts_per_page'   => $atts['posts_per_page'],
		'offset'           => 0,
		'category'         => '',
		'category_name'    => '',
		'orderby'          => $atts['orderby'],
		'order'            => $atts['order'],
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	
	$postslist = get_posts( $postargs );

	$html.='<div class="posts-carousel" data-col="'.$atts['colsnumber'].'">';

			foreach ( $postslist as $post ) {
				$post_index ++;
				if ( (0 == ( $post_index - 1 ) % $atts['rowsnumber'] ) || $post_index == 1) {
					$html .= '<div class="group">';
				}
				$html.='<div class="item-col">';
					$html.='<div class="post-wrapper">';

					// author link
					$author_id = $post->post_author;
					$author_url = get_author_posts_url( get_the_author_meta( 'ID', $author_id ) );
					$author_name = get_the_author_meta( 'user_nicename', $author_id );
					
					//comment variables
					$num_comments = (int)get_comments_number($post->ID);
					$write_comments = '';
					if ( comments_open($post->ID) ) {
						if ( $num_comments == 0 ) {
							$comments = wp_kses(__('<span>0</span> comments', 'pedona'), array('span'=>array()));
						} elseif ( $num_comments > 1 ) {
							$comments = '<span>'.$num_comments .'</span>'. esc_html__(' comments', 'pedona');
						} else {
							$comments = wp_kses(__('<span>1</span> comment', 'pedona'), array('span'=>array()));
						}
						$write_comments = '<a href="' . get_comments_link($post->ID) .'">'. $comments.'</a>';
					}
					
					$html.='<div class="post-content">'; 

						$html.='<div class="post-thumb">'; 

							$html.='<a href="'.get_the_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, $imagesize).'</a>';

						$html.='</div>';
						
						$html.='<div class="post-info">';

							$html.='<h3 class="post-title"><a href="'.get_the_permalink($post->ID).'">'.get_the_title($post->ID).'</a></h3>';	
							$html.='<div class="post-excerpt">';
								$html.= Pedona_Class::pedona_excerpt_by_id($post, $length = $atts['length']);
							$html.='</div>';

						$html.='</div>';

					$html.='</div>';	

					$html.='<div class="post-meta">';

						$html.='<p class="post-author">';
							$html.= sprintf( wp_kses(__( '%s', 'pedona' ), array('a'=>array('href'=>array()))), __('Posted by ', 'pedona').'<a href="'.$author_url.'">'.$author_name.'</a>' );
						$html.='</p>';
						
						$html.='<div class="post-date">'.get_the_date().'</div>';

						$html.='<p class="post-comment">'.$write_comments.'</p>';

					$html.='</div>';

				$html.='</div>';
			$html.='</div>';
			if ( ( ( 0 == $post_index % $atts['rowsnumber'] || $atts['posts_per_page'] == $post_index ))  ) {
				$html .= '</div>';
			}
		}
	$html.='</div>';

	wp_reset_postdata();
	
	return $html;
}

function pedona_contact_map( $atts ) {
	global $pedona_mapid;
	
	if(!isset($pedona_mapid)){
		$pedona_mapid = 1;
	} else {
		$pedona_mapid++;
	}
	$atts = shortcode_atts( array(
		'map_height' => 400,
		'map_zoom' => 17,
		'lat1' => '',
		'long1' => '',
		'address1' => '',
		'marker1' => '',
		'description1' => '',
		
	), $atts, 'pedona_map' );
	
	$map_zoom = 17;
	if(intval($atts['map_zoom'])){
		$map_zoom = intval($atts['map_zoom']);
	}
	$map_height = 400;
	if(intval($atts['map_height'])){
		$map_height = intval($atts['map_height']);
	}
	
	$markers = array(
		array(
			'lat1' => $atts['lat1'],
			'long1' => $atts['long1'],
			'address1' => $atts['address1'],
			'marker1' => $atts['marker1'],
			'description1' => $atts['description1'],
		),
	);
	
	$html = '';
	
	$html.='<div class="map-wrapper">';
		$html.='<div id="map'.$pedona_mapid.'" class="map" style="height: '.$map_height.'px"></div>';
	$html.='</div>';
	
	//Add google map API
	wp_enqueue_script( 'gmap-api-js', 'http://maps.google.com/maps/api/js?sensor=false' , array(), '3', false );
	// Add jquery.gmap.js file
	wp_enqueue_script( 'jquery.gmap-js', get_template_directory_uri() . '/js/jquery.gmap.js', array(), '2.1.5', false );

	?>
	
	<?php 
	    $mark_array = array();
	    $markeridx = 0;
	    foreach($markers as $marker){
	    $markeridx++;
	      
	    $map_desc = str_replace(array("\r\n", "\r", "\n"), "", $marker['description'.$markeridx]);
	    $map_desc = addslashes($map_desc);
			
	    if( $marker['address'.$markeridx]!='' || ($marker['lat'.$markeridx]!='' && $marker['long'.$markeridx]!='') ){

	    	$mark_latitude = esc_js($marker['lat'.$markeridx]);
	    	$mark_longitude = esc_js($marker['long'.$markeridx]);
			  
			$icon = get_template_directory_uri() . '/images/marker.png'; 	
		  	if( isset($marker['marker'.$markeridx]) && $marker['marker'.$markeridx]!='') {
			  $icon =  wp_get_attachment_url( $marker['marker'.$markeridx]); 
		  	}		 
			$mark_options = " {latitude:".$mark_latitude.",longitude:".$mark_longitude.",popup: true,html: '".$map_desc."',icon:{image:'".$icon."',iconsize:[40, 46],iconanchor:[40, 40]}}, ";

			$mark_array  = array(
				'latitude' => $mark_latitude,
				'longitude' => $mark_longitude,
				'html' => $map_desc, 
				'icon' => $icon

			);
      	}
    } 

    wp_enqueue_script('pedona_contact_map_script', get_template_directory_uri() . '/js/contact-map-var.js');
    wp_localize_script('pedona_contact_map_script', 'pedona_contact_vars', array(
    		'pedona_mapid' => esc_attr($pedona_mapid),
    		'zoom' => esc_js($map_zoom),
    		'markers' => $mark_array,
    	)
    );
   
  	?>
	
	<?php
	
	return $html;
}
function pedona_magnifier_options($att) {  
	$enable_slider 	= get_option('yith_wcmg_enableslider') == 'yes' ? true : false;
	$slider_items = get_option( 'yith_wcmg_slider_items', 3 ); 
	if ( !isset($slider_items) || ( $slider_items == null ) ) $slider_items = 3;

	wp_enqueue_script('pedona_magnifier', get_template_directory_uri() . '/js/product-magnifier-var.js');
	wp_localize_script('pedona_magnifier', 'pedona_magnifier_vars', array(
		
			'responsive' => get_option('yith_wcmg_slider_responsive') == 'yes' ? 'true' : 'false',
			'circular' => get_option('yith_wcmg_slider_circular') == 'yes' ? 'true' : 'false',
			'infinite' => get_option('yith_wcmg_slider_infinite') == 'yes' ? 'true' : 'false',

			'visible' => esc_js(apply_filters( 'woocommerce_product_thumbnails_columns', $slider_items )),

			'zoomWidth' => get_option('yith_wcmg_zoom_width'),
			'zoomHeight' => get_option('yith_wcmg_zoom_height'),
			'position' => get_option('yith_wcmg_zoom_position'),

			'lensOpacity' => get_option('yith_wcmg_lens_opacity'),
			'softFocus' => get_option('yith_wcmg_softfocus') == 'yes' ? 'true' : 'false',
			'phoneBehavior' => get_option('yith_wcmg_zoom_mobile_position'),
			'loadingLabel' => stripslashes(get_option('yith_wcmg_loading_label')),
		)
	);
}
?>