<?php
/**
 * Template file to show Testimonials Form
 */
?>

<?php echo apply_filters( 'kbte_testimonials_form_before_widget', $before_widget, $instance, $widget_id ); ?>

<?php do_action( 'kbte_before_testimonials_form', $instance, $widget_id ); ?>

<?php

/**
 * If the Title has been set, output it.
 */
if ( ! empty( $title ) ) {

    /**
     * Render the Widget Title
     */
    $view
        ->set_view( '_title' )
        ->render();
    
}
?>

<form id="form_kbte_review" class="<?php echo implode( ' ', $classes ); ?>" method="post" enctype="multipart/form-data" action="" data-abide>

    <?php if ( isset( $fields['title'] ) ) : ?>
    
        <div class="ktitle-field<?php if ( $fields['title']['error'] ) { echo ' error'; } ?>">
            <label for="field_title"><?php esc_html_e('Title', 'kbte'); ?> <?php if ( $fields['title']['required'] ) : ?><small><?php esc_html_e('required', 'kbte'); ?></small><?php endif; ?></label>
            <input id="field_title" name="kbte_form[<?php echo esc_attr( $fields['title']['name'] ); ?>]" type="text" value="<?php echo esc_html( $fields['title']['value'] ); ?>" <?php if ( $fields['title']['required'] ) : ?>required<?php endif; ?>>
            <?php if ( $fields['title']['required'] ) : ?><small class="error"><?php esc_html_e('A title is required.', 'kbte') ; ?></small><?php endif; ?>
        </div>
    
    <?php endif; ?>
    
    <?php if ( isset( $fields['name'] ) ) : ?>
    
        <div class="kname-field<?php if ( $fields['name']['error'] ) { echo ' error'; } ?>">
            <label for="field_name"><?php esc_html_e('Name', 'kbte'); ?> <?php if ( $fields['name']['required'] ) : ?><small><?php esc_html_e('required', 'kbte'); ?></small><?php endif; ?></label>
            <input id="field_name" name="kbte_form[<?php echo esc_attr( $fields['name']['name'] ); ?>]" type="text" value="<?php echo esc_html( $fields['name']['value'] ); ?>" <?php if ( $fields['name']['required'] ) : ?>required<?php endif; ?>>
            <?php if ( $fields['name']['required'] ) : ?><small class="error"><?php esc_html_e('A name is required.', 'kbte'); ?></small><?php endif; ?>
        </div>
    
    <?php endif; ?>
    
    <?php if ( isset( $fields['url'] ) ) : ?>
    
        <div class="kurl-field<?php if ( $fields['url']['error'] ) { echo ' error'; } ?>">
            <label for="field_url"><?php esc_html_e('URL', 'kbte'); ?> <?php if ( $fields['url']['required'] ) : ?><small><?php esc_html_e('required', 'kbte'); ?></small><?php endif; ?></label>
            <input id="field_url" name="kbte_form[<?php echo esc_attr( $fields['url']['name'] ); ?>]" type="url" value="<?php echo esc_html( $fields['url']['value'] ); ?>" <?php if ( $fields['url']['required'] ) : ?>required<?php endif; ?>>
            <?php if ( $fields['url']['required'] ) : ?><small class="error"><?php esc_html_e('A valid URL is required.', 'kbte'); ?></small><?php endif; ?>
        </div>
    
    <?php endif; ?>

    <?php if ( isset( $fields['email'] ) ) : ?>
    
        <div class="kemail-field<?php if ( $fields['email']['error'] ) { echo ' error'; } ?>">
            <label for="field_email"><?php esc_html_e('Email', 'kbte'); ?> <?php if ( $fields['email']['required'] ) : ?><small><?php esc_html_e('required', 'kbte'); ?></small><?php endif; ?></label>
            <input id="field_email" name="kbte_form[<?php echo esc_attr( $fields['email']['name'] ); ?>]" type="email" value="<?php echo esc_html( $fields['email']['value'] ); ?>" <?php if ( $fields['email']['required'] ) : ?>required<?php endif; ?>>
            <?php if ( $fields['email']['required'] ) : ?><small class="error"><?php esc_html_e('A valid email address is required.', 'kbte'); ?></small><?php endif; ?>
        </div>
    
    <?php endif; ?>
    
    <?php if ( isset( $fields['review'] ) ) : ?>

        <div class="kreview-field<?php if ( $fields['review']['error'] ) { echo ' error'; } ?>">
            <label for="field_review"><?php esc_html_e('Review', 'kbte'); ?> <?php if ( $fields['review']['required'] ) : ?><small><?php esc_html_e('required', 'kbte'); ?></small><?php endif; ?></label>
            <textarea id="field_review" name="kbte_form[<?php echo esc_attr( $fields['review']['name'] ); ?>]" type="text" <?php if ( $fields['review']['required'] ) : ?>required<?php endif; ?>><?php echo esc_textarea( $fields['review']['value'] ); ?></textarea>
            <?php if ( $fields['review']['required'] ) : ?><small class="error"><?php esc_html_e('A review is required.', 'kbte'); ?></small><?php endif; ?>
        </div>
    
    <?php endif; ?>
    
    <?php if ( isset( $fields['rating'] ) ) : ?>
    
        <div class="krating-field<?php if ( $fields['rating']['error'] ) { echo ' error'; } ?>">
            
            <label for="field_rating"><?php esc_html_e('Rating', 'kbte'); ?></label>
            
            <div class="krating">

                <input type="radio" id="kbte_rating_5" class="krating-input" name="kbte_form[<?php echo esc_attr( $fields['rating']['name'] ); ?>]" value="5" <?php checked( $fields['rating']['value'], 5 ); ?>>
                <label for="kbte_rating_5" class="krating-star"></label>

                <input type="radio" id="kbte_rating_4" class="krating-input" name="kbte_form[<?php echo esc_attr( $fields['rating']['name'] ); ?>]" value="4" <?php checked( $fields['rating']['value'], 4 ); ?>>
                <label for="kbte_rating_4" class="krating-star"></label>

                <input type="radio" id="kbte_rating_3" class="krating-input" name="kbte_form[<?php echo esc_attr( $fields['rating']['name'] ); ?>]" value="3" <?php checked( $fields['rating']['value'], 3 ); ?>>
                <label for="kbte_rating_3" class="krating-star"></label>

                <input type="radio" id="kbte_rating_2" class="krating-input" name="kbte_form[<?php echo esc_attr( $fields['rating']['name'] ); ?>]" value="2" <?php checked( $fields['rating']['value'], 2 ); ?>>
                <label for="kbte_rating_2" class="krating-star"></label>

                <input type="radio" id="kbte_rating_1" class="krating-input" name="kbte_form[<?php echo esc_attr( $fields['rating']['name'] ); ?>]" value="1" <?php checked( $fields['rating']['value'], 1 ); ?>>
                <label for="kbte_rating_1" class="krating-star"></label>
            
            </div>
            
            <?php if ( $fields['rating']['required'] ) : ?><small class="error"><?php esc_html_e('A rating is required.', 'kbte'); ?></small><?php endif; ?>
            
        </div>
    
    <?php endif; ?>
    
    <?php if ( in_array( 'hidden_field', $antispam ) ) : ?>
    
        <div class="kaddress-field" style="display: none; visibility: hidden;">
            <label for="field_address_1"><?php esc_html_e('Address', 'kbte'); ?></label>
            <input id="field_address_1" name="kbte_form[address_1]" type="text">
        </div>
    
    <?php endif; ?>
    
    <?php if ( isset( $is_saved ) && 'true' == $is_saved ) : ?>
    
        <div class="kmessage success">
            <?php _e('Thank you. Your review has been saved.', 'kbte'); ?>
        </div>
    
    <?php endif; ?>
    
    <?php if ( in_array( 'time_check', $antispam ) ) : ?>
    
        <input id="time" type="hidden" name="_kbte_time" value="<?php echo esc_attr( time() ); ?>">
    
    <?php endif; ?>
    
    <?php wp_nonce_field( 'kbte_form_submit', '_kbte_form' ); ?>
        
    <input id="_kbte_id" type="hidden" name="_kbte_id" value="<?php echo $form_id; ?>">

    <button id="submit" type="submit"><?php esc_html_e('Submit'); ?></button>

</form>

<?php do_action( 'kbte_after_testimonials_form', $instance, $widget_id ); ?>

<?php echo apply_filters( 'kbte_testimonials_form_before_widget', $after_widget, $instance, $widget_id ); ?>