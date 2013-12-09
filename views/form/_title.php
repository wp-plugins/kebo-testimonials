<?php
/**
 * Template file to show Testimonials Title
 */

/*
 * Print the 'before_title' HMTL set by the Theme.
 */
echo apply_filters( 'kbte_testimonials_form_before_title', $before_title, $instance, $widget_id );

/*
 * Output the Title text set on the Widget.
 */
echo esc_html( apply_filters( 'kbte_testimonials_form_title', $title, $instance, $widget_id ) );

/*
 * Print the 'after_title' HMTL set by the Theme.
 */
echo apply_filters( 'kbte_testimonials_form_after_title', $after_title, $instance, $widget_id );