<?php
    if( function_exists('acf_add_options_page') ) {

        acf_add_options_page(array(
            'page_title' 	=> 'General',
            'menu_title'	=> 'General',
            'menu_slug' 	=> 'general',
            'post_id' 	=> 'general',
            'capability'	=> 'edit_posts',
            'icon_url'      => 'dashicons-info',
            'redirect'		=> false
        ));
    }

    function ACF_flexible_content_collapse() {
        ?>
        <style id="acf-flexible-content-collapse">.acf-flexible-content .acf-fields { display: none; }</style>
        <script type="text/javascript">
            jQuery(function($) {
                $('.postbox').removeClass('closed')
                $('.acf-flexible-content .layout').addClass('-collapsed');
                $('#acf-flexible-content-collapse').detach();
                $('#icl_div_config,#icl_div,#wpseo_meta').addClass('closed')
            });
        </script>
        <?php
    }

    add_action('acf/input/admin_head', 'ACF_flexible_content_collapse');
?>