<?php
  /**
   * Remove left admin footer text
   * @link https://developer.wordpress.org/reference/hooks/admin_footer_text/
   */
  add_filter( 'admin_footer_text', function () {
    return '';
  }, 999);

  /**
   * Remove Help Tabs
   * @link https://codex.wordpress.org/Adding_Contextual_Help_to_Administration_Menus
   *
   * @param $old_help
   * @param $screen_id
   * @param $screen
   */
  add_filter( 'contextual_help', function ( $old_help, $screen_id, $screen ) {
    // Remove all help tabs
    $screen->remove_help_tabs();

    // Remove specific tabs
    $screen->remove_help_tab( 'overview' );

    $screen->remove_help_tab( 'help-navigation' );
    $screen->remove_help_tab( 'help-layout' );
    $screen->remove_help_tab( 'help-content' );

    $screen->remove_help_tab( 'attachment-details' );
    $screen->remove_help_tab( 'managing-pages' );
    $screen->remove_help_tab( 'managing-pages' );

    $screen->remove_help_tab( 'moderating-comments' );

    $screen->remove_help_tab( 'adding-themes' );
    $screen->remove_help_tab( 'customize-preview-themes' );

    $screen->remove_help_tab( 'compatibility-problems' );
    $screen->remove_help_tab( 'adding-plugins' );

    $screen->remove_help_tab( 'screen-display' );
    $screen->remove_help_tab( 'actions' );
    $screen->remove_help_tab( 'user-roles' );

    $screen->remove_help_tab( 'press-this' );
    $screen->remove_help_tab( 'converter' );

    $screen->remove_help_tab( 'options-postemail' );
    $screen->remove_help_tab( 'options-services' );
    $screen->remove_help_tab( 'site-visibility' );
    $screen->remove_help_tab( 'permalink-settings' );
    $screen->remove_help_tab( 'custom-structures' );
  }, 999, 3);


  /**
   * Remove Screen Options tab
   * @link https://developer.wordpress.org/reference/hooks/screen_options_show_screen/
   */
  // add_filter( 'screen_options_show_screen', '__return_false' );


  /**
   * Remove post type functions
   * @link https://codex.wordpress.org/Function_Reference/remove_post_type_support
   */
  add_action( 'init', function () {
    $post_type = 'page';

    // Remove the WYSIWYG-editor
    remove_post_type_support( $post_type, 'editor' );

    // Remove excerpt
    remove_post_type_support( $post_type, 'excerpt' );

    // Remove trackbacks
    remove_post_type_support( $post_type, 'trackbacks' );

    // Remove custom fields
    remove_post_type_support( $post_type, 'custom-fields' );

    // Remove comments
    remove_post_type_support( $post_type, 'comments' );

    // Remove revisions (will still store revisions)
    // remove_post_type_support( $post_type, 'revisions' );

    // Remove page attributes like menu order
    remove_post_type_support( $post_type, 'page-attributes' );

    // Remove post format
    remove_post_type_support( $post_type, 'post-formats' );
  });


  /**
   * Remove post type metaboxes
   * @link https://codex.wordpress.org/Function_Reference/remove_meta_box
   */
  add_action( 'admin_menu', function() {
    $post_type = 'post';
    $context = 'normal';

    /* Auhtor metabox */
    remove_meta_box( 'authordiv', $post_type, $context );


    /* Comments status metabox (discussion) */
    remove_meta_box( 'commentstatusdiv', $post_type, $context );

    /* Comments metabox */
    remove_meta_box( 'commentsdiv', $post_type, $context );

    /* Formats metabox */
    remove_meta_box( 'formatdiv', $post_type, $context );

    /* Attributes metabox */
    remove_meta_box( 'pageparentdiv', $post_type, $context );

    /* Custom fields metabox */
    remove_meta_box( 'postcustom', $post_type, $context );

    /* Excerpt metabox */
    // remove_meta_box( 'postexcerpt', $post_type, $context );

    /* Featured image metabox */
    remove_meta_box( 'postimagediv', $post_type, $context );

    /* Revisions metabox */
    remove_meta_box( 'revisionsdiv', $post_type, $context );

    /* Trackbacks metabox */
    remove_meta_box( 'trackbacksdiv', $post_type, $context );

    // remove_menu_page('edit.php');

    // remove_post_type_support( 'post', 'editor' );
  });


  /**
   * Remove theme features
   * @link https://codex.wordpress.org/Function_Reference/remove_theme_support
   */
  add_action( 'after_setup_theme', function () {
    remove_theme_support( 'post-formats' );
    // remove_theme_support( 'post-thumbnails' );
    remove_theme_support( 'custom-background' );
    remove_theme_support( 'custom-header' );
    remove_theme_support( 'automatic-feed-links' );
    // remove_theme_support( 'html5' );
    remove_theme_support( 'menus' );
  }, 11 );

  /**
   * Unregister default widgets
   * @link https://codex.wordpress.org/Function_Reference/unregister_widget
   */
  add_action( 'widgets_init', function () {
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Archives' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Text' );
    unregister_widget( 'WP_Widget_Categories' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Widget_RSS' );
    unregister_widget( 'WP_Widget_Tag_Cloud' );
    unregister_widget( 'WP_Nav_Menu_Widget' );
  }, 11);

  function remove_core_updates(){
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
  }
  add_filter('pre_site_transient_update_core','remove_core_updates');
  add_filter('pre_site_transient_update_plugins','remove_core_updates');
  add_filter('pre_site_transient_update_themes','remove_core_updates');

  /**
  * Remove Comments
  */
  add_filter( 'comment_form_default_fields', 'disable_comment_fields' );
  // Removes from admin menu
  add_action( 'admin_menu', 'my_remove_admin_menus' );
  function my_remove_admin_menus() {
      remove_menu_page( 'edit-comments.php' );
  }
  // Removes from post and pages
  add_action( 'init', 'remove_comment_support', 100 );
  function remove_comment_support() {
      remove_post_type_support( 'post', 'comments' );
      remove_post_type_support( 'page', 'comments' );
  }
  // Removes from admin bar
  function mytheme_admin_bar_render() {
      global $wp_admin_bar;
      $wp_admin_bar->remove_menu( 'comments' );
  }
  add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );


  // Move Yoast to bottom
  function yoasttobottom() {
    return 'low';
  }
  add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


  /**
   * Removing dashboard widgets.
   * @link https://codex.wordpress.org/Function_Reference/remove_meta_box
   */
  add_action( 'admin_init', function () {
    // Remove the 'Welcome' panel
    remove_action('welcome_panel', 'wp_welcome_panel');

    // Remove the 'incoming links' metabox
    remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );

    // Remove the 'plugins' metabox
    remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );

    // Remove the 'WordPress News' metabox
    remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );

    // Remove the secondary metabox
    remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );

    // Remove the 'Quick Draft' metabox
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

    // Remove the 'Recent Drafts' metabox
    remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );

    // Remove the 'Activity' metabox
    remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );

    // Remove the 'At a Glance' metabox
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );

    // Remove the 'Activity' metabox (since 3.8)
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
    });

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
	// Uncomment to view format of $toolbars

	// echo '< pre >';
	// 	print_r($toolbars);
	// echo '< /pre >';
	// die;


	// Add a new toolbar called "Very Simple"
	// - this toolbar has only 1 row of buttons
	$toolbars['Very Simple' ] = array();
	$toolbars['Very Simple' ][1] = array('bold' , 'italic', 'link', 'unlink', 'superscript', 'subscript');

	// Edit the "Full" toolbar and remove 'code'
	// - delet from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
	if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
	{
	    unset( $toolbars['Full' ][2][$key] );
	}

	// remove the 'Basic' toolbar completely
	unset( $toolbars['Basic' ] );

	// return $toolbars - IMPORTANT!
	return $toolbars;
}


?>