<?php
    get_header();
?>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
    echo '<article class="wrapper grid-item">';
    insert_grid_item_content(get_the_title(), get_the_excerpt(), get_post_thumbnail_id( get_the_id() ), 'post', get_the_tags());
            echo '</article>';
    endwhile; wp_reset_postdata(); else: ?>
    <p>Sorry, no posts to list</p>
    <?php endif; ?>
<?php
    get_footer();
?>
