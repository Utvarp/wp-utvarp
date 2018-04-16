<?php
 
class Utvarp_Admin
{
 
    protected $version;
 
    public function __construct($version)
    {
        $this->version = $version;
    }
 
    public function enqueue_styles()
    {
        wp_enqueue_style(
            'utvarp-admin',
            plugin_dir_url(__FILE__) . 'css/utvarp.css',
            array(),
            $this->version,
            false
        );
    }
 
    public function add_option_page()
    {

        add_menu_page(
            'Utvarp',
            'Útvarp',
            'manage_options',
            plugin_dir_path(__FILE__) . 'partials/utvarp-admin-page.php',
            null,
            plugin_dir_url(__FILE__) . 'images/radio-icon-by-Catalin-Fertu-from-flaticon.png',
            81
        );
    }
}
