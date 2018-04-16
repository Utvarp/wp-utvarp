<?php
 
class Utvarp
{
 
    protected $loader;
 
    protected $plugin_slug;
 
    protected $version;
 
    public function __construct()
    {
 
        $this->plugin_slug = 'hello-utvarp';
        $this->version = '0.0.1';

        $this->load_dependencies();
        $this->define_admin_hooks();
        // $this->add_setting_page();
    }
 
    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-utvarp-admin.php';
 
        require_once plugin_dir_path(__FILE__) . 'class-utvarp-loader.php';

        $this->loader = new Utvarp_Loader();
    }
 
    private function define_admin_hooks()
    {
        $admin = new Utvarp_Admin($this->get_version());
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_styles');
        $this->loader->add_action('admin_init', $admin, 'settings_init');
        $this->loader->add_action('admin_menu', $admin, 'add_setting_page');
    }

    // private function add_setting_page()
    // {
    //     $admin = new Utvarp_Admin($this->get_version());
    //     $admin->settings_init();
    //     // $admin->add_setting_page();
    // }
 
    public function run()
    {
        $this->loader->run();
    }
 
    public function get_version()
    {
        return $this->version;
    }
}
