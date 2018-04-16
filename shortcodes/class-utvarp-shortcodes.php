<?php
 
class Utvarp_Shortcodes
{
 
    protected $version;
    protected $base_api_url;
 
    public function __construct($version)
    {
        $this->version = $version;

        $api_urls = [
            'staging' => "https://stage.utvarp.co/api",
            'live' => "https://app.utvarp.co/api",
        ];

        $this->base_api_url = get_option('utvarp_stage_api') == 1 ? $api_urls['staging'] : $api_urls['live'];
    }

    public function init_shortcodes()
    {
        add_shortcode('utvarp_get_rss_link', [$this, 'get_rss_link_shortcode']);
    }

    public function get_rss_link_shortcode($attributes)
    {
        return "attribute: {$attributes['id']}";
    }
}
