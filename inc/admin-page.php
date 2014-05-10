<?php
/**
 * Padhang admin page
 *
 * @package Padhang
 * @since 1.0.3
 */
 
/**
 * Display the admin menu
 */
function padhang_admin_menu(){
	$padhang_page = add_theme_page(__('Padhang Theme', 'padhang'), __('Padhang Theme', 'padhang'), 'switch_themes', 'padhang', 'padhang_admin_page_render');

	add_action('admin_head-' . $padhang_page, 'padhang_admin_page_style' );
}
add_action('admin_menu', 'padhang_admin_menu');

/**
 * Render the admin page
 */
function padhang_admin_page_render(){
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'description';
?>
	<div class="wrap">
		<h2>Padhang WordPress Theme</h2>
		<h2 class="nav-tab-wrapper">
			<a href="<?php echo add_query_arg('tab', 'description'); ?>" class="nav-tab <?php echo $active_tab == 'description' ? 'nav-tab-active' : ''; ?>"><?php _e('Description', 'padhang'); ?></a>
			<a href="<?php echo add_query_arg('tab', 'docs'); ?>" class="nav-tab <?php echo $active_tab == 'docs' ? 'nav-tab-active' : ''; ?>"><?php _e('Documentations', 'padhang'); ?></a>
			<a href="<?php echo add_query_arg('tab', 'changelog'); ?>" class="nav-tab <?php echo $active_tab == 'changelog' ? 'nav-tab-active' : ''; ?>"><?php _e('Changelog', 'padhang'); ?></a>
		</h2>
			
		<div id="tab_container" class="metabox-holder">
			<div class="postbox">
			<?php if( $active_tab == 'description' ) : ?>
			<div class="section">
				<p><?php _e( 'A minimalist-content-focused theme. It comes with responsive layout, 2 widget areas under the main content, social menu, big background image, custom logo and custom menu. FYI, Padhang is a Javanesse word for bright. It featured bright white color with dark background. It also easily customized via the theme customizer. Stand out your content.', 'padhang' );?></p>

				<h3><?php _e( 'Features', 'padhang' ); ?></h3>
				<ul>
				<li><?php _e( 'Minimalist-content-focused design', 'padhang' ); ?></li>
				<li><?php _e( 'Responsive layout', 'padhang' ); ?></li>
				<li><?php _e( 'Custom header', 'padhang' ); ?></li>
				<li><?php _e( 'Custom background', 'padhang' ); ?></li>
				<li><?php _e( 'Custom color via theme customizer', 'padhang' ); ?></li>
				<li><?php _e( 'Custom menu', 'padhang' ); ?></li>
				<li><?php _e( 'Social menu', 'padhang' ); ?></li>
				<li><?php _e( '2 widget areas', 'padhang' ); ?></li>
				<li><?php _e( 'Translation-ready', 'padhang' ); ?></li>
				</ul>

				<h3><?php _e( 'Support and Contribute', 'padhang' ); ?></h3>
				<ul>
				<li><?php printf( __( 'Any problems? Go to <a href="%1$s">theme support forum</a>', 'padhang' ), 'https://wordpress.org/support/theme/padhang/' ); ?></li>
				<li><?php printf( __( 'Or you can also <a href="%1$s">open new issue on Github</a>', 'padhang' ), 'https://github.com/rizqyhi/padhang/issues/new/' ); ?></li>
				<li><?php printf( __( 'And thank you if you <a href="%1$s">rate or review Padhang</a>', 'padhang' ), 'https://wordpress.org/support/view/theme-reviews/padhang/' ); ?></li>
				<li><?php printf( __( 'Check out the <a href="%1$s">Github repo</a> to contribute', 'padhang' ), 'https://github.com/rizqyhi/padhang/' ); ?></li>
				</ul>

				<h3><?php _e( 'Resources', 'padhang' ); ?></h3>
				<ul>
				<li><a href="http://genericons.com">Genericons</a>, <i>GPL2</i></li>
				<li><a href="http://srobbin.com/jquery-plugins/backstretch/">Backstretch</a>, <i>MIT</i></li>
				<li><a href="http://unsplash.com">Unsplash</a>, <i>CC0</i></li>
				</ul>
			</div>

			<?php elseif( $active_tab == 'docs' ) : ?>
				
			<div class="section">
				<h3><?php _e('Customizing', 'padhang'); ?></h3>
				<p><?php printf( __('Padhang is fully customized via <a href="%1$s">theme customizer</a>, change the colors, background image and transparency, wrapper width, footer text, and others. You can also <a href="%2$s">upload your logo</a> and your <a href="%3$s">custom background image</a>.', 'padhang'), admin_url('customize.php'), admin_url('themes.php?page=custom-header'), admin_url('themes.php?page=custom-background') ); ?></p>

				<h3>Social Links</h3>
				<p><?php printf( __('To set the social links, go to <a href="%1$s">Appearance &rarr; Menus</a>, create a new menu, and choose <b>Social Menu</b> as the theme location. You can start to add your social links and the icon will automatically rendered based on its domain name.', 'padhang'), admin_url('nav-menus.php')); ?></p>
			</div>

			<?php elseif( $active_tab == 'changelog' ) : ?>
			<div class="section">
<h4>1.0.3 - May 10, 2014</h4>
<pre>
- Fix text footer not live changed on customizer
- Add wrapper width option
- Add more social icons
- Add theme page for info, documentations, and changelog
- Better navigation on small device
</pre>

<h4>1.0.2 - April 06, 2014</h4>
<pre>
- Fix widget doesn't load if only one area is active
- Fix icon for multi-level menu
- Move list comment callback to inc/extras.php
- Change author URI
- Add footer text option in customizer
- Add social menu
</pre>

<h4>1.0.1 - March 27, 2014</h4>
<pre>
- Add sanitation and escape function for customizer
- Add copyright information
</pre>

<h4>1.0 - March 25, 2014</h4>
<pre>
- Initial release
</pre>
			</div>
				
			<?php endif; ?>
		</div>
		</div><!--end #tab_container-->		
	</div>
				
<?php 
}

/**
 * Style for the admin page
 */
function padhang_admin_page_style(){
	?>
	<style type="text/css">
		#tab_container h3 {
			padding-left: 0;
			border-bottom: 1px solid #ddd;
		}
		#tab_container p {
			margin-bottom:0;
			padding-bottom:10px;
			line-height: 1.9
		}
		#tab_container ul {
			padding-left: 20px;
			list-style-type: circle;
			line-height: 1.7
		}
		#tab_container pre {
			padding: 10px;
			background: #f1f1f1;
		}
		#tab_container .section {
			padding:10px 20px;
		}
	</style>
	<?php
}
