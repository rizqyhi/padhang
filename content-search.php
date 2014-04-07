<?php
/**
 * @package Padhang
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
		
	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php padhang_posted_on(); ?>
		</div><!-- .entry-meta -->
	<?php endif; ?>

</article><!-- #post-## -->
