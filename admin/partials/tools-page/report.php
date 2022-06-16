<?php 
require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'includes/class-wp-olakai-performance-testing-plugin-form-helper.php');
?>
<style>
    #wpfooter {
        position: static;
    }
</style>

<h3 class="h3">Results</h3>
<span class="font-weight-bold">Would you like to share these results?</span> You can copy and share the following public link.
<div class="my-2 alert alert-success">
    <a href="<?php 
        echo sprintf ("%s?%s", 
            @$_REQUEST['html'], 
            apply_filters( Wp_Olakai_Performance_Testing_Filters::OLAKAI_LINK_UTM_PARAMS, 'test-result')
        ) ?>" target="_blank">
        <?php echo @$_REQUEST['html'] ?>
    </a>
</div>
<div class="mt-3 result">
    <div>
        <div class="float-md-left">
            <strong>How's the result calculated?</strong> See <a target="_blank" href="https://web.dev/performance-scoring/">performance scoring</a>
        </div>
        <div class="float-md-right">
            Open results in a new window <a id='_open_report' target="_blank" href="<?php 
        echo sprintf ("%s?%s", 
            @$_REQUEST['html'], 
            apply_filters( Wp_Olakai_Performance_Testing_Filters::OLAKAI_LINK_UTM_PARAMS, 'test-result')
        ) ?>" title="Open lighthouse report">Open</a>
        </div>
        <div class="oc-clear-all"></div>
    </div>
    <iframe id="_olakai_report_content" src="<?php echo @$_REQUEST['local'] ? @$_REQUEST['local'] : "" ?>"></iframe>
</div>
