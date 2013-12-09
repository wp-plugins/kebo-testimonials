<?php
/* 
 * Kebo Testimonials - Misc/Helper Functions
 */

if ( ! defined( 'KBTE_VERSION' ) ) {
    header( 'HTTP/1.0 403 Forbidden' );
    die;
}

/**
 * Flush Rewrite Rules.
 * Use if slug changes or plugin is installed/uninstalled.
 */
function kbte_flush_rewrite_rules() {
    
    if ( function_exists( 'flush_rewrite_rules' ) ) {
        
        flush_rewrite_rules();
        
    } else {
        
        global $pagenow, $wp_rewrite;

        $wp_rewrite->flush_rules();
    
    }
    
}
add_filter( 'admin_init', 'kbte_flush_rewrite_rules' );
register_activation_hook( __FILE__, 'kbte_flush_rewrite_rules' );
register_deactivation_hook( __FILE__, 'kbte_flush_rewrite_rules' );

/*
 * Helper Function - Returns Form Field Defaults
 */
function kbte_get_default_form_fields() {
    
    $default_fields = array(
        'title' => array(
            'label' => __('Title', 'kbte'),
            'name' => 'title',
            'type' => 'text',
            'required' => false,
            'value' => '',
            'error' => '',
        ),
        'name' => array(
            'label' => __('Name', 'kbte'),
            'name' => 'name',
            'type' => 'text',
            'required' => false,
            'value' => '',
            'error' => '',
        ),
        'email' => array(
            'label' => __('Email', 'kbte'),
            'name' => 'email',
            'type' => 'text_email',
            'required' => false,
            'value' => '',
            'error' => '',
        ),
        'url' => array(
            'label' => __('URL', 'kbte'),
            'name' => 'url',
            'type' => 'text_url',
            'required' => false,
            'value' => '',
            'error' => '',
        ),
        'review' => array(
            'label' => __('Review', 'kbte'),
            'name' => 'review',
            'type' => 'textarea',
            'required' => true,
            'value' => '',
            'error' => '',
        ),
        'rating' => array(
            'label' => __('Rating', 'kbte'),
            'name' => 'rating',
            'type' => 'integer',
            'required' => false,
            'value' => '',
            'error' => '',
        ),
    );
    
    $fields = apply_filters( 'kbte_testimonials_form_default_fields', $default_fields );
    
    return $fields;
    
}

/*
 * Helper Function - Returns Column Sizes
 */
function kbte_get_columns() {
    
    $options = kbte_get_plugin_options();
    
    $columns = array(
        'small' => $options['testimonials_archive_responsive_columns'][0],
        'medium' => $options['testimonials_archive_responsive_columns'][1],
        'large' => $options['testimonials_archive_responsive_columns'][2],
    );
    
    return $columns;
    
}

/*
 * Helper Function - Returns Page Title
 */
function kbte_get_page_title() {
    
    $options = kbte_get_plugin_options();
    
    $title = $options['testimonials_archive_page_title'];
    
    return esc_html( $title );
    
}

/*
 * Helper Function - Returns Page Content Before
 */
function kbte_get_page_content_before() {
    
    $options = kbte_get_plugin_options();
    
    $content = $options['testimonials_archive_page_content_before'];
    
    return wp_filter_post_kses( $content );
    
}

/*
 * Helper Function - Returns Reviewer Name
 */
function kbte_get_review_name() {
    
    global $post;
    
    $kbte_custom_meta = get_post_meta( $post->ID, '_kbte_testimonials_meta_details', true );
    
    $name = ( isset( $kbte_custom_meta['reviewer_name'] ) ) ? $kbte_custom_meta['reviewer_name'] : '' ;
    
    return esc_html( $name );
    
}

/*
 * Helper Function - Returns Reviewer Email
 */
function kbte_get_review_email() {
    
    global $post;
    
    $kbte_custom_meta = get_post_meta( $post->ID, '_kbte_testimonials_meta_details', true );
    
    $email = ( isset( $kbte_custom_meta['reviewer_email'] ) ) ? $kbte_custom_meta['reviewer_email'] : '' ;
    
    return esc_html( $email );
    
}

/*
 * Helper Function - Returns Reviewer URL
 */
function kbte_get_review_url() {
    
    global $post;
    
    $kbte_custom_meta = get_post_meta( $post->ID, '_kbte_testimonials_meta_details', true );
    
    $url = ( isset( $kbte_custom_meta['reviewer_url'] ) ) ? $kbte_custom_meta['reviewer_url'] : '' ;
    
    return esc_url( $url );
    
}

/*
 * Helper Function - Returns Reviewer Rating
 */
function kbte_get_review_rating() {
    
    global $post;
    
    $rating = get_post_meta( $post->ID, '_kbte_testimonials_meta_rating', true );
    
    $rating = ( $rating ) ? absint( $rating ) : null ;
    
    return $rating;
    
}

/*
 * Helper Function - Render Review Rating Stars
 */
function kbte_get_review_rating_stars() {
    
    $total_stars = 5;
    
    $rating = kbte_get_review_rating();
    
    // Begin Output Buffering
    ob_start();
    
    ?>

    <span class="kreviewstars" title="<?php echo sprintf( __('%d out of %d stars', 'kbte'), $rating, $total_stars ); ?>">
        
        <?php for ( $i = 1; $i <= 5; $i++ ) { ?>
        
            <span class="kstar<?php if ( $rating >= $i ) { echo ' active'; } ?>"></span>
            
        <?php } ?>
            
    </span>

    <?php
    
    // End Output Buffering and Clear Buffer
    $output = ob_get_contents();
    ob_end_clean();
        
    return $output;
    
}