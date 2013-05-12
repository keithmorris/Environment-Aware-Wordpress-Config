<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// Define Environments - may be a string or array of options for an environment
$environments = array(
	'local'       => array('.local', 'local.example.com'),
	'development' => array('dev.example.com', 'dev.', '.dev'),
	'staging'     => 'stage.example.com',
);

// Get Server name
$server_name = $_SERVER['SERVER_NAME'];

foreach ( $environments AS $key => $env )
{
	if ( is_array( $env ) )
	{
		foreach ( $env as $option )
		{
			if ( stristr( $server_name, $option ) )
			{
				define('ENVIRONMENT', $key);
				break 2;
			}
		}
	}
	else
	{
		if ( strstr( $server_name, $env ) )
		{
			define('ENVIRONMENT', $key);
			break;
		}
	}
}

// If no environment is set default to production
defined( 'ENVIRONMENT' ) OR define('ENVIRONMENT', 'production');

// Load environment-specific config if it exists
if ( file_exists( dirname( __FILE__ ) . '/wp-config-'.ENVIRONMENT.'.php' ) )
{
	include(dirname( __FILE__ ) . '/wp-config-'.ENVIRONMENT.'.php');
}

// Now define any default values that will be used in all environments that have not defined them.

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
defined('DB_NAME') 		OR define('DB_NAME', 'database_name_here');

/** MySQL database username */
defined('DB_USER') 		OR define('DB_USER', 'username_here');

/** MySQL database password */
defined('DB_PASSWORD')	OR define('DB_PASSWORD', 'password_here');

/** MySQL hostname */
defined('DB_HOST') 		OR define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
defined('DB_CHARSET') 	OR define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
defined('DB_COLLATE') 	OR define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
defined('AUTH_KEY') 		OR define('AUTH_KEY',         'put your unique phrase here');
defined('SECURE_AUTH_KEY') 	OR define('SECURE_AUTH_KEY',  'put your unique phrase here');
defined('LOGGED_IN_KEY') 	OR define('LOGGED_IN_KEY',    'put your unique phrase here');
defined('NONCE_KEY') 		OR define('NONCE_KEY',        'put your unique phrase here');
defined('AUTH_SALT') 		OR define('AUTH_SALT',        'put your unique phrase here');
defined('SECURE_AUTH_SALT')	OR define('SECURE_AUTH_SALT', 'put your unique phrase here');
defined('LOGGED_IN_SALT')	OR define('LOGGED_IN_SALT',   'put your unique phrase here');
defined('NONCE_SALT') 		OR define('NONCE_SALT',       'put your unique phrase here');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
defined('WPLANG') OR define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
defined('WP_DEBUG') OR define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
