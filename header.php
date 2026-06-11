<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<nav>
  <a href="<?php echo esc_url( home_url('/') ); ?>" class="nav-logo" aria-label="<?php esc_attr_e( 'Stavros E. Basta — Home', 'stavros-basta' ); ?>">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="Stavros E. Basta" class="nav-logo-img" width="180" height="87" />
  </a>
  <div class="nav-right">
    <?php
    wp_nav_menu(
      [
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'nav-links',
        'fallback_cb'    => false,
      ]
    );
    ?>
    <form class="nav-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <label class="screen-reader-text" for="nav-search-field"><?php esc_html_e( 'Search site', 'stavros-basta' ); ?></label>
      <input id="nav-search-field" class="nav-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search', 'stavros-basta' ); ?>" />
    </form>
  </div>
</nav>
