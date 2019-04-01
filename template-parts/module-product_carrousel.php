<?php
    $product_args = array(
        'post_type' => 'product',
    );

    // The Query
    $the_query = new WP_Query( $product_args );

    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<div class="swiper-container">
            <ul class="swiper-wrapper">';
        while ( $the_query->have_posts() ) {
            include(locate_template('template-parts/component-carrousel-slide.php'));
        }
            echo '</ul>';
            echo '<ul class="carousel-pagi">';
            echo '<li><a href="#" class="pagi-btn button-prev">';
                include(locate_template('template-parts/svg-arrow.php' ));
            echo '</a></li>';
            echo '<li><a href="#" class="pagi-btn button-next">';
                include(locate_template('template-parts/svg-arrow.php' ));
            echo '</a></li>';
            echo '</ul>';
            echo '</div>';
        /* Restore original Post Data */
        wp_reset_postdata();
    }
?>