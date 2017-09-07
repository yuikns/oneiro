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
    <div class="content-header"><div id="tip"></div><div id="godown"></div></div>

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>


            <div class="post-meta-single">
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
                <span class="showclose" style="display: block">♤ Hide Sidebar</span>
                <span class="con-time">
                <?php if (function_exists('the_views')) {
    the_views();
} ?>　<?php the_time('l, F jS, Y'); ?>
                </span>
            </div><!--.postMeta-->

            <div class="post-content entry-content">
                <?php the_content(); ?>
            </div>

             <div class="post-info">
                     <script> // juqery to the top
                     jQuery(document).ready(function($) {
                        $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');// 这行是 Opera 的补丁, 少了它 Opera 是直接用跳的而且画面闪烁 by willin
                        $('#content .gotop').click(function(){
                            $body.animate({scrollTop: $('#header').offset().top}, 1000);
                            return false;// 返回false可以避免在原链接后加上
                        });
                    });
                     </script>
                 <span class="gotop">TOP</span>
                 <div class="crumbs">
                    <?php if (function_exists('get_breadcrumbs')) {
    get_breadcrumbs();
} ?>
                 </div>
                 <div class="tags"><?php the_tags('tags : ', ', ', '');?></div>
                 <span class="previous"><?php  if (get_next_post()) {
     next_post_link('last : %link');
 } else {
     echo 'last : NULL';
 }; ?> </span>
                 <span class="next"><?php previous_post_link('next : %link');?></span>
                 <div class="clear"> </div>
              </div><!-- end .post-info -->


             <?php comments_template('', true); ?>



        <?php endwhile; else: ?>
            <div class="no-results">
                <p><strong>There has been an error.</strong></p>
                <p>We apologize for any inconvenience, please <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>">return to the home page</a> or use the search form below.</p>
                <?php get_search_form(); ?> <!-- outputs the default Wordpress search form-->
            </div><!--noResults-->
        <?php endif; ?>

        <div class="clear"></div>
    </div><!--#content-->
<?php get_sidebar(); ?>
<div class="clear"></div>
</div><!--#layout-->
<div class="clear"></div>
<?php get_footer(); ?>