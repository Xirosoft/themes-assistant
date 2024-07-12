<div class="col-md-4">
        <article id="post-<?php the_ID(); ?>" <?php post_class(array('post el-blog-post v5', $content_align, $settings['animation'] )); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
            <div class="post-img">
                <div class="img-wrap">
                    <?php the_post_thumbnail('post-thumbnail', array('class' => 'borax-el-thumbnail')); ?>
                </div>
                <div class="date-box">
                    <p class="month"><?php the_time( 'M' ); ?></p>
                    <p class="day"><?php the_time( 'd' ); ?></p>
                </div>
            </div>
            <?php endif; ?>

            <div class="post-content-area p-3">
                
                <div class="entry-meta">
                    <span>
                    <i class="ti-user"></i> <?php ucfirst(the_author()); ?> &nbsp;&nbsp;<i
                            class="ti-bookmark"></i>
                        <?php $categories = get_the_category(); 
                    if ( ! empty( $categories ) ) {
                            echo esc_html( $categories[0]->name );   
                    } ?>
                </span>
            </div><!-- .entry-meta -->
                <hr>
                <h3><a href="<?php echo esc_url( get_permalink() );  ?>"><?php the_title(); ?></a></h3>
                <p><?php echo esc_html__( borax_plugin_excerpt(19), 'themes-assistant'); ?></p>
                <a href="<?php echo esc_url( get_permalink() );  ?>"  title="<?php echo esc_html__( borax_plugin_excerpt(10), 'themes-assistant'); ?>" class="btn">
                    <?php esc_html_e($settings['see_more_text'], 'themes-assistant') ?>
                    <i class="ti-arrow-right"></i>
                </a>
            </div>
    </article>
</div>