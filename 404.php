<?php get_header(); ?>

<!--Navigation Bar-->
<div id="navbar">
    <div id="nav-auto" class="primary">
        <?php wp_nav_menu(array('menu' => 'Header Menu', 'menu_id' => 'nav', 'container' => 'ul')); ?> <!-- editable within the Wordpress backend -->
    </div>

    <div id="search"><?php get_search_form(); ?></div>
</div>
<!--End of Navigation Bar-->

<article>
    <div id="article">
        <div class="xcontainer">
            <div class="layout">


    <div id="content">
    <div class="content-header"></div>


            <h2>404 : File Not Found ... </h2>


             <div class="post-meta-single"></div><!--.postMeta-->



            <div class="post-content">
<p>The <b>404</b> or <b>Not Found</b> <a href="http://en.wikipedia.org/wiki/Error_message" title="Error message">error message</a> is a <a href="http://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol" title="Hypertext Transfer Protocol">HTTP</a> <a href="http://en.wikipedia.org/wiki/List_of_HTTP_status_codes" title="List of HTTP status codes">standard response code</a> indicating that the <a href="http://en.wikipedia.org/wiki/Web_browser" title="Web browser">client</a> was able to communicate with a given <a href="http://en.wikipedia.org/wiki/Server_(computing)" title="Server (computing)">server</a>, but the server could not find what was requested.</p>
<p>The web site hosting server will typically generate a "404 Not Found" web page when a user attempts to follow a <a href="http://en.wikipedia.org/wiki/Link_rot" title="Link rot">broken or dead link</a>; hence the 404 error is one of the most recognizable errors users can find on the web.</p>
<p>A 404 error should not be confused with "server not found" or similar errors, in which a connection to the destination server could not be made at all. A 404 error indicates that the requested resource may be available again in the future; however, the fact does not guarantee the same content.</p>
<p></p>
<p style="text-align: center;"><img src="<?php bloginfo('template_url');?>/images/404.jpg" alt="404"  /></p></div>
<div class="clear"></div></div><!--#content-->
<?php get_sidebar(); ?>
<div class="clear"></div>
</div><!--#layout--><?php get_footer(); ?>