<?php

/**
 * @file
 * Contains \Drupal\happy_formatter\Service\GetCoverService.
 */

namespace Drupal\happy_formatter\Service;

use GuzzleHttp\Client;

/**
 * Class GetCoverService.
 *
 * @package Drupal\happy_formatter\Service
 */
class GetCoverService {

  /**
   * The webservice response.
   *
   * @var array
   */
  protected $response;

  /**
   * The webservice url.
   *
   * @var string
   */
  protected $webservice_url;

  /**
   * @param string $webservice_url
   */
  public function setWebserviceUrl($webservice_url) {
    $this->webservice_url = $webservice_url;
  }

  /**
   * Helper function to get a cover.
   *
   * @return string
   *   An url of the image cover.
   */
  public function getCover($url) {
    $this->setWebserviceUrl($url);
    try {
      $this->fetchResponse();
    } catch (\Exception $e) {
      // If an error occurred just reset the field value.
      return FALSE;
    };
    // Trick the API result to get a decent size of the book cover.
    $cover = str_replace('zoom=1', 'zoom=2', $this->response['items'][0]['volumeInfo']['imageLinks']['thumbnail']);
    return $cover;
  }

  /**
   * Helper function to fetch a result from the webservice.
   *
   */
  public function fetchResponse() {
    $client = new Client();
    $response = $client->get($this->webservice_url);
    $this->response = $response->json();
  }
}
