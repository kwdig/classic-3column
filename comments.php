<?php defined('ABSPATH') || exit;if(post_password_required()) return; ?>
<section class="comments-area" aria-label="コメント"><?php if(have_comments()): ?><h2>コメント</h2><ol class="comment-list"><?php wp_list_comments(array('style'=>'ol','short_ping'=>true)); ?></ol><?php the_comments_pagination(); endif;comment_form(); ?></section>
