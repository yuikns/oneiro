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


    <h1>Result of "<?php the_search_query(); ?>"</h1>

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
                </span
            ></div><!--.postMeta-->



            <div class="post-content">

                <?php if (has_post_thumbnail()) {
    echo '<div class="thumbg"><div class="featured-thumbnail">';
    the_post_thumbnail(array(150, 150));
    echo '</div></div>';
} else {
} ?> <!-- Thumbnail judgment -->

                <?php the_content(__('Read more'));?>
            </div>

             <div class="post-bottom"> </div><!-- end .post-bottom -->



        <?php endwhile; else: ?>


    <h2>(*ﾟｰﾟ) Nothing Found ! How about change to another keyword ? </h2>
    <p style="text-align: center;"><img src="<?php bloginfo('template_url');?>/images/404.jpg" alt="404"  /></p>

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