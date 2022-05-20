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
define( 'DB_NAME', 'wph0_ybyzs' );

/** MySQL database username */
define( 'DB_USER', 'wph0_cpe8y' );

/** MySQL database password */
define( 'DB_PASSWORD', 'k*Xa!L5r0xc6bMTV' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '06e&IE4B6:dz8Y|%D*33Qr3*:k5U8A2hV7F2V950R0Ool1w(rV&1e9KK5&4k8Ac0');
define('SECURE_AUTH_KEY', '9o]OAt83!znjKY6j#U&qg4a1+42ne1]l]3/Jao36PF170i+4%3-Q5a9(6!*5g_GM');
define('LOGGED_IN_KEY', '2@d8N&vY9;99&[@xm*)zLx@sf6[%qqtG1EoX7kfS&#s||cu(;;;4|/j-/c_O8PP*');
define('NONCE_KEY', ';EM&;9B#Kj(aI]4V!RE7987y/)s8a[-%9/MNNx)-8s/6KLu4M2gXq1o%ae~@cmZT');
define('AUTH_SALT', 'Mf9e:C713]7-|C~3XX0iTqz8:uT921A3+@]iJKQ!J4pJHI4g41WnW(F@[46Ou8Ps');
define('SECURE_AUTH_SALT', 'vobJ~5n88r#TV3Jdr8mLuM0iY~0(l5uT:yPT5p44Mbd%[bI~10w;|vr)(*IbOk:q');
define('LOGGED_IN_SALT', 'T+1@+27oP(*6yq9#83u|nz3+Bz/[z7(|/K4/g-7Bi2+l#c:o95lP3d3!)JTJ2pUb');
define('NONCE_SALT', '1s&_8yyjJv%a-&7l8n/OFI)r8VK*h]:lOISUz4/db%v~kAa3A3;_LUbzg~3c61A:');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = '9v1VY_';


define('WP_ALLOW_MULTISITE', true);
define( 'DISABLE_WP_CRON', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
