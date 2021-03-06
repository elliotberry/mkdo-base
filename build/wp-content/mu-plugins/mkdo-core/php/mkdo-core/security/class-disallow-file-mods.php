<?php
/**
 * Disallow file mods.
 *
 * @since 1.0.0
 *
 * @package MKDO_Core
 */

namespace MKDO_Core;

/**
 * Disallow file mods.
 */
class Disallow_File_Mods {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

	}

	/**
	 * Go.
	 *
	 * @since 1.0.0
	 */
	public function run() {
		add_filter( 'plugins_loaded', array( $this, 'disallow_file_mods' ), 10 );
	}

	/**
	 * Function to decide whether or not to disable file mods.
	 */
	public function disallow_file_mods() {
		// Disable Plugin and Theme Update and Installation.
		// Unless our domain ends in .local (development environment).
		if ( 'test' !== MKDO_CORE_TLD && ! defined( 'DISALLOW_FILE_MODS' ) ) {
			// Get current user and store all possible MakeDo variations to check against.
			$current_user    = wp_get_current_user();
			$potential_users = array(
				'mkdo',
				'makedo',
				'mk_do',
				'make_do',
			);

			// If we have a user.
			if ( ! empty( $current_user ) ) {
				// Store username, email and create a variable to house our true/false check.
				$current_username   = $current_user->user_login;
				$current_user_email = $current_user->user_email;
				$email_pass         = false;

				// For every potential user.
				foreach ( $potential_users as $potential_user ) {
					// Check that the users email doesn't contain any of the potential MakeDo values.
					if ( strpos( $current_user_email, $potential_user ) !== false ) {
						// If true set our email flag to true and break the loop.
						// We only need one instance to flag true.
						$email_pass = true;
						break;
					}
				}

				// If the username doesn't contain any potential MakeDo values
				// AND
				// the users email doesn't contain any of the potential MakeDo values.
				if ( true !== in_array( $current_username, $potential_users, true ) && true !== $email_pass ) {
					define( 'DISALLOW_FILE_MODS', true ); // @codingStandardsIgnoreLine
				}
			} else {
				define( 'DISALLOW_FILE_MODS', true ); // @codingStandardsIgnoreLine
			}
		}
	}
}

$mkdo_core_disallow_mods = new Disallow_File_Mods();

$mkdo_core_disallow_mods->run();
