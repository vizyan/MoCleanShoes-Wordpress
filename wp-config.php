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
define('DB_NAME', 'moclean');

/** MySQL database username */
define('DB_USER', 'vizyan');

/** MySQL database password */
define('DB_PASSWORD', 'gr4dnl1v1n4');

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
define('AUTH_KEY',         'b:FGmLXT?T*aho]H&nx11vD0;MN41-EI}[7{T`^ra&bwn.s~Belt JahmHx]k7U~');
define('SECURE_AUTH_KEY',  '|%Z`wmPXA Rqp8>d/1m3%_0@1WhZ{X8mD+fTpX<;u1(.&3D6+LKb*Phe5AZkU<Mg');
define('LOGGED_IN_KEY',    '!~!Yi#w8Y6jPX<z+K^CU*Kx4WEc/j%SYz*mu,_r=qx8z.]<Dg=BqF)O7>VVGM*ZU');
define('NONCE_KEY',        '=Y{5z0S #f?tW1Sd.iunNAI@:C1}.uPTT/,^?@H!e^88raX VJee4dgvrQeYxYGo');
define('AUTH_SALT',        'r;kwY_9B`zv9}]1KVLJHtVN@6fr=eW/u(h`tP$nXv.Vb;(t):dR|4+bxA(+3-M9g');
define('SECURE_AUTH_SALT', '{7Cp%hA?Rr|tNu?Xi8|:z}MGG*;t6p)L`a,k}$~9:H{MAigt]UEgYHL4]u9M~Lim');
define('LOGGED_IN_SALT',   'pZ18X77U={Sogoe@okf_AlHny=1ceoaiMFRWh a}BnJFau)+6,#IbOPt&_3VN*AC');
define('NONCE_SALT',       'ww@3VhX$H.g{]R`PC&nU.|aflPqHST--Ge`w~s9 fLqHN|p]e*1X:gK>c(lmti-h');

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
