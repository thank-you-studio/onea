<?php
    $lang_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
?>
<a href="<?php echo $lang_home_url; ?>" class="fs--s fw--medium tt--uc monogram-link">
    <?php include(locate_template('template-parts/svg-monogram.php' )); ?>
</a>