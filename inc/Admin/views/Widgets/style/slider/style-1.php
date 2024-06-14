<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly.
?>
<section class="banner v2">	
			<div class="align-items-center">
				<?php if ( $settings['list'] ) : ?>
					<div class="hero-slide owl-carousel" 
					data-nav="<?php echo esc_attr( $settings['nav'] ); ?>" 
					data-control="<?php echo esc_attr( $settings['control'] ); ?>" 
					data-autoplay="<?php echo esc_attr( $settings['autoplay'] ); ?>"
					data-loop="<?php echo esc_attr( $settings['loop'] ); ?>"
					data-rtl="<?php echo esc_attr( $settings['rtl'] ); ?>"
					>
						<?php foreach ( $settings['list'] as $item ) { ?>
							<div class="item">
								<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="
													<?php
														printf(
															esc_attr__( '%s', 'themes-assistant' ),
															esc_attr( $settings['title'] )
														);
													?>
								" width="1920" height="750">
								<div class="ImageOverlay"></div>
								<div class="container">
									<div class="row">		
										<div class="col-lg-6 slide-box s1">
											<div class="content-box text-left boxShape v1">
												<span class="borderShape"></span>
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
															esc_html( $settings['content_txt'] )
														);
													?>
												</p>
												<a href="<?php echo esc_url( $item['link']['url'] ); ?>" class="btn ">
													<?php
														printf(
															esc_html__( '%s', 'themes-assistant' ),
															esc_html( $settings['button_text'] )
														);
													?>
												</a>
												<?php if ( $item['button_text'] ) { ?>
													<a class="video-btn" data-fancybox="true" href="<?php echo esc_url( $item['link2']['url'] ); ?>" aria-hidden="false">
														<i class="ti-control-play"></i>
														<?php
															printf(
																esc_html__( '%s', 'themes-assistant' ),
																esc_html( $settings['button_text2'] )
															);
														?>
													</a>
												<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>

					<?php } ?>
				</div>
					<?php
			endif;
				?>
		</div>
	</section> 