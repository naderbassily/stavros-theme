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
  <a href="<?php echo esc_url( home_url('/') ); ?>" class="nav-logo">Stavros E. Basta</a>
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
</nav>
