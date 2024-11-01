<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>


<?php if ('yes' === $settings[$preset.'_show_connector']) : ?>
    <div class="divider-counter">
        <span></span>
    </div>
<?php endif; ?>

<div data-number-format="<?php echo esc_attr($settings['numbers_format' ]); ?>" class="wha-counter-box">

    <div class="wha-counter">
        <div class="wha-counter-inner">
            <div class="wha-counter-icon">
                <div class="wha-icon">
                    <div class="wha-icon-inner">
                        <div class="wha-wrapper-icon-inner">
                            <?php \Elementor\Icons_Manager::render_icon($settings[$preset.'_icon'], ['aria-hidden' => 'true']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wha-inner-wrapper <?php echo ('yes' === $settings[$preset.'_vertical_position_description'])?'wha-top-text':''?>">
                <div class="wha-counter-number">
                    <div class="wha-counter-odometer odometer" data-to="<?php echo esc_attr($settings[$preset.'_ending_number' ]); ?>">
                        <?php if ('yes' !== $settings[$preset.'_animation_enabled']) : ?>
                            <?php echo $settings[$preset.'_ending_number' ]; ?>
                        <?php else: ?>
                            <?php echo $settings[$preset.'_starting_number' ]; ?>
                        <?php endif; ?>
                    </div>
                    <?php if(!empty($settings[$preset.'_number_suffix' ])):?>
                        <div class="wha-counter-suffix <?php echo ('yes' === $settings[$preset.'_spacing_suffix'])?'wha-counter-suffix-spacing':''?>">
                            <?php echo esc_html($settings[$preset.'_number_suffix' ]); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="wha-counter-text">
                    <?php echo (!empty($settings[$preset.'_description' ])) ? esc_html($settings[$preset.'_description' ]) : ''; ?>
                </div>
            </div>
        </div>
    </div>

    <?php

        $link = $this->get_link_url( $settings );

        if ( $link ) : ?>

            <?php $this->add_link_attributes( 'link', $link ); ?>

            <a class="wha-counter-link" <?php echo ($this->get_render_attribute_string( 'link' )) ?>></a>

    <?php endif; ?>

</div>








