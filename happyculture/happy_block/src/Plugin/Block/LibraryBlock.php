<?php

/**
 * @file
 * Contains \Drupal\user\Plugin\Block\LibraryBlock.
 */

namespace Drupal\happy_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResultAllowed;

/**
 * Provides a 'Call to visit' block.
 *
 * @Block(
 *   id = "visit_library",
 *   admin_label = @Translation("Visit library"),
 * )
 */
class LibraryBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Keep the code but show this part only on the second part of the training
    // once we have the link view mode.
    if (false) {
      // Query against our entities.
      $query = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', 'happy_book')
        ->condition('changed', REQUEST_TIME, '<');

      $book_number = 2;
      if (!is_null($book_number) && is_numeric($book_number)) {
        $query->range(1, $book_number);
      }

      $nids = $query->execute();

      // Load the storage manager of our entity.
      $storage = \Drupal::entityManager()->getStorage('node');
      // Now we can load the entities.
      $nodes = $storage->loadMultiple($nids);

      return entity_view_multiple($nodes, 'link');
    }
    else {
      return array(
        '#markup' => \Drupal::l(t('Visit the library'), new Url('happy_query.query', array(), array(
          'attributes' => array(
            'title' => t('Visit the library.'),
          ),
        ))),
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return AccessResultAllowed::allowedIfHasPermission($account, 'access_happy_library');
  }

}