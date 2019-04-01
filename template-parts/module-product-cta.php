<?php
$product_cta_image = get_field('product_cta_image');
$product_cta_text = get_field('product_cta_text');

if($product_cta_image && $product_cta_text):
    echo '<section class="product-cta module" data-color="light"><div class="wrapper grid">';

        if($product_cta_image){
            echo '<div class="image">';
                insert_image($product_cta_image);
            echo '</div>';
        }

        if(is_array($product_cta_text)){
            echo '<div class="text">';
                echo '<div class="inner">';
                    if($product_cta_text['title']){
                        echo '<h4 class="fs--s tt--uc lh--m"><span>'.$product_cta_text['title'].'</span></h4>';
                    }
                    if($product_cta_text['text']){
                        echo '<div class="lh--m ls--s paragraph-text">'. $product_cta_text['text'] .'</div>';
                    }
                    if($product_cta_text['link']){
                        echo '<div>';
                            echo '<a class="button button--secondary fw--medium fs--xs tt--uc" href="'.$product_cta_text['link']['url'].'"><span class="text">'.$product_cta_text['link']['title'].'</span></a>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        }


    echo '</div></section>';
endif;
?>