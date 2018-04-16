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
        $this->add_admin_menus();
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
    }

    private function add_admin_menus()
    {
        $admin = new Utvarp_Admin($this->get_version());
        $admin->add_option_page();
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
