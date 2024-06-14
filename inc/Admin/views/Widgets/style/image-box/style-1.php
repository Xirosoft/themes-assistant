<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.
?>

<article class="post service-post service-image-height 
<?php
echo esc_attr( $settings['content_align'] );
echo ' ' . esc_attr( $settings['animation'] );
echo ' ' . esc_attr( $settings['background_shape'] );
?>
borax-img-box">

	<div class="">

		<div class="">
			<img 
				src="<?php echo esc_url( $settings['box_image']['url'] ); ?>" 
				alt="
				<?php
					printf(
						esc_attr__( '%s', 'themes-assistant' ),
						esc_attr( $settings['title'] )
					);
					?>
				"
				width="<?php echo esc_attr( $settings['box_image_dimension']['width'] ); ?>"
				height="<?php echo esc_attr( $settings['box_image_dimension']['height'] ); ?>"
			>
		</div>

	</div>

	<?php if ( $settings['title'] ) : ?>

	<h2>
		<a href="<?php echo esc_url( $settings['link']['url'] ); ?>">
			<?php
				printf(
					esc_html__( '%s', 'themes-assistant' ),
					esc_html( $settings['title'] )
				);
			?>
		</a>
	</h2>

	<?php endif; ?>

	<?php echo wp_kses_post( $settings['content'] ); ?>

	<?php if ( $settings['button_text'] ) : ?>

		<a href="<?php echo esc_url( $settings['link']['url'] ); ?>"class="btn ">
			<?php
				printf(
					esc_html__( '%s', 'themes-assistant' ),
					esc_html( $settings['button_text'] )
				);
			?>
		</a>

	<?php endif; ?>

</article>