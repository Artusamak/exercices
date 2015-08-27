<?php

/**
 * @file
 * Contains \Drupal\happy_alexandrie\Service\GetCoverService.
 *
 * This code is used in the training exercise about services. It become useless
 * once the RemotePoster Plugin type is created.
 */

namespace Drupal\happy_alexandrie\Service;

use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Url;

/**
 * Class GetCoverService.
 *
 * @package Drupal\happy_alexandrie\Service
 */
class GetCoverService implements GetCoverServiceInterface {
  /**
   * The webservice url.
   *
   * @var string
   */
  protected $webservice_url;

  /**
   * GetCoverService constructor.
   */
  public function __construct() {
    $this->base_webservice_url = 'http://covers.openlibrary.org/b/isbn/!param-L.jpg';
  }

  /**
   * Helper function to get a cover.
   *
   * @param $param
   *   A parameter used by the service to get the cover.
   * @return string
   *   An url of the image cover.
   */
  public function getCover($param) {
    $url = SafeMarkup::format($this->base_webservice_url, array('!param' => $param));
    return  Url::fromUri($url);
  }
}
