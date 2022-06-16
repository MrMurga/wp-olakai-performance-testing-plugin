<?php
    echo apply_filters(Wp_Olakai_Performance_Testing_Filters::OLAKAI_CTA_HEADER, null);

    $args = [
        'url' => @$_GET['url'],
        'html' => @$_GET['html'],
        'json' => @$_GET['json'],
        'local' => @$_GET['local'],
        'preset' => @$_GET['preset'],
    ]
?>
<script type="text/javascript">
    var _olakai = {
        admin: "<?php echo admin_url('admin.php'); ?>",
        tools: "<?php echo admin_url('tools.php'); ?>",
        action_report: "<?= $this->action_report ?>",
        action_lighthouse_run: "<?= $this->action_lighthouse_run ?>",
        query_args: <?php echo json_encode($args) ?>
    };
</script>
<div id="_olakai_container" class="container">
    <div class="row">
        <div class="col col-lg-6 col-md-6 col-sm-12">
            <div id="_olakai_form" class="">
                <?php
                    require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'admin/partials/tools-page/form.php');
                ?>
            </div>
            <div id="oc-signup" class="hidden">
                <?php
                    require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'admin/partials/tools-page/signup.php');
                ?>
            </div>
        </div>
        <div class="col col-lg-6 col-md-6">
            <?php
                require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'admin/partials/olakai_consulting_card.php');
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-12 col-md-12">
            <div id="_olakai_report" class="hidden">
                <?php
                    require_once(WP_OLAKAI_PERFORMANCE_TESTING_PLUGIN_PATH . 'admin/partials/tools-page/report.php');
                ?>
            </div>
        </div>
    </div
</div>
</div>

<?php
    echo apply_filters(Wp_Olakai_Performance_Testing_Filters::OLAKAI_CTA_FOOTER, null)
?>
