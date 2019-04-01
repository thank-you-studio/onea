<?php
    $contact_form_shortcode = get_field('cf7_shortcode', false, false);
    $product_name = get_field('product_name');
    if($contact_form_shortcode && get_field('hide_shop') === true){
        echo '<section class="module contact-form">';
            if($product_name){
                echo '<h4 class="wrapper ta--center lh--s fs--l form-title">Interested in '.get_field('product_name').'? <br /> Make an appointment</h4>';
            }
            echo '<div class="wrapper grid">';
                echo do_shortcode($contact_form_shortcode);
            echo '</div>';
        echo '</section>';
    }
?>