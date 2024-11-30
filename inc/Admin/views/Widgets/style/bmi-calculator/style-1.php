<form class="bmi-form bmi" id="form">
    <div class="form-row">
        <div class="form-field col-12">
            <p class="text"><?php echo esc_html__('Age', 'themes-assistant'); ?></p>
            <input type="number" class="text-input form-control" id="age" autocomplete="off" required  placeholder="<?php echo esc_attr('Enter Your age', 'themes-assistant'); ?>"/>
        </div>

        <div class="col-12">
            <div class="form-field">
                <p class="text"><?php echo esc_html__('Height (cm)', 'themes-assistant'); ?></p>
                <input type="number" class="text-input form-control" id="height" autocomplete="off" required  placeholder="<?php echo esc_attr('Enter Your height', 'themes-assistant'); ?>">
            </div>
            <div class="form-field">
                <p class="text"><?php echo esc_html__('Weight (kg)', 'themes-assistant'); ?></p>
                <input type="number" class="text-input form-control" id="weight" autocomplete="off" required  placeholder="<?php echo esc_attr('Enter Your weight', 'themes-assistant'); ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-field col-lg-3 col-sm-6">
            <label class="custom-label">
                <input type="radio" name="radio" id="f">
                <p class="text"><?php echo esc_html__('Female', 'themes-assistant'); ?></p>
                <span class="checkmark"></span>
            </label>
        </div>
        <div class="form-field col-lg-8 col-sm-6">
            <label class="custom-label">
                <input type="radio" name="radio" id="m">
                <p class="text"><?php echo esc_html__('Male', 'themes-assistant'); ?></p>
                <span class="checkmark"></span>
            </label>
        </div>
    </div>
    <button type="button" id="submit" class="btn "><?php echo esc_html__('Submit', 'themes-assistant'); ?></button>
    <div id="message"></div>
</form>
