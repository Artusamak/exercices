<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\Controller\AlexandrieController.
 */

namespace Drupal\happy_alexandrie\Controller;

use Drupal\Core\Controller\ControllerBase;

class AlexandrieController extends ControllerBase {
  /**
   * Say hello to the world.
   *
   * @return string
   *   Return "Hello world!" string.
   */
  public function helloWorld() {
    $content = [
      '#type' => 'markup',
      '#markup' => $this->t('Hello world!')
    ];
    // Second version displaying the opening hours of the library.
    $opening_hours = $this->config('happy_alexandrie.library_config')->get('opening_hours');
    if (!empty($opening_hours)) {
      $content = [
        'content' => [
          '#markup' => $this->t('<p>Greetings dear adventurer!</p><p>Opening hours:<br />@opening_hours</p>', array('@opening_hours' => $opening_hours)),
        ]
      ];
    }
    return $content;
  }

  /**
   * Say hello to the visitor.
   *
   * @return string
   *   Return a welcoming string.
   */
  public function hello($name) {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello @name!', ['@name' => $name])
    ];
  }
}
