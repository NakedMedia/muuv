<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package leedo
 */

class CustomWalker extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
    	$output .= "<ul class='navbar-dropdown is-boxed'>\n";
       
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "</ul>\n";
    }
    
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $has_children = in_array('menu-item-has-children', $item->classes);
 
        $classes[] = 'navbar-item';

        $classes[] = $has_children ? 'has-dropdown is-hoverable' : '';


        $class_names = join( ' ', $classes );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
 
        $container .= $has_children ? '<div'. $class_names .'>' : '';
 
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
 
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $link_class = $has_children ? 'navbar-link' : 'navbar-item';
 
        $item_output .= $container . '<a'. $attributes .' class="'. $link_class .'">';
        $item_output .= $item->title;
        $item_output .= '</a>';
 
        $output .= $item_output;
    }

     public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $n = "\n";
        $has_children = in_array('menu-item-has-children', $item->classes);

        $output .= $has_children ? "</a></div>" : "</a>";
     }
}

$nav_menu_slug = get_term( get_nav_menu_locations()['nav-menu'], 'nav_menu' )->slug;
$nav_menu_right_slug = get_term( get_nav_menu_locations()['nav-menu-right'], 'nav_menu' )->slug;

?> 

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="root">
		<nav class="navbar is-transparent container">
		  <div class="navbar-brand">
		    <a class="navbar-item" href="/">
		      <img src="<?=wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) , 'full' )[0];?>" alt="Logo">
		    </a>
		    <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
		      <span></span>
		      <span></span>
		      <span></span>
		    </div>
		  </div>

		  <div class="navbar-menu">
		    <?= $nav_menu_slug
		    	? wp_nav_menu(array('menu' => $nav_menu_slug, 'menu_class' => 'navbar-start', 'container' => null, 'walker' => new CustomWalker()))
		    	: '' 
		    ?>
		  </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="field is-grouped">
              <div class="control">
                  <a class="button is-text" href="#">
                    <span class="icon">
                      <i class="fas fa-truck-moving"></i>
                    </span>
                    <span>Sign Up</span>
                  </a>
              </div>
              <div class="control">
                  <a class="button is-text" href="#">
                    <span class="icon">
                      <i class="fas fa-sign-in-alt"></i>
                    </span>
                    <span>Login</span>
                  </a>
              </div>
          </div>
        </div>
        <div class="navbar-item">
          <a class="button is-primary has-text-secondary" href="tel:<?= get_theme_mod('phone_number'); ?>">
            <span class="icon">
              <i class="fas fa-phone"></i>
            </span>
            <span><?= get_theme_mod('phone_number'); ?></span>
          </a>
        </div>
      </div>
		</nav>