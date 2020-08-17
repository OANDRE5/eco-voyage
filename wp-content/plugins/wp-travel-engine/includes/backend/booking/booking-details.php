<?php
/**
 * Booking details screen - Edit booking
 * 
 * @package WP_Travel_Engine
 */
global $post;

// Get settings.
$booking_metas         = get_post_meta( $post->ID, 'wp_travel_engine_booking_setting', true );
$pno                   = isset( $booking_metas['place_order']['traveler'] ) ? $booking_metas['place_order']['traveler'] : 0;
$billing_options       = isset( $booking_metas['place_order'] ) ? $booking_metas['place_order'] : array();
$additional_fields     = isset(  $booking_metas['additional_fields'] ) && is_array( $booking_metas['additional_fields'] ) ? $booking_metas['additional_fields'] : array();
$traveller_information = get_post_meta( $post->ID, 'wp_travel_engine_placeorder_setting', true );
$personal_options      = isset( $traveller_information['place_order'] ) ? $traveller_information['place_order'] : array();
$booking_discounts = get_post_meta( $post->ID, 'wpte_booking_discounts', true );
?>
<div class="wpte-main-wrap wpte-edit-booking">
    <div class="wpte-block-wrap wpte-floated">
        <?php 
            $booked_travellers = isset( $booking_metas['place_order']['traveler'] ) ? $booking_metas['place_order']['traveler'] : 0;
            $total_paid = isset( $booking_metas['place_order']['cost'] ) ? $booking_metas['place_order']['cost'] : 0;
            $remaining_payment = isset( $booking_metas['place_order']['due'] ) ? $booking_metas['place_order']['due'] : 0;
            $total_cost = isset( $booking_metas['place_order']['due'] ) && $booking_metas['place_order']['due'] != '' ? floatval( $booking_metas['place_order']['cost'] ) + floatval( $booking_metas['place_order']['due']) : $total_paid;
            $trip_id = isset( $booking_metas['place_order']['tid'] ) ? $booking_metas['place_order']['tid'] : 0;
            $trip_name = get_the_title( $trip_id );
            $trip_start_date = isset( $booking_metas['place_order']['datetime'] ) ? $booking_metas['place_order']['datetime'] : '';

            include plugin_dir_path( __FILE__ ) . '/booking-parts/trip-info.php';
            
            include plugin_dir_path( __FILE__ ) . '/booking-parts/payment-details.php'; 
            
            include plugin_dir_path( __FILE__ ) . '/booking-parts/customer-details.php'; 
        ?>
    </div> <!-- .wpte-block-wrap -->
    
    <?php 
        if ( isset( $personal_options ) && ! empty( $personal_options ) ) :
            include plugin_dir_path( __FILE__ ) . '/booking-parts/personal-details.php';
        endif;

        // Hook for addons.
        /**
         * Passed - $booking_id
         */
        do_action( 'wp_travel_engine_booking_screen_after_personal_details', $post->ID );
    ?>
</div><!-- .wpte-main-wrap -->
<?php
