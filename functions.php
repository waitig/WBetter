<?php
//加载主题包含文件
require get_template_directory() . '/inc/user/use.php';
if (!isset($locking)) {
    require get_template_directory() . '/inc/options/options-framework.php';
    if (is_admin() && $_GET['activated'] == 'true') {
        header("Location: themes.php?page=options-framework");
    }
}

//注册菜单
register_nav_menus(
    array(
        'primary' => '主要菜单',
        'header' => '顶部菜单',
        'mobile' => '移动端菜单'
    )
);

add_theme_support( 'custom-background' );
add_theme_support( 'post-formats', array(
    'aside', 'image', 'quote'
) );
require get_template_directory() . '/inc/user/use.php';
add_editor_style( '/css/editor-style.css' );
add_theme_support( 'automatic-feed-links' );
show_admin_bar(false);
function default_menu() {
    echo '<ul class="default-menu"><li><a href="'.home_url().'/wp-admin/nav-menus.php">设置菜单</a></li></ul>';
}
define( 'version', '2016.08.03' );
// 禁止加载jquery
add_action( 'pre_get_posts', 'jquery_register' );
function jquery_register() {
    if ( !is_admin() ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), '1.10.1', false );
        wp_enqueue_script( 'jquery' );
    }
}

// 头部冗余代码
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

// 编辑器增强
function enable_more_buttons($buttons) {
    $buttons[] = 'hr';
    $buttons[] = 'del';
    $buttons[] = 'sub';
    $buttons[] = 'sup';
    $buttons[] = 'fontselect';
    $buttons[] = 'fontsizeselect';
    $buttons[] = 'cleanup';
    $buttons[] = 'styleselect';
    $buttons[] = 'wp_page';
    $buttons[] = 'anchor';
    $buttons[] = 'backcolor';
    return $buttons;
}
add_filter( "mce_buttons_2", "enable_more_buttons" );

// 禁止代码标点转换
remove_filter( 'the_content', 'wptexturize' );

// 禁止后台加载谷歌字体
function wp_remove_open_sans_from_wp_core() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'wp_remove_open_sans_from_wp_core' );

//w_gopt
function w_gopt($e){
    return stripslashes(get_option($e));
}

//隐藏admin Bar
add_filter('show_admin_bar','hide_admin_bar');

// 禁用xmlrpc
if (w_gopt('w_xmlrpc_no')) {
    add_filter('xmlrpc_enabled', '__return_false');
}