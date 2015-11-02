<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\Entity\AuthorEntity.
 */

namespace Drupal\happy_alexandrie\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\happy_alexandrie\AuthorEntityInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Author entity.
 *
 * @ingroup happy_alexandrie
 *
 * @ContentEntityType(
 *   id = "author_entity",
 *   label = @Translation("Author"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\happy_alexandrie\AuthorEntityListBuilder",
 *     "views_data" = "Drupal\happy_alexandrie\Entity\AuthorEntityViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\happy_alexandrie\Entity\Form\AuthorEntityForm",
 *       "add" = "Drupal\happy_alexandrie\Entity\Form\AuthorEntityForm",
 *       "edit" = "Drupal\happy_alexandrie\Entity\Form\AuthorEntityForm",
 *       "delete" = "Drupal\happy_alexandrie\Entity\Form\AuthorEntityDeleteForm",
 *     },
 *     "access" = "Drupal\happy_alexandrie\AuthorEntityAccessControlHandler",
 *   },
 *   base_table = "author_entity",
 *   admin_permission = "administer AuthorEntity entity",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "full_name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/author_entity/{author_entity}",
 *     "edit-form" = "/admin/author_entity/{author_entity}/edit",
 *     "delete-form" = "/admin/author_entity/{author_entity}/delete"
 *   },
 *   field_ui_base_route = "author_entity.settings"
 * )
 */
class AuthorEntity extends ContentEntityBase implements AuthorEntityInterface {
  use EntityChangedTrait;
  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Author entity.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Author entity.'))
      ->setReadOnly(TRUE);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Author entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValueCallback('Drupal\node\Entity\Node::getCurrentUserId')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['full_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Full name'))
      ->setDescription(t('The Full name of the Author entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['display_name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Displayed name'))
      ->setDescription(t('The name use in display of the AuthorEntity entity.'))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
         'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['birthdate'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Birth date'))
      ->setDescription(t('The birth date the Author entity.'))
      ->setSetting('datetime_type', 'date')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => array(
          'format_type' => 'html_date',
        ),
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'datetime_default',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['deathdate'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Death date'))
      ->setDescription(t('The death date the Author entity.'))
      ->setSetting('datetime_type', 'date')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'datetime_default',
        'settings' => array(
          'format_type' => 'html_date',
        ),
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'datetime_default',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code for the Author entity.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
