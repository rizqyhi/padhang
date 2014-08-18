<?php
/**
 * Custom controls for customizer
 *
 * @package Padhang
 */

if ( ! class_exists( 'Padhang_Customize_Textarea_Control' ) ) :
/**
 * Class Padhang_Customize_Textarea_Control
 *
 * Custom textarea control for customizer
 *
 * @since 1.0.0
 */
class Padhang_Customize_Textarea_Control extends WP_Customize_Control {
	public $type = 'textarea';
	
	public function render_content() {
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>
		<?php 
	}
}
endif;

if ( ! class_exists( 'Padhang_Customize_Image_Control' ) ) :
/**
 * Padhang Customize Image Class
 *
 * Extend WP_Customize_Image_Control allowing access to uploads made within
 * the same context
 *
 * source: https://gist.github.com/eduardozulian/4739075
 */
class Padhang_Customize_Image_Control extends WP_Customize_Image_Control {
	/**
	 * Constructor.
	 *
	 * @since 3.4.0
	 * @uses WP_Customize_Image_Control::__construct()
	 *
	 * @param WP_Customize_Manager $manager
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
	}
	
	/**
	 * Search for images within the defined context
	 */
	public function tab_uploaded() {
		$my_context_uploads = get_posts( array(
		    'post_type'  => 'attachment',
		    'meta_key'   => '_wp_attachment_context',
		    'meta_value' => $this->context,
		    'orderby'    => 'post_date',
		    'nopaging'   => true,
		) );
		?>
	
		<div class="uploaded-target"></div>
		
		<?php
		if ( empty( $my_context_uploads ) )
		    return;
		
		foreach ( (array) $my_context_uploads as $my_context_upload ) {
		    $this->print_tab_image( esc_url_raw( $my_context_upload->guid ) );
		}
	}
}
endif;

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Padhang_Customize_Misc_Control' ) ) :
/**
 * Class Padhang_Customize_Misc_Control
 *
 * Control for adding arbitrary HTML to a Customizer section.
 * 
 * Taken from "Make" theme by The Theme Foundry.
 * http://wordpress.org/themes/make
 *
 * @since 1.0.0.
 */
class Padhang_Customize_Misc_Control extends WP_Customize_Control {
	/**
	 * The current setting name.
	 *
	 * @since 1.0.0.
	 *
	 * @var   string    The current setting name.
	 */
	public $settings = 'blogname';

	/**
	 * The current setting description.
	 *
	 * @since 1.0.0.
	 *
	 * @var   string    The current setting description.
	 */
	public $description = '';

	/**
	 * The current setting group.
	 *
	 * @since 1.0.0.
	 *
	 * @var   string    The current setting group.
	 */
	public $group = '';

	public function render_content() {
		switch ( $this->type ) {
			default:
			case 'text' :
				echo '<p class="description">' . $this->description . '</p>';
				break;

			case 'heading':
				echo '<span class="customize-control-title">' . $this->label . '</span>';
				break;

			case 'line' :
				echo '<hr />';
				break;
		}
	}
}
endif;