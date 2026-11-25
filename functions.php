<?php
defined('ABSPATH') || exit;
function gsw_setup() {
 load_theme_textdomain('classic-3column', get_template_directory().'/languages');
 add_theme_support('title-tag'); add_theme_support('post-thumbnails');
 add_theme_support('automatic-feed-links'); add_theme_support('responsive-embeds');
 add_theme_support('html5', array('search-form','comment-form','comment-list','gallery','caption','style','script'));
 add_theme_support('custom-logo', array('height'=>64,'width'=>64,'flex-height'=>true,'flex-width'=>true));
 add_theme_support('editor-styles'); add_editor_style('editor.css');
 register_nav_menus(array('sidebar'=>'ナビゲーション'));
 $GLOBALS['content_width']=632;
}
add_action('after_setup_theme','gsw_setup');
function gsw_assets(){
 wp_enqueue_style('gsw',get_stylesheet_uri(),array(),wp_get_theme()->get('Version'));
 wp_enqueue_script('gsw',get_template_directory_uri().'/assets/theme.js',array(),wp_get_theme()->get('Version'),true);
 if(is_singular() && comments_open() && get_option('thread_comments')) wp_enqueue_script('comment-reply');
}
add_action('wp_enqueue_scripts','gsw_assets');
function gsw_breadcrumbs(){
 echo '<nav class="breadcrumbs" aria-label="パンくずリスト"><a href="'.esc_url(home_url('/')).'">トップ</a>';
 if(is_singular()){
  $cats=get_the_category(); if($cats) echo '<span>›</span><a href="'.esc_url(get_category_link($cats[0]->term_id)).'">'.esc_html($cats[0]->name).'</a>';
  echo '<span>›</span><span aria-current="page">'.esc_html(get_the_title()).'</span>';
 }elseif(is_search()){echo '<span>›</span><span>検索結果</span>';}
 elseif(is_archive()){echo '<span>›</span><span>'.esc_html(wp_strip_all_tags(get_the_archive_title())).'</span>';}
 elseif(is_404()){echo '<span>›</span><span>ページが見つかりません</span>';}
 echo '</nav>';
}

function classic_3column_widgets_init(){
 register_sidebar(array(
  'name'=>__('左カラム','classic-3column'),
  'id'=>'classic-left-sidebar',
  'description'=>__('PCの左側、スマートフォンのスライドメニュー内に表示します。未設定時はナビゲーションと最近の記事を表示します。','classic-3column'),
  'before_widget'=>'<section id="%1$s" class="panel widget %2$s">',
  'after_widget'=>'</section>',
  'before_title'=>'<h2 class="widget-title">',
  'after_title'=>'</h2>',
  'show_in_rest'=>true,
 ));
 register_sidebar(array(
  'name'=>__('右カラム','classic-3column'),
  'id'=>'classic-right-sidebar',
  'description'=>__('PCでは右側、スマートフォンでは本文下に表示します。未設定時は関連記事を表示します。','classic-3column'),
  'before_widget'=>'<section id="%1$s" class="panel widget %2$s">',
  'after_widget'=>'</section>',
  'before_title'=>'<h2 class="widget-title">',
  'after_title'=>'</h2>',
  'show_in_rest'=>true,
 ));
 register_widget('Classic_3column_Related_Widget');
}
add_action('widgets_init','classic_3column_widgets_init');
class Classic_3column_Related_Widget extends WP_Widget {
 public function __construct(){
  parent::__construct('classic_related_posts',__('関連記事（classic 3column）','classic-3column'),array('description'=>__('同じカテゴリーの記事を最大5件表示します。一覧・固定ページでは最近の記事を表示します。','classic-3column')));
 }
 public function widget($args,$instance){
  $title=!empty($instance['title'])?$instance['title']:(is_single()?'関連記事':'最近の記事');
  $title=apply_filters('widget_title',$title,$instance,$this->id_base);
  echo $args['before_widget'];
  get_template_part('template-parts/related-posts',null,array('title'=>$title));
  echo $args['after_widget'];
 }
 public function form($instance){
  $title=isset($instance['title'])?$instance['title']:'';
  ?><p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">タイトル（空欄で自動表示）</label>
  <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"></p><?php
 }
 public function update($new_instance,$old_instance){
  return array('title'=>sanitize_text_field(isset($new_instance['title'])?$new_instance['title']:''));
 }
}
