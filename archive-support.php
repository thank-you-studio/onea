<?php

get_header();

$_terms = get_terms( array('support_category') );

foreach ($_terms as $term) :

    $term_slug = $term->slug;
    $support_posts = new WP_Query( array(
                'post_type'         => 'support',
                'posts_per_page'    => 999, //important for a PHP memory limit warning
                'tax_query' => array(
                    array(
                        'taxonomy' => 'support_category',
                        'field'    => 'slug',
                        'terms'    => $term_slug,
                    ),
                ),
            ));
    echo '<section class="support-category" id="'.url_string($term->name).'">';
    echo '<div class="wrapper">';
    if( $support_posts->have_posts() ) :
        // echo '<h3 class="fs--xxxxl ls--m tt--uc" data-animatable>'. $term->name .'</h3>';
        echo '<nav class="support-deep-links grid">';
        echo '<div class="inner">';
            echo '<h4 class="fs--xl tt--uc ls--m">'. $term->name .'</h4>';
            echo '<ul>';
                while ( $support_posts->have_posts() ) : $support_posts->the_post();
                $support_title = get_the_title();
                    echo '<li><a href="#'.url_string($support_title).'" class="deep-link fw--bold tt--uc">';
                        echo '<span>'.$support_title.'</span>';
                        include(locate_template('template-parts/component-arrow-down.php' ));
                    echo '</a></li>';
                endwhile;
            echo '</ul>';
        echo '</div>';
        echo '</nav>';
    endif;
    if( $support_posts->have_posts() ) :
        echo '<section class="support-posts">';
        echo '<ul class="support-posts-content grid">';
            while ( $support_posts->have_posts() ) : $support_posts->the_post();
            $support_title = get_the_title();
                echo '<li class="support-post" id="'.url_string($support_title).'">
                <h5 class="support-post-title tt--uc fs--xl lh--s">'.$support_title.'</h5>';
                echo '<article class="post-content" data-module="article">'.get_field('content').'</article>';
                if( have_rows('dropdowns') ):
                    echo '<nav class="dropdowns"><ul>';
                    while ( have_rows('dropdowns') ) : the_row();
                    echo '<li class="dropdown-item inactive">';
                        echo '<a class="dropdown-link" href="#"><h6 class="tt--uc fw--bold">'.get_sub_field('title');
                        include(locate_template('template-parts/component-arrow-down.php' ));
                        echo '</a></h6>';
                        echo '<article class="post-content" data-module="article">'.get_sub_field('content').'</article>';
                    echo '</li>';
                    endwhile;
                    echo '</ul></nav>';
                endif;
                echo '</li>';
            endwhile;
        echo '</ul>';
        echo '</section>';
    endif;
    wp_reset_postdata();

    echo '</div>';
    echo '</section>';

endforeach;

get_footer();
