<?php
    echo '<header data-inview><h3 class="sticky-header fs--xxxxl ls--m tt--uc"><span>Latest</span></h3></header>';
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4
    );
    $latest_query = new WP_Query( $args );
    if ( $latest_query->have_posts() ) {
        echo '<section class="posts module">';
        while ( $latest_query->have_posts() ) {
            $latest_query->the_post();
            echo '<article class="grid-item" data-inview>';
                insert_grid_item_content(get_the_title(), get_the_excerpt(), get_post_thumbnail_id( get_the_id() ), 'post', get_the_tags(), false, "more", array("image","text"));
            echo '</article>';
        }
        echo '</section>';
        /* Restore original Post Data */
        wp_reset_postdata();
    }
?>