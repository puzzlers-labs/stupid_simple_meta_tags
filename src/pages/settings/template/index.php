<?php
if (!defined('ABSPATH')) exit;

$tab_input  = isset($_GET['tab']) ? sanitize_text_field(wp_unslash($_GET['tab'])) : '';
$active_tab = in_array($tab_input, ['basic_configuration', 'advanced_configuration']) ? $tab_input : 'basic_configuration';
?>
<div class="wrap">
    <h1>Straightforward Simple Meta Tags (SSMT) Settings</h1>
    <h2 class="nav-tab-wrapper">
        <a href="?page=ssmt_settings&tab=basic_configuration" class="nav-tab <?php echo $active_tab === 'basic_configuration' ? 'nav-tab-active' : ''; ?>">Basic Configuration</a>
        <a href="?page=ssmt_settings&tab=advanced_configuration" class="nav-tab <?php echo $active_tab === 'advanced_configuration' ? 'nav-tab-active' : ''; ?>">Advanced Configuration</a>
    </h2>
    <?php if ($active_tab === 'advanced_configuration'): ?>
        <?php ssmt_settings_tab_advanced_configuration_render(); ?>
    <?php else: ?>
        <?php ssmt_settings_tab_basic_configuration_render(); ?>
    <?php endif; ?>
</div>