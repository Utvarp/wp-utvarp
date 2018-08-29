<?php

use Vinelab\Rss\Rss;
 
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
        add_shortcode('utvarp_get_rss_link', [$this, 'getRSSLinkShortcode']);
        add_shortcode('utvarp_show_player', [$this, 'getPodcastPlayerShortcode']);
    }

    public function getPodcastPlayerShortcode($attributes)
    {
        if ($this->api->isOk() !== true) {
            return $this->api->isOk();
        }

        $show = $this->getShow($attributes);

        if (is_string($show)) {
            return $show;
        }

        $rss = new Rss();
        $feed = $rss->feed($show->podcasts_rss_url);

        $output="";

        foreach ($feed->articles as $item) {
            $output .= "<h1 class='utvarp-latest-podcasts-title'>{$item->title}<h1><p class='utvarp-latest-podcasts-paragraph'><audio controls class='utvarp-latest-podcasts-audio'><source src='{$item->enclosure}' type='audio/mpeg'></audio></p>";
        }
        
        return $output;
    }

    public function getRSSLinkShortcode($attributes)
    {
        if ($this->api->isOk() !== true) {
            return $this->api->isOk();
        }

        $show = $this->getShow($attributes);

        if (is_string($show)) {
            return $show;
        }
        
        return $show->podcasts_rss_url;
    }

    // helper function.

    public function getShow($attributes)
    {
        $uuid_is_set = $this->isUUIDSet($attributes);
        
        if ($uuid_is_set !== true) {
            return $uuid_is_set['msg'];
        };

        $show = $this->isShowFound($attributes);

        if (is_array($show)) {
            return $show['error'];
        } else {
            return $show;
        };
    }

    private function isUUIDSet($attributes)
    {
        if (!isset($attributes['uuid'])) {
            return ['continue' => false, 'msg' => "No identifier specified for this show."];
        }

        return true;
    }

    private function isShowFound($attributes)
    {
        $show = $this->api->getShow($attributes['uuid']);

        if (isset($show->error)) {
            return ['error' => "Cannot find a show for this identifier."];
        }

        return $show;
    }
}
