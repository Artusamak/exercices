<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\AuthorEntityListBuilder.
 */

namespace Drupal\happy_alexandrie;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Author entities.
 *
 * @ingroup happy_alexandrie
 */
class AuthorEntityListBuilder extends EntityListBuilder {
  use LinkGeneratorTrait;
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Author ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\happy_alexandrie\Entity\AuthorEntity */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $this->getLabel($entity),
      new Url(
        'entity.author_entity.edit_form', array(
          'author_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
