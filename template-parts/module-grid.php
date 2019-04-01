<?php
    if(get_sub_field('add_grid_title')){
        echo '<h3 class="wrapper ta--center fs--xxxl tt--uc ls--m">'.get_sub_field('grid_title').'</h3>';
    }

    if( have_rows('rows') ):
        echo '<nav class="filter-nav"><ul class="wrapper">';
        // loop through the rows of data
        while ( have_rows('rows') ) : the_row();
            $content = get_sub_field('content');
            echo '<li><a class="fs--s tt--uc faded" href="#'.url_string($content['heading']).'">'.$content['heading'].'</a></li>';

        endwhile;

        echo '</ul></nav>';

    endif;

    if( have_rows('rows') ):
        $grid_count = 0;
        echo '<section>';

        while ( have_rows('rows') ) : the_row();

            $content = get_sub_field('content');
            $content_type = get_sub_field('content_type');
            $grid_count++;

            if($content['nested_items']){
                $nested_class='nested-items';
            }else{
                $nested_class='';
            }

            if($grid_count % 2 == 0 && !is_front_page() && !is_singular('product')){
                $data_color = 'data-color="light"';
            }else{
                $data_color = '';
                if(!is_front_page() && !is_singular('product')){
                    $data_color = 'data-color="dark"';
                }
            }

            echo '<article id="'.url_string($content['heading']).'" class="grid-item '.$nested_class.'" '.$data_color.'>';
                echo '<div class="wrapper">';
                echo '<h3 class="sticky-header fs--xxxxl ls--m tt--uc"><span>'.$content['heading'].'</span></h3>';

                if(!$content['nested_items']){
                    $link = $content['link'];
                    if(is_array($link)){
                        if($link['title']){
                            $link_text = $link['title'];
                        }else{
                            $link_text = 'more';
                        }
                        $url = $link['url'];
                    }else{
                        $link_text = false;
                        $url = false;
                    }
                    insert_grid_item_content($content['title'],$content['text'],$content['image'], false, false, $url, $link_text, $content_type);
                }

                if($content['nested_items']){
                    foreach ($content['nested_items'] as $nested_item) {
                        insert_grid_item_content($nested_item['content']['title'],$nested_item['content']['text'],$nested_item['content']['image'],'nested',false, false, false, $nested_item['nested_content_type']);
                    }
                }

                echo '</div>';
            echo '</article>';

        endwhile;

        echo '</section>';

    endif;
?>