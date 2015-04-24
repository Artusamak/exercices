<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\authorEntityInterface.
 */

namespace Drupal\happy_alexandrie;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a AuthorEntity entity.
 * @ingroup account
 */
interface authorEntityInterface extends ContentEntityInterface, EntityOwnerInterface {


  // Add get/set methods for your configuration properties here.
}
