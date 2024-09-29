<?php 
    use Elementor\Icons_Manager; 
?>

<div class="contact">
    <!-- Address -->
    <address>
        <?php if ($settings['address_icon_type'] == 'address_icon') : ?>
            <span class="icon">
                <?php Icons_Manager::render_icon($settings['address_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php elseif ($settings['address_icon_type'] == 'address_iconclass') : ?>
            <span class="icon">
                <i class="<?php echo esc_attr($settings['address_iconclass']); ?>"></i>
            </span>
        <?php elseif ($settings['address_icon_type'] == 'address_image') : ?>
            <span class="icon">
                <img src="<?php echo esc_url($settings['address_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['a_title'] ) ); ?>" class="img-icon" width="30" height="30">
            </span>
        <?php endif; ?>
        <h5>
            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['a_title'] ) ); ?>
        </h5>
        <p>
            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['a_text'] ) ); ?>
        </p>
    </address>
    
    <!-- E-mail  -->
    <address>
        <?php if ($settings['Phone_icon_type'] == 'Phone_icon') : ?>
            <span class="icon">
                <?php Icons_Manager::render_icon($settings['Phone_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php elseif ($settings['Phone_icon_type'] == 'Phone_iconclass') : ?>
            <span class="icon">
                <i class="<?php echo esc_attr($settings['Phone_iconclass']); ?>"></i>
            </span>
        <?php elseif ($settings['Phone_icon_type'] == 'Phone_image') : ?>
            <span class="icon">
                <img src="<?php echo esc_url($settings['Phone_image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['p_title'] ) ); ?>" class="img-icon" width="30" height="30">
            </span>
        <?php endif; ?>

        <h5>
            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['p_title'] ) ); ?>
        </h5>
        <a href="mailto:<?php echo esc_url($settings['p_text1']); ?>">
            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['p_text1'] ) ); ?>
        </a><br>
        <a href="mailto:<?php echo esc_url($settings['p_text2']); ?>">
            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['p_text2'] ) ); ?>
        </a>
    </address>

    <!-- Phone number -->
    <address>
        <?php if ($settings['Email_icon_type'] == 'Email_icon') : ?>
            <span class="icon">
                <?php Icons_Manager::render_icon($settings['Email_icon'], ['aria-hidden' => 'true']); ?>
            </span>
        <?php elseif ($settings['Email_icon_type'] == 'Email_iconclass') : ?>
            <span class="icon">
                <i class="<?php echo esc_attr($settings['Email_iconclass']); ?>"></i>
            </span>
        <?php elseif ($settings['Email_icon_type'] == 'Email_image') : ?>
            <span class="icon">
                <img src="<?php echo esc_url($settings['Email_image']['url']); ?>" alt="<<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['e_title'] ) ); ?>" class="img-icon" width="30" height="30">
            </span>
        <?php endif; ?>

        <h5>
            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['e_title'] ) ); ?>
        </h5>
        <a href="<?php echo esc_attr($settings['e_text1']); ?>">
            <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['e_text1'] ) ); ?>
        </a><br>
        <a href="<?php echo esc_url($settings['e_text2']) ?>">
        <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['a_text'], ) ); ?>
        </a>
    </address>
</div>