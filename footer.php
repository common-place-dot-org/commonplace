<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package commonplace
 */
?>
</div>
<!-- #content -->


<footer class="site-footer">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<?php
					// Only display the footer if a menu of "Footer" exists in the site. 
					if (wp_get_nav_menu_object('Footer')){
						$defaults = array(
							'menu'			=> 'Footer',
							'container'       => false,
							'items_wrap'      => '%3$s',
							'depth'			=> 1,
							'fallback_cb'		=> false
						);
						wp_nav_menu( $defaults );
					}
					?>
				</ul>
			</div>
		</div>
	</nav>
	<ul id="footer-list">
		<li><span id="copyright">&copy; <?php echo date("Y"); ?> Common-place.</span> <span id="issn">ISSN 1544-824X</span></li>
		<li><a href="<?php echo site_url(); ?>/wp-admin/">Editor Login</a></li>
		<?php
		// Only display the footer if a menu of "Footer" exists in the site. 
		if (wp_get_nav_menu_object('SubFooter')){
			$defaults = array(
				'menu'			=> 'SubFooter',
				'container'       => false,
				'items_wrap'      => '%3$s',
				'depth'			=> 1,
				'fallback_cb'		=> false
			);
			wp_nav_menu( $defaults );
		}
		?>
	</ul>
</footer>
</div>
<!-- #page -->
<?php wp_footer(); ?>
</body></html>