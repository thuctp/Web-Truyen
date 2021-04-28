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
define('DB_NAME', 'demoair_demo6v2');

/** MySQL database username */
define('DB_USER', 'demoair_demo');

/** MySQL database password */
define('DB_PASSWORD', '@Nhanhweb@123');

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
define('AUTH_KEY',         'A_GQrz jbp;G*PQ>F:/{I0pDwo;XTtjZ^3PdX yz4+rsZCoX1B~)#~HSa2`T]F],');
define('SECURE_AUTH_KEY',  '9nZr(}g?iU/^xj4ZNqdEF0Y9i66z806e+!g1,fk9|pm#u,-Jm^5D|srllB>kXXO7');
define('LOGGED_IN_KEY',    '!dVDt0T`+r( z}~=By%jF]|$|<Annf!0io]q&mn?pfU3GNa%(x]E9KJr54NSaune');
define('NONCE_KEY',        '##?U{sw-B5B.JB@|xsOm`B3b5e|SdlsO/u|8Lp<`G0rCF5|w#Mj}Lp,U9?C <Esv');
define('AUTH_SALT',        'W*$hL*R7h|`WRp~U~HlA1D.awgt  z0#l5p-LwRzS.~Q^ Im)t#!2t.=l+ RZm(h');
define('SECURE_AUTH_SALT', 'd|$OS|QTBzW|S*$6$$BX5PhII:V>C#MbU+sJ0s@;7h+|tb-Ni--Caj=v+Q{ pf?[');
define('LOGGED_IN_SALT',   'c,=YW?ZwE|v0#)lmh&2+T;ZSZxL.@|oket*^tG}fd>r:zz8-dP!DH|T9r- 6+5Kh');
define('NONCE_SALT',       'm1WB,FS5Y-#G>nnz*odFQrM||@/%2{|D}$qCu?IgZ1}8>b|eTT5u^_8)mK/R#]~A');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'icms_';

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
