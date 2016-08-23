<?php

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	return $themename;
}

function optionsframework_options() {

	$blogpath =  get_stylesheet_directory_uri() . '/img';

	// 将所有分类（categories）加入数组
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// 所有分类ID
	$categories = get_categories(); 
	foreach ($categories as $cat) {
        $cats_id ='';
        $cats_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
	}

	// 所有视频分类ID
//	$categories = get_categories(array('taxonomy' => 'videos'));
//	foreach ($categories as $cat) {
//	$catv_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
//	}
//
//	// 所有图片分类ID
//	$categories = get_categories(array('taxonomy' => 'gallery'));
//	foreach ($categories as $cat) {
//	$catp_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
//	}
//
//	// 所有商品分类ID
//	$categories = get_categories(array('taxonomy' => 'taobao'));
//	foreach ($categories as $cat) {
//	$catt_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
//	}
//
//	// 所有公告分类ID
//	$categories = get_categories(array('taxonomy' => 'notice'));
//	foreach ($categories as $cat) {
//	$catb_id .= '<li>'.$cat->cat_name.' [ '.$cat->cat_ID.' ]</li>';
//	}

	// 将所有标签（tags）加入数组
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = '选择页面:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$options = array();



	return $options;
}