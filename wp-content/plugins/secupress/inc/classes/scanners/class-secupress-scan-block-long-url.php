<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Long URL scan class.
 *
 * @package SecuPress
 * @subpackage SecuPress_Scan
 * @since 1.0
 */
class SecuPress_Scan_Block_Long_URL extends SecuPress_Scan implements SecuPress_Scan_Interface {

	/** Constants. ============================================================================== */

	/**
	 * Class version.
	 *
	 * @var (string)
	 */
	const VERSION = '1.0.1';


	/** Properties. ============================================================================= */

	/**
	 * The reference to the *Singleton* instance of this class.
	 *
	 * @var (object)
	 */
	protected static $_instance;

	/**
	 * Maximum uri length.
	 *
	 * @var (int)
	 */
	public $length;


	/** Init and messages. ====================================================================== */

	/**
	 * Init.
	 *
	 * @since 1.0
	 */
	protected function init() {
		/** This filter is documented in inc/modules/firewall/plugins/bad-url-length.php */
		$this->length   = apply_filters( 'secupress.plugin.bad-url-length.len', 300 );
		$this->title    = sprintf( __( 'Check if long URL can access your website (more than %s chars).', 'secupress' ), number_format_i18n( $this->length ) );
		$this->more     = sprintf( __( 'An typical URL has no more than %s characters, but attackers often need to test very long strings when they try to hack something.', 'secupress' ), number_format_i18n( $this->length ) );
		$this->more_fix = sprintf(
			__( 'Activate the option %1$s in the %2$s module.', 'secupress' ),
			'<em>' . __( 'Block Long URLs', 'secupress' ) . '</em>',
			'<a href="' . esc_url( secupress_admin_url( 'modules', 'firewall' ) ) . '#row-bbq-url-content_bad-url-length">' . __( 'Firewall', 'secupress' ) . '</a>'
		);
	}


	/**
	 * Get messages.
	 *
	 * @since 1.0
	 *
	 * @param (int) $message_id A message ID.
	 *
	 * @return (string|array) A message if a message ID is provided. An array containing all messages otherwise.
	 */
	public static function get_messages( $message_id = null ) {
		$messages = array(
			// "good"
			0   => __( 'You are currently blocking <strong>excessively long string requests</strong>.', 'secupress' ),
			1   => __( 'Protection activated', 'secupress' ),
			// "warning"
			100 => __( 'Unable to determine if your website is blocking <strong>excessively long string requests</strong>.', 'secupress' ),
			// "bad"
			200 => __( 'Your website should block <strong>excessively long string requests</strong>.', 'secupress' ),
		);

		if ( isset( $message_id ) ) {
			return isset( $messages[ $message_id ] ) ? $messages[ $message_id ] : __( 'Unknown message', 'secupress' );
		}

		return $messages;
	}


	/** Scan. =================================================================================== */

	/**
	 * Scan for flaw(s).
	 *
	 * @since 1.0
	 *
	 * @return (array) The scan results.
	 */
	public function scan() {
		$response = wp_remote_get( add_query_arg( secupress_generate_key( 6 ), wp_generate_password( $this->length, false ), user_trailingslashit( home_url() ) ), $this->get_default_request_args() );

		if ( ! is_wp_error( $response ) ) {

			if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
				// "bad"
				$this->add_message( 200 );
			} else {
				// "good"
				$this->add_message( 0 );
			}
		} else {
			// "warning"
			$this->add_message( 100 );
		}

		return parent::scan();
	}


	/** Fix. ==================================================================================== */

	/**
	 * Try to fix the flaw(s).
	 *
	 * @since 1.0
	 *
	 * @return (array) The fix results.
	 */
	public function fix() {
		// Activate.
		secupress_activate_submodule( 'firewall', 'bad-url-length' );

		// "good"
		$this->add_fix_message( 1 );

		return parent::fix();
	}
}
