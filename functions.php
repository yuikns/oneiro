<?php


    // enables wigitized sidebars
    if (function_exists('register_sidebar')) {

    // Sidebar Widget


    // Location: the sidebar
    register_sidebar(array('name' => 'Sidebar',
        'before_widget' => '<div id="widgit-sidebar" class="widgit-area">',
        'after_widget' => '</ul></div></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3><ul>',
    ));
    }

    // post thumbnail support
    add_theme_support('post-thumbnails');set_post_thumbnail_size(150, 150, true);
    // custom menu support
    add_theme_support('menus');
    if (function_exists('register_nav_menus')) {
        register_nav_menus(
            array(
              'header_menu' => 'Header Menu',
              'sidebar_menu' => 'Sidebar Menu',
              'footer_menu' => 'Footer Menu',
            )
        );
    }

    // enable threaded comments
    function enable_threaded_comments()
    {
        if (!is_admin()) {
            if (is_singular() and comments_open() and (get_option('thread_comments') == 1)) {
                wp_enqueue_script('comment-reply');
            }
        }
    }
    add_action('get_header', 'enable_threaded_comments');

    // removes detailed login error information for security
    add_filter('login_errors', create_function('$a', 'return null;'));

    // Removes Trackbacks from the comment cout
    add_filter('get_comments_number', 'comment_count', 0);
    function comment_count($count)
    {
        if (!is_admin()) {
            global $id;
            $comments_by_type = &separate_comments(get_comments('status=approve&post_id='.$id));

            return count($comments_by_type['comment']);
        } else {
            return $count;
        }
    }

    // custom excerpt ellipses for 2.9+
    function custom_excerpt_more($more)
    {
        return 'Read More &raquo;';
    }
    add_filter('excerpt_more', 'custom_excerpt_more');

    // no more jumping for read more link

    function remove_more_jump_link($link)
    {
        return preg_replace('/#more-\d+/i', '', $link);
    }
    add_filter('the_content_more_link', 'remove_more_jump_link');

    // 截断文字
    function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
    {
        if ($code == 'UTF-8') {
            $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
            preg_match_all($pa, $string, $t_string);
            if (count($t_string[0]) - $start > $sublen) {
                return implode('', array_slice($t_string[0], $start, $sublen)).'...';
            }

            return implode('', array_slice($t_string[0], $start, $sublen));
        } else {
            $start = $start * 2;
            $sublen = $sublen * 2;
            $strlen = strlen($string);
            $tmpstr = '';
            for ($i = 0; $i < $strlen; $i++) {
                if ($i >= $start && $i < ($start + $sublen)) {
                    if (ord(substr($string, $i, 1)) > 129) {
                        $tmpstr .= substr($string, $i, 2);
                    } else {
                        $tmpstr .= substr($string, $i, 1);
                    }
                }
                if (ord(substr($string, $i, 1)) > 129) {
                    $i++;
                }
            }
            if (strlen($tmpstr) < $strlen) {
                $tmpstr .= '...';
            }

            return $tmpstr;
        }
    }

    //breadcrumbs
    function get_breadcrumbs()
    {
        global $wp_query;

        if (!is_home()) {

            // Start the UL
            echo '<ul class="breadcrumbs">';
            // Add the Home link
            echo '<li>Categories : <a href="'.get_settings('home').'">'.get_bloginfo('name').'&nbsp;</a></li>';

            if (is_category()) {
                $catTitle = single_cat_title('', false);
                $cat = get_cat_ID($catTitle);
                echo '<li> &gt; '.get_category_parents($cat, true, ' &gt; ').'</li>';
            } elseif (is_archive() && !is_category()) {
                echo '<li> &gt; Archives</li>';
            } elseif (is_search()) {
                echo '<li> &gt; Search Results</li>';
            } elseif (is_404()) {
                echo '<li> &gt; 404 Not Found</li>';
            } elseif (is_single()) {
                $category = get_the_category();
                $category_id = get_cat_ID($category[0]->cat_name);

                echo '<li> &gt; '.get_category_parents($category_id, true, ' &gt; ');
                echo the_title('', '', false).'</li>';
            } elseif (is_page()) {
                $post = $wp_query->get_queried_object();

                if ($post->post_parent == 0) {
                    echo '<li> &gt; '.the_title('', '', false).'</li>';
                } else {
                    $title = the_title('', '', false);
                    $ancestors = array_reverse(get_post_ancestors($post->ID));
                    array_push($ancestors, $post->ID);

                    foreach ($ancestors as $ancestor) {
                        if ($ancestor != end($ancestors)) {
                            echo '<li> &gt; <a href="'.get_permalink($ancestor).'">'.strip_tags(apply_filters('single_post_title', get_the_title($ancestor))).'</a></li>';
                        } else {
                            echo '<li> &gt; '.strip_tags(apply_filters('single_post_title', get_the_title($ancestor))).'</li>';
                        }
                    }
                }
            }

            // End the UL
            echo '</ul>';
        }
    }

     // pagenavi
 function par_pagenavi($range = 9)
 {
     global $paged, $wp_query;
     if (!$max_page) {
         $max_page = $wp_query->max_num_pages;
     }
     if ($max_page > 1) {
         if (!$paged) {
             $paged = 1;
         }
         if ($paged != 1) {
             echo "<a href='".get_pagenum_link(1)."' class='extend' title='跳转到首页'>返回首页</a>";
         }
         previous_posts_link('上一页');
         if ($max_page > $range) {
             if ($paged < $range) {
                 for ($i = 1; $i <= ($range + 1); $i++) {
                     echo "<a href='".get_pagenum_link($i)."'";
                     if ($i == $paged) {
                         echo " class='current'";
                     }
                     echo ">$i</a>";
                 }
             } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                 for ($i = $max_page - $range; $i <= $max_page; $i++) {
                     echo "<a href='".get_pagenum_link($i)."'";
                     if ($i == $paged) {
                         echo " class='current'";
                     }
                     echo ">$i</a>";
                 }
             } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                 for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                     echo "<a href='".get_pagenum_link($i)."'";
                     if ($i == $paged) {
                         echo " class='current'";
                     }
                     echo ">$i</a>";
                 }
             }
         } else {
             for ($i = 1; $i <= $max_page; $i++) {
                 echo "<a href='".get_pagenum_link($i)."'";
                 if ($i == $paged) {
                     echo " class='current'";
                 }
                 echo ">$i</a>";
             }
         }
         next_posts_link('下一页');
         if ($paged != $max_page) {
             echo "<a href='".get_pagenum_link($max_page)."' class='extend' title='跳转到最后一页'>最后一页</a>";
         }
     }
 }

    //禁用半角符号自动转换为全角
    remove_filter('the_content', 'wptexturize');

    // down shortlink
function downlink($atts, $content = null)
{
    extract(shortcode_atts(array('href' => 'http://'), $atts));

    return '<div class="but_down"><a href="http://'.$href.'"target="_blank"><span>'.$content.'</span></a><div class="clear"></div></div>';
}

add_shortcode('Downlink', 'downlink');
add_shortcode('flv', 'flvlink');
add_shortcode('mp3', 'mp3link');

    // Custom Style. ThemesOptionsPage.
    define('themename', 'Oneiro');
    add_action('admin_menu', 'Options_add_theme_page');
    function Options_add_theme_page()
    {
        add_theme_page(__(themename.'说明'), __(themename.'说明'), 'edit_themes', basename(__FILE__), 'Options_theme_page');
    }
    function Options_theme_page_head()
    {
    }
    function Options_theme_page()
    {
        // Store options if set in post. ?>


<div class="wrap" style="padding:10px;">
        <h2>Oneiro主题说明</h2>

        <p>呃，因为作者还不太会php，看着各种数组变量什么的会头大，所以就不做主题设置这种太高级的东西了，留下一些说明请自行参看修改。</p>
        <br>


        <h3>Logo说明</h3>
        <p>Logo使用的是图片，请在主题文件的images里找到PSD用Photoshop自行修改文字。然后保存为Oneiro-logo.png,替换原图片即可。</p>

         <br>
        <h3>如何自定义幻灯片</h3>
        <p>1.首先在Wordpress后台由[外观]进入[编辑]，再进入[slideshow.php]。</p>
        <p>2.从文件中下找到&lt;div class="slides"&gt; ， 里面一层就是开始添加幻灯片了。（具体位置我写有注释，相信你能很快找到，从下往上看会比较容易找到）</p>
        <p>3.添加幻灯片的方法就是加入&lt;div &gt; &lt;/div &gt; （注意，div是要并列的，不能嵌套）。嗯，也就是说每加入一个幻灯片必须要用&lt;div &gt; &lt;/div &gt;包裹住</p>

        <p>4.默认有4个例子，你可以在&lt;div &gt; &lt;/div &gt; 的中间修改，加入想展示的内容。</p>
        <blockquote>（1）展示图片：加入<span style="color: #ff6600;">&lt;img src="图片地址" alt="标题" /&gt;</span>，就可以显示图片了。【图片大小为730×230px，超出部分会被隐藏】</blockquote>
    <blockquote>（2）展示带有链接的图片：加入<span style="color: #ff6600;">&lt;a href="链接地址"&gt;&lt;img src="图片地址" alt="标题" /&gt;&lt;/a&gt;</span></blockquote>
        <blockquote>（3）展示带介绍文字的图片：首先加入图片代码：<span style="color: #ff6600;">&lt;img src="图片地址" alt="标题" /&gt;</span>，然后在后面加上显示文字的代码：<span style="color: #ff6600;">&lt;span class="slidestext"&gt; 这里添加文字&lt;/span&gt;</span><br>

        <blockquote>文字说明：<br>
        a.要用换行符号换行<strong>&lt;br&gt;</strong><br>
        b.如果不标注换行，超过300px宽度则自动换行<br>
        c.为文字加入标题：&lt;h3&gt;的颜色是紫色，&lt;h4&gt;是蓝色。</blockquote>

        （4）展示带介绍文字的链接图片：基本参见上一条，只不过把图片代码换成了<span style="color: #ff6600;">&lt;a href="链接地址"&gt;&lt;img src="图片地址" alt="标题" /&gt;&lt;/a&gt;</span>，这个和第2点是相同的……

        </blockquote>

        <br>
        <h3>导航栏说明</h3>
        <p>如果从来没有使用过[外观]里的[菜单]，请先去设置好。没有设置的话，会引起导航栏错位。</p>


        <br>
        <h3>下载缩写短代码</h3>
        <p>短代码源于<a href="http://xuui.net/wordpress/istudio-theme-release.html">istudio</a></p>
        <p>[Downlink href="URL"]Filename[/Downlink]  &nbsp;（URL请直接输入网址，不要带上“http://”)</p>
        <p>例：[Downlink href="ongakuer.com"]下载文件名[/Downlink] </p>


          <br>
        <h3>侧边栏说明</h3>
        <p>边栏模板(sidebar.php) 默认有：随机文章、最新评论、存档、友情链接，即使添加小工具也不覆盖。所以不需要的话请自行删除。</p>
        <p>侧边栏的广告可以替换成自己的，或者删掉。</p>

        <br>
           <h3>Guestbook模板使用</h3>
        <p>这个模板是用来制作留言本的。与默认模板的区别是评论按照时间顺序倒序排列，最新发表的评论在最上面。</p>
        <p>使用方法为，添加新页面，在右侧的“页面属性”下选择“Guestbook(留言本)”即可。</p>



          <br>
        <h3>其他注意的地方</h3>
        <p>头部背景附带有psd，可以用PS自行修改。保存图片的时候请选择“储存为web及设备所用格式”，jpg的格式。</p>
        <p>推荐配合Mail to Commenter使用评论邮件通知。在其插件设置页面代码类型选择[ '@+用户名+:']即可</p>

  <br><br><br><br>
        以上，说明完了。如果你在使用中有其他问题，可以 <a href="http://ongakuer.com/archives/oneiro-theme/" target="_blank">给我留言</a>。
</div>


    <?php

    }

    // A Function that output's the current page's URL
    // Used in the canonical link within the header but can be used elsewhere
    // output with: echo curPageURL();
    function curPageURL()
    {
        $pageURL = 'http';
        if ($_SERVER['HTTPS'] == 'on') {
            $pageURL .= 's';
        }
        $pageURL .= '://';
        if ($_SERVER['SERVER_PORT'] != '80') {
            $pageURL .= $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
        } else {
            $pageURL .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        }

        return $pageURL;
    }

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////

    //reply for xxx
    function to_reply()
    {
        ?>
    <a onclick='to_reply("<?php comment_ID() ?>", "<?php comment_author();
        ?>")' href="#respond" style="cursor:pointer;">Reply</a>
    <?php

    }

    //callback for comments list
function custom_comments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    //global $commentcount;
    //if (!$commentcount) {
    //    $commentcount = 0;
    //}
    //$commentcount++;
    $intval_depth = intval($depth) - 1;
    if($intval_depth > 5) $intval_depth = 5;
    global $commentalt;
    ($commentalt == 'alt') ? $commentalt = '' : $commentalt = 'alt';
    ?>

    <li <?php comment_class( $depth == '1' ? 'parent' : 'children'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="list" style="margin-left:<?php echo 5 * $intval_depth; ?>%">
            <?php if ($comment->comment_author_email == get_the_author_email()) { ?>
                <!--master's reply-->
                <div class="master">
                    <div class="master-layout" >
                        <?php if (function_exists('get_avatar')) { ?>
                            <div class="gravatar2"><?php echo get_avatar($comment, 32);?></div>
                        <?php } ?>

                        <cite><?php comment_author_link() ?></cite>

                        <span class="masterinfo"><?php to_reply(); ?>
                            <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date() ?> <?php comment_time('H:i'); ?></a><?php edit_comment_link('Edit'); ?>
                        </span>

                        <div class="mastertext"><?php comment_text() ?></div>

                    </div> <!-- .master-layout end-->
                </div> <!--.master end-->

            <?php } else if ($comment->comment_approved == '0') { ?>
                <span style="color:#F60; padding-left:5px;">Your comment is awaiting moderation.</span>
            <?php } else { ?>
                <!--customer's reply-->
                <div class="customer">
                    <div class="customer-layout" >

                        <?php if (function_exists('get_avatar')) { ?>
                            <div class="gravatar"><?php echo get_avatar($comment, 32); ?></div>
                        <?php } ?>

                        <cite><?php comment_author_link() ?></cite>

                        <span class="customerinfo"><?php to_reply(); ?>
                            <a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date() ?> <?php comment_time('H:i:s'); ?></a> <?php edit_comment_link('Edit'); ?>
                        </span>

                        <div class="customertext"><?php comment_text() ?></div>

                    </div> <!-- .customer-layout end-->
                </div> <!--.customer end-->
            <?php } ?>

        </div> <!-- list end -->
    </li>
<?php
}
//////////////////////////////////////////////////////////////


    //非插件表情
    function wp_smilies()
    {
        global $wpsmiliestrans;
        if (!get_option('use_smilies') or (empty($wpsmiliestrans))) {
            return;
        }
        $smilies = array_unique($wpsmiliestrans);
        $link = '';
        foreach ($smilies as $key => $smile) {
            $file = get_bloginfo('wpurl').'/wp-includes/images/smilies/'.$smile;
            $value = ' '.$key.' ';
            $img = "<img src=\"{$file}\" alt=\"{$smile}\" />";
            $imglink = htmlspecialchars($img);
            $link .= "<a href=\"#commentform\" title=\"{$smile}\" onclick=\"document.getElementById('comment').value += '{$value}'\">{$img}</a>&nbsp;";
        }
        echo '<div class="wp_smilies">'.$link.'</div>';
    }

///////////////////////////////////////////////////////////////


?>