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
   *   The webservice url to ask for a poster.
   *
   * @return string
   *   An url of the image cover.
   */
  public function getCover($webservice_url);

  /**
   * Extract the cover image url from the response webservice data.
   *
   * @return string
   *   An url of the image cover.
   */
  public function extractCover();

  /**
   * Helper function to fetch a result from the webservice.
   */
  public function fetchResponse();
}
