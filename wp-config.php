<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
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
define( 'DB_NAME', 'voyage' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'FGsdD$~ :]gk!$RPgAxP<dM8 Ihx}uZ_eq0Ub3 VA<!::O=LDNx=30nH&{6,EkuR' );
define( 'SECURE_AUTH_KEY',  '=Ly1gbl7HKA}T:SH)XMAM)F5Cn~-|TK3uyV?(.~17n5 *onIc8G{an#P!@yCr-AI' );
define( 'LOGGED_IN_KEY',    '3(LIq`zZ=<1)hzg]l.Prl6(J+*}?H-&JstHUu/aw~#y#,E<4_JK0M# i$Sj06s$a' );
define( 'NONCE_KEY',        '16hE?Lku]vhAjjbWiv!d?|%u(_9{eZRx^3zTcb-$sTZ:x.liu0=1NWw<A9Gqwg}!' );
define( 'AUTH_SALT',        '}fHyo0k}qtn382w;uchaP2=Uv&k((eRVom&cpyK/g{7*BwOLg~HZ7jqm&niX@KJB' );
define( 'SECURE_AUTH_SALT', ':`j21#wzdwyxco{}h8fYVN2@nRDWLdzvhW:AJJ3H<9|MGFTPAEGT#Z$YwY5h$~<K' );
define( 'LOGGED_IN_SALT',   'PR,cniuiOi(F?c~OC[C)1-ey+277m6iabYwN)h6^iR.pu8k_5yxgR,,7>^Nu8YtZ' );
define( 'NONCE_SALT',       '!WVpIV:z:g9vX8;4<$,/T~4me.t99N*8MfH7R+o#sch`{~Z6nOXBq8=ovLCWDM==' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
