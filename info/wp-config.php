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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u804441525_ymegy');

/** MySQL database username */
define('DB_USER', 'u804441525_yxywe');

/** MySQL database password */
define('DB_PASSWORD', 'eqyXudytet');

/** MySQL hostname */
define('DB_HOST', 'mysql');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'LsKYLOiWfJTrdkLqgmlY924qDGkRywsR2J4007SIt2k2jNI9Wct5xRd7Fof6ofUE');
define('SECURE_AUTH_KEY',  '9Io0FSVnnrjvk9LKLRRmHJCBG2jXtEagGNjFh0mQ8KpREmedT2Nm4sPbBqVpiBfG');
define('LOGGED_IN_KEY',    'y3crGY50l3JCHhjZp0JAbD3JkSKvSBWK5KMxpxVlMNNbltJGvnXqLF9IT94L6aIe');
define('NONCE_KEY',        'xxsjeIhFG9tRCRjtiGTUIFB7QJkcBflRAsCPeKQ0U8LGqJIuioH1AD3896cuMEi8');
define('AUTH_SALT',        '3mLLyJdWcqstbKldUuepRXigaM1G7n891tEsoH3aX92y2wkuotbvHSvuNnonayY3');
define('SECURE_AUTH_SALT', 'VRkh8veo5SKVSjm8WXrTABNVyR9MFNgHOlTArQTDMAb4MfDtZ17boQGbQm2GBEw1');
define('LOGGED_IN_SALT',   'FMcivKUczCIKw5eOsPZczVQpec0ZciBImIxIKjNWot0M1yBQ31OSkjGNDGDou0eB');
define('NONCE_SALT',       'amCGLM35zr8g5u7tsI1uYiiluxue7VUqRIxBWbpnWmaNfPXr6ES6Q1kAb3M3l1ps');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'qgv4_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
