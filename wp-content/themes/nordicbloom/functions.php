<?php

function nordicbloom_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
}

add_action('after_setup_theme', 'nordicbloom_setup');


function nordicbloom_styles() {
    wp_enqueue_style(
        'nordicbloom-style',
        get_stylesheet_uri()
    );
}

add_action('wp_enqueue_scripts', 'nordicbloom_styles');