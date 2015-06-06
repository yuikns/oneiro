<div  id="comments1"> 

<script language="javascript">
//<![CDATA[
function to_reply(commentID,author) {
var nNd='<a href=\'#comment-'+commentID+'\'>@'+author+' </a>';
var myField;
if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
myField = document.getElementById('comment');
document.getElementById('comment_parent').value = commentID;
} else {
return false;
}
if (document.selection) {
myField.focus();
sel = document.selection.createRange();
sel.text = nNd;
myField.focus();
}
else if (myField.selectionStart || myField.selectionStart == '0') {
var startPos = myField.selectionStart;
var endPos = myField.selectionEnd;
var cursorPos = endPos;
myField.value = myField.value.substring(0, startPos)
+ nNd
+ myField.value.substring(endPos, myField.value.length);
cursorPos += nNd.length;
myField.focus();
myField.selectionStart = cursorPos;
myField.selectionEnd = cursorPos;
}
else {
myField.value += nNd;
myField.focus();
}
}
//]]>
</script>
 
<style>
li {list-style-type:none;}
</style>

<div class="comments_warp">
<?php // Dont delete 
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');
if (post_password_required()) { ?>
	<h3 id="respond"><?php _e('This post is password protected. Enter the password to view comments.'); ?></h3>
<?php return; } ?>
<!-- start comments  -->
<?php if (have_comments()): ?>

		<h3 id="comments"><?php comments_number('No Comment', '1 Comment', '% Comments' );?> </h3>


        <!--style of comments -->
        <?php if ( ! empty($comments_by_type['comment']) ) : ?>
      <ul class="commentlist">
            <?php wp_list_comments(array ('type' => 'comment','callback' => 'custom_comments','reverse_top_level' => 'DESC')); ?>
      </ul>
        <?php endif; ?>
        
        
     <!--Flip of comments --> 
      <div class="navigation">
            
         <?php paginate_comments_links(); ?>
      </div>
      
  
   <!--Also removed Pingbacklist--> 
   
   
    
<?php else : // this is displayed if there are no comments so far ?>

<?php endif; ?>


<!--Input Area--> 
<?php if ('open' == $post->comment_status) : ?>
<div id="respond">
<h3 id="respondh3"><?php comment_form_title( __('Write a Comment') ); ?></h3>

<div class="cancel-reply"><?php cancel_comment_reply_link() ?></div>


    <!--Interpretation of whether to set a user must be registered and logged in to post a comment --> 
    <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
    <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), '/wp-login.php?redirect_to=' . urlencode(get_permalink())); ?></p>
    <?php else : ?>
    <form action="/wp-comments-post.php" method="post" id="commentform" class="reply">
    	<?php if ( $user_ID ) : ?>
   			 <p><?php printf(__('Logged in as <a href="%1$s">%2$s</a>.'),'/wp-admin/profile.php', $user_identity); ?> <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account'); ?>"><?php _e('Log out &raquo;'); ?></a></p>
   	 	<?php else : ?>
        
        
        
	<!--Start of Ajax Comment-->

<?php if ( $comment_author != "" ) : ?>
	<script type="text/javascript">function setStyleDisplay(id, status){document.getElementById(id).style.display = status;}</script>
	<div class="form_row small">
		<!-- Welcome to the visitor -->
		<span style="color:#999"><?php printf(__('<strong>%s</strong>, welcome back !'), $comment_author) ?></span>
 
		<!-- Change button (clicked: Hide Changes button to display the Cancel button to display the data entry box) -->
		<span id="show_author_info"><a href="javascript:setStyleDisplay('author_info','');setStyleDisplay('show_author_info','none');setStyleDisplay('hide_author_info','');"><?php _e(' （Change Another &raquo;）'); ?></a></span>
 
		<!-- Cancel button (clicked: Display Change button, hide the Cancel button, the hidden data entry box) -->
		<span id="hide_author_info"><a href="javascript:setStyleDisplay('author_info','none');setStyleDisplay('show_author_info','');setStyleDisplay('hide_author_info','none');"><?php _e('Close &raquo;'); ?></a></span>
	</div>
<?php endif; ?>
 
<!-- Contact Input Area -->
<div id="author_info">

		<label for="author" ><span class="authoricon"><?php _e('Name'); ?> <?php if ($req) _e('(Required)'); ?></span></label>
	<div class="form_row">
		<input type="text" class="border"  name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" />
	</div>
    
    	<label for="email" ><span class="emailicon"><?php _e('Email');?> <?php if ($req) _e('(Required)'); ?></span></label>
	<div class="form_row">
		<input type="text" class="border" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" />
		
	</div>
    
    
    	<label for="url" ><span class="urlicon"><?php _e('Website'); ?></span></label>
	<div class="form_row">
		<input type="text"  class="border" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
		
	</div>
 
</div>
 
<!-- Visitors with cookie -->
<?php if ( $comment_author != "" ) : ?>
	<!-- Hide cancel button and contact info input area-->
	<script type="text/javascript">setStyleDisplay('hide_author_info','none');setStyleDisplay('author_info','none');</script>
<?php endif; ?>

<!--End of Ajax Comment--->
            
            
            

		<?php endif; ?>
        
<div class="input">
<p><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea></p>

</div>

<div class="clear"></div>

<!--smilies-->       

<div style=" margin-left:10px;"><?php wp_smilies();?></div>
<!--smilies-->

<input name="submit" type="submit" id="submit" tabindex="5" value="Post Your Idea (Ctrl+Enter)" class="comm_submit" /><?php comment_id_fields(); ?></p>
<?php do_action('comment_form', $post->ID); ?>

</form>
	<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>
</div>

</div>


