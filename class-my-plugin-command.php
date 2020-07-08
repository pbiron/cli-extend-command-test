<?php

namespace SHC;

use WP_CLI;

defined( 'ABSPATH' ) || die;

/**
 * Extend the "wp plugin install" command to demonstrate that extending an existing command
 * stopped working in WP-CLI 2.2.0 (and still doesn't work as of 2.4.0).
 */
class My_Plugin_Command extends \Plugin_Command {
	/**
	 * Installs one or more plugins.
	 *
	 * ## OPTIONS
	 *
	 * <plugin|zip|url>...
	 * : One or more plugins to install. Accepts a plugin slug, the path to a local zip file, or a URL to a remote zip file.
	 *
	 * [--my-flag]
	 * : If set, will echo that the flag was set and then return.  This is just to test whether wp-cli is finding this extension of the "wp plugin install" command.
	 *
	 * [--version=<version>]
	 * : If set, get that particular version from wordpress.org, instead of the
	 * stable version.
	 *
	 * [--force]
	 * : If set, the command will overwrite any installed version of the plugin, without prompting
	 * for confirmation.
	 *
	 * [--activate]
	 * : If set, the plugin will be activated immediately after install.
	 *
	 * [--activate-network]
	 * : If set, the plugin will be network activated immediately after install
	 *
	 * ## EXAMPLES
	 *
	 *     # Test whether wp-cli correctly recognized this extension of "wp plugin install"
	 *     $ wp plugin install foo --my-flag
	 *     Success: --my-flag recognized.
	 *
	 *     # Install the latest version from wordpress.org and activate
	 *     $ wp plugin install bbpress --activate
	 *     Installing bbPress (2.5.9)
	 *     Downloading install package from https://downloads.wordpress.org/plugin/bbpress.2.5.9.zip...
	 *     Using cached file '/home/vagrant/.wp-cli/cache/plugin/bbpress-2.5.9.zip'...
	 *     Unpacking the package...
	 *     Installing the plugin...
	 *     Plugin installed successfully.
	 *     Activating 'bbpress'...
	 *     Plugin 'bbpress' activated.
	 *     Success: Installed 1 of 1 plugins.
	 *
	 *     # Install the development version from wordpress.org
	 *     $ wp plugin install bbpress --version=dev
	 *     Installing bbPress (Development Version)
	 *     Downloading install package from https://downloads.wordpress.org/plugin/bbpress.zip...
	 *     Unpacking the package...
	 *     Installing the plugin...
	 *     Plugin installed successfully.
	 *     Success: Installed 1 of 1 plugins.
	 *
	 *     # Install from a local zip file
	 *     $ wp plugin install ../my-plugin.zip
	 *     Unpacking the package...
	 *     Installing the plugin...
	 *     Plugin installed successfully.
	 *     Success: Installed 1 of 1 plugins.
	 *
	 *     # Install from a remote zip file
	 *     $ wp plugin install http://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef
	 *     Downloading install package from http://s3.amazonaws.com/bucketname/my-plugin.zip?AWSAccessKeyId=123&Expires=456&Signature=abcdef
	 *     Unpacking the package...
	 *     Installing the plugin...
	 *     Plugin installed successfully.
	 *     Success: Installed 1 of 1 plugins.
	 *
	 *     # Update from a remote zip file
	 *     $ wp plugin install https://github.com/envato/wp-envato-market/archive/master.zip --force
	 *     Downloading install package from https://github.com/envato/wp-envato-market/archive/master.zip
	 *     Unpacking the package...
	 *     Installing the plugin...
	 *     Renamed Github-based project from 'wp-envato-market-master' to 'wp-envato-market'.
	 *     Plugin updated successfully
	 *     Success: Installed 1 of 1 plugins.
	 *
	 *     # Forcefully re-install all installed plugins
	 *     $ wp plugin install $(wp plugin list --field=name) --force
	 *     Installing Akismet (3.1.11)
	 *     Downloading install package from https://downloads.wordpress.org/plugin/akismet.3.1.11.zip...
	 *     Unpacking the package...
	 *     Installing the plugin...
	 *     Removing the old version of the plugin...
	 *     Plugin updated successfully
	 *     Success: Installed 1 of 1 plugins.
	 */
	public function install( $args, $assoc_args = array() ) {
		$my_flag = \WP_CLI\Utils\get_flag_value( $assoc_args, 'my-flag' );

		if ( $my_flag ) {
			WP_CLI::success( '--my-flag recognized.' );

			return;
		}

		parent::install( $args, $assoc_args );
	}
}
