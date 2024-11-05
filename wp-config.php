<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mexpropertysearch' );

define('FS_METHOD', 'direct');

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
define( 'AUTH_KEY',         '=T^g(y;/_2$,aEFlijx9^IWZ~<eZ4>%h!%/l+3?ne4$lPn==@mKqo}tL{zOUIpSl' );
define( 'SECURE_AUTH_KEY',  '<f9WC4jo/]$^qS_O/@Pix&M`3b|r|LGLj4__si=[I7/9I:LmEt$Nw(bef,l8tC 0' );
define( 'LOGGED_IN_KEY',    'dYG2{A!k[TS)`8yV:fz^-6^3AyTw-e:+Sc8g[E_Rcln/Q^2]ANC!c.=43O@i+150' );
define( 'NONCE_KEY',        ':r-&N%GDnp[yo?MsD[i*HV{]-~VcoFls_;6 6|hjK/;r/0:(rF2b-^h@,Xsd;+@Z' );
define( 'AUTH_SALT',        'wxInm|/9]}Zg ^g.u[{GrKx~kyQyEXT}LyX&FDqbS{uA{i4MU6gjjt=l#mk%lSWu' );
define( 'SECURE_AUTH_SALT', '@lkfI~Tz~A2lp2o:W]e+Wv8K}g~$:X[Hu5c+*kXGA+ n[V{4)+cn^^:a/jYPc42E' );
define( 'LOGGED_IN_SALT',   'e;6:%kH5-}t+y/S7Jx;]~ADkMi2h=oy<K/-|yKM3%r&SZB?/>a*.rRv|,C*8UD$h' );
define( 'NONCE_SALT',       '1/y1=}^vXnUirIMN`{n97qbK4bP!RQHk.l@2T:yHJ<|YV_xk-{hHR:Ck>omSi1Z=' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
