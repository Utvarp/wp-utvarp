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

    public function settings_init()
    {
        register_setting('utvarp', 'utvarp_api_key');
        register_setting('utvarp', 'utvarp_stage_api');
        register_setting('utvarp', 'utvarp_station_uuid');

        add_settings_section(
            'utvarp_api_section',
            __('API Informations', 'utvarp'),
            array( $this, 'render_api_section' ),
            'utvarp'
        );

        add_settings_field(
            'utvarp_api_key',
            __('Api Key', 'utvarp'),
            array( $this, 'render_api_field' ),
            'utvarp',
            'utvarp_api_section'
        );

        add_settings_field(
            'utvarp_station_uuid',
            __("Your station's indentifier", 'utvarp'),
            array( $this, 'render_station_uuid_field' ),
            'utvarp',
            'utvarp_api_section'
        );

        add_settings_field(
            'utvarp_stage_api',
            __('Use staging API (development only)', 'utvarp'),
            array( $this, 'render_stage_api_field' ),
            'utvarp',
            'utvarp_api_section'
        );
    }

    public function render_api_section()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-settings-api-section.php';
    }

    public function render_station_uuid_field()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-settings-uuid-field.php';
    }

    public function render_api_field()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-settings-api-field.php';
    }

    public function render_stage_api_field()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-settings-stage-api-field.php';
    }

    public function add_setting_page()
    {
        add_menu_page(
            "Útvarp's options",
            'Útvarp',
            'manage_options',
            'utvarp',
            array( $this, 'render_utvarp_setting_page' ),
            plugin_dir_url(__FILE__) . 'images/radio-icon-by-Catalin-Fertu-from-flaticon.png',
            81
        );
    }

    public function render_utvarp_setting_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-settings-page.php';
    }
}
