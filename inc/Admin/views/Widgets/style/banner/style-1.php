<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.
?>
<section class="banner a">
	<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 order-1 order-md-0">
					<div class="content-box">
						<span class="tagline">
							<?php
								printf(
									esc_html__( '%s', 'themes-assistant' ),
									esc_html( $settings['top_title'] )
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
						<a href="<?php echo esc_url( $settings['link']['url'] ); ?>" class="btn">
							<?php
								printf(
									esc_html__( '%s', 'themes-assistant' ),
									esc_html( $settings['button_text'] )
								);
								?>
						</a>
					<?php if ( $settings['video_btn_text'] != '' ) : ?>
						<a class="video-btn" data-fancybox="true" href="<?php echo esc_url( $settings['video_btn_link']['url'] ); ?>" aria-hidden="false">
							<i class="ti-control-play"></i>
							<?php
								printf(
									esc_html__( '%s', 'themes-assistant' ),
									esc_html( $settings['video_btn_text'] )
								);
							?>
						</a>
					<?php endif; ?>
				</div>
			</div>
				<div class="col-md-6 order-0 order-md-1">
					<div class="">
						<div class="">
							<?php if ( $settings['image']['url'] ) : ?>
							<figure class="ban-img">

								<img 
									fetchPriority="high" 
									src="<?php esc_url( $settings['image']['url'] ); ?>" 
									alt="
										<?php
										printf(
											esc_html__( '%s', 'themes-assistant' ),
											esc_html( $settings['top_title'] )
										)
										?>
																			" 
									width="530"
									height="530"
								/>
						</figure>
							<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>