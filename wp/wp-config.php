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
define('DB_NAME', 'db_showindow');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'zoqtmxhs');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '+H)v#FBz/!SBQNVgG-e!G@u=-.e}g^YOx{9=,?y_L_]EgL4Ue(A +fPdha,3O$f|');
define('SECURE_AUTH_KEY',  'XxoIk,am%|BS),sp}]pX%-X@mjN$Sdk^ 4]J8=awCn8Ipd+.cOG}k:~(%xCr.2{B');
define('LOGGED_IN_KEY',    '^]>Tn-P:Q*Dg;_@S||x$8t(!Mg^W|JoQ_5Tgft-^6NX xfaRsla@|Ufe<aE1Nf(a');
define('NONCE_KEY',        ')Q6OFsV#WY4|%0f8lcjpu/H~*pD,#o-vJQ}{OY,fT1_U(ZwL2S=Yjr?fvs0daUlS');
define('AUTH_SALT',        '4QP~:EKd |RZQVd$)fxA;-8/ar3-5c19bPt<5_K$TB]RV[j(pxyd|.c|C,$ZDP3@');
define('SECURE_AUTH_SALT', 'o7g-GOflCsYbfbd V4y5FLMv44X7i)HTG~qR[D6$Whq7fjCY^%d5zZH#:.BeB.wS');
define('LOGGED_IN_SALT',   '/m[JGHZm1W/DrzbXr?He+2RNf!fzC93+BBzgZqm4}^G!ktEs-X}fTqi+,(:@H@{Y');
define('NONCE_SALT',       'y_;zc`S-hwf`tlL34I+b?wK_ zj8e;8sL88|&=ag*=IFA-GGY7O5Q?`nSmse2eg8');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'db_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'ko_KR');

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
