<?php
    $hero_type = get_field('hero_type');
    $hero_text_color = get_field('hero_text_color');
    if(get_field('animate_background') && $hero_type === 'image'){
        $animate = 'animate';
    }else{
        $animate = '';
    }

    if($hero_type === 'solid'){
        $solid_style = 'style="background-color:'.get_field('hero_background_color').'"';
    } else{
        $solid_style = '';
    }
    if(isset($hero_text_color)){
        $text_color = $hero_text_color;
    }else{
        $text_color = 'dark';
    }
    if(is_archive() || is_home()){
        if(!is_post_type_archive('support')){
            $text_color = 'light';
        }
    }
    echo '<header class="hero '.$animate.'" data-type="'.get_field('hero_type').'" data-color="'.$text_color.'" '.$solid_style.'">';
        if($hero_type === 'image'){
            $hero_image = get_field('hero_image');
            if($hero_image){
                insert_image($hero_image);
            }
        }
        if($hero_type === 'video'){
            $hero_video = get_field('hero_video');
            if(isset($hero_video)){
                echo '<div class="video-wrapper"><video autoplay loop defaultmuted muted playsinline preload="none"><source src="'.$hero_video['url'].'" type="video/mp4"></video></div>';
            }
        }
        echo '<div class="wrapper">';
            echo '<div class="inner ta--center" data-animatable>';
                if(!is_front_page()){
                    $title = get_the_title();
                    if(is_archive()){
                        if(!is_post_type_archive('support')){
                            $title = get_the_archive_title();
                        }else{
                            $title = get_field("support_en", "general")['support_title'];
                        }
                    }
                    if(is_singular('product')){
                        $title = get_field('product_name');
                    }
                    if(is_home()){
                        $title = get_the_title( get_option('page_for_posts', true));
                    }
                    echo '<h1 class="fs--xxxl tt--uc ls--m">'.$title.'</h1>';
                }else{
                    echo '<h1 class="fs--xl tt--uc ls--s">One A</h1>';
                    echo '<div class="product-name description"><p class="lh--m ls--s wrapper">';
                        echo get_bloginfo('description');
                    echo '</p></div>';
                }
                if(is_singular('product')){
                    $product_name = get_the_excerpt();
                    if(isset($product_name)){
                        echo '<div class="product-name"><h2 class="fs--l fw--lighter">'.$product_name.'</h2></div>';
                    }
                }
                if(is_post_type_archive('support')){
                    echo '<div class="product-name description"><p class="lh--m wrapper">';
                        echo get_field("support_en", "general")['support_description'];
                    echo '</p>';
                    echo '</div>';
                }
                if(is_404()){
                    echo '<h1 class="fs--xxxl tt--uc ls--m">Error 404</h1>';
                    echo '<div class="product-name description"><p class="lh--m ls--s wrapper">';
                        echo 'Page Not Found';
                    echo '</p></div>';
                }
            echo '</div>';
        echo '</div>';
        echo '<a href="#" class="hero-arrow">';
        include(locate_template('template-parts/component-arrow-down.php' ));
        echo '</a>';
    echo '</header>';
?>