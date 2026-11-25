<?php defined('ABSPATH') || exit;get_header(); ?>
<header class="archive-header"><span class="eyebrow">ARTICLES</span><h1><?php
if(is_search()) echo '「'.esc_html(get_search_query()).'」の検索結果';
elseif(is_archive()) echo esc_html(wp_strip_all_tags(get_the_archive_title()));
elseif(is_home() && !is_front_page()) single_post_title();
else echo '最新の記事'; ?></h1><?php if(is_archive()) the_archive_description('<div>','</div>'); ?></header>
<?php if(have_posts()): ?><div class="post-list"><?php while(have_posts()):the_post(); ?>
<article <?php post_class('post-card'); ?>><?php if(has_post_thumbnail()): ?><a class="card-image" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true"><?php the_post_thumbnail('medium'); ?></a><?php endif; ?><div><time datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>"><?php echo esc_html(get_the_modified_date('Y/m/d')); ?></time><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?><div class="card-categories"><?php the_category(' '); ?></div></div></article>
<?php endwhile; ?></div><?php the_posts_pagination(array('prev_text'=>'前へ','next_text'=>'次へ')); ?>
<?php else: ?><div class="empty-state"><h2>記事が見つかりませんでした</h2><p>別のキーワードで検索するか、カテゴリーから探してください。</p><?php get_search_form(); ?></div><?php endif;get_footer(); ?>
