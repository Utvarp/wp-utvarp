<?php

use Cake\Chronos\Chronos;

class UtvarpMusicEntriesAjax
{

    protected $version;
    protected $api;

    public function __construct($version, $api)
    {
        $this->version = $version;
        $this->api = $api;
    }

    public function enqueue_scripts()
    {
        wp_register_script(
            'utvarp-music-entries-script',
            plugin_dir_url(__FILE__) . 'js/utvarp-musical-entries-ajax-search.js',
            array(),
            $this->version,
            true
        );

        wp_enqueue_script('utvarp-music-entries-script');

        $nonce = wp_create_nonce('utvarp-music-entries');

        wp_localize_script('utvarp-music-entries-script', 'utvarp', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => $nonce,
        ));
    }

    public function run()
    {
        check_ajax_referer('utvarp-music-entries', 'nonce');

        $station = $this->api->getStation();
        $results = $this->api->getStationMusicalEntries($_POST['from'], $_POST['to']);

        echo json_encode([
            'from' => Chronos::parse($_POST['from'], $station->timezone)->startOfDay(),
            'to' => Chronos::parse($_POST['to'], $station->timezone)->startOfDay(),
            'results' => $results
        ]);

        die();
    }
}
