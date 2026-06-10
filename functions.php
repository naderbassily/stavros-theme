<?php

// ── Theme setup ──────────────────────────────────────────────
function stavros_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'stavros-basta' ),
    ] );
}
add_action( 'after_setup_theme', 'stavros_setup' );


// ── Enqueue styles & scripts ─────────────────────────────────
function stavros_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'stavros-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Inter:wght@300;400;500;600&family=Courier+Prime:wght@400;700&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'stavros-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [ 'stavros-fonts' ],
        wp_get_theme()->get( 'Version' )
    );
}
add_action( 'wp_enqueue_scripts', 'stavros_enqueue_assets' );


// ── Custom post types ────────────────────────────────────────
function stavros_register_post_types() {
    register_post_type(
        'book',
        [
            'labels' => [
                'name'                  => __( 'Books', 'stavros-basta' ),
                'singular_name'         => __( 'Book', 'stavros-basta' ),
                'add_new'               => __( 'Add New', 'stavros-basta' ),
                'add_new_item'          => __( 'Add New Book', 'stavros-basta' ),
                'edit_item'             => __( 'Edit Book', 'stavros-basta' ),
                'new_item'              => __( 'New Book', 'stavros-basta' ),
                'view_item'             => __( 'View Book', 'stavros-basta' ),
                'view_items'            => __( 'View Books', 'stavros-basta' ),
                'search_items'          => __( 'Search Books', 'stavros-basta' ),
                'not_found'             => __( 'No books found.', 'stavros-basta' ),
                'not_found_in_trash'    => __( 'No books found in Trash.', 'stavros-basta' ),
                'all_items'             => __( 'All Books', 'stavros-basta' ),
                'menu_name'             => __( 'Books', 'stavros-basta' ),
                'name_admin_bar'        => __( 'Book', 'stavros-basta' ),
            ],
            'public'              => true,
            'show_in_rest'        => true,
            'has_archive'         => true,
            'menu_icon'           => 'dashicons-book-alt',
            'rewrite'             => [ 'slug' => 'books' ],
            'supports'            => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'page-attributes' ],
        ]
    );

    register_taxonomy(
        'genre',
        'book',
        [
            'label'        => __( 'Genre', 'stavros-basta' ),
            'public'       => true,
            'hierarchical' => true,
            'rewrite'      => [ 'slug' => 'genre' ],
            'show_in_rest' => true,
        ]
    );
}
add_action( 'init', 'stavros_register_post_types' );


// ── Book field helper ────────────────────────────────────────
function stavros_book_field( $key, $post_id = null ) {
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $key, $post_id );
        if ( $value ) {
            return $value;
        }
    }

    return get_post_meta( $post_id ?: get_the_ID(), $key, true );
}


// ── Theme URL helpers ───────────────────────────────────────
function stavros_section_url( $section_id = '' ) {
    $home_url = home_url( '/' );

    if ( '' === $section_id ) {
        return $home_url;
    }

    return $home_url . '#' . ltrim( $section_id, '#' );
}

function stavros_contact_url() {
    $contact_page = get_page_by_path( 'contact' );

    if ( ! $contact_page ) {
        $contact_page = get_page_by_path( 'contact-us' );
    }

    if ( $contact_page instanceof WP_Post ) {
        return get_permalink( $contact_page );
    }

    return stavros_section_url( 'contact' );
}


// ── ACF: load field groups from /acf-json ────────────────────
// Uncomment once you create the acf-json folder:
// add_filter( 'acf/settings/save_json', function() {
//     return get_stylesheet_directory() . '/acf-json';
// });
// add_filter( 'acf/settings/load_json', function( $paths ) {
//     $paths[] = get_stylesheet_directory() . '/acf-json';
//     return $paths;
// });
