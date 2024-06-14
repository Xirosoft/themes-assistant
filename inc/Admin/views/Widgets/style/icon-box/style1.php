<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.
?>
<?php use Elementor\Icons_Manager; ?>
<div class="iconBox 
<?php
echo esc_attr( $settings['select_style'] );
echo ' ' . esc_attr( $settings['animation'] );
?>
">
	<div class="icon-heading">
		<?php if ( $settings['icon_type'] == 'icon' ) : ?>
			<span class="icon">
				<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
		</span>
			<?php elseif ( $settings['icon_type'] == 'iconclass' ) : ?>
			<span class="icon">
				<i class="<?php echo esc_attr( $settings['iconclass'] ); ?>"></i>
		</span>
			<?php elseif ( $settings['icon_type'] == 'image' ) : ?>
			<span class="icon">
				<img 
					src="<?php echo esc_url( $settings['image']['url'] ); ?>" 
					alt="
						<?php
							printf(
								esc_attr__( '%s', 'themes-assistant' ),
								esc_attr( $settings['title'] )
							);
						?>
						" 
					class="img-icon" 
					width="40" 
					height="40" 
				/>
		</span>
		<?php endif; ?>
		<a href="<?php echo esc_url( $settings['link']['url'] ); ?>" class="flex-grow-1 flex-shrink-1">
			<h3>
				<?php
					printf(
						esc_html__( '%s', 'themes-assistant' ),
						esc_html( $settings['title'] )
					);
					?>
			</h3>
		</a>
	</div>
	<p>
		<?php
			printf(
				esc_html__( '%s', 'themes-assistant' ),
				esc_html( $settings['content'] )
			);
			?>
	</p>
</div>