<?php defined('ABSPATH') || exit; $gsw_search_id=wp_unique_id('gsw-search-'); ?>
<form role="search" method="get" class="site-search" action="<?php echo esc_url(home_url('/')); ?>">
<label class="screen-reader-text" for="<?php echo esc_attr($gsw_search_id); ?>">記事を検索</label>
<input id="<?php echo esc_attr($gsw_search_id); ?>" type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="キーワードを入力して検索"><button type="submit">検索</button></form>
