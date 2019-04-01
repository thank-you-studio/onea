<section class="projects" data-color="dark">
<?php
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
        echo '<section>';
        // loop through the rows of data
        while ( have_rows('rows') ) : the_row();

            $content = get_sub_field('content');
            if($content['nested_items']){
                $nested_class='nested-items';
            }else{
                $nested_class='';
            }

            echo '<article id="'.url_string($content['heading']).'" class="grid-item '.$nested_class.'">';
                echo '<div class="wrapper">';
                // echo '<h3 class="fs--xxxxl ls--m tt--uc" data-animatable><span>'.$content['heading'].'</span></h3>';
                if(!$content['nested_items']){
                    insert_grid_item_content($content['title'],$content['text'],$content['image']);
                }
                if($content['nested_items']){
                    foreach ($content['nested_items'] as $nested_item) {
                        // var_dump($nested_item['content']['title']);
                        insert_grid_item_content($nested_item['content']['title'],$nested_item['content']['text'],$nested_item['content']['image'],'nested',false);
                    }
                }

                if( have_rows('nested_items') ):
                    while ( have_rows('nested_items') ) : the_row();

                    endwhile;
                endif;
                echo '</div>';
            echo '</article>';

        endwhile;

        echo '</section>';

    endif;
?>
</section>