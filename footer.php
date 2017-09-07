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
            <p>Designed by <a href="http://weibo.com/123551954" rel="external nofollow">Ongakuer</a></p>
            <p>Revised by <a title="ArgCV" href="http://ArgCV.com"><strong><span style="color: OrangeRed;">Arg</span><span style="color: Gold;">C</span><span style="color: MediumPurple;">V</span></strong></a></p>
                </div> <!-- .footerinfo -->

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

            </div> <!-- .footerbar -->
            <div id="copyright"></div> <!-- .copyright -->
        </div><!--.fcontainer This is used to make it in center of the page -->
        <script src="<?php bloginfo('template_url');?>/js/Oneirojs.min.js"></script>
        <!-- footer end -->
    </div><!--footer-->
</div><!--#main-->
<?php wp_footer(); ?>
<!-- stats of cnzz.com start -->
<!-- stop using cnzz -->
<!--
<div style="display:none"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1253531223'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "v1.cnzz.com/z_stat.php%3Fid%3D1253531223%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script></div>
-->
<!-- stats of cnzz.com end -->
</body>
</html>