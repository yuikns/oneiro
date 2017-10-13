<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title>
    <?php
        global $page, $paged;
        wp_title('|', true, 'right');
        // Add the blog name.
        bloginfo('name');
        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page())) {
            echo " | $site_description";
        }
        // Add a page number if necessary:
        if ($paged >= 2 || $page >= 2) {
            echo ' | '.sprintf(__('Page %s', 'Oneiro'), max($paged, $page));
        }
    ?></title>


    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="/favicon.png" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="index" title="<?php bloginfo('name'); ?>" href="<?php echo get_option('home'); ?>/" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('atom_url'); ?>" />

    <link rel="canonical" href="<?php echo curPageURL(); ?>" /> <!-- Canonical helps with SEO -->
    <!-- Let IE8 compatible HTML5  -->
        <!--[if lt IE 9]>
            <script src="/wp-content/themes/Oneiro1.4.3/js/html5shiv.min.js"></script>
        <![endif]-->
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />

    <!--
    <script  src="<?php bloginfo('template_url');?>/js/jquery.js"></script>
    -->

    <?php
        wp_deregister_script('jquery');
	wp_register_script('jquery', '//upcdn.b0.upaiyun.com/libs/jquery/jquery-2.0.3.min.js', array(), '2.0.3');
        wp_enqueue_script('jquery');
    ?>

    <?php
        // bootstrap , shall after jquery
        /*
        wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array(), '3.3.5');
        wp_enqueue_script('bootstrap');
        wp_register_style( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css");
        wp_enqueue_style( 'bootstrap');*/
    ?>

    <?php wp_head(); ?>

    <?php if (is_singular()) {
    ?>
    <script type="text/javascript" src="<?php bloginfo('template_directory');
    ?>/comments-ajax.js"></script>
    <?php

} ?>

</head>

<body>
<!--Code generation start -->
<div id="main"><!-- The bottom of the frame structures -->

    <!-- header start -->
    <div id="header">
        <div class="tcontainer">

             <div class="bokeh"> 
                    <?php  if (is_user_logged_in()) {
     ?> <!-- Control Panel -->
                    <div id="if-logged-in">
                        <a href="<?php bloginfo('url');
     ?>/wp-admin/">Control Panel</a>
                    </div><!--#if-logged-in-->
                    <?php

 } ?>



                <div id="logo">
                    <?php if (is_front_page() || is_home()) {
    ?>
                        <h1><a href="<?php bloginfo('url');
    ?>/" title="<?php bloginfo('description');
    ?>"><?php bloginfo('name');
    ?></a></h1>
                    <?php

} else {
    ?>
                        <h2><a href="<?php bloginfo('url');
    ?>/" title="<?php bloginfo('description');
    ?>"><?php bloginfo('name');
    ?></a></h2>
                    <?php

} ?>
                </div>

                <span style="display:block;overflow: hidden; width: 0; height: 0;"><?php bloginfo('description'); ?></span>
            </div><!--.bokeh-->
        </div><!--.tcontainer-->
    </div><!-- header -->
    <!-- header end -->



    <?php /* - Slides (if you are sure do not need to slide, delete the follow line */
/*include(TEMPLATEPATH . '/slideshow.php');*/ ?>
