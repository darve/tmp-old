<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'db128318_tmp');

/** MySQL database username */
define('DB_USER', 'db128318_tmpuser');

/** MySQL database password */
define('DB_PASSWORD', 'F@3E_tqd6*f');

/** MySQL hostname */
define('DB_HOST', 'internal-db.s128318.gridserver.com');

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
define('AUTH_KEY',         'jEo6RiSvommB0sL0JFAMssg0yoXxxfjzXZ7vQPcefv3G58ALAVEtjjThVc1eclb9');define('SECURE_AUTH_KEY',  'iUXxfzmhI5e32T8zOy82TwoGdVc4pcpJtc4JsOMGYGtJMidmccTCrPtSzDvbLjS9');define('LOGGED_IN_KEY',    'Kk8cAL3M4lWjcloceVG10vVpkpaOzMCZaBkcYm8PDXA8SBpO8hlNx2viUyEQW2KW');define('NONCE_KEY',        '5562Dm4egEaWFL7mQBLKiL6IDFfKUA3SeWMQwz7eId4ALX34Lu1pXvdprAYj4xbu');define('AUTH_SALT',        'qvfMhyMtWY7qFsSeYpUHXQL58xBB9PUckhiny5EYpMLQyD22NPLBpAqv1dxwiKmv');define('SECURE_AUTH_SALT', 'It5uNZLMBfHR2UnvzKDsNxz5cEhBKiatcCqRCmdu2XNnWnNwtC3gU5izXmGJ8M37');define('LOGGED_IN_SALT',   'KoUACTqaHLKWKDQJL4J66J17eiUASSNNV1q0z7lGpI5McyM93Fva112rXkWd4HSn');define('NONCE_SALT',       'SZJ9WVd40NlBsNGsJGaAMSytRIAypH8SuuSrDmlutZN2sbkXfo6NRfoAdpHh69JR');/** * Other customizations. */define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');/** * Turn off automatic updates since these are managed upstream. */define('AUTOMATIC_UPDATER_DISABLED', true);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ioge_';

// define( 'WP_SITEURL',     'https://www.tmpmortgages.co.uk/' );
// define( 'WP_HOME',        'https://www.tmpmortgages.co.uk' );

define( 'WP_SITEURL', 'https://www.tmpmortgages.co.uk/');
define( 'WP_HOME', 'https://www.tmpmortgages.co.uk');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
