<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package paper-anchor
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'paper-anchor' ); ?></a>

	<header id="header" class="header" role="banner">
		<div class="masthead">
		<div class="brand">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title">
					<?php
						$logo = get_option('logo');
					?>
					<?php if ( !empty($logo) )  : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
							<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="no-logo" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					<?php endif; ?>
				</h1>
			<?php else : ?>
				<p class="site-title h1">
					<?php
						$logo = get_option('logo');
					?>
					<?php if ( !empty($logo) )  : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo" rel="home">
							<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo( 'name' ); ?>">
						</a>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="no-logo" rel="home">
							<?php bloginfo( 'name' ); ?>
						</a>
					<?php endif; ?>
				</p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div>
	<!-- .brand -->
	<div class="nav-container">
		<nav id="site-navigation" class="nav" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'paper-anchor' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</div>
	</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
