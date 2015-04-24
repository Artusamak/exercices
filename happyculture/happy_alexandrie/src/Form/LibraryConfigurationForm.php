<?php

/**
 * @file
 * Contains \Drupal\happy_alexandrie\Form\LibraryConfigurationForm
 */

namespace Drupal\happy_alexandrie\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class LibraryConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'happy_alexandrie.librarysettings',
    ];
  }

  public function getFormId() {
    return 'library_configuration';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('happy_alexandrie.librarysettings');

    $form['book_number'] = [
      '#type' => 'number',
      '#title' => $this->t('Number of book to display'),
      '#default_value' => $config->get('book_number'),
    ];
    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = \Drupal::configFactory()
      ->getEditable('happy_alexandrie.librarysettings');
    $config->set('book_number', $form_state->getValue('book_number'));
    $config->save();
    parent::submitForm($form, $form_state);
  }
}