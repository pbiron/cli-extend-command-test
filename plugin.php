<?php

/**
 * Plugin Name: WP-CLI test
 * Description: Test extending existing command
 * Version: 0.1.0
 * Author: Paul V. Biron/Sparrow Hawk Computing
 * Author URI: https://sparrowhawkcomputing.com
 * Plugin URI: https://github.com/pbiron/cli-extend-command-test
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * In WP-CLI 2.1.0, it was possible to create a command that extended an existing
 * command (e.g., added an $assoc_arg).  That stopped working in 2.2.0 :-(
 *
 * See https://github.com/wp-cli/wp-cli/issues/5274.
 *
 * This plugin adds such an extension to "wp plugin install" to demonstrate the problem.
 *
 * When run with WP-CLI 2.1.0 (or with the "Possible Solution" solution in the above
 * issue applied to WP-CLI 2.2.0+), you will see the following:
 *
 * $ wp plugin install foo --my-flag
 * Success: --my-flag recognized.
 *
 * When run with WP-CLI 2.2.0+, you will see the following:
 *
 * $ wp plugin install foo --my-flag
 * Error: Parameter errors:
 *  unknown --my-flag parameter
 */

namespace SHC;

use WP_CLI;

/**
 * Register our extension of "wp plugin install".
 */
add_action(
	'cli_init',
	function() {
		require __DIR__ . '/class-my-plugin-command.php';

		WP_CLI::add_command( 'plugin', __NAMESPACE__ . '\My_Plugin_Command' );
	}
);
