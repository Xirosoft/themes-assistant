<div class="background_animation">
<?php 
    $i = 1;
    foreach ( $settings['list'] as $item ) {
    1
            
            ?>
                <div class=" el-animation-items <?php echo $item['shape_rotate']; ?>  <?php if ( 'yes' === $item['shape_shadow'] ) { echo 'ImgShadow'; }  ?> ael el<?php echo $i++ ?>" 
                    style="
                        width: <?php echo $item['shapeWidth']['size'].$item['shapeWidth']['unit']; ?>; 
                        height: <?php echo $item['shapeHeight']['size'].$item['shapeHeight']['unit']; ?>;
                        border-radius: <?php echo $item['shapeRound']['size'].$item['shapeRound']['unit']; ?>;
                    "
                >
                <div class="<?php echo $item['shape_type']; ?>">
                    <div class="elements" style="background-color: <?php echo $item['shape_color']; ?>"></div>
                </div>
            </div>
        <?php
    }
?>
</div>