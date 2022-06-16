<?php 
require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'includes/class-wp-olakai-performance-testing-plugin-form-helper.php');

$checked_desktop = (@$_GET['preset'] == 'desktop' ? "checked='true'" : "");
$checked_mobile = (@$_GET['preset'] != 'desktop' ? "checked='true'" : "");

?>

<h3 class="h3">Website</h3>
<form id="olakai-performance-form" class="form" action="<?php echo admin_url( 'admin.php' ); ?>" method="POST">
    <input class="form-control" type="hidden" name="action" value="<?= $this->action_lighthouse_run ?>" />
    <div class="form-group">
        <?php
            echo _olakai_func_add_field("text", "_olakai_url", "olakai[url]", @$_GET['url'], "https://www.olakaiconsulting.com", "URL");
        ?>
    </div>
    <div class="form-group">
        <div>
            <input type="radio" name="olakai[preset]" id="radio_mobile" value="mobile" <?= $checked_mobile ?> >
            <label for="radio_mobile">Mobile</label>
        </div>

        <div>
            <input type="radio" name="olakai[preset]" id="radio_desktop" value="desktop" <?= $checked_desktop ?>>
            <label for="radio_desktop">Desktop</label>
        </div>

    </div>
    <div class="form-group">
        <input type="submit" value="Run test" class=" btn btn-primary"/>
        &nbsp;|&nbsp;<a href="javascript:void(0);" onclick="jQuery('#oc-signup').slideDown()">Stay in touch</a>
        &nbsp;|&nbsp;<a href="<?php echo apply_filters(Wp_Olakai_Performance_Testing_Filters::OLAKAI_TESTING_PLUGIN_RUN, '') ?>">New Test</a>
    </div>
    <div id="olakai-performance-progress-bar-container" class="hidden">
        <div class="progress">
            <div id="olakai-performance-progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
        </div>
    </div>
</form>

