<?php get_header(); ?>
            <!--Navigation Bar-->
            <div id="navbar">
                <div id="nav-auto" class="primary">
                <?php wp_nav_menu(array('menu' => 'Header Menu', 'menu_id' => 'nav', 'container' => 'ul')); ?> <!-- editable within the Wordpress backend -->
                </div>
                <div id="search">
                <?php get_search_form(); ?>
                </div>
            </div>
            <!--End of Navigation Bar-->

    <!-- article -->
    <div id="article">
            <div class="xcontainer">

              <div class="layout">


    <div id="content">
    <div class="content-header"></div>





   <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
   <?php /* If this is a category archive */ if (is_category()) {
     ?>
    <h1>Archive for the &#8216;<?php single_cat_title();
     ?>&#8217; Category</h1>
   <?php /* If this is a tag archive */
 } elseif (is_tag()) {
     ?>
    <h1>Posts Tagged &#8216;<?php single_tag_title();
     ?>&#8217;</h1>
   <?php /* If this is a daily archive */
 } elseif (is_day()) {
     ?>
    <h1>Archive for <?php the_time('F jS, Y');
     ?></h1>
   <?php /* If this is a monthly archive */
 } elseif (is_month()) {
     ?>
    <h1>Archive for <?php the_time('Y年F ');
     ?></h1>
   <?php /* If this is a yearly archive */
 } elseif (is_year()) {
     ?>
    <h1>Archive for <?php the_time('Y');
     ?></h1>
   <?php /* If this is an author archive */
 } elseif (is_author()) {
     ?>
    <h1>Author Archive</h1>
   <?php /* If this is a paged archive */
 } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
     ?>
    <h1>Blog Archives</h1>
   <?php

 } ?>



    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>


            <div class="post-meta">
                <span class="com-writer">
                    <?php the_author_posts_link() ?>
                </span>
                <span class="con-cate">
                    <?php the_category(', ') ?>
                </span>

                 <span class="con-commt">
                    <?php comments_popup_link('No Comment', '1 Comment', '% Comments'); ?>
                </span>
                <span class="con-edit">
                <?php edit_post_link('<span class="edit">Edit</span>');?>
                </span>
                <span class="con-time">
                <?php if (function_exists('the_views')) {
    the_views();
} ?>　<?php the_time('Y.m.j'); ?>
                </span></div><!--.postMeta-->



            <div class="post-content">

                <?php if (has_post_thumbnail()) {
    echo '<div class="thumbg"><div class="featured-thumbnail">';
    the_post_thumbnail(array(150, 150));
    echo '</div></div>';
} else {
} ?> <!-- Thumbnail judgment code -->

                <?php the_content(__('Read more'));?>
            </div>

             <div class="post-bottom"> </div><!-- end .post-bottom -->



        <?php endwhile; else: ?>
            <div class="no-results">
                <p><strong>There has been an error.</strong></p>
                <p>We apologize for any inconvenience, please <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>">return to the home page</a> or use the search form below.</p>
                <?php get_search_form(); ?> <!-- outputs the default Wordpress search form-->
            </div><!--noResults-->
        <?php endif; ?>

        <div id="postnavigation">
               <div class="page_navi"> <?php par_pagenavi(9); ?> </div>
            <div class="clear"></div>
        </div><!-- end#postnavigation -->
    <div class="clear"></div>

    </div><!--#content-->
<?php get_sidebar(); ?>
<div class="clear"></div>
</div><!--#layout-->
<div class="clear"></div>
<?php get_footer(); ?>