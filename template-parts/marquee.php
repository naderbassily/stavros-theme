<div class="marquee-band">
  <div class="marquee-track">
    <?php
    $items = [ 'GICSP','CISM','LPTM','GSLC','CPENT','ICS Security','Critical Infrastructure','Penetration Testing','Risk Management','Cloud Security','CISSP','Supply Chain Resilience' ];
    // Double the list so the loop is seamless
    $all = array_merge( $items, $items );
    foreach ( $all as $i => $item ) :
        echo '<span class="m-item">' . esc_html( $item ) . '</span>';
        echo '<span class="m-item m-sep">&mdash;</span>';
    endforeach;
    ?>
  </div>
</div>
