<div id="sidebar">

  <div id="sidebar-layout">
	<?php if (!dynamic_sidebar('Sidebar')) : ?>
	<?php endif; ?>
	<ul>

		<!--Random Posts-->
		<li id="sidebar-random" class="widget">
			<h3>Random Posts</h3>
			<ul class="ulstyle">
				<?php $rand_posts = get_posts('numberposts=5&orderby=rand'); foreach ($rand_posts as $post) : ?>
				<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</li>


		<!--Recent Comments-->
		<li id="sidebar-commt" class="widget">
			<h3>Recent Comments</h3>
			<ul class="ulstyle">
			<?php
                    $limit_num = '8'; //Here is the comment limit
                    $my_email = "'".get_bloginfo('admin_email')."'";//not show host's email
                    $rc_comms = $wpdb->get_results("
					 SELECT ID, post_title, comment_ID, comment_author,comment_author_email, comment_content
					 FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts
					 ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID)
					 WHERE comment_approved = '1'
					 AND comment_type = ''
					 AND post_password = ''
					 AND comment_author_email != $my_email
					 ORDER BY comment_date_gmt
					 DESC LIMIT $limit_num
					 ");
                    $rc_comments = '';
                    foreach ($rc_comms as $rc_comm) { //get_avatar($rc_comm,$size='50')
                    $rc_comments .= "<li><a href='"
                    .get_permalink($rc_comm->ID).'#comment-'.$rc_comm->comment_ID
                    //. htmlspecialchars(get_comment_link(  $rc_comm->comment_ID, array('type' => 'comment'))) // another implement of the previous line
."' title='Commented on ".$rc_comm->post_title.".'><span class='comer'>".$rc_comm->comment_author.' : </span>'.cut_str(strip_tags($rc_comm->comment_content), 14)."</a></li>\n";
                    }
                    $rc_comments = convert_smilies($rc_comments);
                    echo $rc_comments;
                    ?>
			</ul>
		</li>



		<!--Archives-->
		<li id="sidebar-archives" class="widget">
			<h3>Archives</h3>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</li>

     <!--Links-->
		<li id="sidebar-link" class="widget">
			<h3>Links</h3>
			<ul class="ulstyle">
				 <?php wp_list_bookmarks('categorize=0&title_after=&title_before=&title_li='); ?>
			</ul>
		</li>

   </ul>

  </div><!--sidebar-layout-->
  <div style="height:60px;"></div>
  <div class="clear"></div>
</div><!--sidebar-->