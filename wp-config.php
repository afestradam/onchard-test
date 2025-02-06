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
define( 'DB_NAME', 'orchard_test' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '_`l48])A}T/rq4jG18nnW{f6a0VP3}tGS{iR+`#4gEkuEu?TKNA/+iNV`m>3*}!^' );
define( 'SECURE_AUTH_KEY',  'pz_FI;x~:wI/mcS<CpCN+-n&}MLh1F$$!*2/&b(S(bhq*lcG@:<eZLSAXGmg;$p*' );
define( 'LOGGED_IN_KEY',    '?=WMNJVHL!CjYsy:Jvl2>X[jHxZX$u75@D.3[-^N|P*W9IG18jH27 07rP`lr5@|' );
define( 'NONCE_KEY',        '$rZX#,:@%1i!hn` MbXnx-*d>nYmD,_.Gr+]P*|v9Q^k5T9 ;F/[(yuxC:n5>&+r' );
define( 'AUTH_SALT',        '1`h9I-jYhD$e<[b<W?RrPeA6lTmiwynL3>A]{(m-E|17V~z%c|in4rN3?f`q@bFE' );
define( 'SECURE_AUTH_SALT', 'yv9Ley-V[zVUz_[-jr@c(@&x#AZk^$kcuehF9bF;KEs5h-uKb7)A]n-mstopkh9n' );
define( 'LOGGED_IN_SALT',   ']2WOp<7Wh]f4M`=Te7HA(Sa5T:c`C:=<k.ua_%o!U%K<q8fGQ.uWD%g}nB?z@6:)' );
define( 'NONCE_SALT',       '.y9d@2G-.GGa-0[Rf;6JoIK; MSOfZ{Ei4&5;)b:,Yzh^rauF4Xv5t1-|N}N,%ts' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
