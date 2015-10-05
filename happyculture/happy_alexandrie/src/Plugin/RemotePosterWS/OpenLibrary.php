<?php

/**
 * @file
 * Contains \Drupal\happy_alexandrie\Plugin\RemotePosterWS\OpenLibrary.
 */

namespace Drupal\happy_alexandrie\Plugin\RemotePosterWS;

use Drupal\happy_alexandrie\RemotePosterWSPluginBase;
use Drupal\Core\Url;

/**
 * Fetch a cover from the openlibrary api web service.
 *
 * @RemotePosterWS(
 *   id = "openlibrary_remote_poster",
 *   name = "Book (from Open Library)"
 * )
 */
class OpenLibrary extends RemotePosterWSPluginBase {

  /**
   * Constructs a \Drupal\happy_alexandrie\Plugin\RemotePosterWS\OpenLibrary object.
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
    $this->base_webservice_url = 'http://covers.openlibrary.org/b/isbn';
  }

  /**
   * Build the webservice url with parameter, ready to be called.
   *
   * @var string
   *   The parameter used by the service to get the url of a poster.
   */
  public function buildWebserviceUrl($param) {
    $this->webservice_url_with_parameters = Url::fromUri($this->base_webservice_url . '/' . $param . '-L.jpg');
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
    return $this->webservice_url_with_parameters->toString();
  }
}
