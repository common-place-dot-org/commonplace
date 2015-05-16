<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package gazette
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link type="text/plain" rel="author" href="<?php echo esc_url( home_url( '/' ) ); ?>/humans.txt" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="container">
		<a class="skip-link sr-only" href="#content"><?php _e( 'Skip to content', 'gazette' ); ?></a>
		<header id="masthead" role="banner">
			<div class="row">
				<div class="col-sm-4">
					<?php 
						if (wp_get_nav_menu_object('Header Left')){
							$defaults = array(
								'menu'			=> 'Header Left',
								'container'       => false,
								'items_wrap'      => '<ul id="%1$s" class="%2$s nav nav-pills">%3$s</ul>',
								'depth'			=> 1,
								'fallback_cb'		=> false
							);
							wp_nav_menu( $defaults );
						}
					?>
				</div>				
				<div class="col-sm-4">
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?> : <?php bloginfo( 'description' ); ?>"/>
						</a>
					</h1>
				</div>
				<div class="col-sm-4">
					<?php echo get_bsearch_form(); ?>
				</div>
			</div>
			<nav id="site-navigation" class="navbar navbar-default" role="navigation">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
					<div class="collapse navbar-collapse" id="columns-nav">
						<?php
							$defaults = array(
								'theme_location'  => 'primary',
								'container'       => false,
								'menu_class'      => 'nav navbar-nav',
								'depth' => '1'
							);
							wp_nav_menu( $defaults );

							?>
					</div>
					<!-- /.navbar-collapse -->
			</nav>
			<!-- #site-navigation -->
		</header>
		<!-- #masthead -->
		<div id="content" class="site-content">
