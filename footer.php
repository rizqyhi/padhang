<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Padhang
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php 
			wp_nav_menu( array(
				'theme_location'  => 'social',
				'container_class' => 'social-menu',
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => '',
				'depth'           => 1
			) ); 
		?>

		<div class="site-info">
			<div class="copyright">
				<?php do_action( 'padhang_footer' ); ?>
			</div><!--.copyright -->			

			<div class="powered">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'padhang' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'padhang' ), 'WordPress' ); ?></a>
				<span class="sep">&bull;</span> 
				<?php printf( __( 'Theme: %1$s by %2$s.', 'padhang' ), 'Padhang', '<a href="http://blog.hirizh.name/" rel="designer">Rizqy Hidayat</a>' ); ?>
			</div><!-- .powered -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<div class="overlay"></div>

<?php wp_footer(); ?>

</body>
</html>
