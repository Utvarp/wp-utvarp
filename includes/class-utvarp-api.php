<?php

class Utvarp_Api
{
    protected $station_uuid;
    protected $api_key;
    protected $api_version;
    protected $base_api_url;
    protected $api_urls;

    public function __construct($version, $key, $station_uuid, $use_staging, $use_local = false)
    {
        $this->api_version = $version;
        $this->api_key = $key;
        $this->station_uuid = $station_uuid;

        $this->api_urls = [
            'staging' => "https://api.stage.utvarp.co/{$this->api_version}",
            'live' => "https://api.utvarp.co/{$this->api_version}",
            'local' => "http://api.utvarp.co.test/{$this->api_version}",
        ];

        $this->base_api_url = $this->api_urls['live'];

        if ($use_staging == true) {
            $this->base_api_url = $this->api_urls['staging'];
        }

        if ($use_local == true) {
            $this->base_api_url = $this->api_urls['local'];
        }
    }

    public function isOk()
    {
        if ($this->missingInfosForApi()) {
            return e("***Missing configuration options in WP Admin***", 'utvarp');
        }

        return true;
    }

    private function missingInfosForApi()
    {
        return $this->api_key === false;
    }

    private function generateApiUrl($path, array $parameters)
    {
        $parameters['api_token'] = $this->api_key;
        $parameters = http_build_query($parameters);

        $url = "{$this->base_api_url}{$path}?{$parameters}";
        return $url;
    }

    private function call($path, array $parameters = [])
    {
        $response = wp_remote_get($this->generateApiUrl($path, $parameters));
        $body = wp_remote_retrieve_body($response);
        return json_decode($body);
    }

    /**
     * Get the station
     * @return array
     */
    public function getStation()
    {
        return $this->call("/self");
    }

    /**
     * Get all shows
     * @return array
     */
    public function getShows(bool $active = true)
    {
        return $this->call("/shows", ['active' => $active]);
    }

    /**
     * Get a show
     * @param  string $uuid The show's UUID
     * @return array
     */
    public function getShow($uuid = "empty")
    {
        return $this->call("/shows/{$uuid}");
    }

    /**
     * Get a station's musical entries for a specified date range
     * @param  string $start The date time string of the start of the search
     * @param  string $end The date time string of the end of the search
     * @return array
     */
    public function getStationMusicalEntries($start, $end)
    {
        return $this->call("/entries/from:{$start}/to:{$end}");
    }
}
