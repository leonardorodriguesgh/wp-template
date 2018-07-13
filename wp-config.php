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
define('DB_NAME', 'lisieux_treinamento');

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
define('AUTH_KEY',         '4BZ[ZHn|iGe9}o/Nho!EnwKw9RIus@Tm-HQ?[zRa!,y/Wd%5-w%x8GBy~o6#&0l~');
define('SECURE_AUTH_KEY',  'h6aS_*LW2>pxq<C ^iJw9e$T|uICq`0PUMp{Z0 ^jA:D}J%Kk`$p1VPzkd/rcnM*');
define('LOGGED_IN_KEY',    '8$+Mw^wne.6mTU%dk#H{XX{Ubk(PH;!Nm*u}6kzAG=Vvt/3J@&0YF/RhD-oUsxBR');
define('NONCE_KEY',        '`l/`fTClPv4IVBG)7fs[} yGp*y|Ygg(nDG43%rrk,:=#H[+KYm)g4ag0+jQT+Y>');
define('AUTH_SALT',        ',bH$<U^%Wm;Bi~ptLcpea+f}B>9m;Fg0yMQ-gF(>r[{T[`KEN/8YOzhPP5@|6dRz');
define('SECURE_AUTH_SALT', '@#-2CSI&8O8X%9_ZEIY*=bXy?YMy1Qd{fllq`*8%fxLQ7E%Q%+|Yj|)UJxcL|!L!');
define('LOGGED_IN_SALT',   ':p;@z:e8Vdot5&.DS-8,.uQ!nX5w^Z`|Ongu]_|?dN_]rH29->SxSvg{o`7}O!yT');
define('NONCE_SALT',       'J@,Z:n*C>)1~# eAxr{wK{eFh(j9~L!+Rps=#/4CstW*po7$fg[tr!2}i=aSk%Ne');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tb_';

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
