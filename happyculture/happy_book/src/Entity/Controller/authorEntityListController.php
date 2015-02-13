<?php

/**
 * @file
 * Contains Drupal\happy_book\Entity\Controller\authorEntityListController.
 */

namespace Drupal\happy_book\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for AuthorEntity entity.
 *
 * @ingroup happy_book
 */
class authorEntityListController extends EntityListBuilder
 {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('authorEntityID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\happy_book\Entity\AuthorEntity */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
        $this->getLabel($entity),
        new Url(
          'entity.author_entity.canonical', array(
            'author_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }
}
