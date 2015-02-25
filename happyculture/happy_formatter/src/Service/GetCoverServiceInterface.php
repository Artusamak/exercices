<?php

/**
 * @file
 * Contains \Drupal\happy_formatter\Service\GetCoverServiceInterface.
 */

namespace Drupal\happy_formatter\Service;

/**
 * Get Cover Service interface methods.
 */
interface GetCoverServiceInterface {

  /**
   * Helper function to fetch a result from the webservice.
   *
   */
  public function fetchResponse();

  /**
   * Helper function to get a cover.
   *
   *   An url of the image cover.
   */
  public function getCover();

}
