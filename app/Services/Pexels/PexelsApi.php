<?php

namespace App\Services\Pexels;

use Illuminate\Support\Facades\Http;

class PexelsApi
{
  private $httpClient;
  private $apiBaseUrl = 'https://api.pexels.com/v1/';

  public function __construct()
  {
    $apiKey = config('services.pexels.key');

    $this->httpClient = Http::withToken($apiKey)->baseUrl($this->apiBaseUrl);
  }

  /**
   * Return search results
   * @param string $searchQuery
   * @return PhotosSearchResponse
   */
  public function search(string $searchQuery)
  {
    $array = $this->httpClient->get(
      'search',
      array_merge(
        ['query' => $searchQuery],
        [
          'orientation' => 'landscape',
        ]
      )
    )->json();

    return $array;
  }
}
