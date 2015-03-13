<?php

/**
 * @file
 * Contains \Drupal\happy_formatter\RemotePosterWSPluginBase.
 */

namespace Drupal\happy_formatter;

use Drupal\Core\Plugin\PluginBase;

/**
 * Defines a base Remote Poster WebService implementation.
 *
 * @see plugin_api
 */
abstract class RemotePosterWSPluginBase extends PluginBase implements RemotePosterWSInterface {

  /**
   * The webservice response.
   *
   * @var array
   */
  protected $response;

  /**
   * The base webservice url used to build the full url.
   *
   * @var string
   */
  protected $base_webservice_url;

  /**
   * The webservice url with parameter, ready to be called.
   *
   * @var string
   */
  protected $webservice_url_with_parameters;

  /**
   * build the webservice url with parameter, ready to be called.
   *
   * @var string
   *   The parameter used by the service to get the url of a poster.
   */
  public function buildWebserviceUrl($param) {
    $this->$webservice_url_with_parameters = $this->$base_webservice_url . '/' . $param;
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
  public function extractCover() {
    return $this->response['data']['cover'];
  }

  /**
   * Helper function to fetch a result from the webservice.
   */
  public function fetchResponse() {
    $client = new Client();
    $response = $client->get($this->$webservice_url_with_parameters);
    $this->response = $response->json();
  }
}
