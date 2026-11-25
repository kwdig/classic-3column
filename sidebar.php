<?php defined('ABSPATH') || exit; ?>
<aside class="right-sidebar" aria-label="サイドバー">
<?php if(is_active_sidebar('classic-right-sidebar')): ?>
<?php dynamic_sidebar('classic-right-sidebar'); ?>
<?php else: ?>
<section class="panel"><?php get_template_part('template-parts/related-posts'); ?></section>
<?php endif; ?>
</aside>
