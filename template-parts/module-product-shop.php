<?php if(!get_field('hide_shop')): ?>
<section class="module shop" data-color="dark">
<?php
$text = get_field('text');
$price = get_field('price');
$shop_gallery = get_field('shop_gallery');
if(isset($text) && $shop_gallery){
    echo '<section class="shop-info wrapper"><div class="inner wrapper"><div class="center">';
    echo '<div class="buttons">';
    if(get_field('shopify_item_id')){
        echo '<p id="buy-btn" data-shopify="'.get_field('shopify_item_id').'"></p>';
    }
    echo '<p class="solid-button solid-button--ghosted">Find Retailer</p></div>';
    echo '<div class="shop-content">';
    echo '<div class="product-content">';
    echo '<h4 class="fs--xl">'.get_the_title().'</h4>';
    echo '<p class="ls--s lh--m">'.$price.' &euro;</p>';
    echo '<p class="ls--s lh--m">'.$text.'</p>';
    echo '</div>';
    if( have_rows('tab') ):
        echo '<div class="tab-wrapper"><ul class="tabs">';
        // loop through the rows of data
            while ( have_rows('tab') ) : the_row();

            // display a sub field value
            echo '<li>
                <a class="tab-title fs--xs tt--uc line-link" href="#"><span class="line"></span><span class="text">'.get_sub_field('title').'</span></a>
                <div class="tab-content ls--s lh--m wrapper"><h5 class="fw--bold">'.get_sub_field('title').'</h5>'.get_sub_field('text').'</div>
            </li>';

            endwhile;
        echo '</ul></div></div>';
    endif;
    echo '</div></div></section>';
}
if($shop_gallery){
    echo '<div class="shop-carrousel swiper-container"><div class="swiper-wrapper">';
    foreach($shop_gallery as $image){
        $landscape_class = '';
        if($image['width'] > $image['height']){
            $landscape_class = 'landscape';
        }
        echo '<div class="swiper-slide '.$landscape_class.'">';
        insert_image($image);
        echo '</div>';
    }
    echo '</div></div>';
}

?>
</section>
<?php endif; ?>