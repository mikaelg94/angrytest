<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Str;

/**
 * Inject the Vite assets into the head.
 *
 * @return void
 */
add_filter('wp_head', function () {
    echo Str::wrap(app('assets.vite')([
        'resources/css/app.css',
        'resources/js/app.js',
    ]), "\n");

    echo '<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&display=swap" rel="stylesheet">';
});


/**
 * Inject assets into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    $screen = get_current_screen();

    if (! $screen?->is_block_editor()) {
        return;
    }

    $dependencies = File::json(public_path('build/editor.deps.json')) ?? [];

    foreach ($dependencies as $dependency) {
        if (! wp_script_is($dependency)) {
            wp_enqueue_script($dependency);
        }
    }

    echo Str::wrap(app('assets.vite')([
        'resources/css/editor.css',
        'resources/js/editor.js',
    ]), "\n");
});


/**
 * enqueue tailwind css classes inside the block iframe rendering
 */
add_action( 'enqueue_block_assets', function () {
    wp_enqueue_style('tailwind-editor-style', app('assets.vite')->asset('resources/css/editor.css'),[],'1.0','all');
});

/**
 * Use theme.json from the build directory
 *
 * @param  string  $path
 * @param  string  $file
 * @return string
 */
add_filter('theme_file_path', function (string $path, string $file): string {
    if ($file === 'theme.json') {
        return public_path().'/build/assets/theme.json';
    }

    return $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Allowed blocks to show in editor
 */
add_filter('allowed_block_types_all', function ($allowed_blocks, $editor_context): array {
    $allowed_blocks = [
        'gonera/products',
    ];

    return $allowed_blocks;
}, 100, 2);

/**
 * Register custom blocks
 */
add_action('init', function () {

    $blocks_path = get_theme_file_path('/resources/blocks/build');

    // Loop through each block folder
    foreach (glob($blocks_path.'/*', GLOB_ONLYDIR) as $block_folder) {
        register_block_type($block_folder);
    }
});
