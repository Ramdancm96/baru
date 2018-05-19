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
define('DB_NAME', 'u804441525_unupy');

/** MySQL database username */
define('DB_USER', 'u804441525_ydezy');

/** MySQL database password */
define('DB_PASSWORD', 'ySuXyvunap');

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
define('AUTH_KEY',         'FDz3T2W1kjKETy0JPnffclik0mLzf6B2WMRDcTse7PUhAGauLIzv7u18rpN2P7pp');
define('SECURE_AUTH_KEY',  'tlKucNPjxhZs1YRStHW3i3dkf9FoyuHaIqlMs8sZ6dfnFEwkrOkhk13H2Hab1WWp');
define('LOGGED_IN_KEY',    'uVHXgXvZ27A5LD7G5A8nZhkaTXagF7CbXCRLwtRzz5LHRO8k1FDGUSiQNi4YkvKF');
define('NONCE_KEY',        'muF8TWED1ZY6wdyz3fLrXTBHYMYhUIWXwtiS7YcMGucwQ3ZG5DYDSil3GfPThGVB');
define('AUTH_SALT',        '6AS2qssVFlbQo257Ata2oWNW1n50qOzKaHYOsqaq37ntCIbccHY3AY5lWJuQdsJM');
define('SECURE_AUTH_SALT', 'BndYzpn2mbPx3q6kCwW4OMvKafjnJOqx4V5pW5BlUrZf7eDOwRYjPgSzmbPYxClc');
define('LOGGED_IN_SALT',   'LBpKwkNeQK9K1UHYYWRud03bc2YEHdWDwFbjuTmoWF1SqzbLAgM3uw4Mwv1kiDHm');
define('NONCE_SALT',       'GdhA6AHkkNwJEFgfXX6VBlXbJDSGWAXltdq8wJLvT310CXUjEvbDv64ThYqSUOz2');

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
$table_prefix  = 'v34k_';

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
