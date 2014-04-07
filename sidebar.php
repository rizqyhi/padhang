<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Padhang
 */

	if ( ! is_active_sidebar( 'left-widget-area'  ) && ! is_active_sidebar( 'right-widget-area' ) )
		return;
?>

	<div id="secondary" class="widget-area" role="complementary">
		
		<?php if ( is_active_sidebar( 'left-widget-area' ) ) : ?>
			<div class="left-widget-area">
				<?php dynamic_sidebar( 'left-widget-area' ); ?>
			</div><!-- .left-widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'right-widget-area' ) ) : ?>
			<div class="right-widget-area">
				<?php dynamic_sidebar( 'right-widget-area' ); ?>
			</div><!-- .left-widget-area -->
		<?php endif; ?>

	</div><!-- #secondary -->
