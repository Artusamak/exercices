<?php

/**
 * @file
 * Contains \Drupal\happy_alexandrie\Plugin\RemotePosterWS\GoogleRemotePoster.
 */

namespace Drupal\happy_alexandrie\Plugin\RemotePosterWS;

use Drupal\happy_alexandrie\RemotePosterWSPluginBase;
use GuzzleHttp\Client;
use Drupal\Core\Url;

/**
 * Fetch a cover from google api web service.
 *
 * @RemotePosterWS(
 *   id = "google_remote_poster",
 *   name = "Book (from Google Books)"
 * )
 */
class GoogleRemotePoster extends RemotePosterWSPluginBase {

  /**
   * Constructs a \Drupal\happy_alexandrie\Plugin\RemotePosterWS\GoogleRemotePoster object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->base_webservice_url = 'https://www.googleapis.com/books/v1/volumes';
  }

  /**
   * build the webservice url with parameter, ready to be called.
   *
   * @var string
   *   The parameter used by the service to get the url of a poster.
   */
  public function buildWebserviceUrl($param) {
    $options = array(
      'query' => array('q' => 'isbn:' . $param),
      'absolute' => TRUE,
      //'https' => true,
    );
    $this->webservice_url_with_parameters = Url::fromUri($this->base_webservice_url, $options);
  }

  /**
   * Call the web service with the good parameter to get the cover image url.
   *
   * @var string
   *   The parameter used by the service to get the url of a poster.
   *
   * @return string
   *   An url of the image cover.
   */
  public function getCover($param) {
    $this->buildWebserviceUrl($param);
    try {
      $this->fetchResponse();
    } catch (\Exception $e) {
      // If an error occurred just reset the field value.
      return FALSE;
    };

    return $this->extractCover();
  }

  /**
   * Extract the cover image url from the response webservice data.
   *
   * @return string
   *   An url of the image cover.
   */
  protected function extractCover() {
    // Trick the API result to get a decent size of the book cover.
    return str_replace('zoom=1', 'zoom=2', $this->response['items'][0]['volumeInfo']['imageLinks']['thumbnail']);
  }

  /**
   * Helper function to fetch a result from the webservice.
   */
  protected function fetchResponse() {
    $client = new Client();
    $response = $client->get($this->webservice_url_with_parameters->toString());
    $this->response = $response->json();
  }
}
