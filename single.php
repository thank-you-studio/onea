<?php
    get_header();
    echo '<div class="wrapper">';
        echo '<div class="grid" data-animatable>';
            echo '<header class="post-title"><h1 class="fs--xl tt--uc ls--m lh--s">'.get_the_title().'</h1></header>';
            echo '<aside class="post-date"><span class="faded lh--m tt--uc">'.get_the_date().'</span></aside>';
            echo '<article class="post-content" data-module="article">'.apply_filters('the_content', $post->post_content).'</article>';
            insert_posttags(get_the_tags());
        echo '</div>';
    echo '</div>';
    get_footer();