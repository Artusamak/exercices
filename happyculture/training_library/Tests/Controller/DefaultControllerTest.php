<?php

/**
 * @file
 * Contains Drupal\training_library\Tests\DefaultController.
 */

namespace Drupal\training_library\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the training_library module.
 */
class DefaultControllerTest extends WebTestBase
 {





  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => "training_library DefaultController's controller functionality",
      'description' => 'Test Unit for module training_library and controller DefaultController.',
      'group' => 'Other',
    );
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests training_library functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module training_library.
    $this->assertEqual(TRUE, TRUE, 'Test Unit Generated via App Console.');
  }
}
