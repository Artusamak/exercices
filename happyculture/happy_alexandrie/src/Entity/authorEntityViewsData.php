<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\Entity\AuthorEntity.
 */

namespace Drupal\happy_alexandrie\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the AuthorEntity entity type.
 */
class authorEntityViewsData extends EntityViewsData implements EntityViewsDataInterface {


  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['author_entity']['table']['base'] = array(
      'field' => 'id',
      'title' => t('AuthorEntity'),
      'help' => t('The author_entity entity ID.'),
    );

    return $data;
  }


}
