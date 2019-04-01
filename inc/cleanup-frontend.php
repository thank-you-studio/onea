<?php
    /**
     * Remove feeds and wordpress-specific content that is generated on the wp_head hook.
     * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
     */
    add_action( 'init', function () {
        // Remove the Really Simple Discovery service link
        remove_action( 'wp_head', 'rsd_link' );

        // Remove the link to the Windows Live Writer manifest
        remove_action( 'wp_head', 'wlwmanifest_link' );

        // Remove the general feeds
        remove_action( 'wp_head', 'feed_links', 2 );

        // Remove the extra feeds, such as category feeds
        remove_action( 'wp_head','feed_links_extra', 3 );

        // Remove the displayed XHTML generator
        remove_action( 'wp_head', 'wp_generator' );

        // Remove the REST API link tag
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    });


    /**
     * Remove emoji support
     * @link https://codex.wordpress.org/Emoji
     */
    add_action( 'init', function () {
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        add_filter( 'emoji_svg_url', '__return_false' );

        // Filter to remove TinyMCE emojis
        add_filter( 'tiny_mce_plugins', function ( $plugins ) {
            if ( is_array( $plugins ) ) {
                return array_diff( $plugins, array( 'wpemoji' ) );
            }

            return array();
        });
    });


    /**
     * De-registers WordPress default javascript
     * @link https://codex.wordpress.org/Function_Reference/wp_deregister_script
     */
    add_action( 'wp_enqueue_scripts', function () {
        wp_deregister_script( 'jquery' );
        wp_deregister_script( 'wp-embed' );
    });

    function disable_json_api () {

        // Filters for WP-API version 1.x
        add_filter('json_enabled', '__return_false');
        add_filter('json_jsonp_enabled', '__return_false');

        // Filters for WP-API version 2.x
        add_filter('rest_enabled', '__return_false');
        add_filter('rest_jsonp_enabled', '__return_false');

        }
        add_action( 'after_setup_theme', 'disable_json_api' );
        function remove_json_api () {

        // Remove the REST API lines from the HTML Header
        remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

        // Remove the REST API endpoint.
        remove_action( 'rest_api_init', 'wp_oembed_register_route' );

        // Turn off oEmbed auto discovery.
        add_filter( 'embed_oembed_discover', '__return_false' );

        // Don't filter oEmbed results.
        remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

        // Remove oEmbed discovery links.
        remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

        // Remove oEmbed-specific JavaScript from the front-end and back-end.
        remove_action( 'wp_head', 'wp_oembed_add_host_js' );

    }

    add_action( 'after_setup_theme', 'remove_json_api' );


    // Remove YOAST HTML comments
    add_action('wp_head',function() { ob_start(function($o) {
        return preg_replace('/^\n?\<\!\-\-.*?[Y]oast.*?\-\-\>\n?$/mi','',$o);
    }); },~PHP_INT_MAX);


    /**
    * Disable xmlrpc.php
    */
    add_filter( 'xmlrpc_enabled', '__return_false' );
    remove_action( 'wp_head', 'rsd_link' );
    remove_action( 'wp_head', 'wlwmanifest_link' );


    /**
    * Remove Query String from Static Resources
    */
    function remove_cssjs_ver( $src ) {
        if( strpos( $src, '?ver=' ) )
            $src = remove_query_arg( 'ver', $src );
            return $src;
    }
    add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
    add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );

    add_filter( 'wpcf7_load_css', '__return_false' );


?>