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
 * Display notice informing the major update for Padhang
 * at version > 1.0.3
 */
function padhang_major_update_notice() {
	global $pagenow;

	$padhang = wp_get_theme();

	if ( $pagenow == 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] == 'padhang' && version_compare( $padhang->get( 'Version' ), '1.0.3', '>' ) ) {
		?>

		<div class="update-nag">
			<h4><?php _e( 'Hey, Padhang just got some major update!', 'padhang' ); ?></h4>
			<p><?php _e( "In this new version, I've made some (big) changes. Here some of them:", 'padhang' ); ?></p>
			<ul>
				<li><?php _e( 'Custom header support is removed and please welcome the new logo and favicon uploader. Try it from customizer.', 'padhang' ); ?></li>
				<li><?php _e( 'Background is now unstretched by default and freedom to control it from background options. But if you want the old stretched, you can activate it from the customizer.', 'padhang' ); ?></li>
				<li><?php _e( 'Social menu now works just fine.', 'padhang' ); ?></li>
				<li><?php _e( 'Some new styles for navigation, form elements, blockquote, etc. Also a brand new mobile menu.', 'padhang' ); ?></li>
				<li><a href="<?php echo add_query_arg('tab', 'changelog'); ?>"><?php _e( 'See all changes &rarr;', 'padhang' ); ?></a></li>
			</ul>
			<p><strong><?php _e( "I say sorry if you just updated Padhang and some of your change broken and have to reconfigure it. But I'm sure you'll love this update too. :)", 'padhang' ); ?></strong></p>
		</div>

		<?php
	}
}
add_action( 'admin_notices', 'padhang_major_update_notice' );


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
			<a href="<?php echo add_query_arg('tab', 'faq'); ?>" class="nav-tab <?php echo $active_tab == 'faq' ? 'nav-tab-active' : ''; ?>"><?php _e('F.A.Q', 'padhang'); ?></a>
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
				<li><a href="http://slicknav.com/">Slicknav</a>, <i>MIT</i></li>
				<li><a href="http://unsplash.com">Unsplash</a>, <i>CC0</i></li>
				</ul>
			</div>

			<?php elseif( $active_tab == 'faq' ) : ?>
				
			<div class="section">
				<h3><?php _e('How do I customize this theme?', 'padhang'); ?></h3>
				<p><?php printf( __( 'Padhang is fully customized via theme customizer, change the colors, background image, overlay, wrapper width, footer text, and others. You can also upload your logo and favicon. <a href="%s">Go to theme customizer</a>.', 'padhang' ), admin_url( 'customize.php' ) ); ?></p>

				<h3>Social Links</h3>
				<p><?php printf( __( 'To set the social links, go to <a href="%s">Appearance &rarr; Menus</a>, create a new menu, and choose <b>Social Menu</b> as the theme location. You can start to add your social links and the icon will automatically rendered based on its domain name.', 'padhang' ), admin_url( 'nav-menus.php' ) ); ?></p>
			</div>

			<?php elseif( $active_tab == 'changelog' ) : ?>
			<div class="section">
<h4>1.1.0 - August 17, 2014</h4>
<pre>
- New default fonts: Roboto and Roboto Slab
- New styles for navigation, form elements, blockquote
- New mobile navigation using slicknav.js
- New logo and favicon uploader
- New options to show/hide site title and tagline
- New options to revert back to old Open Sans font
- New options to change site title and tagline color
- New option to make the background image stretched
- Add support for post format: audio, chat, gallery, status
- Add support for editor style
- Background image is now controllable from background options
- Remove custom header support
- Fix social menu not showing icons
- Fix post meta for updated date
</pre>

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
		.update-nag ul {
			margin-left: 15px;
			font-size: 13px;
			list-style-type: disc;
		}
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
			line-height: 1.6
		}
		#tab_container .section {
			padding:10px 20px;
		}
	</style>
	<?php
}
