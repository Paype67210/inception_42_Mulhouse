<?php
// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */

define( 'DB_NAME', getenv('SQL_DATABASE') );
define( 'DB_USER', getenv('SQL_USER') );
define( 'DB_PASSWORD', getenv('SQL_PASSWORD') );
define( 'DB_HOST', getenv('DBHOST') );
define( 'WP_HOME', getenv('WP_FULL_URL') );
define( 'WP_SITEURL', getenv('WP_FULL_URL') );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/* Redis */
define('WP_CACHE', true);
define('WP_REDIS_HOST', 'redis');
define('WP_REDIS_PORT', 6379);
define('WP_REDIS_DATABASE', 0);  // Base Redis utilisée
define('WP_REDIS_TIMEOUT', 1.0); // Timeout pour éviter les longues attentes
define('WP_REDIS_READ_TIMEOUT', 1.0);

/* ftp-server */
define('FS_METHOD', 'ftpext');
define('FTP_BASE', '/var/www/html/wordpress');
define('FTP_USER', 'ftpuser');
define('FTP_PASS', 'ftp_password');
define('FTP_HOST', 'ftp');
define('FTP_SSL', false);

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '' );
define( 'SECURE_AUTH_KEY',  '' );
define( 'LOGGED_IN_KEY',    '' );
define( 'NONCE_KEY',        '' );
define( 'AUTH_SALT',        '' );
define( 'SECURE_AUTH_SALT', '' );
define( 'LOGGED_IN_SALT',   '' );
define( 'NONCE_SALT',       '' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
define('WP_LOG_FILE', '/var/log/wordpress/debug.log');

if (defined('WP_DEBUG') && WP_DEBUG) {
    if (!file_exists(dirname(WP_LOG_FILE))) {
        mkdir(dirname(WP_LOG_FILE), 0755, true);
    }
}

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';