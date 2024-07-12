<div class="col-md-4 blog-style-2">

    <div class="blog-post-item <?php echo $settings['animation']; ?>">

        <div class="blog-feature-thumb">

            <?php the_post_thumbnail('post-thumbnail', array('class' => 'post-feature-thumb')); ?>

        </div>

        <div class="blog-post-body">

            <div class="blog-post-meta">

                <i class="ti-user"></i> <?php the_author(); ?> &nbsp;

                <i class="ti-alarm-clock"></i> <?php the_time( 'd M, Y' ); ?>

            </div>

            <h3><a href="<?php echo esc_url( get_permalink() );  ?>" area-label="<?php the_title(); ?>" ><?php the_title(); ?></a></h3>

            <p><?php echo esc_html__( borax_plugin_excerpt(19), 'themes-assistant'); ?></p>

        </div>

    </div>

</div>





            