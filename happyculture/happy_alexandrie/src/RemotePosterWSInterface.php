<?php

/**
 * @file
 * Contains \Drupal\happy_alexandrie\RemotePosterWSInterface.
 */

namespace Drupal\happy_alexandrie;

/**
 * Defines an interface for Remote Poster Webservice items.
 *
 * @see plugin_api
 */
interface RemotePosterWSInterface {

  /**
   * Used for returning values by key.
   *
   * @var string
   *   The webservice url to ask for a poster.
   */
  public function buildWebserviceUrl($webservice_url);

  /**
   * Call the web service with the good parameter to get the cover image url.
   *
   * @var string
   *   The parameter used by the service to get the url of a poster. An isbn
   *   number most of the time.
   *
   * @return string
   *   An url of the image cover.
   */
  public function getCover($param);
}
