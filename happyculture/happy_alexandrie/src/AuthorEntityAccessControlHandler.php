<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\AuthorEntityAccessControlHandler.
 */

namespace Drupal\happy_alexandrie;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Author entity.
 *
 * @see \Drupal\happy_alexandrie\Entity\AuthorEntity.
 */
class AuthorEntityAccessControlHandler extends EntityAccessControlHandler {
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view author entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit author entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete author entities');
    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add author entities');
  }

}
