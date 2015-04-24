<?php

/**
 * @file
 * Contains Drupal\happy_alexandrie\Entity\Form\authorEntitySettingsForm.
 */

namespace Drupal\happy_alexandrie\Entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class authorEntitySettingsForm.
 * @package Drupal\happy_alexandrie\Form
 * @ingroup happy_alexandrie
 */
class authorEntitySettingsForm extends FormBase {


  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'authorEntity_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param array $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Define the form used for AuthorEntity  settings.
   * @return array
   *   Form definition array.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param array $form_state
   *   An associative array containing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['authorEntity_settings']['#markup'] = 'Settings form for AuthorEntity. Manage field settings here.';
    return $form;
  }
}
