<?php
    $lang_home_url = apply_filters( 'wpml_home_url', get_option( 'home' ) );
    if(ICL_LANGUAGE_CODE=='de'):
        $menu = 'Inhalt';
    else:
        $menu = 'Menu';
    endif;
?>
<a role="menuitem" href="<?php echo $lang_home_url; ?>" class="fs--s fw--medium tt--uc line-link from-opposite no-barba menu-trigger">
    <span class="line"></span>
    <span class="line navicon-line"></span>
    <span class="text"><?php echo $menu; ?></span>
</a>