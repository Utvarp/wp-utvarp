<?php
 
class Utvarp_Shortcodes
{
 
    protected $version;
    protected $api;
 
    public function __construct($version, $api)
    {
        $this->version = $version;
        $this->api = $api;
    }

    public function init_shortcodes()
    {
        add_shortcode('utvarp_get_station_infos', [$this, 'get_station_infos']);
        add_shortcode('utvarp_get_rss_link', [$this, 'get_rss_link_shortcode']);
    }

    public function get_rss_link_shortcode($attributes)
    {
        if ($this->api->isOk() !== true) {
            return $this->api->isOk();
        }
        
        return $this->api->getShow($attributes['uuid'])->podcasts_rss_url;
    }
}
