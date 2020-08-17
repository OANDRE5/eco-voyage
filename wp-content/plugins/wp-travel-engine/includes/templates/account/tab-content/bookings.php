<?php
/**
 * Booking Tab.
 *
 * @package wp-travel-engine/includes/templates/account/tab-content/
 */
$bookings = $args['bookings'];

global $wp;
wp_enqueue_style( 'magnific-popup' );
wp_enqueue_script( 'magnific-popup' );
?>
<header class="wpte-lrf-header">
    <h2 class="wpte-lrf-title"><?php _e( 'Bookings', 'wp-travel-engine' ); ?></h2>
    <div class="wpte-lrf-description">
        <p><?php _e( 'Here is the list of bookings made successfully with your user account.', 'wp-travel-engine' ); ?></p>
    </div>
</header>
<div class="wpte-lrf-block-wrap">
    <div class="wpte-lrf-block">
        <table class="wpte-lrf-table">
            <?php 
            if ( ! empty( $bookings ) ) :
                foreach( $bookings as $key => $booking ) : 
                    
                    $booking_metas  = get_post_meta( $booking, 'wp_travel_engine_booking_setting', true );
                    $payment_status = get_post_meta( $booking, 'wp_travel_engine_booking_payment_status', true );

                    if ( ! $payment_status ) {
                        $payment_status = __( 'pending', 'wp-travel-engine' );
                    }
                    
                    $total_paid = isset( $booking_metas['place_order']['cost'] ) ? $booking_metas['place_order']['cost'] : 0;
                    $remaining_payment = isset( $booking_metas['place_order']['due'] ) ? $booking_metas['place_order']['due'] : 0;
                    $total_cost = isset( $booking_metas['place_order']['due'] ) && $booking_metas['place_order']['due'] != '' ? floatval( $booking_metas['place_order']['cost'] ) + floatval( $booking_metas['place_order']['due']) : $total_paid;
                ?>
                    <tr>
                        <th><?php echo isset( $booking_metas['place_order']['tname'] ) ? esc_html( $booking_metas['place_order']['tname'] ) : ''; ?></th>
                        <td>
                            <span class="lrf-td-title"><?php _e( 'Departure', 'wp-travel-engine' ); ?></span>
                            <span class="lrf-td-desc"><?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $booking_metas['place_order']['datetime'] ) ) ); ?></span>
                        </td>
                        <td>
                            <span class="lrf-td-title"><?php _e( 'Booking Status', 'wp-travel-engine' ); ?></span>
                            <span class="lrf-td-desc"><?php _e( 'Booked', 'wp-travel-engine' ); ?></span>
                        </td>
                        <td>
                            <span class="lrf-td-title"><?php _e( 'Payment Status', 'wp-travel-engine' ); ?></span>
                            <span class="lrf-td-desc"><?php echo esc_html( $payment_status ); ?></span>
                        </td>
                        <td>
                            <span class="lrf-td-title"><?php _e( 'Paid', 'wp-travel-engine' ); ?></span>
                            <span class="lrf-td-desc"><?php echo wp_travel_engine_get_formated_price_with_currency_code_symbol( $total_paid ); ?></span>
                        </td>
                        <td>
                            <span class="lrf-td-title"><?php _e( 'Due', 'wp-travel-engine' ); ?></span>
                            <span class="lrf-td-desc"><?php echo wp_travel_engine_get_formated_price_with_currency_code_symbol( $remaining_payment ); ?></span>
                        </td>
                        <td>
                            <span class="lrf-td-title"><?php _e( 'Total', 'wp-travel-engine' ); ?></span>
                            <span class="lrf-td-desc"><?php echo wp_travel_engine_get_formated_price_with_currency_code_symbol( $total_cost ); ?></span>
                        </td>
                        <td>
                            <a class="wpte-magnific-popup wpte-lrf-btn-transparent" href="#popup-content-<?php echo esc_attr( $booking ); ?>"><?php _e( 'View Detail', 'wp-travel-engine' ); ?></a>
                        </td>
                    </tr>
                    <div id="popup-content-<?php echo esc_attr( $booking ); ?>" class="white-popup mfp-hide">
                        <h5><?php echo sprintf( __( 'Booking Details #%1$s', 'wp-travel-engine' ), $booking ); ?></h5>
                        <h6><?php _e( 'Trip Information', 'wp-travel-engine' ); ?></h6>
                        <span>
                            <?php _e( 'Trip Name:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo isset( $booking_metas['place_order']['tname'] ) ? esc_html( $booking_metas['place_order']['tname'] ) : ''; ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'Trip Starting Date:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $booking_metas['place_order']['datetime'] ) ) ); ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'Travellers:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( $booking_metas['place_order']['traveler'] ); ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'Total Paid:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo wp_travel_engine_get_formated_price_with_currency_code_symbol( $total_paid ); ?>
                        </span>
                        <br/>
                        <span>
                            <?php _e( 'Due:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo wp_travel_engine_get_formated_price_with_currency_code_symbol( $remaining_payment ); ?>
                        </span>
                        <br/>
                        <span>
                            <?php _e( 'Total Cost:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo wp_travel_engine_get_formated_price_with_currency_code_symbol( $total_cost ); ?>
                        </span>
                        <h6><?php _e( 'Billing Information', 'wp-travel-engine' ); ?></h6>
                        <span>
                            <?php _e( 'First Name:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( $booking_metas['place_order']['booking']['fname'] ); ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'Last Name:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( $booking_metas['place_order']['booking']['lname'] ); ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'Email:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( $booking_metas['place_order']['booking']['email'] ); ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'Address:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( $booking_metas['place_order']['booking']['address'] ); ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'City:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( $booking_metas['place_order']['booking']['city'] ); ?>
                        </span>
                        <br>
                        <span>
                            <?php _e( 'Country:', 'wp-travel-engine' ); ?>
                        </span>
                        <span>
                            <?php echo esc_html( $booking_metas['place_order']['booking']['country'] ); ?>
                        </span>
                    </div>
                <?php endforeach;

                else :
                    _e( 'You have not made any bookings yet. Book Trips and it will be listed here', 'wp-travel-engine' );
            endif;    
            ?>
        </table>
        <div class="wpte-lrf-btn-wrap">
            <a target="_blank" class="wpte-lrf-btn" href="<?php echo esc_url( get_post_type_archive_link( 'trip' ) ); ?>"><?php _e( 'Book More Trips', 'wp-travel-engine' ); ?></a>
        </div>
    </div>
</div>
<?php
