<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Adserball_&_Knudsen
 */

$template_dir = get_template_directory_uri();
if(is_front_page()){
	$namespace = 'frontpage';
}else if(is_post_type_archive('support')){
	$namespace = 'support';
}else if(is_archive() || is_home()){
	$namespace = 'archive';
}else{
	$namespace = get_post_type( get_the_ID() );
}
?>
<!doctype html>
<html lang="da" class="loading">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $template_dir; ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $template_dir; ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $template_dir; ?>/favicon-16x16.png">
	<link rel="manifest" href="<?php echo $template_dir; ?>/site.webmanifest">
	<link rel="mask-icon" href="<?php echo $template_dir; ?>/safari-pinned-tab.svg" color="#151515">
	<meta name="msapplication-TileColor" content="#151515">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="https://use.typekit.net/tlc6mea.css">

	<?php wp_head(); ?>
</head>

<body>
<aside class="load-layer"></aside>
<aside class="load-layer"></aside>

<aside id="preloader" data-color="light">
<ul class="fs--xl tt--uc ls--s ta--center lh--m" style="opacity:0">
	<li>one hundred</li>
	<li>ninety-nine</li>
	<li>ninety-eight</li>
	<li>ninety-seven</li>
	<li>ninety-six</li>
	<li>ninety-five</li>
	<li>ninety-four</li>
	<li>ninety-three</li>
	<li>ninety-two</li>
	<li>ninety-one</li>
	<li>ninety</li>
	<li>eighty-nine</li>
	<li>eighty-eight</li>
	<li>eighty-seven</li>
	<li>eighty-six</li>
	<li>eighty-four</li>
	<li>eighty-three</li>
	<li>eighty-two</li>
	<li>eighty-one</li>
	<li>eighty</li>
	<li>seventy-nine</li>
	<li>seventy-eight</li>
	<li>seventy-seven</li>
	<li>seventy-six</li>
	<li>seventy-five</li>
	<li>seventy-four</li>
	<li>seventy-three</li>
	<li>seventy-two</li>
	<li>seventy-one</li>
	<li>seventy</li>
	<li>sixty-nine</li>
	<li>sixty-eight</li>
	<li>sixty-seven</li>
	<li>sixty-six</li>
	<li>sixty-five</li>
	<li>sixty-four</li>
	<li>sixty-three</li>
	<li>sixty-two</li>
	<li>sixty-one</li>
	<li>sixty</li>
	<li>fifty-nine</li>
	<li>fifty-eight</li>
	<li>fifty-seven</li>
	<li>fifty-six</li>
	<li>fifty-five</li>
	<li>fifty-four</li>
	<li>fifty-three</li>
	<li>fifty-two</li>
	<li>fifty-one</li>
	<li>fifty</li>
	<li>forty-nine</li>
	<li>forty-eight</li>
	<li>forty-seven</li>
	<li>forty-six</li>
	<li>forty-five</li>
	<li>forty-four</li>
	<li>forty-three</li>
	<li>forty-two</li>
	<li>forty-one</li>
	<li>forty</li>
	<li>thirty-nine</li>
	<li>thirty-eight</li>
	<li>thirty-seven</li>
	<li>thirty-six</li>
	<li>thirty-five</li>
	<li>thirty-four</li>
	<li>thirty-three</li>
	<li>thirty-two</li>
	<li>thirty-one</li>
	<li>thirty</li>
	<li>twenty-nine</li>
	<li>twenty-eight</li>
	<li>twenty-seven</li>
	<li>twenty-six</li>
	<li>twenty-five</li>
	<li>twenty-four</li>
	<li>twenty-three</li>
	<li>twenty-two</li>
	<li>twenty-one</li>
	<li>twenty</li>
	<li>nineteen</li>
	<li>eighteen</li>
	<li>seventeen</li>
	<li>sixteen</li>
	<li>fifteen</li>
	<li>fourteen</li>
	<li>thirteen</li>
	<li>twelve</li>
	<li>eleven</li>
	<li>ten</li>
	<li>nine</li>
	<li>eight</li>
	<li>seven</li>
	<li>six</li>
	<li>five</li>
	<li>four</li>
	<li>three</li>
	<li>two</li>
	<li>one <span>a</span></li>
</ul>
</aside>


<?php
	include(locate_template('template-parts/module-main-header.php' ));
	$invert_data_string = '';
	if(is_singular('product') || get_field('invert_page') || is_archive() || is_home()) {
		if(!is_post_type_archive('support')){
			$invert_data_string = 'data-color="light"';
		}
	}
?>
<main id="content-area">
	<div class="content-container" data-namespace="<?php echo $namespace; ?>" data-url="<?php the_permalink(); ?>" <?php echo $invert_data_string; ?>>
	<?php
		if(!is_singular('post')){
			include(locate_template('template-parts/module-hero.php' ));
		}
	?>