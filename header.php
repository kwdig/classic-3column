<?php defined('ABSPATH') || exit; ?><!doctype html>
<html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<a class="skip-link" href="#main">本文へスキップ</a>
<header class="site-header"><div class="header-inner">
<button class="nav-toggle" aria-controls="left-nav" aria-expanded="false" aria-label="メニューを開く" hidden>☰</button>
<div class="brand"><?php if(has_custom_logo()) the_custom_logo(); ?><a class="brand-name" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?><small><?php bloginfo('description'); ?></small></a></div>
<?php get_search_form(); ?>
</div></header>
<?php gsw_breadcrumbs(); ?>
<div class="layout"><?php get_template_part('sidebar','left'); ?>
<main id="main" class="main-content" tabindex="-1">
