<?php 
    use Elementor\Icons_Manager; 
    $lists  = $settings[ 'list' ];
?>
<section class="feature-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="feature-process">
                    <div class="main-content text-left">
                        <div class="item-content">
                            <span class="tagline">
                                <?php
                                    printf(
                                        esc_html__( '%s', 'themes-assistant' ),
                                        esc_html( $settings['img_title'] )
                                    );
                                ?>
                            </span>
                            <h2>
                                <?php
                                    printf(
                                        esc_html__( '%s', 'themes-assistant' ),
                                        esc_html( $settings['title'] )
                                    );
                                ?>
                            </h2>
                            <p>
                                <?php
                                    printf(
                                        esc_html__( '%s', 'themes-assistant' ),
                                        esc_html( $settings['content'] )
                                    );
                                ?>
                            </p>
                        </div>
                        <div class="item-btn">
                            <a 
                                href="<?php echo esc_url($settings['btn_link']['url']); ?>"
                                class="btn btn-round btn-slide-up">
                                    <?php
                                        printf(
                                            esc_html__( '%s', 'themes-assistant' ),
                                            esc_html( $settings['btn_text'] )
                                        );
                                    ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if (!empty($lists)): ?>
                <div class="col-lg-6">
                    <div class="row">
                        <?php foreach ($lists as $list): ?>
                            <div class="feature-process col-md-6">
                                <?php if($list['link']['url']): ?>
                                    <a href="<?php echo esc_url($list['link']['url']);?>">
                                    <?php endif; ?>
                                        <div class="feature-item text-center">
                                            <?php if( $list['icon_type'] == 'icon'):?>
                                                <span class="icon-box">
                                                    <?php Icons_Manager::render_icon( $list['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </span>
                                            <?php elseif( $list['icon_type'] == 'iconclass'):?>
                                                <span class="icon-box">
                                                    <i class="<?php echo esc_html__($list['iconclass'], 'themes-assistant'); ?>"></i>
                                                </span>
                                            <?php elseif( $list['icon_type'] == 'image'):?>
                                                <span class="icon-box">
                                                    <img 
                                                        src="<?php echo esc_url($list['image']['url']); ?>" 
                                                        alt="
                                                            <?php
                                                                printf(
                                                                    esc_html__( '%s', 'themes-assistant' ),
                                                                    esc_html( $list['title'] )
                                                                );
                                                            ?>
                                                        " 
                                                        class="img-icon" 
                                                        height="25" 
                                                        width="25"
                                                    />
                                                </span>
                                            <?php endif;?>
                                            <div class="feature-content">
                                                <h3>
                                                    <?php
                                                        printf(
                                                            esc_html__( '%s', 'themes-assistant' ),
                                                            esc_html( $list['title'] )
                                                        );
                                                    ?>
                                                <p>
                                                    <?php
                                                        printf(
                                                            esc_html__( '%s', 'themes-assistant' ),
                                                            esc_html( $list['text'] )
                                                        );
                                                    ?>
                                            </div>
                                        </div>
                                    <?php if($list['link']['url']): ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>