<?php
 
class Utvarp_Admin
{
 
    protected $version;
    protected $api;
 
    public function __construct($version, $api)
    {
        $this->version = $version;
        $this->api = $api;
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
        register_setting('utvarp', 'utvarp_local_api');
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

        add_settings_field(
            'utvarp_local_api',
            __('Use local API (development only)', 'utvarp'),
            array( $this, 'render_local_api_field' ),
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

    public function render_local_api_field()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-settings-local-api-field.php';
    }

    public function add_utvarp_admin_pages()
    {
        add_menu_page(
            "Útvarp's options",
            'Útvarp',
            'manage_options',
            'utvarp',
            array( $this, 'render_utvarp_home_page' ),
            plugin_dir_url(__FILE__) . 'images/radio-icon-by-Catalin-Fertu-from-flaticon.png',
            81
        );

        add_submenu_page(
            'utvarp',
            e('Plugin settings', 'utvarp'),
            e('Settings', 'utvarp'),
            'manage_options',
            'utvarp-settings',
            array( $this, 'render_utvarp_setting_page' )
        );

        add_submenu_page(
            'utvarp',
            e('List of active shows', 'utvarp'),
            e('Shows', 'utvarp'),
            'manage_options',
            'utvarp-shows',
            array( $this, 'render_utvarp_shows_page' )
        );

        add_submenu_page(
            'utvarp',
            e('List available shortcodes', 'utvarp'),
            e('Shortcodes', 'utvarp'),
            'manage_options',
            'utvarp-shortcodes',
            array( $this, 'render_utvarp_shortcodes_page' )
        );
    }

    public function render_utvarp_home_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-home-page.php';
    }

    public function render_utvarp_shortcodes_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-shortcodes-page.php';
    }

    public function render_utvarp_shows_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-shows-page.php';
    }

    public function render_utvarp_setting_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/utvarp-settings-page.php';
    }
}
