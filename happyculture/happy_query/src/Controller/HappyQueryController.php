<?php

/**
 * @file
 *
 */

namespace Drupal\happy_query\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * Returns responses for Happyquery module routes.
 */
class HappyQueryController extends ControllerBase {

  public function query() {

    // Query against our entities.
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('changed', REQUEST_TIME, '<');

    $nids = $query->execute();

    // Load the storage manager of our entity.
    $storage = \Drupal::entityManager()->getStorage('node');
    // Now we can load the entities.
    $nodes = $storage->loadMultiple($nids);

    return entity_view_multiple($nodes, 'teaser');
  }

  public function query_mode($view_mode) {

    $storage = \Drupal::entityManager()->getStorage('node');

    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('changed', REQUEST_TIME, '<');

    $nids = $query->execute();

    $nodes = $storage->loadMultiple($nids);

    return entity_view_multiple($nodes, $view_mode);

  }

}
