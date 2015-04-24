<?php

/**
 * @file
 * Contains \Drupal\user\Plugin\Block\LibraryBlock.
 */

namespace Drupal\happy_alexandrie\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResultAllowed;

/**
 * Provides a 'Call to visit' block.
 *
 * @Block(
 *   id = "visit_library",
 *   admin_label = @Translation("Visit the library"),
 * )
 */
class LibraryBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Keep the code but show this part only on the second part of the training
    // once we have the link view mode.
    // @TODO:
    // Find the right way to manage the two potential behaviors.
    if (FALSE) {
      // Query against our entities.
      $query = \Drupal::entityQuery('node')
        ->condition('status', 1)
        ->condition('type', 'happy_book')
        ->condition('changed', REQUEST_TIME, '<');

      // @TODO:
      // Document this portion. Find a way to have something more consistent?
      // What are the intentions?
      $book_number = 2;
      if (!is_null($book_number) && is_numeric($book_number)) {
        $query->range(1, $book_number);
      }

      $nids = $query->execute();

      // Load the storage manager of our entity.
      $storage = \Drupal::entityManager()->getStorage('node');
      // Now we can load the entities.
      $nodes = $storage->loadMultiple($nids);

      // Make sure that we have content to display to the user, otherwise
      // display a polite message.
      if (count($nodes) > 0) {
        return entity_view_multiple($nodes, 'link');
      }
      else {
        return array(
          '#markup' => "<p>Aucun noeud n'est disponible pour le moment !</p>",
        );
      }
    }
    else {
      $options = array(
        'attributes' => array(
          'title' => $this->link_label(),
        ),
      );
      return array(
        '#type' => 'link',
        '#title' => $this->link_label(),
        '#url' => new Url('happy_query.query', array(), $options),
        '#prefix' => '<p>',
        '#suffix' => '</p>',
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function access(AccountInterface $account, $return_as_object = FALSE) {
    return AccessResultAllowed::allowedIfHasPermission($account, 'access_happy_library');
  }

  /**
   * Returns the custom label of the link.
   *
   * @return string
   *   The link label.
   */
  public function link_label() {
    if (!empty($this->configuration['link_label'])) {
      return $this->configuration['link_label'];
    }
    else {
      return t('Visit the library.');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $form['link_label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label of the link'),
      '#maxlength' => 255,
      '#default_value' => $this->link_label(),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    // Save our custom settings when the form is submitted.
    $this->setConfigurationValue('link_label', $form_state->getValue('link_label'));
  }
}