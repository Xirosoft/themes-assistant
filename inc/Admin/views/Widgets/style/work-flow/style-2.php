<?php use Elementor\Icons_Manager; ?>
<?php
$lists        = $settings[ 'list' ];
if (!empty($lists)): ?>
    <section class="process-sec">
        <div class="working-process v2">
            <?php foreach ($lists as $list): ?>
            <?php if($list['link']['url']): ?>
            <a href="<?php echo esc_url($list['link']['url']);?>">
                <?php endif; ?>
                <div class="process-item text-center">
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
                        <img src="<?php echo esc_url($list['image']['url']); ?>" alt="<?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $list['title'] ) ); ?>" class="img-icon" width="50" height="50">
                </span>
                    <?php endif;?>
                    <div class="process-content">
                        <h3><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $list['title'] ) ); ?></h3>
                        <p><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( wp_kses_post( $list['text']) ) ); ?></p>
                </div>
            </div>
                <?php if($list['link']['url']): ?>
        </a>
            <?php endif; ?>
            <?php endforeach; ?>
            <div class="border-icon">
                <i class="ti-angle-right"></i>
        </div>
            <div class="border-icon-2">
                <i class="ti-angle-right"></i>
        </div>
            <svg width="1175.5" height="145.5">
                <g fill="none" stroke-width="2">
                    <path class="dashed1" stroke="rgba(17, 17, 17, 0.2)" stroke-dasharray="6, 6" stroke-linecap="butt"
                        stroke-linejoin="miter"
                        d="M4.874,5.310 C4.874,5.310 160.876,216.949 377.890,107.556 C377.890,107.556 612.318,-26.577 759.317,91.500 C759.317,91.500 971.500,225.630 1169.809,1.491">
                    </path>
                    <path class="dashed2" stroke="#ddd" stroke-dasharray="6, 6" stroke-linecap="butt"
                        stroke-linejoin="miter"
                        d="M4.874,5.310 C4.874,5.310 160.876,216.949 377.890,107.556 C377.890,107.556 612.318,-26.577 759.317,91.500 C759.317,91.500 971.500,225.630 1169.809,1.491">
                    </path>
            </g>
        </svg>
    </div>
</section>
    <?php endif; ?>