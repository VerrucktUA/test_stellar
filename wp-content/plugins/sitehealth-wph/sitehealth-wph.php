<?php
/**
 * Plugin Name: WPHost.me helper plugin
 * Plugin URI: https://wphost.me
 * Description: Simple plugin to help you faster connect with WPHost.me support and increase site speed
 * Version: 1.1
 * Author: Dmytro Kondryuk
 * Author URI: https://wphost.me
 */
/*
function secplugin_remove_database_info( $debug_info ) {
    $debug_info['wp-database']['private'] = true;
    return $debug_info;
}
add_filter( 'debug_information', 'secplugin_remove_database_info' );*/

if(!function_exists('wp_new_blog_notification')){
	function wp_new_blog_notification( $blog_title, $blog_url, $user_id, $password ) {
		$user      = new WP_User( $user_id );
		$email     = $user->user_email;
		$name      = $user->user_login;
		$login_url = wp_login_url();

		$message = sprintf(
			/* translators: New site notification email. 1: New site URL, 2: User login, 3: User password or password reset link, 4: Login URL. */
			__(
				'Дякуємо за замовлення наших послуг. Для Вас автоматично встановлено WordPress за посиланням:

				%1$s

				You can log in to the administrator account with the following information:

				Username: %2$s
				Password: %3$s
				Log in here: %4$s

				We hope you enjoy your new site. Thanks!

				--The WordPress Team
				https://wordpress.org/
				'
			),
			$blog_url,
			$name,
			$password,
			$login_url
		);

		wp_mail( $email, __( 'New WordPress Site' ), $message );
	}
}
/**************** Remove wrong Database info ***************/
function myhost_remove_update_check( $tests ) {
    unset( $tests['direct']['sql_server'] );
    return $tests;
}
add_filter( 'site_status_tests', 'myhost_remove_update_check' );

/******************** Add additional admin bar button ************/
function myplugin_admin_bar_menu() {
    if ( current_user_can( 'manage_options' ) ) {
        global $wp_admin_bar;
        $wp_admin_bar->add_menu( array(
            'id'    => 'myplugin-page',
            'title' => '<span class="ab-icon dashicons dashicons-carrot"></span>' . _( 'Хостинг WordPress' ),
            'href'  => '#',
        ) );
        $wp_admin_bar->add_menu( array(
            'parent' => 'myplugin-page',
            'id'     => 'myplugin-page-items',
            'title'  => __( 'Написати в підтримку' ),
            'href'  => 'https://my.wphost.me/submitticket.php',
        ) );
    }
}
add_action( 'admin_bar_menu', 'myplugin_admin_bar_menu' );

/******************** Remove admin bar unused buttons ************/
function remove_from_admin_bar($wp_admin_bar) {
    if ( ! is_admin() ) {
        // Example of removing item generated by plugin. Full ID is #wp-admin-bar-si_menu
        //$wp_admin_bar->remove_node('si_menu');
        // WordPress Core Items (uncomment to remove)
        //$wp_admin_bar->remove_node('updates');
        //$wp_admin_bar->remove_node('comments');
        //$wp_admin_bar->remove_node('new-content');
        $wp_admin_bar->remove_node('wp-logo');
        //$wp_admin_bar->remove_node('site-name');
        //$wp_admin_bar->remove_node('my-account');
        //$wp_admin_bar->remove_node('search');
        //$wp_admin_bar->remove_node('customize');
    }

    /*
     * Items placed outside the if statement will remove it from both the frontend
     * and backend of the site
    */
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'remove_from_admin_bar', 999);

