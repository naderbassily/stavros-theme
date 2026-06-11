<?php
/**
 * Post taxonomy and date archive template.
 */

get_header();

$archive_title       = get_the_archive_title();
$archive_description = get_the_archive_description();

if ( is_category() ) {
    $archive_title = single_cat_title( '', false );
} elseif ( is_tag() ) {
    $archive_title = single_tag_title( '', false );
} elseif ( is_author() ) {
    $archive_title = get_the_author();
}

get_template_part(
    'template-parts/posts-archive',
    null,
    [
        'title'       => $archive_title ?: __( 'Posts', 'stavros-basta' ),
        'description' => $archive_description,
    ]
);

get_footer();
