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
            'staging' => "https://api.stage.utvarp.co/{$this->api_version}",
            'live' => "https://api.utvarp.co/{$this->api_version}",
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
