<?php defined('ABSPATH') || exit; $gsw_related_title=isset($args['title'])?$args['title']:(is_single()?'関連記事':'最近の記事'); ?>
<h2>▤ <?php echo esc_html($gsw_related_title); ?></h2><div class="panel-body"><ul class="related-list">
<?php
$gsw_args=array('posts_per_page'=>5,'ignore_sticky_posts'=>true,'no_found_rows'=>true);
if(is_singular()) $gsw_args['post__not_in']=array(get_queried_object_id());
if(is_single()) { $gsw_cats=wp_get_post_categories(get_queried_object_id()); if($gsw_cats) $gsw_args['category__in']=$gsw_cats; }
$gsw_related=new WP_Query($gsw_args);
if($gsw_related->have_posts()):while($gsw_related->have_posts()):$gsw_related->the_post(); ?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php endwhile;else: ?><li>記事を追加するとここに表示されます。</li><?php endif;wp_reset_postdata(); ?>
</ul></div>