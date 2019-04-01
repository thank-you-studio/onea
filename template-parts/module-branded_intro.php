<?php
    echo '<div class="grid">';
            echo '<div class="text fs--l lh--s fw--lighter"><div class="inner">'.get_sub_field('text').'</div></div>';
    echo '</div>';
    echo '<div class="logo-wrapper wrapper">';
    include(locate_template('template-parts/svg-monogram.php' ));
    echo '</div>';
?>