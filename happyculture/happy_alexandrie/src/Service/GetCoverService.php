<?php

/**
 * @file
 * Contains \Drupal\happy_alexandrie\Service\GetCoverService.
 *
 * This code is used in the training exercise about services. It become useless
 * once the RemotePoster Plugin type is created.
 */

namespace Drupal\happy_alexandrie\Service;

use GuzzleHttp\Client;

/**
 * Class GetCoverService.
 *
 * @package Drupal\happy_alexandrie\Service
 */
class GetCoverService implements GetCoverServiceInterface {

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
  private function setWebserviceUrl($webservice_url) {
    $this->webservice_url = $webservice_url;
  }

  /**
   * Helper function to get a cover.
   *
   * @param $url
   *   An url of the service to access to get the cover.
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
