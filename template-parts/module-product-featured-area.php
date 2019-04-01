<?php
$featured_image_id = get_post_thumbnail_id( get_the_id() );
$overwrite_featured_image = get_field('overwrite_featured_image');
$product_color_style = '';
	$invert_data_string = '';
	if(is_singular('product')){
		$product_color_theme = get_field('color_theme');
		if(isset($product_color_theme)){
			$product_color_style = 'style="background-color:'.$product_color_theme.'"';
		}
	}
if($featured_image_id || $overwrite_featured_image){
    echo '<section class="featured-area module" '.$product_color_style.'>';
        echo '<div class="wrapper grid">';
            echo '<div class="col">';
                if($featured_image_id && !$overwrite_featured_image){
                    insert_image(get_post_thumbnail_id( get_the_id() ));
                }

                if($overwrite_featured_image && get_field('new_featured_image')){
                    insert_image(get_field('new_featured_image'));
                }
            echo '</div>';
        echo '</div>';
    echo '</section>';
}
?>