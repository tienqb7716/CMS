<?php
// exit if accessed directly
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

$option_name = 'wpmte_options';
delete_option($option_name);
delete_site_option($option_name);
?>
