<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\AuthorEntityInterface.
 */

namespace Drupal\happy_alexandrie;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Author entities.
 *
 * @ingroup happy_alexandrie
 */
interface AuthorEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  // Add get/set methods for your configuration properties here.

}
