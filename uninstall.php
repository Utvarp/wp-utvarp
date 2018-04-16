<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
 
$options = ['utvarp_api_key', 'utvarp_stage_api', 'utvarp_station_uuid'];

foreach ($options as $option) {
    delete_option($option);
}
