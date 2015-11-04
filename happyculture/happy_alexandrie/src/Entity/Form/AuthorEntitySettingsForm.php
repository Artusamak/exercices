<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\Entity\Form\AuthorEntitySettingsForm.
 */

namespace Drupal\happy_alexandrie\Entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AuthorEntitySettingsForm.
 *
 * @package Drupal\happy_alexandrie\Form
 *
 * @ingroup happy_alexandrie
 */
class AuthorEntitySettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'AuthorEntity_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Defines the settings form for Author entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['AuthorEntity_settings']['#markup'] = 'Settings form for Author entities. Manage field settings here.';
    return $form;
  }

}
