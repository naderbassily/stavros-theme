<?php

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

if ( ! defined( 'STAVROS_BASTA_VERSION' ) ) {
    define( 'STAVROS_BASTA_VERSION', '1.0.5' );
}

function stavros_get_github_update_token() {
    if ( defined( 'STAVROS_BASTA_GITHUB_TOKEN' ) && STAVROS_BASTA_GITHUB_TOKEN ) {
        return (string) STAVROS_BASTA_GITHUB_TOKEN;
    }

    $token = getenv( 'STAVROS_BASTA_GITHUB_TOKEN' );

    return $token ? (string) $token : '';
}

function stavros_init_github_theme_updater() {
    $puc_loader = get_template_directory() . '/inc/plugin-update-checker/plugin-update-checker.php';

    if ( ! file_exists( $puc_loader ) ) {
        return;
    }

    require_once $puc_loader;

    if ( ! class_exists( PucFactory::class ) ) {
        return;
    }

    $update_checker = PucFactory::buildUpdateChecker(
        'https://github.com/naderbassily/stavros-theme/',
        __FILE__,
        'stavros-theme'
    );

    $update_checker->setBranch( 'main' );

    $github_token = stavros_get_github_update_token();
    if ( '' !== $github_token ) {
        $update_checker->setAuthentication( $github_token );
    }
}
stavros_init_github_theme_updater();

// ── Theme setup ──────────────────────────────────────────────
function stavros_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'stavros-basta' ),
        'footer'  => __( 'Footer Navigation', 'stavros-basta' ),
    ] );
}
add_action( 'after_setup_theme', 'stavros_setup' );


// ── Enqueue styles & scripts ─────────────────────────────────
function stavros_enqueue_assets() {
    $main_css_path = get_theme_file_path( '/assets/css/main.css' );

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
        file_exists( $main_css_path ) ? filemtime( $main_css_path ) : wp_get_theme()->get( 'Version' )
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


// ── Custom field helper ──────────────────────────────────────
function stavros_book_field( $key, $post_id = null ) {
    if ( function_exists( 'get_field' ) ) {
        $value = get_field( $key, $post_id );
        if ( $value ) {
            return $value;
        }
    }

    return get_post_meta( $post_id ?: get_the_ID(), $key, true );
}
// Alias kept for backwards compatibility with any external code.
function stavros_custom_field( $key, $post_id = null ) {
    return stavros_book_field( $key, $post_id );
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

function stavros_contact_recipient_email() {
    return 'me@naderamsis.com';
}

function stavros_contact_display_email() {
    return 'contact@stavrosbasta.com';
}

function stavros_contact_from_email() {
    return stavros_contact_display_email();
}

function stavros_contact_mail_headers( $reply_name = '', $reply_email = '' ) {
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: Stavros Basta <' . stavros_contact_from_email() . '>',
    ];

    if ( $reply_name && $reply_email && is_email( $reply_email ) ) {
        $headers[] = 'Reply-To: ' . sanitize_text_field( $reply_name ) . ' <' . sanitize_email( $reply_email ) . '>';
    }

    return $headers;
}

function stavros_handle_contact_form_submission() {
    $redirect_url = wp_get_referer() ? wp_get_referer() : stavros_contact_url();
    $redirect_url = remove_query_arg( [ 'contact_status', 'contact_error' ], $redirect_url );

    if ( ! isset( $_POST['stavros_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['stavros_contact_nonce'] ) ), 'stavros_contact_form' ) ) {
        wp_safe_redirect( add_query_arg( 'contact_status', 'error', $redirect_url ) );
        exit;
    }

    $name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
    $email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
    $subject = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
    $message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

    if ( ! $name || ! is_email( $email ) || ! $subject || ! $message ) {
        wp_safe_redirect( add_query_arg( 'contact_status', 'error', $redirect_url ) );
        exit;
    }

    $mail_error_message = '';
    $mail_error_hook    = static function ( $wp_error ) use ( &$mail_error_message ) {
        if ( $wp_error instanceof WP_Error ) {
            $mail_error_message = $wp_error->get_error_message();
        }
    };

    add_action( 'wp_mail_failed', $mail_error_hook );

    $sent = wp_mail(
        stavros_contact_recipient_email(),
        sprintf( __( 'Stavros Basta contact form: %s', 'stavros-basta' ), $subject ),
        sprintf(
            "Name: %1\$s\nEmail: %2\$s\nSubject: %3\$s\n\nMessage:\n%4\$s",
            $name,
            $email,
            $subject,
            $message
        ),
        stavros_contact_mail_headers( $name, $email )
    );

    remove_action( 'wp_mail_failed', $mail_error_hook );

    if ( ! $sent && $mail_error_message ) {
        $redirect_url = add_query_arg(
            [
                'contact_status' => 'error',
                'contact_error'  => rawurlencode( $mail_error_message ),
            ],
            $redirect_url
        );
        wp_safe_redirect( $redirect_url );
        exit;
    }

    wp_safe_redirect( add_query_arg( 'contact_status', $sent ? 'sent' : 'error', $redirect_url ) );
    exit;
}
add_action( 'admin_post_stavros_contact_form', 'stavros_handle_contact_form_submission' );
add_action( 'admin_post_nopriv_stavros_contact_form', 'stavros_handle_contact_form_submission' );

function stavros_get_result_excerpt( $post_id = null, $word_count = 28 ) {
    $post = get_post( $post_id ?: get_the_ID() );

    if ( ! $post instanceof WP_Post ) {
        return '';
    }

    $excerpt = trim( get_the_excerpt( $post ) );
    if ( '' !== $excerpt ) {
        return $excerpt;
    }

    return wp_trim_words( wp_strip_all_tags( strip_shortcodes( $post->post_content ) ), $word_count );
}

function stavros_get_search_paper_results( $search_term ) {
    $search_term = trim( (string) $search_term );
    if ( '' === $search_term ) {
        return [];
    }

    $results          = [];
    $registered_types = array_values(
        array_filter(
            [ 'paper', 'papers' ],
            'post_type_exists'
        )
    );

    if ( ! empty( $registered_types ) ) {
        $paper_query = new WP_Query(
            [
                'post_type'           => $registered_types,
                'post_status'         => 'publish',
                'posts_per_page'      => -1,
                's'                   => $search_term,
                'orderby'             => 'date',
                'order'               => 'DESC',
                'no_found_rows'       => true,
                'ignore_sticky_posts' => true,
            ]
        );

        foreach ( $paper_query->posts as $paper_post ) {
            $results[ $paper_post->ID ] = $paper_post;
        }
    }

    $papers_category = get_category_by_slug( 'papers' );
    if ( $papers_category instanceof WP_Term ) {
        $paper_posts_query = new WP_Query(
            [
                'post_type'           => 'post',
                'post_status'         => 'publish',
                'posts_per_page'      => -1,
                's'                   => $search_term,
                'orderby'             => 'date',
                'order'               => 'DESC',
                'no_found_rows'       => true,
                'ignore_sticky_posts' => true,
                'cat'                 => (int) $papers_category->term_id,
            ]
        );

        foreach ( $paper_posts_query->posts as $paper_post ) {
            $results[ $paper_post->ID ] = $paper_post;
        }
    }

    $results = array_values( $results );
    usort(
        $results,
        static function ( $left, $right ) {
            return strtotime( $right->post_date_gmt ?: $right->post_date ) <=> strtotime( $left->post_date_gmt ?: $left->post_date );
        }
    );

    return $results;
}


// ── Book archive query controls ────────────────────────────
function stavros_modify_book_archive_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() || ! is_post_type_archive( 'book' ) ) {
        return;
    }

    $query->set( 'posts_per_page', -1 );

    $genre = isset( $_GET['book_genre'] ) ? sanitize_text_field( wp_unslash( $_GET['book_genre'] ) ) : '';
    if ( '' !== $genre ) {
        $query->set(
            'tax_query',
            [
                [
                    'taxonomy' => 'genre',
                    'field'    => 'slug',
                    'terms'    => $genre,
                ],
            ]
        );
    }

    $search = isset( $_GET['book_search'] ) ? sanitize_text_field( wp_unslash( $_GET['book_search'] ) ) : '';
    if ( '' !== $search ) {
        $query->set( 's', $search );
    }

    $sort = isset( $_GET['book_sort'] ) ? sanitize_text_field( wp_unslash( $_GET['book_sort'] ) ) : 'date_desc';
    switch ( $sort ) {
        case 'date_asc':
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'ASC' );
            break;
        case 'title_asc':
            $query->set( 'orderby', 'title' );
            $query->set( 'order', 'ASC' );
            break;
        case 'title_desc':
            $query->set( 'orderby', 'title' );
            $query->set( 'order', 'DESC' );
            break;
        case 'date_desc':
        default:
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
            break;
    }
}
add_action( 'pre_get_posts', 'stavros_modify_book_archive_query' );


// ── ACF: load field groups from /acf-json ────────────────────
// Uncomment once you create the acf-json folder:
// add_filter( 'acf/settings/save_json', function() {
//     return get_stylesheet_directory() . '/acf-json';
// });
// add_filter( 'acf/settings/load_json', function( $paths ) {
//     $paths[] = get_stylesheet_directory() . '/acf-json';
//     return $paths;
// });
