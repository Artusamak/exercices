<?php

/**
 * @file
 *
 */

namespace Drupal\happy_query\Controller;

use Drupal\Core\Entity\EntityViewModeInterface;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Component\Utility\String;

/**
 * Returns responses for Happyquery module routes.
 */
class HappyQueryController extends ControllerBase {

  /**
   * Number of element to get.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  public $formBuilder;

  public function query() {

    $config = \Drupal::config('happy_forms.librarysettings');
    $book_number = $config->get('book_number');

    // Query against our entities.
    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('changed', REQUEST_TIME, '<');

    if (!is_null($book_number) && is_numeric($book_number)) {
      $query->range(0, $book_number);
    }

    $nids = $query->execute();

    if ($nids) {
      // Load the storage manager of our entity.
      $storage = \Drupal::entityManager()->getStorage('node');
      // Now we can load the entities.
      $nodes = $storage->loadMultiple($nids);

      return entity_view_multiple($nodes, 'list');
    }
    else {
      return array(
        '#markup' => 'No result'
      );
    }
  }

  public function query_mode(EntityViewModeInterface $viewmode) {

    $config = \Drupal::config('happy_forms.librarysettings');
    $book_number = $config->get('book_number');

    $query = \Drupal::entityQuery('node')
      ->condition('status', 1)
      ->condition('changed', REQUEST_TIME, '<');

    if (!is_null($book_number) && is_numeric($book_number)) {
      $query->range(0, $book_number);
    }

    $nids = $query->execute();

    if ($nids) {
      $storage = \Drupal::entityManager()->getStorage('node');
      $nodes = $storage->loadMultiple($nids);

      list($entity_type, $viewmode_name) = explode('.', $viewmode->getOriginalId());
      $build = entity_view_multiple($nodes, $viewmode_name);
      $build['#title'] = \Drupal::translation()->translate('Happy Query by view mode: @label', array('@label' => $viewmode->label()));
      return $build;
      }
    else {
      return array(
        '#markup' => 'No result'
      );
    }
  }

}
