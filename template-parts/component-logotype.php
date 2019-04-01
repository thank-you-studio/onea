<?php
    $lang_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
    if(ICL_LANGUAGE_CODE=='de'):
        $tagline = 'Neue Maßstäbe für Architekturbeleuchtung';
    else:
        $tagline = 'Innovates architectural lighting products';
    endif;
?>
<a href="<?php echo $lang_home_url; ?>" class="fs--s fw--medium tt--uc line-link">
    <span class="line"></span>
    <span class="text multiline">
        <div class="inner">
            <div class="text-line">ONE A</div>
            <div class="text-line"><?php echo $tagline; ?></div>
        </div>
    </span>
</a>