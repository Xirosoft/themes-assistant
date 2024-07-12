<?php use Elementor\Icons_Manager; ?>
<section class="feature-sec">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="feature-process">
                        <div class="main-content text-left">
                            <div class="item-content">
                                <span class="tagline"><?php echo esc_html__($settings['top_title'], 'themes-assistant'); ?></span>
                            <h2><?php echo esc_html__($settings['title'], 'themes-assistant'); ?></h2>
                            <p><?php echo esc_html__( $settings['content'], 'themes-assistant'); ?></p>
                        </div>
                        <div class="item-btn">
                                <a 
                                    href="<?php echo esc_url($settings['btn_link']['url']); ?>"
                                    class="btn btn-round btn-slide-up">
                                    <?php echo esc_html__($settings['btn_text'], 'themes-assistant'); ?>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (!empty($lists)): ?>
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
                                        <img src="<?php echo esc_url($list['image']['url']); ?>" alt="<?php echo esc_html($list['title']);?>" class="img-icon" height="25" width="25">
                                </span>
                                    <?php endif;?>
                                    <div class="feature-content">
                                        <h3><?php echo esc_html($list['title']);?></h3>
                                        <p><?php echo esc_html($list['text']);?></p>
                                </div>
                            </div>
                                <?php if($list['link']['url']): ?>
                        </a>
                            <?php endif; ?>
                    </div>
                        <?php endforeach; ?>
                </div>
                    <?php endif; ?>
            </div>
        </div>
</section>