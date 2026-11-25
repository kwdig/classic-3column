<?php defined('ABSPATH') || exit; ?>
<aside id="left-nav" class="left-nav">
<?php if(is_active_sidebar('classic-left-sidebar')): dynamic_sidebar('classic-left-sidebar'); else: ?>
<div class="nav-heading">ナビゲーション<small>CATEGORIES</small></div>
<nav aria-label="カテゴリー"><?php if(has_nav_menu('sidebar')){wp_nav_menu(array('theme_location'=>'sidebar','container'=>false,'depth'=>3));}else{ ?>
<ul><li><a href="<?php echo esc_url(home_url('/')); ?>">⌂ トップページ</a></li></ul>
<h2 class="side-label">カテゴリー</h2><ul><?php wp_list_categories(array('title_li'=>'','show_count'=>true,'hide_empty'=>false,'depth'=>3)); ?></ul>
<?php } ?></nav>
<section class="left-recent"><h2 class="side-label">最近の記事</h2><ul><?php $gsw_recent=new WP_Query(array('posts_per_page'=>6,'ignore_sticky_posts'=>true,'no_found_rows'=>true)); while($gsw_recent->have_posts()):$gsw_recent->the_post(); ?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php endwhile;wp_reset_postdata(); ?></ul></section>
<?php endif; ?>
</aside>
