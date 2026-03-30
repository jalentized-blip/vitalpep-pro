<?php
/**
 * Custom Walker for footer nav menus — outputs simple <a> links with footer__link class.
 */
class VPP_Footer_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $output .= '<a href="' . esc_url( $item->url ) . '" class="footer__link">' . esc_html( $item->title ) . '</a>';
    }
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        // No closing tag needed
    }
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
}
