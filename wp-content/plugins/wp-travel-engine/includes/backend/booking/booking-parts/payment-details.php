<?php 
/**
 * Payment Details 
 */
// Payment Details.
$payment_status  = get_post_meta( $post->ID, 'wp_travel_engine_booking_payment_status', true );
$payment_gateway = get_post_meta( $post->ID, 'wp_travel_engine_booking_payment_gateway', true );
$payment_details = get_post_meta( $post->ID, 'wp_travel_engine_booking_payment_details', true );
?>
<div class="wpte-block wpte-col3">
    <div class="wpte-title-wrap">
        <h4 class="wpte-title"><?php _e( 'Payment Details', 'wp-travel-engine' ); ?></h4>
        <div class="wpte-button-wrap wpte-edit-bkng">
            <a href="#" class="wpte-btn-transparent wpte-btn-sm">
                <i class="fas fa-pencil-alt"></i>
                <?php _e( 'Edit', 'wp-travel-engine' ); ?>
            </a>
        </div>
    </div>
    <div class="wpte-block-content">
        <ul class="wpte-list">
            <li>
                <b><?php _e( 'Payment Status', 'wp-travel-engine' ); ?></b>
                <span class="wpte-payment-status"><?php echo esc_html( ucfirst( $payment_status ) ); ?></span>
            </li>
            <li>
                <b><?php _e( 'Payment Gateway', 'wp-travel-engine' ); ?></b>
                <span><?php echo ! empty( $payment_gateway ) ? esc_html( $payment_gateway ) : 'N/A'; ?></span>
            </li>
            <?php 
                if ( ! empty( $payment_details ) && is_array( $payment_details ) ) : 
                    foreach( $payment_details as $key => $value ) :
                    ?>
                        <li>
                            <b><?php echo esc_html( $value['label'] ); ?></b>
                            <span><?php echo esc_html( $value['value'] ); ?></span>
                        </li>
                    <?php
                    endforeach;
                endif;
            ?>
        </ul>
    </div>
    <div style="display:none;" class="wpte-block-content-edit edit-payment-info">
        <ul class="wpte-list">
            <li>
                <b><?php _e( 'Payment Status', 'wp-travel-engine' ); ?></b>
                <span class="wpte-payment-status">
                <div class="wpte-field wpte-select">
                    <select name="wp_travel_engine_booking_payment_status" id="wp_travel_engine_booking_payment-status">    
                        <?php 
                            $payment_status_arr = array(
                                'completed' => __( 'Completed', 'wp-travel-engine' ),
                                'cancelled' => __( 'Cancelled', 'wp-travel-engine' ),
                                'pending'   => __( 'Pending', 'wp-travel-engine' ),
                                'refunded'  => __( 'Refunded', 'wp-travel-engine' ),
                                'abandoned' => __( 'Abandoned', 'wp-travel-engine' )
                            );
                            foreach( $payment_status_arr as $key => $status ) {
                                $selected = selected( $payment_status, $key, false );
                                echo "<option " . $selected . " value='{$key}'>{$status}</option>";
                            }
                        ?>
                    </select>
                    </div>
                </span>
            </li>
            <li>
                <b><?php _e( 'Payment Gateway', 'wp-travel-engine' ); ?></b>
                <span>
                <div class="wpte-field wpte-text">
                    <input type="text" name="wp_travel_engine_booking_payment_gateway" value="<?php echo esc_attr( $payment_gateway ); ?>" >
                    </div>
                    </span>
            </li>
            <?php 
                if ( ! empty( $payment_details ) && is_array( $payment_details ) ) : 
                    foreach( $payment_details as $key => $value ) :
                    ?>
                        <li>
                            <b>
                            <div class="wpte-field wpte-text">
                                <input type="text" name="wp_travel_engine_booking_payment_details[<?php echo esc_attr( $key ) ?>][label]" value="<?php echo esc_html( $value['label'] ); ?>" >
                            </div>    
                            </b>
                            <span>
                            <div class="wpte-field wpte-text">
                                <input type="text" name="wp_travel_engine_booking_payment_details[<?php echo esc_attr( $key ) ?>][value]" value="<?php echo esc_html( $value['value'] ); ?>" >
                                </div>
                                </span>
                        </li>
                    <?php
                    endforeach;
                endif;
            ?>
        </ul>
    </div>
</div> <!-- .wpte-block -->