<div class="ata-table-area">
    <div class="ata-table-row">
        <ul class="ata-nav-tabs" id="ata-tabs" role="tablist">
            <?php 
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            foreach ($days as $index => $day) : 
                $lowercase_day = strtolower($day);
            ?>
                <li class="ata-nav-item" role="presentation">
                    <button class="ata-nav-link <?php echo $index === 0 ? 'active' : ''; ?>" 
                            id="<?php echo $lowercase_day; ?>-tab" 
                            data-tab="<?php echo $lowercase_day; ?>" 
                            role="tab" 
                            aria-controls="<?php echo $lowercase_day; ?>" 
                            aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                        <span><?php echo esc_html__($day, 'themes-assistant'); ?></span>
                    </button>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="ata-tab-content" id="ata-tabContent">
            <?php 
            foreach ($days as $index => $day) : 
                $lowercase_day = strtolower($day);
                $list_key = $lowercase_day . 'list';
            ?>
                <div class="ata-tab-pane <?php echo $index === 0 ? 'active' : ''; ?>" 
                     id="<?php echo $lowercase_day; ?>" 
                     role="tabpanel" 
                     aria-labelledby="<?php echo $lowercase_day; ?>-tab">
                    <div class="ata-table-responsive">
                        <table class="ata-table">
                            <thead>
                                <tr>
                                    <th><?php printf(esc_html__('%s', 'themes-assistant'), esc_html($settings['fcolname'])); ?></th>
                                    <th><?php printf(esc_html__('%s', 'themes-assistant'), esc_html($settings['scolname'])); ?></th>
                                    <th><?php printf(esc_html__('%s', 'themes-assistant'), esc_html($settings['tcolname'])); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($settings[$list_key])) :
                                    foreach ($settings[$list_key] as $item) :
                                ?>
                                        <tr>
                                            <td><?php printf(esc_html__('%s', 'themes-assistant'), esc_html($item['start_time_value'])); ?> - <?php printf(esc_html__('%s', 'themes-assistant'), esc_html($item['end_time_value'])); ?></td>
                                            <td><?php printf(esc_html__('%s', 'themes-assistant'), esc_html($item['class_type'])); ?></td>
                                            <td>
                                                <div class="ata-avatar">
                                                    <img src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="avatar">
                                                    <span><?php printf(esc_html__('%s', 'themes-assistant'), esc_html($item['coach_name'])); ?></span>
                                                </div>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>