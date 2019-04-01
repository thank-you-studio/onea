<?php
add_theme_support('post-thumbnails');
/**
 * Adserball & Knudsen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Adserball_&_Knudsen
 */

/**
 * Enqueue scripts and styles.
 */
add_action( 'after_setup_theme', 'register_my_menu' );
function register_my_menu() {
	register_nav_menus( array(
		'primary_menu' => 'Primary Menu',
	) );
}

function onea_scripts() {

	wp_enqueue_style( 'onea-styles', get_template_directory_uri() . '/assets/dist/styles/styles.min.css', array(), true );
	wp_enqueue_script( 'onea-scripts', get_template_directory_uri() . '/assets/build/scripts/scripts.js', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'onea_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
*/

require get_template_directory() . '/inc/template-functions.php';

// require get_template_directory() . '/inc/custom-admin-nav.php';

require get_template_directory() . '/inc/cleanup-admin.php';

require get_template_directory() . '/inc/cleanup-frontend.php';

require get_template_directory() . '/inc/acf.php';

add_image_size( 'lowres-thumbnail', 20, 20, false );

function insert_image($img) {

	if(is_array($img)){
		$img_id = $img['id'];
	}else{
		$img_id = $img;
	}

	$dominant_hex = get_color_data($img_id,'dominant_color_hex');
	$srcset = wp_get_attachment_image_srcset($img_id);
	$full_size = wp_get_attachment_image_src($img_id, 'full')[0];
	$lores_thumb = wp_get_attachment_image_src( $img_id, 'lowres-thumbnail')[0];

	// var_dump($dominant_hex);


	echo '<div style="background-color:'.$dominant_hex.'" class="image-wrapper">';
	echo '<div class="inner">';
	echo '<img src="'.$full_size.'" alt="'.get_post_meta($img_id, 'caption', true).'"/>';
	if(isset($img['caption'])){
		if($img['caption'] != ''){
			echo '<p class="caption lh-medium fs-small">'.$img['caption'].'</p>';
		}
	}
	echo '</div></div>';
}

function insert_menu_items($items, $size = 'l', $direction = ''){
	if(isset($items)){
		foreach( $items as $item ){
			$link = $item->url;
			$title = $item->title;
			echo '<li>
				<a href="'.$link.'" class="line-link fs--'.$size.' tt--uc '.$direction.'">
					<span class="line"></span>
					<span class="text">'.$title.'</span>
				</a>
				</li>';
		}
	}
}

function insert_language_items($items, $size = 'l'){
	if(isset($items)){
		foreach( $items as $item ){
			$link = $item['url'];
			$title = $item['native_name'];
			echo '<li>
				<a href="'.$link.'" class="fs--'.$size.' tt--uc no-barba">
					<span class="line"></span>
					<span class="text">'.$title.'</span>
				</a>
				</li>';
		}
	}
}

function insert_terms($tax_name){
	$tax_obj = get_taxonomy($tax_name);

	if (!is_object($tax_obj)) {
		return false;
	}

	$tax_label = $tax_obj->label;
	$terms = get_the_terms( get_the_ID(), $tax_name );

	if ( $terms && ! is_wp_error( $terms ) ){
		$tax_terms = array();
		foreach ( $terms as $term ) {
			$tax_terms[] = $term->name;
		}
		$tax_term_list = join( ", ", $tax_terms);

		echo '<li><span class="tax uppercase fw-strong">'.$tax_label.'</span> <span class="term lh-medium">'.$tax_term_list.'</span></li>';
	}
}

function insertProductMenu(){
	$cat_args = array(
		'child_of'      => 0,
		'orderby'       => 'name',
		'order'         => 'ASC',
		'hide_empty'    => 1,
		'taxonomy'      => 'category', //change this to any taxonomy
	);

	foreach (get_categories($cat_args) as $tax) :
		// List posts by the terms for a custom taxonomy of any post type
		$args = array(
			'post_type'         => 'product',
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
			'orderby'           => 'title',
			'tax_query' => array(
				array(
					'taxonomy'  => 'category',
					'field'     => 'slug',
					'terms'     => $tax->slug
				)
			)
		);
		if (get_posts($args)) :
		?>
			<h4 class="fs--xs tt--uc faded"><?php echo $tax->name; ?></h4>
			<ul>
				<?php foreach(get_posts($args) as $p) : ?>
					<li><a href="<?php echo get_permalink($p); ?>" class="line-link fs--l tt--uc">
						<span class="line"></span>
						<span class="text"><?php echo $p->post_title; ?></span>
					</a></li>
				<?php endforeach; ?>
			</ul>
		<?php
		endif;
	endforeach;
}

function include_modules(){
	if ( have_rows( 'modules' ) ) :
		$module_count = 0;
		while ( have_rows('modules' ) ) : the_row();
			$module_count++;
			$layout = get_row_layout();

			if($layout === 'support'){
				$data_color = 'data-color="dark"';
			}else{
				$data_color = '';
			}

			echo '<section class="module module--' . get_row_layout() . ' module-count-'.$module_count.'" data-module="'.$layout.'" '.$data_color.'>';
				if($layout != 'banner' && $layout != 'product_carrousel' && $layout != 'grid'){
					echo '<div class="wrapper">';
				}
					include(locate_template('template-parts/module-' . get_row_layout() . '.php'));
				if($layout != 'banner' && $layout != 'product_carrousel' && $layout != 'grid'){
					echo '</div>';
				}
			echo '</section>';
		endwhile;
	endif;
}

function insert_button($text,$url,$type = 'primary'){
	echo '<a class="button button--'.$type.' border-button fw--medium fs--xs tt--uc ls--m" href="'.$url.'"><span>'.$text.'</span></a>';
}

function url_string($string){
	$url_string = str_replace(' ','-',strtolower($string));
	return preg_replace('/[^A-Za-z0-9\-]/', '', $url_string);
}

function insert_grid_item_content($title = false,$text = false, $image = false, $type = false, $posttags = false, $link = false, $link_text = "more", $content_type = false){
	echo '<div class="content grid nested-grid-item" data-inview>';
		$image_checked = false;
		$text_checked = false;
		if($content_type){
			foreach($content_type as $checkbox){
				if($checkbox === 'image'){
					$image_checked = true;
				}
				if($checkbox === 'text'){
					$text_checked = true;
				}
			}
		}
		if($text_checked){
			if($title || $text){
				echo '<div class="text">';
					echo '<div class="inner">';
						if($type === 'post'){
							echo '<aside class="post-date"><span class="faded lh--m fs--s tt--uc">'.get_the_date().'</span></aside>';
						}
						if($title){
							$font_size = 'fs--s';
							if($type === 'post'){
								$font_size = 'fs--m';
							}
							echo '<h4 class="'.$font_size.' tt--uc lh--m"><span>'.$title.'</span></h4>';
						}
						if($text){
							echo '<div class="lh--m ls--s paragraph-text">'.$text.'</div>';
						}
						if($type === 'post' || $link){
							if ($link){
								$url = $link;
							}else{
								$url = get_permalink();
							}
							echo '<div>';
								echo '<a class="fs--xs tt--uc fw--medium more-link" href="'.$url.'"><span>'.$link_text.'</span></a>';
							echo '</div>';
						}
						if($posttags){
							insert_posttags($posttags);
						}
						if($type === 'nested' && !$image){
							include(locate_template('template-parts/component-arrow-down.php' ));
						}
					echo '</div>';
				echo '</div>';
			}
		}
		if($image_checked){
			if($image){
				echo '<div class="image">';
					insert_image($image);
				echo '</div>';
			}
		}

	echo '</div>';
}

function insert_posttags($posttags){
	if ($posttags) {
		echo '<ul class="post-tags">';
		foreach($posttags as $tag) {
			echo '<li><a class="button button--tertiary fw--medium fs--xs tt--uc" href="'.get_term_link($tag).'"><span>'.$tag->name . '</span></a></li>';
		}
		echo '</ul>';
	}
}

define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS',true);