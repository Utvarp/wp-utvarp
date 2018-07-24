<?php

class Utvarp_Api
{
    protected $station_uuid;
    protected $api_key;
    protected $api_version;
    protected $base_api_url;
    protected $api_urls;

    public function __construct($version, $key, $station_uuid, $use_staging)
    {
        $this->api_version = $version;
        $this->api_key = $key;
        $this->station_uuid = $station_uuid;

        $this->api_urls = [
            'staging' => "https://stage.utvarp.co/api/{$this->api_version}",
            'live' => "https://app.utvarp.co/api/{$this->api_version}",
        ];

        $this->base_api_url = $use_staging == 1 ? $this->api_urls['staging'] : $this->api_urls['live'];
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
        return $this->station_uuid === false || $this->api_key === false;
    }

    private function generateApiUrl($path)
    {
        return "{$this->base_api_url}/station/{$this->station_uuid}{$path}?api_token={$this->api_key}";
    }

    private function call($path)
    {
        $response = wp_remote_get($this->generateApiUrl($path));
        $body = wp_remote_retrieve_body($response);
        return json_decode($body);
    }

    /**
     * Get the station
     * @return array
     */
    public function getStation()
    {
        return $this->call("/");
    }

    /**
     * Get the programmation
     * @return array
     */
    public function getProgramming()
    {
        return $this->call("/programming");
    }

    /**
     * Get all users
     * @return array
     */
    public function getUsers()
    {
        return $this->call("/users");
    }

    /**
     * Get all shows
     * @return array
     */
    public function getShows()
    {
        return $this->call("/shows");
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
     * Get all of a show's logs
     * @param  string $uuid The show's UUID
     * @return array
     */
    public function getShowLogs($uuid = "empty")
    {
        return $this->call("/shows/{$uuid}/logs");
    }

    /**
     * Get a show's logs entries
     * @param  string $uuid The show's UUID
     * @return array
     */
    public function getShowLogEntries($uuid = "empty", $log = "empty")
    {
        return $this->call("/shows/{$uuid}/logs/{$log}/entries");
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
