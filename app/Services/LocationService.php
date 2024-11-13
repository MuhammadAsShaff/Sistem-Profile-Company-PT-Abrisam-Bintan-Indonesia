<?php

namespace App\Services;

use GuzzleHttp\Client;

class LocationService
{
  protected $client;

  public function __construct()
  {
    $this->client = new Client();
  }

  public function getAddressFromCoordinates($latitude, $longitude)
  {
    $apiKey = env('LOCATIONIQ_API_KEY');
    $url = "https://us1.locationiq.com/v1/reverse.php?key={$apiKey}&lat={$latitude}&lon={$longitude}&format=json";

    $response = $this->client->get($url);
    $data = json_decode($response->getBody(), true);

    return $data;
  }
}
