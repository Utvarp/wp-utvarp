<?php
 
class Utvarp
{
 
    protected $loader;
 
    protected $plugin_slug;
 
    protected $version;

    protected $api;
 
    public function __construct()
    {
 
        $this->plugin_slug = 'hello-utvarp';
        $this->version = '0.0.1';
        $this->api_version = 'v1';

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_shortcodes_hooks();
    }
 
    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-utvarp-admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'shortcodes/class-utvarp-shortcodes.php';

        require_once plugin_dir_path(__FILE__) . 'class-utvarp-api.php';
 
        require_once plugin_dir_path(__FILE__) . 'class-utvarp-loader.php';

        $this->loader = new Utvarp_Loader();
        
        $this->api = new Utvarp_Api(
            $this->api_version,
            get_option('utvarp_api_key'),
            get_option('utvarp_station_uuid'),
            get_option('utvarp_stage_api')
        );
    }
 
    private function define_admin_hooks()
    {
        $admin = new Utvarp_Admin($this->get_version());
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_styles');
        $this->loader->add_action('admin_init', $admin, 'settings_init');
        $this->loader->add_action('admin_menu', $admin, 'add_setting_page');
    }

    private function define_shortcodes_hooks()
    {
        $shortcodes = new Utvarp_Shortcodes($this->get_version(), $this->api);
        $this->loader->add_action('init', $shortcodes, 'init_shortcodes');
    }
 
    public function run()
    {
        $this->loader->run();
    }
 
    public function get_version()
    {
        return $this->version;
    }
}
