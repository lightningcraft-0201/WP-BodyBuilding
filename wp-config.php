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
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'bodybuilding' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         ';/+/zO&GDwfHkV=9jC`_;PetJ4j0VZSvX.4njIT0QF,j@8?Q{MF4q~?T$QYeIm ?' );
define( 'SECURE_AUTH_KEY',  'K9^&.<=V}0!}{,36z$GpO&}!DET_8]|~OIjE0OI(Vh*]fvhppa. o ^Bx mRl@58' );
define( 'LOGGED_IN_KEY',    '8Qo)7rvu;D6Bck4fmNzw8LfWKu|b70;$;;@m2bXoi8aXpCEMbsJdZrK}@aaqxP/^' );
define( 'NONCE_KEY',        'n%_l^tqsu>,z/;V>,#Gisl__K6ym]Jk~MDP3(^;_|WQMvcJTLeNTHbH:Lk@NoW1L' );
define( 'AUTH_SALT',        '7<hFx aN^(+4~RcinmfN$rZ::.V1H4fUQB}V.R{j`3)l9S_%i*G0Xw/)98WQzJZ3' );
define( 'SECURE_AUTH_SALT', '+:RZG<,lvMs:q&7UxvjqSub^}M6bJLE;nlu;s}u_QV1w0)_m{>npAKkO!&v$B`P}' );
define( 'LOGGED_IN_SALT',   'ct.GBBsdIaZ5E=A,/l3h8bBh4xkv3WfI,}xrv +iNH#~mctri*hxW6kh|WlTX>/-' );
define( 'NONCE_SALT',       '%;N]Qa|=`&;A[o]I7yZ~NZRW&|NW=dT&J2rzslePD;u*Z^kBq1iKdr(e+an%}4=~' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
