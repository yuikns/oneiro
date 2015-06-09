    </div><!--.xcontainer-->
    <div class="clear"></div>
    </div><!--#article-->
    <div class="clear"></div>
    <!-- article end -->
    <div class="clear"></div>


    <div id="footerbg"></div><!--footerbg-->
    <div id="footer">
     <!-- footer start -->
         <div class="fcontainer">
             <div class="footerbar">
                <div class="footerinfo">
            <h4 class="footertitleinfo">　</h4>
            <p><a href="<?php echo get_option('home');?>/"><?php bloginfo('name');?></a></p>
            <p><?php bloginfo('description'); ?></p>
            <p>Powered by <a href="http://wordpress.org/" rel="external nofollow">WordPress <?php bloginfo('version');?></a></p>
            <p>Designed by <a href="http://Ongakuer.com/" rel="external nofollow">Ongakuer</a></p>
            <p>Revised by <a href="http://argcv.com" rel="external nofollow">argcv</a></p>
<!-- stats of cnzz.com start -->
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253531223'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "v1.cnzz.com/z_stat.php%3Fid%3D1253531223%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
<!-- stats of cnzz.com end -->
                </div>

                <ul>
                    <!--Latest articles, non-Home Display-->
                    <li class="widgit-layout">
                        <h4 class="footertitlepost">Recent Posts</h4>
                            <ul>
                                <?php get_archives('postbypost', 5); ?>
                            </ul>
                    </li>


                    <li class="widgit-layout2">
                        <h4 class="footertags">Tags</h4>
                            <ul>
                               <li><?php wp_tag_cloud('smallest=12&largest=18&unit=px&number=30 &format=flat&orderby=name&order=ASC'); ?></li>
                           </ul>
                    </li>

                </ul>

            </div>
            <div id="copyright"></div>

        </div><!--.xcontainer This is used to make it in center of the page -->
      <!-- footer end -->
      <script type='text/javascript'> // This is the animated navigation bar
    jQuery(document).ready(function() {
    $("#nav ul").css({display: "none"}); // Opera Fix
    $("#nav li").hover(function(){
            $(this).find('ul:first').css({visibility: "visible",display: "none"}).show(268);
            },function(){
            $(this).find('ul:first').fadeOut(200)
            });
    $("#nav a").hover(function(){
                    $(this).stop().animate({marginTop:"2px"},100);}
                ,function(){
                    $(this).stop().animate({marginTop:"0px"},100);
            });
            $("#nav ul a").hover(function(){
                    $(this).stop().animate({marginLeft:"10px"},200);}
                ,function(){
                    $(this).stop().animate({marginLeft:"0px"},200);
            });
    });
    </script>
    <script src="<?php bloginfo('template_url');?>/js/Oneirojs.js"></script>
    </div><!--footer-->
</div><!--#main-->
<?php wp_footer(); ?>
</body>
</html>