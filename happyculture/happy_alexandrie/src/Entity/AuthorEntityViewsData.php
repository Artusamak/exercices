<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\Entity\AuthorEntity.
 */

namespace Drupal\happy_alexandrie\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides Views data for Author entities.
 */
class AuthorEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {
  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['author_entity']['table']['base'] = array(
      'field' => 'id',
      'title' => $this->t('Author'),
      'help' => $this->t('The Author ID.'),
    );

    return $data;
  }

}
