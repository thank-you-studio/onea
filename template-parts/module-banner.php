<?php
    $banner_obj = get_sub_field('select_banner');
    // $banner_obj
    $post_thumbnail_obj = wp_get_attachment_metadata( get_post_thumbnail_id( $banner_obj->ID ) );
    $link_obj = get_field('link', $banner_obj);
    echo '<div class="inner">';
    echo '<div class="bg-image" style="opacity:'. get_field('image_opacity', $banner_obj).'">';
        insert_image(get_post_thumbnail_id( $banner_obj->ID ));
    echo '</div>';
    echo '<div class="wrapper grid" data-color="light">';
        echo '<div>';
            echo '<h5 class="fs--xl tt--uc lh--s" data-animatable><span>' . $banner_obj->post_title . '</span></h5>';
            echo '<p class="lh--m" data-animatable><span>' . get_field('text', $banner_obj) . '</span></p>';
            echo '<div data-animatable><span>';
            insert_button($link_obj['title'],$link_obj['url'], 'secondary');
            echo '</span></div>';
        echo '</div>';
    echo '</div>';
    echo '</div>';
?>