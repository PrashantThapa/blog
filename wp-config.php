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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '5x]?#+yPyBM<`=+mRhb~S2m;aw`j dR%_^PcCo<~LL!$(jQ*o1DN?Fq8vNT)Qu_{');
define('SECURE_AUTH_KEY',  'WLPQ:@5?0GerSS/w)6PiZUau&}B9R?!k}`jh**Lc([y=R!pfY;5g8wp<|yH=y;j:');
define('LOGGED_IN_KEY',    'UoI&74a<WoLnFfKbS3J]THD-Ocy)Qm0,aPy|eTd ^}i#3M m--[D#dQ$lj]#QNnM');
define('NONCE_KEY',        '[1buFBBvZ,&NJI6F[#rm`kdyO4Y MUBLpWU!#59<]J*y!JhT&}E+5&B@p=(CeWnw');
define('AUTH_SALT',        '`>BvJL_5NgYxdk|hrr#*DP,T0SH|keD;wn.W5i]Kt2bGH`tsl5.t,U8^T_k-g9rQ');
define('SECURE_AUTH_SALT', 'Ypm<coQ07Iib@Og&y}pZO`&DU&d^Q&(!WG|oCKprBcjO|ou9zTscd!:%aYEQ@)W[');
define('LOGGED_IN_SALT',   'tPVf{NU ,v0([!Uw.d}W,cxuc?r;11GamS9{K5[V.n;4AL:$A>SH@GB !Z)BzI.P');
define('NONCE_SALT',       '{4DN{480d6$N[ty;[Y,|J#!0K9%3~@c3+GBK|nM/vl%@ 4h&~&M}IgP}m E6?S9|');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
