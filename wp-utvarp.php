<?php

/*
 * This file is part of the Hello Útvarp plugin for WordPress.
 *
 * (c) Jean-Philippe Murray <jp@utvarp.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Hello Utvarp is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.
 */

/*
* Plugin Name: Hello Útvarp
* Description: Facilitates the integration of Útvarp's services into WordPress.
* Author: Útvarp
* Author URI: https://utvarp.co
* Version: 0.0.1
* Plugin URI: https://github.com/Utvarp/wp-utvarp
* Text Domain: wputvarp
* Domain Path:  /languages
* License: MPL-2.0
*/

if (! defined('WPINC')) {
    die;
}

require_once plugin_dir_path(__FILE__) . 'includes/class-utvarp.php';
 
function run_utvarp()
{
 
    $utvarp = new Utvarp();
    $utvarp->run();
}
 
run_utvarp();
