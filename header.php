<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$primary_menu_items = [];
$contact_menu_item  = null;
$menu_locations     = get_nav_menu_locations();
$primary_menu_id    = $menu_locations['primary'] ?? 0;

if ( $primary_menu_id ) {
  $menu_items = wp_get_nav_menu_items(
    $primary_menu_id,
    [
      'update_post_term_cache' => false,
    ]
  );

  if ( is_array( $menu_items ) ) {
    foreach ( $menu_items as $menu_item ) {
      if ( (int) $menu_item->menu_item_parent !== 0 ) {
        continue;
      }

      if ( 'contact' === sanitize_title( $menu_item->title ) ) {
        $contact_menu_item = $menu_item;
        continue;
      }

      $primary_menu_items[] = $menu_item;
    }
  }
}
?>

<nav>
  <a href="<?php echo esc_url( home_url('/') ); ?>" class="nav-logo" aria-label="<?php esc_attr_e( 'Stavros E. Basta — Home', 'stavros-basta' ); ?>">
    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>" alt="Stavros E. Basta" class="nav-logo-img" width="180" height="87" />
  </a>
  <div class="nav-right">
    <div class="nav-menu-row">
      <?php if ( ! empty( $primary_menu_items ) ) : ?>
        <ul class="nav-links">
          <?php foreach ( $primary_menu_items as $menu_item ) : ?>
            <li class="menu-item">
              <a href="<?php echo esc_url( $menu_item->url ); ?>"><?php echo esc_html( $menu_item->title ); ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else : ?>
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
      <?php endif; ?>

      <?php if ( $contact_menu_item ) : ?>
        <a class="nav-contact-link" href="<?php echo esc_url( $contact_menu_item->url ); ?>">
          <?php echo esc_html( $contact_menu_item->title ); ?>
        </a>
      <?php endif; ?>
    </div>

    <form class="nav-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <label class="screen-reader-text" for="nav-search-field"><?php esc_html_e( 'Search site', 'stavros-basta' ); ?></label>
      <input id="nav-search-field" class="nav-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search', 'stavros-basta' ); ?>" />
    </form>
  </div>
</nav>
