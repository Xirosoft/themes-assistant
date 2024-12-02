<?php use Elementor\Icons_Manager; ?>
<div class="sec-heading m-auto text-<?php echo esc_attr( $settings['align'] ); ?>">
			<?php
			if ( ! empty( $settings['title_image']['url'] ) ) {
				echo '<img src="' . esc_url( $settings['title_image']['url'] ) . '" alt="' . wp_kses_post( $settings['title'] ) . '" width="50" height="50">';
			}
			?>
			<?php if ( ! empty( $settings['top_title'] ) ) { ?>
				<span class="tagline">
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( $settings['top_title'] )
                        );
                    ?>
                </span>
				<?php
			}
			if ( ! empty( $settings['title'] ) ) {
				?>
				<h2 class="sec-title">
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( $settings['title'] )
                        );
                    ?>
                </h2>
				<?php
			}
			if ( 'icon' === $settings['icon_type'] ) :
				?>
				<span class="divider_icon">
					<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
				</span>
			<?php elseif ( 'iconclass' === $settings['icon_type'] ) : ?>
				<span class="divider_icon">
					<i class="<?php echo esc_attr( $settings['iconclass'] ); ?>"></i>
				</span>
			<?php elseif ( 'image' === $settings['icon_type'] ) : ?>
				<span class="divider_icon">
					<img src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="<?php echo wp_kses_post( $settings['title'] ); ?>" class="img-icon" width="50" height="50">
				</span>
				<?php
			endif;
			if ( ! empty( $settings['description'] ) ) {
				?>
				<div class="paragraph">
                    <?php
                        printf(
                            esc_html__( '%s', 'themes-assistant' ),
                            esc_html( wp_kses_post( $settings['description']) )
                        );
                    ?>    
                </div>
			<?php } ?>
		</div>