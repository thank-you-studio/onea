<?php
    $support_title = get_sub_field('title');
    $support_text = get_sub_field('text');
    echo '<div class="grid" data-color="dark">';
    echo '<div class="text" data-animatable>';
    if(isset($support_title)){
        echo '<h4 class="fs--xxl tt--uc"><a href="'.get_post_type_archive_link('support').'" class="line-link"><div class="line"></div><span class="text">'.$support_title.'</span></a></h4>';
    }
    if(isset($support_text)){
        echo '<div class="lh--m">'.$support_text.'</div>';
    }
    echo '</div>';

    $archive_url = get_post_type_archive_link('support');
    $cats = get_sub_field('support_categories');
    if(is_array($cats)){
        echo '<nav class="support-categories" data-animatable>';
        echo '<ul data-animatable>';
        foreach ($cats as $cat) {
            echo '<li class="rollover-effect"><a class="fs--s" href="'.$archive_url . '#' . $cat->slug .'"><span>'.$cat->name.'</span><span class="arrow-right">&#8594;</span></a></li>';
        }
        echo '</ul>';
        echo '</nav>';
    }
    echo '</div>';
?>
