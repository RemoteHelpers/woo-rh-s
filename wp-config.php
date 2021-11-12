<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'new_wordpress');

/** MySQL database username */
define('DB_USER', 'new');

/** MySQL database password */
define('DB_PASSWORD', '11235813213455-2021');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define('AUTH_KEY', 'SGaYSpba3l8O7StCgevPPmplcGM7DtRASi62OE3fvExlbjBTZmViQM5yfRtpohdW');
define('SECURE_AUTH_KEY', 'UyHAFaehbyxYKFgCBFY35B6a2xVIWVKhV79cewe5aGbql8zfoBS5kWZPHfu7oIF7');
define('LOGGED_IN_KEY', 'CQQIQWyeod6ZTSCZeFhp11mxMcLT9Q1JJdU01JYrPMBgSMJzp7ksDq3TJcPiSSHO');
define('NONCE_KEY', 'BUMBDXV8GW9qeeetJW1JMNXfXrVdnnSWXNzXWPG4hZnQipVdjBBmvIzDDKcaOoGd');
define('AUTH_SALT', 'N4pQsGz3UbCivmO6C14Mxa7OQAPlWYhKIJy7zy2SrfXncJRScnRnE1BNCDm4Hvad');
define('SECURE_AUTH_SALT', 'fkvLRcNaSyIw7lNXKbGnUagDg8k5GeSiBUPeqWKFEhxi4b1GF4ntfFYHAE2k2uSk');
define('LOGGED_IN_SALT', 'qk53GP3eQrPj9wuV7P2RFy9buKKGm51DZLmSfBRldQXklhOOzo71TDt5i3W5RsV8');
define('NONCE_SALT', 'rv0Cp1fk8RD2vxhSLRPNHZbuzh1xw2aHs6S5u7Y8ec7ZKm0aapvfCpehFt7EFghJ');

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
define('WP_MEMORY_LIMIT', '2000M');

/* Add any custom values between this line and the "stop editing" line. */

define('WP_CACHE', false);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
