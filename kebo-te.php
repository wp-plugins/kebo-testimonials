<?php
/*
 * Plugin Name: Kebo Testimonials
 * Plugin URI: http://kebopowered.com/plugins/kebo-testimonials/
 * Description: Easiest way to add great looking Testimonials to your website.
 * Version: 0.5.0
 * Author: Kebo
 * Author URI: http://kebopowered.com
 * Text Domain: kbte
 * Domain Path: languages
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Sorry, no direct access.' );
}

define( 'KBTE_VERSION', '0.1.0' );
define( 'KBTE_URL', plugin_dir_url(__FILE__) );
define( 'KBTE_PATH', plugin_dir_path(__FILE__) );

/*
 * Load textdomain early, as we need it for the PHP version check.
 */
function kbte_load_textdomain() {
    
    load_plugin_textdomain( 'kbte', false, KBTE_PATH . '/languages' );
    
}
add_filter( 'wp_loaded', 'kbte_load_textdomain' );

/*
 * Check for the required version of PHP
 */
if ( version_compare( PHP_VERSION, '5.2', '<' ) ) {
    
    if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
        
        require_once ABSPATH . '/wp-admin/includes/plugin.php';
        deactivate_plugins(__FILE__);
        wp_die( __( 'Kebo Testimonials requires PHP 5.2 or higher, as does WordPress 3.2 and higher.', 'kbso' ) );
        
    } else {
        
        return;
        
    }
    
}

/*
 * Load Relevant Internal Files
 */
function kbte_plugin_setup() {

    /*
     * Include Options.
     */
    require_once( KBTE_PATH . 'inc/options.php' );
    
    /*
     * Include Custom Post Type.
     */
    require_once( KBTE_PATH . 'inc/custom-post-type.php' );
    
    /*
     * Include Meta Functions.
     */
    require_once( KBTE_PATH . 'inc/meta.php' );
    
    /*
     * Include View Class.
     */
    require_once( KBTE_PATH . 'inc/classes/Views.php' );
    
    /*
     * Include Form Class.
     */
    require_once( KBTE_PATH . 'inc/classes/Forms.php' );
    
    /*
     * Include Akismet Class.
     */
    require_once( KBTE_PATH . 'inc/classes/Akismet.php' );
    
    /*
     * Include Shortcode.
     */
    require_once( KBTE_PATH . 'inc/shortcode.php' );
    
    /*
     * Include Widget.
     */
    require_once( KBTE_PATH . 'inc/widget.php' );
    
    
    /*
     * Admin or Frontend
     */
    if ( is_admin() ) {
    
        /*
         * Include Admin Customisations.
         */
        require_once( KBTE_PATH . 'inc/admin.php' );
        
        /*
         * Include Menu Page.
         */
        require_once( KBTE_PATH . 'inc/menu.php' );
    
    } else {
        
        /*
         * Include Frontend Customisations.
         */
        require_once( KBTE_PATH . 'inc/front.php' );
        
        /*
         * Include Pagination.
         */
        require_once( KBTE_PATH . 'inc/pagination.php' );
        
    }
    
    /*
     * Include Form Functions.
     */
    require_once( KBTE_PATH . 'inc/forms.php' );
    
    /*
     * Include Misc Functions.
     */
    require_once( KBTE_PATH . 'inc/misc.php' );
    
}
add_action( 'plugins_loaded', 'kbte_plugin_setup', 15 );


/**
 * Register plugin scripts and styles.
 */
function kbte_register_files() {

    // Register Styles
    wp_register_style( 'kbte-front', KBTE_URL . 'assets/css/front.css', array(), KBTE_VERSION, 'all' );
    wp_register_style( 'kbte-admin', KBTE_URL . 'assets/css/admin.css', array(), KBTE_VERSION, 'all' );
        
    // Register Scripts
    wp_register_script( 'responsive-slides', KBTE_URL . 'assets/js/responsiveslides.min.js', array( 'jquery' ), KBTE_VERSION, false );
    wp_register_script( 'kbte-foundation-abide', KBTE_URL . 'assets/js/foundation.abide.custom.js', array( 'jquery' ), KBTE_VERSION, false );
        
}
add_action( 'wp_enqueue_scripts', 'kbte_register_files' );
add_action( 'admin_enqueue_scripts', 'kbte_register_files' );
    
/**
 * Enqueue frontend plugin scripts and styles.
 */
function kbte_enqueue_frontend() {
    
    global $post;
    
    if ( isset( $post->post_type ) && 'kbte_testimonials' == $post->post_type ) {
        
        $options = kbte_get_plugin_options();
        
        if ( 'none' != $options['testimonials_general_visual_style'] ) {
        
            wp_enqueue_style( 'kbte-front' );
        
        }
        
    }
        
}
add_action( 'wp_enqueue_scripts', 'kbte_enqueue_frontend' );
    
/**
 * Enqueue backend plugin scripts and styles.
 */
function kbte_enqueue_backend( $hook_suffix ) {
        
    // Enqueue on all pages
    wp_enqueue_style( 'kbte-admin' );
    
    // TODO: Only enqueue on required pages
        
}
add_action( 'admin_enqueue_scripts', 'kbte_enqueue_backend' );

/**
 * Add a link to the plugin screen, to allow users to jump straight to the settings page.
 */
function kbte_add_plugin_link( $links ) {
    
    $links[] = '<a href="' . admin_url( 'edit.php?post_type=kbte_testimonials&page=kbte-testimonials' ) . '">' . __( 'Settings', 'kbte' ) . '</a>';
    return $links;
    
}
add_filter( 'plugin_action_links_kebo-te/kebo-te.php', 'kbte_add_plugin_link' );

/**
 * Adds a WordPress Pointer to Kebo Testimonials options page.
 */
function kbte_pointer_script_style() {

    // Assume pointer shouldn't be shown
    $enqueue_pointer_script_style = false;

    // Get array list of dismissed pointers for current user and convert it to array
    $dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

    // Check if our pointer is not among dismissed ones
    if ( ! in_array( 'kbte_install_pointer', $dismissed_pointers ) ) {
        $enqueue_pointer_script_style = true;

        // Add footer scripts using callback function
        add_action( 'admin_print_footer_scripts', 'kbte_pointer_script_style' );
    }

    // Enqueue pointer CSS and JS files, if needed
    if ( $enqueue_pointer_script_style ) {
        wp_enqueue_style( 'wp-pointer' );
        wp_enqueue_script( 'wp-pointer' );
    }
    
}
add_action( 'admin_enqueue_scripts', 'kbte_pointer_script_style' );