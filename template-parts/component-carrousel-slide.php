<?php
    if(ICL_LANGUAGE_CODE=='de'):
        $products = 'produkte';
        $more = 'mehr';
    else:
        $products = 'products';
        $more = 'more';
    endif;
    $the_query->the_post();
    echo '<li class="swiper-slide" data-swiper-parallax-scale="0">
        <div class="inner">
            <div class="content">';
                echo '<h5 class="fs--s tt--uc fw--medium" data-swiper-parallax="-96" data-swiper-parallax-opacity="0">'.$products.'</h5>';
                echo '<h4 class="fs--xl tt--uc" data-swiper-parallax="96">' . get_field('product_name') . '</h4>';
                echo '<p class="lh--s" data-swiper-parallax="-96" data-swiper-parallax-opacity="0">'.get_the_excerpt().'</p>';
                echo '<a class="fs--xs tt--uc fw--medium more-link" href="'.get_the_permalink().'" data-swiper-parallax="-96" data-swiper-parallax-opacity="0">'.$more.'</a>';
            echo '</div>
    </div>';
    echo '<div class="bg-image">';
    insert_image(get_post_thumbnail_id( get_the_id()));
    echo '</div>';
    echo '</li>';
?>