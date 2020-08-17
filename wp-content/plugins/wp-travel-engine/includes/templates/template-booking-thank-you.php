<?php
/**
 * Thank you page template after booking success.
 *
 * @package WP_Travel_Engine
 */
global $wte_cart;

$cart_items          = $wte_cart->getItems();
$cart_totals         = $wte_cart->get_total();
$date_format         = get_option( 'date_format' );
$wte_settings        = get_option( 'wp_travel_engine_settings' );
$extra_service_title = isset( $wte_settings['extra_service_title'] ) && ! empty( $wte_settings['extra_service_title'] ) ? $wte_settings['extra_service_title'] : __( 'Extra Services:', 'wp-travel-engine' );

if ( ! empty( $cart_items ) ) :

        $thankyou  = __('Thank you for booking the trip. Please check your email for confirmation.','wp-travel-engine');
        $thankyou .= __(' Below is your booking detail:','wp-travel-engine');
        $thankyou .= '<br>';

        if ( isset( $wte_settings['confirmation_msg'] ) && $wte_settings['confirmation_msg']!='' ) {
            $thankyou = $wte_settings['confirmation_msg'];
        }

        // Display thany-you message.
        echo wp_kses_post( $thankyou );
    ?>

        <div class="thank-you-container">
            <h3 class="trip-details"><?php echo esc_html__( 'Trip Details:', 'wp-travel-engine' ); ?></h3>
            <div class="detail-container">

                <?php if ( isset( $_GET['booking_id'] ) && ! empty( $_GET['booking_id'] ) ) : ?>

                    <div class="detail-item">
                        <strong class="item-label"><?php esc_html_e( 'Booking ID:', 'wp-travel-engine' ); ?></strong>
                        <span class="value"><?php echo esc_html( $_GET['booking_id'] ); ?></span>
                    </div>

                <?php endif;

                    foreach( $cart_items as $key => $cart_item ) :

                ?>
                    <div class="detail-item">
                        <strong class="item-label"><?php esc_html_e( 'Trip ID:', 'wp-travel-engine' ); ?></strong>
                        <span class="value"><?php echo esc_html( $cart_item['trip_id'] ); ?></span>
                    </div>

                    <div class="detail-item">
                        <strong class="item-label"><?php esc_html_e( 'Trip Name:', 'wp-travel-engine' ); ?></strong>
                        <span class="value"><?php echo esc_html( get_the_title( $cart_item['trip_id'] ) ); ?></span>
                    </div>

                    <?php
                        /**
                         * wte_thankyou_after_trip_name hook
                         * 
                         * @hooked wte_display_trip_code_thankyou - Trip Code Addon
                         */
                        do_action( 'wte_thankyou_after_trip_name', $cart_item['trip_id'] ); 
                    ?>

                    <div class="detail-item">
                        <strong class="item-label"><?php esc_html_e( 'Trip Cost:', 'wp-travel-engine' ); ?></strong>
                        <span class="value"><?php echo esc_html( wp_travel_engine_get_formated_price_with_currency( wp_travel_engine_get_actual_trip_price( $cart_item['trip_id'] ), null, true ) ); ?></span>
                    </div>

                    <div class="detail-item">
                        <strong class="item-label"><?php esc_html_e( 'Trip start date:', 'wp-travel-engine' ); ?></strong>
                        <span class="value"><?php echo esc_html( date_i18n( $date_format, strtotime( $cart_item['trip_date'] ) ) ); ?></span>
                    </div>

                    <?php
                        if( isset( $cart_item['multi_pricing_used'] ) && $cart_item['multi_pricing_used'] ) :

                            foreach( $cart_item['pax'] as $pax_key => $pax ) :

                                if ( '0' == $pax || empty( $pax ) ) continue;

                                $pax_label = wte_get_pricing_label_by_key_invoices( $cart_item['trip_id'], $pax_key, $pax  );
                    ?>
                                <div class="detail-item">
                                    <strong class="item-label"><?php echo esc_html( $pax_label ); ?></strong>
                                    <span class="value"><?php echo esc_html( $pax ); ?> X <?php echo wp_kses_post( wp_travel_engine_get_formated_price_with_currency( $cart_item['pax_cost'][ $pax_key ], null, true ) ); ?></span>
                                </div>

                    <?php   endforeach;
                        else :
                    ?>
                            <div class="detail-item">
                                <strong class="item-label"><?php esc_html_e( 'Number of Traveller(s):', 'wp-travel-engine' ); ?></strong>
                                <span class="value"><?php echo esc_html( $cart_item['pax']['adult'] ); ?> X <?php echo wp_kses_post( wp_travel_engine_get_formated_price_with_currency( $cart_item['pax_cost']['adult'], null, true ) ); ?></span>
                            </div>

                            <?php if ( isset( $cart_item['pax']['child'] ) && 0 != $cart_item['pax']['child'] ) : ?>

                                <div class="detail-item">
                                    <strong class="item-label"><?php esc_html_e( 'Number of Child Traveller(s):', 'wp-travel-engine' ); ?></strong>
                                    <span class="value"><?php echo esc_html( $cart_item['pax']['child'] ); ?> X <?php echo wp_kses_post( wp_travel_engine_get_formated_price_with_currency( $cart_item['pax_cost']['child'], null, true ) ); ?></span>
                                </div>

                            <?php endif;

                        endif;

                    if ( isset( $cart_item['trip_extras'] ) && ! empty( $cart_item['trip_extras'] ) ) : ?>

                        <div class="detail-item">
                            <strong class="item-label"><?php echo esc_html( $extra_service_title ) ?></strong>
                            <span class="value">
                        <?php foreach ( $cart_item['trip_extras'] as $trip_extra ) : ?>
                            <div>
                            <?php
                                $qty = $trip_extra['qty'];
                                $extra_service = $trip_extra['extra_service'];
                                $price = $trip_extra['price'];
                                $cost = $qty * $price;
                                if ( 0 === $cost ) continue;
                                $formattedCost = wp_travel_engine_get_formated_price_with_currency( $cost, null, true );
                                $output = "{$qty} X {$extra_service} = {$formattedCost}";
                                echo esc_html( $output );
                            ?>
                            </div>
                        <?php endforeach; ?>
                            </span>
                        </div>

                    <?php 

                    endif;

                    $cart_discounts = $wte_cart->get_discounts();
                    if(!empty($cart_discounts) || sizeof($cart_discounts) !== 0):
                    $trip_total = $wte_cart->get_total();
                    $code = isset($wte_settings['currency_code']) ? $wte_settings['currency_code']: 'USD';
                    $calculated_total = isset( $trip_total['cart_total'] ) && ! empty( $trip_total['cart_total'] ) ? intval($trip_total['cart_total']) : 0;
                    foreach( $cart_discounts as $discount_key => $discount_item ) { 
                    ?>
                    <div class="detail-item">
                        <strong class="item-label">
                            <?php esc_html_e( 'Coupon Discount :', 'wp-travel-engine' );?> 
                            <div><?php echo esc_attr($discount_item['name']).' - ';?><?php echo isset($discount_item ['type']) && 'percentage' === $discount_item ['type']?'('.esc_attr($discount_item ['value']).'%)':'('.wp_travel_engine_get_formated_price_with_currency(esc_attr($discount_item['value'])).')'; ?>
                            </div>
                        </strong>
                        <span class="value">
                            <?php 
                            if ( 'fixed' === $discount_item ['type'] ) {
                                $new_tcost = $calculated_total - $discount_item ['value'];
                            echo wp_travel_engine_get_formated_price_with_currency( $discount_item['value'], null, true );
                            }else if('percentage' === $discount_item ['type'] ){
                                $discount_amount_actual = number_format( ( ( $calculated_total * $discount_item ['value'] ) / 100 ), '2', '.', '');
                                $new_tcost = $calculated_total - $discount_amount_actual;
                                echo wp_travel_engine_get_formated_price_with_currency( $discount_amount_actual, null, true );
                            }else{
                                $new_tcost = $calculated_total;
                            }
                        } ?>
                        </span>
                    </div>
                    <?php
                    endif;

                    if ( wp_travel_engine_is_trip_partially_payable( $cart_item['trip_id'] ) ) :

                    $booking = get_post_meta( $_GET['booking_id'], 'wp_travel_engine_booking_setting', true );
                    $due     = isset( $booking['place_order']['due'] ) ? $booking['place_order']['due'] : 0;
                    $paid    = isset( $booking['place_order']['cost'] ) ? $booking['place_order']['cost'] : 0;

                        if( 0 < floatval( $due ) && $paid != floatval( $due + $paid ) ) :

                        ?>
                            <div class="detail-item">
                                <strong class="item-label"><?php esc_html_e( 'Total Paid:', 'wp-travel-engine' ); ?></strong>
                                <span class="value"><?php echo esc_html( wp_travel_engine_get_formated_price_with_currency( $paid, null, true ) ); ?></span>
                            </div>

                            <div class="detail-item">
                                <strong class="item-label"><?php esc_html_e( 'Due:', 'wp-travel-engine' ); ?></strong>
                                <span class="value"><?php echo esc_html( wp_travel_engine_get_formated_price_with_currency( $due, null, true ) ); ?></span>
                            </div>

                        <?php

                        endif;

                    endif;

                    endforeach;
                ?>
                    <div class="detail-item">
                        <strong class="item-label"><?php esc_html_e( 'Total Cost:', 'wp-travel-engine' ); ?></strong>
                        <span class="value">
                            <?php if(!empty($cart_discounts) || sizeof($cart_discounts) !== 0){ 
                                echo esc_html( wp_travel_engine_get_formated_price_with_currency( $new_tcost, null, true ) );
                            }else{
                                echo esc_html( wp_travel_engine_get_formated_price_with_currency( $cart_totals['cart_total'], null, true ) );
                            } ?>
                        </span>
                    </div>

            </div>
        </div>
    <?php

    else :

        $thank_page_msg = __('Sorry, you may not have confirmed your booking. Please fill up the form and confirm your booking. Thank you.','wp-travel-engine');

        $thank_page_error = apply_filters('wp_travel_engine_thankyou_page_error_msg',$thank_page_msg);

        echo wp_kses_post( $thank_page_error );

endif;

// Clear cart data.
$wte_cart->clear();
