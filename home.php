<?php
/**
 * Main posts index template.
 */

get_header();

get_template_part(
    'template-parts/posts-archive',
    null,
    [
        'title'         => __( 'Posts', 'stavros-basta' ),
        'empty_message' => __( 'No posts have been published yet.', 'stavros-basta' ),
    ]
);

get_footer();
