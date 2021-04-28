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
define('DB_NAME', 'tru86047_truyen');

/** MySQL database username */
define('DB_USER', 'tru86047_admin');

/** MySQL database password */
define('DB_PASSWORD', 'Minhthuc#1996');

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
define('AUTH_KEY',         '8%XT|8|qpA_05?rff1n-A<t9v=#`wurDkL7eueWbfjl+Z$*a!_m8?er]a:W5yX,/');
define('SECURE_AUTH_KEY',  '+;<HSGd}X?NK@/~B`5k5:_SZ41#hfI]UY|$K#UHK3+$N!UyAb|#:u:h^F%epDGc3');
define('LOGGED_IN_KEY',    'Rm3MW=/]{q+1ZI/=C?d-}}dL&4n0l0HX~{Ops,K_/n&]Ap%GOOEW{m.!7o.I|?e>');
define('NONCE_KEY',        '}Qn}+?WL!`B_g$~&&{Y?;&}0?2H:(7_*S_S+`}UOybGBI!|`MmEA#gH<1JNvBf!B');
define('AUTH_SALT',        'NF2_re25Wr0j;V!SBch,FU/y[,PgM=}xHzRTEwKBN?|/G`LVD-PT/DXe~y*@0kOn');
define('SECURE_AUTH_SALT', '0-qY/Ad&?L_#Fngz&AFqMt^Ch?N)8(pfeQhlR2fB?#:2*`52jJ/9.7>BX<7;XM0x');
define('LOGGED_IN_SALT',   'msMmTW UtYB*4nS/t6<mu>HUDbl+|eHxjumtgPpEpk|.pt?kmG3`+Y-/z_,J xn.');
define('NONCE_SALT',       'lP_bI@TL8g|qN{UpEd2-~S7.L[?uX1+kn;RyT|n9zfWVn`Gu;uZskvwWIKe9mF-c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tr_';

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
