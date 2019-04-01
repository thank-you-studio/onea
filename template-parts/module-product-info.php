<?php
$recognition = get_field('recognition');
$color_var = 'light';
if($recognition){
    $color_var = 'dark';
}
if(ICL_LANGUAGE_CODE=='de'):
    $specifications = 'Spezifikationen';
else:
    $specifications = 'Specifications';
endif;
echo '<section class="product-info module" data-inview data-color="'.$color_var.'"><div class="wrapper grid">';

    $product_description = get_field('description');

    if($product_description){
        echo '<div class="product-description fs--l lh--m fw--lighter ls--s" data-animatable>'.$product_description . '</div>';
    }

    if(!get_field('show_recognition')){
        echo '<section class="product-specifications fs--s tt--uc" data-animatable>';
            echo '<h3 class="faded">'.$specifications.'</h3>';
            echo '<ul>';
                insert_terms('size');
                insert_terms('lumens');
                insert_terms('temperature');
                insert_terms('watts');
            echo '</ul>';
        echo '</section>';
    }else{
        if(is_array($recognition)){
            echo '<ul class="recognition">';
            foreach($recognition as $logo){
                echo '<li>';
                echo '<img src="'.$logo['url'].'".>';
                echo '</li>';
            }
            echo '</ul>';
        }
    }

echo '</div></section>';
?>