<div class="table-area">
    <div class="table-row">
        <ul class="nav nav-tabs nav-pills flex-column flex-sm-row mb-4" id="pills-tab" role="tablist">
            <li class="nav-item flex-sm-fill text-center" role="presentation">
                <a class="nav-link active" id="monday-tab" data-toggle="pill" href="#monday" role="tab" aria-controls="monday" aria-selected="true"><span><?php echo esc_html__('Monday', 'themes-assistant'); ?> </span></a>
            </li>
            <li class="nav-item flex-sm-fill text-center" role="presentation">
                <a class="nav-link" id="tuesday-tab" data-toggle="pill" href="#tuesday" role="tab" aria-controls="tuesday" aria-selected="false"><span><?php echo esc_html__('Tuesday', 'themes-assistant'); ?> </span></a>
            </li>
            <li class="nav-item flex-sm-fill text-center" role="presentation">
                <a class="nav-link" id="wednesday-tab" data-toggle="pill" href="#wednesday" role="tab" aria-controls="wednesday" aria-selected="false"><span><?php echo esc_html__('Wednesday', 'themes-assistant'); ?> </span></a>
            </li>
            <li class="nav-item flex-sm-fill text-center" role="presentation">
                <a class="nav-link" id="thursday-tab" data-toggle="pill" href="#thursday" role="tab" aria-controls="thursday" aria-selected="false"><span><?php echo esc_html__('Thursday', 'themes-assistant'); ?> </span></a>
            </li>
            <li class="nav-item flex-sm-fill text-center" role="presentation">
                <a class="nav-link" id="friday-tab" data-toggle="pill" href="#friday" role="tab" aria-controls="friday" aria-selected="false"><span><?php echo esc_html__('Friday', 'themes-assistant'); ?> </span></a>
            </li>
            <li class="nav-item flex-sm-fill text-center" role="presentation">
                <a class="nav-link" id="saturday-tab" data-toggle="pill" href="#saturday" role="tab" aria-controls="saturday" aria-selected="false"><span><?php echo esc_html__('Saturday', 'themes-assistant'); ?> </span></a>
            </li>
            <li class="nav-item flex-sm-fill text-center" role="presentation">
                <a class="nav-link" id="sunday-tab" data-toggle="pill" href="#sunday" role="tab" aria-controls="sunday" aria-selected="false"><span><?php echo esc_html__('Sunday', 'themes-assistant'); ?> </span></a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="monday" role="tabpanel" aria-labelledby="monday-tab">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-skew mb-0">
                        <thead class="bg-white">
                            <tr>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['fcolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['scolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['tcolname'] ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($settings['mondaylist']) :
                                foreach ($settings['mondaylist'] as $item) :

                            ?>
                                    <tr>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?><?php echo esc_html__('-', 'themes-assistant'); ?> <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></td>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['class_type'] ) ); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="avatar" width="40" height="40">
                                                <span class="ml-3 mb-0 pr-4"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['coach_name'] ) ); ?></span>
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
            <div class="tab-pane fade" id="tuesday" role="tabpanel" aria-labelledby="tuesday-tab">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-skew mb-0">
                        <thead class="bg-white">
                            <tr>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['fcolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['scolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['tcolname'] ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($settings['tuesdaylist']) :
                                foreach ($settings['tuesdaylist'] as $item) :

                            ?>
                                    <tr>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></td>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['class_type'] ) ); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['coach_name'] ) ); ?></span>
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
            <div class="tab-pane fade" id="wednesday" role="tabpanel" aria-labelledby="wednesday-tab">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-skew mb-0">
                        <thead class="bg-white">
                            <tr>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['fcolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['scolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['tcolname'] ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($settings['wednesdaylist']) :
                                foreach ($settings['wednesdaylist'] as $item) :

                            ?>
                                    <tr>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></td>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['class_type'] ) ); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['coach_name'] ) ); ?></span>
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
            <div class="tab-pane fade" id="thursday" role="tabpanel" aria-labelledby="thursday-tab">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-skew mb-0">
                        <thead class="bg-white">
                            <tr>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['fcolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['scolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['tcolname'] ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($settings['thursdaylist']) :
                                foreach ($settings['thursdaylist'] as $item) :

                            ?>
                                    <tr>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></td>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['class_type'] ) ); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['coach_name'] ) ); ?></span>
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
            <div class="tab-pane fade" id="friday" role="tabpanel" aria-labelledby="friday-tab">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-skew mb-0">
                        <thead class="bg-white">
                            <tr>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['fcolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['scolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['tcolname'] ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($settings['fridaylist']) :
                                foreach ($settings['fridaylist'] as $item) :

                            ?>
                                    <tr>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></td>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['class_type'] ) ); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['coach_name'] ) ); ?></span>
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
            <div class="tab-pane fade" id="saturday" role="tabpanel" aria-labelledby="saturday-tab">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-skew mb-0">
                        <thead class="bg-white">
                            <tr>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['fcolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['scolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['tcolname'] ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($settings['saturdaylist']) :
                                foreach ($settings['saturdaylist'] as $item) :

                            ?>
                                    <tr>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></td>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['class_type'] ) ); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['coach_name'] ) ); ?></span>
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
            <div class="tab-pane fade" id="sunday" role="tabpanel" aria-labelledby="sunday-tab">
                <div class="table-responsive">
                    <table class="table table-borderless table-striped table-skew mb-0">
                        <thead class="bg-white">
                            <tr>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['fcolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['scolname'] ) ); ?></th>
                                <th><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $settings['tcolname'] ) ); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($settings['sundaylist']) :
                                foreach ($settings['sundaylist'] as $item) :

                            ?>
                                    <tr>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['start_time_value'] ) ); ?> <?php echo esc_html__('-', 'themes-assistant'); ?> <?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['end_time_value'] ) ); ?></td>
                                        <td><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['class_type'] ) ); ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid avatar avatar-sm" src="<?php echo esc_url($item['coach_photo']['url']); ?>" alt="">
                                                <span class="ml-3 mb-0 pr-4"><?php printf( esc_html__( '%s', 'themes-assistant' ), esc_html( $item['coach_name'] ) ); ?></span>
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
        </div>
    </div>
</div>