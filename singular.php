<?php defined('ABSPATH') || exit; get_header(); ?>
<?php while(have_posts()):the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('wiki-article'); ?>>
<header class="article-header"><h1><?php the_title(); ?></h1><div class="article-meta"><span>最終更新：<time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>"><?php echo esc_html(get_the_modified_date('Y/m/d')); ?></time></span><?php if(is_single()) the_category(' '); ?><?php edit_post_link('編集'); ?></div></header>
<?php if(post_password_required()):the_content();else: ?>
<?php if(has_post_thumbnail()): ?><figure class="featured-image"><?php the_post_thumbnail('large'); ?></figure><?php endif; ?>
<div class="entry-content"><?php the_content(); ?></div>
<?php wp_link_pages(array('before'=>'<nav class="page-links" aria-label="記事のページ">','after'=>'</nav>')); ?>
<?php if(is_single()): ?><div class="post-tags"><?php the_tags('タグ：',' / '); ?></div><?php the_post_navigation(array('prev_text'=>'← %title','next_text'=>'%title →')); endif; ?>
<?php endif; ?></article>
<?php if(comments_open() || get_comments_number()) comments_template(); ?>
<?php endwhile;get_footer(); ?>
