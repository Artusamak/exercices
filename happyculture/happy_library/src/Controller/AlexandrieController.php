<?php

/**
 * @file
 * Contains Drupal\happy_library\Controller\AlexandrieController.
 */

namespace Drupal\happy_library\Controller;

use Drupal\Core\Controller\ControllerBase;

class AlexandrieController extends ControllerBase {
  /**
   * Say hello to the world.
   *
   * @return string
   *   Return "Hello world!" string.
   */
  public function helloWorld() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello world!')
    ];
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
