<?php

/**
 * @file
 * Contains Drupal\account\authorEntityAccessController.
 */

namespace Drupal\happy_alexandrie;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the AuthorEntity entity.
 *
 * @see \Drupal\happy_alexandrie\Entity\authorEntity.
 */
class authorEntityAccessControlHandler extends EntityAccessControlHandler {


  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view AuthorEntity entity');
        break;

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit AuthorEntity entity');
        break;

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete AuthorEntity entity');
        break;

    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add AuthorEntity entity');
  }
}
