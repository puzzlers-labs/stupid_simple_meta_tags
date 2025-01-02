<?php $active_tab = isset($_GET['tab']) && in_array($_GET['tab'], ['basic_configuration', 'advanced_configuration']) ? $_GET['tab'] : 'basic_configuration'; ?>
<div class="wrap">
    <h1>Stupid Simple Meta Tags (SSMT) Settings</h1>
    <h2 class="nav-tab-wrapper">
        <a href="?page=stupid_simple_meta_tags_settings&tab=basic_configuration" class="nav-tab <?php echo $active_tab === 'basic_configuration' ? 'nav-tab-active' : ''; ?>">Basic Configuration</a>
        <a href="?page=stupid_simple_meta_tags_settings&tab=advanced_configuration" class="nav-tab <?php echo $active_tab === 'advanced_configuration' ? 'nav-tab-active' : ''; ?>">Advanced Configuration</a>
    </h2>
    <?php
    if ($active_tab === 'advanced_configuration') {
        echo stupid_simple_meta_tags_settings_tab_advanced_configuration_render();
    } else {
        echo stupid_simple_meta_tags_settings_tab_basic_configuration_render();
    }
    ?>
</div>